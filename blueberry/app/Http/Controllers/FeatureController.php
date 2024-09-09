<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\Categories\DeleteCategoryRequest;
use App\Http\Requests\Features\AddFeatureRequest;
use App\Http\Requests\Features\DeleteFeatureRequest;
use App\Http\Requests\Features\EditFeatureRequest;
use App\Http\Resources\ResourceFeature;
use App\Models\Feature;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-feature')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if (!$request->ajax()) {
            $active = 'features';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Features',
                    'url' => url('admin/features'),
                    'active' => 'features',
                ]
            ];
            $statuses = StatusEnum::values();
            return view('features', compact('active', 'breadCrumbs', 'permissions','statuses'));
        } else {
            $model = Feature::query();

            return DataTables::of($model)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $html = "";
                    if ($data->id > 2) {
                        if (hasPermissions($permissions, 'edit-role')) {
                            $html .= "<a title='Edit Feature' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                        }
                        if (hasPermissions($permissions, 'delete-role')) {
                            $html .= '<a title="Delete Feature" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                        }
                    }
                    return $html;
                })->rawColumns(['actions'])->make(true);
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddFeatureRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New Feature created successfully!";
        $data = $request->validated();
        $response['data'] = new ResourceFeature(Feature::create($data));
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditFeatureRequest $request)
    {

        $response['status'] = true;
        $response['message'] = "Feature Updated successfully!";
        $data = $request->validated();
        $role = Feature::where('id', $request->id)->where('id','>',2)->first();
        $role->name = $data['name'];
        $role->status = $data['status'];
        $role->save();
        $response['data'] = new ResourceFeature($role);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteFeatureRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Feature Deleted successfully!";
        $role = Feature::where('id', $request->id)->where('id','>',2)->first();
        $role->delete();
        $response['data'] = new ResourceFeature($role);
        return response()->json($response);
    }

}
