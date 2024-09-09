<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\B2B\AddB2BRequest;
use App\Http\Requests\B2b\EditB2BRequest;
use App\Http\Requests\Users\DeleteUserRequest;
use App\Http\Requests\Users\EditUserRequest;
use App\Http\Resources\ResourceB2B;
use App\Models\User;
use App\Models\Role;

use App\Repositories\CategoryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class B2BController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-b2b')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if (!$request->ajax()) {
            $active = 'b2bs';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'B2B User',
                    'url' => url('admin/b2bs'),
                    'active' => 'b2bs',
                ]
            ];
            $statuses = StatusEnum::values();
            $roles = Role::where('status',StatusEnum::ACTIVE)->whereNotIn('id', [3])->orderBy('name','asc')->get();
            return view('b2bs', compact(
                'active',
                'breadCrumbs',
                'permissions',
                'roles',
                'statuses'
            ));
        } else {
            $roleId = 4;

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
                ->editColumn('role_id', function ($data) {
                    return $data->role?->name;
                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $html = "";


                        if (hasPermissions($permissions, 'edit-b2b')) {
                            $html .= "<a title='Edit User' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                        }
                        if (hasPermissions($permissions, 'delete-customer')) {
                            $html .= '<a title="Delete User" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                        }


                    return $html;
                })->rawColumns(['actions'])->make(true);
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddB2BRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New B2B User created successfully!";
        $data = $request->all();
        $data['role_id'] = 4;
        $data['password'] = Hash::make($data['password']);
        $data['email_verified_at'] = date('Y-m-d H:i:s');
        $response['data'] = new ResourceB2B(User::create($data));
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditB2BRequest $request)
    {

        $response['status'] = true;
        $response['message'] = "User Updated successfully!";
        $data = $request->all();
        $user = User::where('id', $request->id)->first();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->status = $data['status'];
        if(!empty($request->password)){
            $user->password = Hash::make($data['password']);
        }
        $user->save();
        $response['data'] = new ResourceB2B($user);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteUserRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "User Deleted successfully!";
        $category = User::where('id', $request->id)->first();
        $category->delete();
        $response['data'] = new ResourceB2B($category);
        return response()->json($response);
    }
}
