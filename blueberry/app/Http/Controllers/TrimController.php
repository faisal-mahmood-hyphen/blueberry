<?php

namespace App\Http\Controllers;

use App\Http\Requests\Trims\AddTrimRequest;
use App\Http\Requests\Trims\DeleteTrimRequest;
use App\Http\Requests\Trims\EditTrimRequest;
use App\Http\Resources\ResourceTrim;
use App\Models\Brand;
use App\Models\Models;
use App\Models\Trim;
use App\Models\Module;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Enums\StatusEnum;

class TrimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-trim')) {
            abort(403, 'Unauthorized');
        }

        if (!$request->ajax()) {
            $active = 'trims';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Car Trims',
                    'url' => url('admin/car-trims'),
                    'active' => 'trims',
                ]
            ];
            $statuses = StatusEnum::values();
            $brands = Brand::where('status',StatusEnum::ACTIVE)->orderBy('name','asc')->get();

            return view('trims', compact('active', 'breadCrumbs', 'permissions', 'statuses','brands'));
        } else {
            $carTrim = Trim::query();

            return DataTables::of($carTrim)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->editColumn('brand_id', function ($data) {
                    return $data->brands?->name;
                })
                ->editColumn('model_id', function ($data) {
                    return $data->models?->name;
                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $html = "";
                        if (hasPermissions($permissions, 'edit-trim')) { // Changed 'edit-trim' to 'edit-brand'
                            $html .= "<a title='Edit Trim' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                        }
                        if (hasPermissions($permissions, 'delete-trim')) { // Changed 'delete-trim' to 'delete-brand'
                            $html .= '<a title="Delete Trim" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                        }
                    return $html;
                })->rawColumns(['actions'])->make(true);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddTrimRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New trims created successfully!";
        $data = $request->validated();
        $response['data'] = new ResourceTrim(Trim::create($data));
        return response()->json($response);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(EditTrimRequest $request)
    {

        $response['status'] = true;
        $response['message'] = "Trims Updated successfully!";
        $data = $request->validated();
        $trim = Trim::where('id', $request->id)->first();
        $trim->trims = $data['trims'];
        $trim->status = $data['status'];
        $trim->model_id = $data['model_id'];
        $trim->brand_id = $data['brand_id'];
        $trim->save();
        $response['data'] = new ResourceTrim($trim);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteTrimRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Car Trims Deleted successfully!";
        $trim = Trim::where('id', $request->id)->first();
        $trim->delete();
        $response['data'] = new ResourceTrim($trim);
        return response()->json($response);
    }
    Public function model($brandId)
    {
        $models = Models::where('brand_id',$brandId)->where('status',StatusEnum::ACTIVE)->get();
        return response()->json($models);
    }
    public function getTrims(Request $request)
    {
        $trims = Trim::where('status',StatusEnum::ACTIVE);
        if($request->has('model_id')){
            $trims->where('model_id',$request->model_id);
        }

        return $trims->get();
    }
}
