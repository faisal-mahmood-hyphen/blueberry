<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\Customers\AddCustomerRequest;
use App\Http\Requests\Customers\DeleteCustomerRequest;
use App\Http\Requests\Customers\EditCustomerRequest;
use App\Http\Resources\ResourceCustomer;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-customer')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if (!$request->ajax()) {
            $active = 'customers';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Customers',
                    'url' => url('admin/customers'),
                    'active' => 'customers',
                ]
            ];
            $statuses = StatusEnum::values();
            $roles = Role::where('status',StatusEnum::ACTIVE)->whereNotIn('id', [3])->orderBy('name','asc')->get();
            return view('customers', compact(
                'active',
                'breadCrumbs',
                'permissions',
                'roles',
                'statuses'
            ));
        } else {
            $roleId = 3;

            $model = User::query()
                ->whereHas('role', function ($query) use ($roleId) {
                    $query->where('role_id', $roleId);
                })
                ->with(['role'])
                ->get();

            return DataTables::of($model)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->editColumn('image', function ($data) {
                    if (!empty($data->image)) {
                        return '<img src="' . $data->src . '" alt="Customer Image" width="75"/>';
                    }

                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $data->src = asset('storage/images/customers/' . $data->image);
                    $html = "";

                        if (hasPermissions($permissions, 'edit-customer')) {
                            $html .= "<a title='Edit Customer' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                        }
                        if (hasPermissions($permissions, 'delete-customer')) {
                            $html .= '<a title="Delete Customer" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                        }


                    return $html;
                })->rawColumns(['actions', 'image'])->make(true);
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCustomerRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New Customer created successfully!";
        $data = $request->all();
        unset($data['image']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'customers_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/customers', $imageName);
            $data['image'] = $imageName;
        }
        $data['role_id'] = 3;
        $data['password'] = Hash::make($data['password']);
        $data['email_verified_at'] = date('Y-m-d H:i:s');
        $response['data'] = new ResourceCustomer(User::create($data));
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditCustomerRequest $request)
    {

        $response['status'] = true;
        $response['message'] = "Customer Updated successfully!";
        $data = $request->all();
        $user = User::where('id', $request->id)->first();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->status = $data['status'];
        $user->nationality = $data['nationality'];
        $user->gender = $data['gender'];
        $user->dob = $data['dob'];
        if(!empty($request->password)){
            $user->password = Hash::make($data['password']);
        }
        unset($data['image']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'customers_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/customers', $imageName);
            $user->image = $imageName;
        }
        $user->save();
        $response['data'] = new ResourceCustomer($user);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteCustomerRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Customer Deleted successfully!";
        $category = User::where('id', $request->id)->first();
        $category->delete();
        $response['data'] = new ResourceCustomer($category);
        return response()->json($response);
    }



}
