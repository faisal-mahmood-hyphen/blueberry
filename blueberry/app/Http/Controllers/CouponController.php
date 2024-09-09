<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\Categories\AddCategoryRequest;
use App\Http\Requests\Categories\CategoriesRequest;
use App\Http\Requests\Categories\DeleteCategoryRequest;
use App\Http\Requests\Categories\EditCategoryRequest;
use App\Http\Requests\Coupons\AddCouponRequest;
use App\Http\Requests\Coupons\DeleteCouponRequest;
use App\Http\Requests\Coupons\EditCouponRequest;
use App\Http\Resources\ResourceCategory;
use App\Http\Resources\ResourceCoupon;
use App\Http\Resources\ResourceFeature;
use App\Models\Category;

use App\Models\Coupon;
use App\Models\User;
use App\Models\UserCoupon;
use App\Repositories\CategoryRepo;
use App\Repositories\FeatureRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-coupon')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if (!$request->ajax()) {
            $active = 'coupons';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Coupons',
                    'url' => url('admin/coupons'),
                    'active' => 'coupons',
                ]
            ];
            return view('coupons', compact(
                'active',
                'breadCrumbs',
                'permissions',
            ));
        } else {
            $model = Coupon::query();

            return DataTables::of($model)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $html = "";
                    if (hasPermissions($permissions, 'edit-coupon')) {
                        $html .= "<a title='Edit Coupon' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                    }
//                    if (hasPermissions($permissions, 'show-coupon')) {
//                        $html .= '<a href="' . route('coupons.show', ['couponId' => $data->id]) . '" class="btn btn-success m-1 show-record" data-id="' . $data->id . '"><i class="fas fa-eye"></i></a>';
//                    }
                    if (hasPermissions($permissions, 'assign-coupon')) {
                        $html .= '<a href="' . route('coupons.assign', ['couponId' => $data->id]) . '" class="btn btn-success m-1 show-record" data-id="' . $data->id . '" title="Assign Coupoon"><i class="fas fa-user" ></i></a>';
                    }
                    if (hasPermissions($permissions, 'delete-coupon')) {
                        $html .= '<a title="Delete Coupon" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                    }
                    return $html;
                })->rawColumns(['actions'])->make(true);
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCouponRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New Coupon created successfully!";
        $data = $request->all();
        $response['data'] = new ResourceCoupon(Coupon::create($data));
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditCouponRequest $request)
    {

        $response['status'] = true;
        $response['message'] = "Coupon Updated successfully!";
        $data = $request->all();
        $coupon = Coupon::where('id', $request->id)->first();
        $coupon->coupons = $data['coupons'];
        $coupon->validity = $data['validity'];
        $coupon->no_of_uses = $data['no_of_uses'];
        $coupon->save();
        $response['data'] = new ResourceCoupon($coupon);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteCouponRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Coupon Deleted successfully!";
        $category = Coupon::where('id', $request->id)->first();
        $category->delete();
        $response['data'] = new ResourceCoupon($category);
        return response()->json($response);
    }

    public function assign(Request $request, $couponId)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'assign-coupon')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        $coupon = Coupon::where('id', $couponId)->first();
        if (!$coupon) {
            return redirect('admin/coupons');
        }
        $active = 'coupons';
        $breadCrumbs = [
            [
                'name' => 'Dashboard',
                'url' => url('/')
            ],
            [
                'name' => 'Coupons',
                'url' => url('admin/coupons'),
            ],
            [
                'name' => 'Assign Coupons to Users',
                'url' => url('admin/coupons'),
                'active' => 'coupons',
            ]
        ];
        $assignedUserIds = UserCoupon::where('coupons_id', $couponId)->pluck('user_id')->toArray();
        $users = User::where('role_id',3)->get();
        return view('assign_coupons', compact('active', 'breadCrumbs', 'permissions','coupon','users','assignedUserIds'));
    }
    public function assignCoupon(Request $request, $couponId)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'assign-permission')) {
            abort(403, 'Unauthorized');
        }

        $coupon = Coupon::find($couponId);

        if (!$coupon) {
            return redirect('admin/coupons');
        }

        $data = $request->all();

        if (isset($data['user_ids']) && is_array($data['user_ids']) && count($data['user_ids'])) {
            UserCoupon::where('coupons_id', $couponId)->delete();
            $now = Carbon::now()->toDateTimeString();
            $userCouponData = [];
            foreach ($data['user_ids'] as $userId) {
                $userCouponData[] = [
                    'coupons_id' => $couponId,
                    'user_id' => $userId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            UserCoupon::insert($userCouponData);
        }
        else{
            UserCoupon::where('coupons_id', $couponId)->delete();
        }

        return redirect()->route('coupons.assign', ['couponId' => $couponId])->with(['success' => "Coupon Assigned Successfully"]);
    }
}
