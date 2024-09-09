<?php

namespace App\Http\Controllers;

use App\Http\Requests\BodyTypes\AddBodyTypeRequest;
use App\Http\Requests\BodyTypes\DeleteBodyTypeRequest;
use App\Http\Requests\BodyTypes\EditBodyTypeRequest;
use App\Http\Resources\ResourceBodyType;
use App\Models\BodyType;
use Illuminate\Http\Request;
use App\Enums\StatusEnum;
use Yajra\DataTables\Facades\DataTables;

class BodyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-body-types')) {
            abort(403, 'Unauthorized');
        }

        if (!$request->ajax()) {
            $active = 'car-body-types';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Car Body Types',
                    'url' => url('admin/car-body-types'),
                    'active' => 'car-body-types',
                ]
            ];
            $statuses = StatusEnum::values();
            return view('body_types', compact('active', 'breadCrumbs', 'permissions', 'statuses'));
        } else {
            $bodyTypes = BodyType::query();

            return DataTables::of($bodyTypes)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $html = "";


                    if (hasPermissions($permissions, 'edit-body-types')) { // Changed 'edit-body-types' to 'edit-body-types'
                        $html .= "<a title='Edit BodyTypes' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                    }
                    if (hasPermissions($permissions, 'delete-body-types')) { // Changed 'delete-body-types' to 'delete-body-types'
                        $html .= '<a title="Delete BodyTypes" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                    }
                    return $html;
                })->rawColumns(['actions'])->make(true);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddBodyTypeRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New car body types created successfully!";
        $data = $request->validated();
        $response['data'] = new ResourceBodyType(BodyType::create($data));
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditBodyTypeRequest $request)
    {

        $response['status'] = true;
        $response['message'] = "Body Types Updated successfully!";
        $data = $request->validated();
        $bodyTypes = BodyType::where('id', $request->id)->where('id','>=',1)->first();
        $bodyTypes->name = $data['name'];
        $bodyTypes->status = $data['status'];
        $bodyTypes->save();
        $response['data'] = new ResourceBodyType($bodyTypes);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteBodyTypeRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Body Types Deleted successfully!";
        $bodyTypes = BodyType::where('id', $request->id)->where('id','>=',1)->first();
        $bodyTypes->delete();
        $response['data'] = new ResourceBodyType($bodyTypes);
        return response()->json($response);
    }

}
