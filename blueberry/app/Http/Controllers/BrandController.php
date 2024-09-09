<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brands\AddBrandRequest;
use App\Http\Requests\Brands\DeleteBrandRequest;
use App\Http\Requests\Brands\EditBrandRequest;
use App\Http\Resources\ResourceBrand;
use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\StatusEnum;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-brand')) {
            abort(403, 'Unauthorized');
        }

        if (!$request->ajax()) {
            $active = 'brands';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Car Brands',
                    'url' => url('admin/car-brands'),
                    'active' => 'brands',
                ]
            ];
            $statuses = StatusEnum::values();
            return view('brands', compact('active', 'breadCrumbs', 'permissions', 'statuses'));
        } else {
            $brand = Brand::query();

            return DataTables::of($brand)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->editColumn('image', function ($data) {
                    if (!empty($data->image)) {
                        return '<img src="' . $data->src . '" alt="Brand Image" width="75"/>';
                    }

                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $data->src = asset('storage/images/brands/' . $data->image);

                    $html = "";


                        if (hasPermissions($permissions, 'edit-brand')) { // Changed 'edit-role' to 'edit-brand'
                            $html .= "<a title='Edit Brand' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                        }
                        if (hasPermissions($permissions, 'delete-brand')) { // Changed 'delete-role' to 'delete-brand'
                            $html .= '<a title="Delete Brand" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                        }
                    return $html;
                })->rawColumns(['actions', 'image'])->make(true);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddBrandRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New car brands created successfully!";
        $data = $request->all();
        unset($data['image']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'brands_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/brands', $imageName);
            $data['image'] = $imageName;
        }
        $response['data'] = new ResourceBrand(Brand::create($data));
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditBrandRequest $request)
    {

        $response['status'] = true;
        $response['message'] = "Brand Updated successfully!";
        $data = $request->all();
        $brand = Brand::where('id', $request->id)->where('id','>=',1)->first();
        unset($data['image']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'brands_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/brands', $imageName);
            $brand->image = $imageName;
        }
        $brand->name = $data['name'];
        $brand->status = $data['status'];
        $brand->save();
        $response['data'] = new ResourceBrand($brand);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteBrandRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "brand Deleted successfully!";
        $brand = Brand::where('id', $request->id)->where('id','>=',1)->first();
        $brand->delete();
        $response['data'] = new ResourceBrand($brand);
        return response()->json($response);
    }

}
