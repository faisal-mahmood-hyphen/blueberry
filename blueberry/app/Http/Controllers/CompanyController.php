<?php

namespace App\Http\Controllers;

use App\Enums\CompanyStatusEnum;
use App\Enums\RequestStatusEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\B2B\AddB2BRequest;
use App\Http\Requests\B2b\EditB2BRequest;
use App\Http\Requests\Companies\EditCompanyRequest;
use App\Http\Requests\Users\DeleteUserRequest;
use App\Http\Requests\Users\EditUserRequest;
use App\Http\Resources\ResourceB2B;
use App\Http\Resources\ResourceCompany;
use App\Models\User;
use App\Models\Role;

use App\Repositories\CategoryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-company')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if (!$request->ajax()) {
            $active = 'companies';
            $breadCrumbs = [
                [
                    'name' => 'Companies',
                    'url' => url('/')
                ],
                [
                    'name' => 'Companies',
                    'url' => url('admin/companies'),
                    'active' => 'companies',
                ]
            ];
            $requestStatus = RequestStatusEnum::values();
            $companyStatus = CompanyStatusEnum::values();
            return view('companies', compact(
                'active',
                'breadCrumbs',
                'permissions',
                'requestStatus',
                'companyStatus'
            ));
        } else {

            $model = User::where('is_company_account',1)->get();
            return DataTables::of($model)
                ->editColumn('logo', function ($data) {
                    if (!empty($data->logo)) {
                        $data->src = asset('storage/images/companies/logos/' . $data->logo);
                        return '<img src="' . $data->src . '" alt="Company Logo" width="75"/>';
                    }

                })
                ->addColumn('requested_status', function ($data) {
                    $statusColor = '';

                    switch ($data->requested_status) {
                        case 'Pending':
                            $statusColor = '<span class="badge badge-primary"><i class="fa fa-question" aria-hidden="true" style="margin-right: 5px"></i>Pending</span>';
                            break;
                        case 'Approved':
                            $statusColor = '<span class="badge badge-success"><i class="fa fa-check" aria-hidden="true" style="margin-right: 5px;"></i>Approved</span>';
                            break;
                        case 'Rejected':
                            $statusColor = '<span class="badge badge-danger"><i class="fa fa-times" aria-hidden="true" style="margin-right: 5px;"></i>Rejected</span>';
                            break;
                        default:
                            $statusColor = "N/A";
                            break;
                    }

                    return $statusColor;
                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $html = "";

                        if (hasPermissions($permissions, 'edit-user')) {
                            $html .= "<a title='Edit User' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                        }
                    return $html;
                })->rawColumns(['actions','requested_status','logo'])->make(true);
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
    public function update(EditCompanyRequest $request)
    {

        $response['status'] = true;
        $response['message'] = "User Updated successfully!";
        $data = $request->all();
        $user = User::where('id', $request->id)->first();
        $user->requested_status = $data['requested_status'];
        $user->company_role = $data['company_role'];
        $user->rejection_reason = $data['rejection_reason'];
        $user->save();
        $response['data'] = new ResourceCompany($user);
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
