<?php

namespace App\Http\Controllers;

use App\Http\Requests\Models\AddModelRequest;
use App\Http\Requests\Models\DeleteModelRequest;
use App\Http\Requests\Models\EditModelRequest;
use App\Http\Resources\ResourceModel;
use App\Models\Brand;
use App\Models\Models;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\StatusEnum;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-model')) {
            abort(403, 'Unauthorized');
        }

        if (!$request->ajax()) {
            $active = 'models';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Car Models',
                    'url' => url('admin/car-models'),
                    'active' => 'brands',
                ]
            ];
            $statuses = StatusEnum::values();
            $brands = Brand::where('status',StatusEnum::ACTIVE)->orderBy('name','asc')->get();
            return view('models', compact('active', 'breadCrumbs', 'permissions', 'statuses','brands'));
        } else {
            $model = Models::query();

            return DataTables::of($model)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->addColumn('brand_id', function ($data) {
                    return $data->brands?->name;
                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $html = "";
                    if (hasPermissions($permissions, 'edit-model')) { // Changed 'edit-role' to 'edit-brand'
                        $html .= "<a title='Edit Model' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                    }
                    if (hasPermissions($permissions, 'delete-brand')) { // Changed 'delete-role' to 'delete-brand'
                        $html .= '<a title="Delete Model" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                    }
                    return $html;
                })->rawColumns(['actions'])->make(true);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddModelRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New Models created successfully!";
        $data = $request->validated();
        $response['data'] = new ResourceModel(Models::create($data));
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditModelRequest $request)
    {

        $response['status'] = true;
        $response['message'] = "Models Updated successfully!";
        $data = $request->validated();
        $model = Models::where('id', $request->id)->where('id','>=',1)->first();
        $model->name = $data['name'];
        $model->status = $data['status'];
        $model->brand_id = $data['brand_id'];
        $model->save();
        $response['data'] = new ResourceModel($model);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteModelRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Models Deleted successfully!";
        $model = Models::where('id', $request->id)->where('id','>=',1)->first();
        $model->delete();
        $response['data'] = new ResourceModel($model);
        return response()->json($response);
    }
    public function getModels(Request $request)
    {
        $models = Models::where('status',StatusEnum::ACTIVE);
        if($request->has('brand_id')){
            $models->where('brand_id',$request->brand_id);
        }

        return $models->get();
    }

}
