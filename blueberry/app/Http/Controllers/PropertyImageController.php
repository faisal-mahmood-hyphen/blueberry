<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyImages\AddPropertyImageRequest;
use App\Http\Requests\PropertyImages\DeletePropertyImageRequest;
use App\Http\Requests\PropertyImages\EditPropertyImageRequest;
use App\Http\Resources\ResourcePropertyImage;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PropertyImageController extends Controller
{
    public function index(Request $request,  $propertyId)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-image')) {
            abort(403, 'Unauthorized');
        }

        if (!$request->ajax()) {
            $active = 'properties';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Property Images',
                    'url' => url('admin/property-images'),
                    'active' => 'properties',
                ]
            ];
            return view('property_images', compact('active', 'breadCrumbs', 'permissions','propertyId'));
        } else {
            $propertyImages = PropertyImage::where('property_id', $propertyId);

            return DataTables::of($propertyImages)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->editColumn('make_primary', function ($data) {
                    return $data->make_primary == 1 ? 'Yes' : 'No';
                })
                ->editColumn('image', function ($data) {
                    if (!empty($data->image)) {
                        $data->src = asset('storage/images/property-images/' . $data->image);
                        return '<a href="'.$data->src.'" target="_blank"><img src="' . $data->src . '" alt="Property Image" height="75"/></a>';
                    }

                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $html = "";

                    if (hasPermissions($permissions, 'edit-property')) { // Changed 'edit-role' to 'edit-brand'
                        $html .= "<a title='Edit Property' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                    }
                    if (hasPermissions($permissions, 'show-property')) {
                        $html .= '<a href="' . route('property.images.show', ['propertyImageId' => $data->id]) . '" class="btn btn-success m-1 show-record" data-id="' . $data->id . '"><i class="fas fa-eye"></i></a>';
                    }
                    if (hasPermissions($permissions, 'delete-property')) { // Changed 'delete-role' to 'delete-brand'
                        $html .= '<a title="Delete Property" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                    }
                    return $html;
                })->rawColumns(['actions', 'image'])->make(true);
        }
    }
    public function store(AddPropertyImageRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New Property Image added successfully!";
        $data = $request->all();
        unset($data['image']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'properties_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/property-images', $imageName);
            $data['image'] = $imageName;
        }
        $response['data'] = new ResourcePropertyImage(PropertyImage::create($data));
        return response()->json($response);
    }
    public function update(EditPropertyImageRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Property Image Updated successfully!";
        $data = $request->all();
        $propertyImage = PropertyImage::where('id', $request->id)->first();
        unset($data['image']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'properties_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/property-images', $imageName);
            $propertyImage->image = $imageName;
        }


        $propertyImage->alt_text = $data['alt_text'];
        $propertyImage->property_id = $data['property_id'];
        $propertyImage->make_primary = $data['make_primary'];
        $propertyImage->save();

        $response['data'] = new ResourcePropertyImage($propertyImage);
        return response()->json($response);
    }
    public function destroy(DeletePropertyImageRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Property Image Removed successfully!";
        $propertyImage = PropertyImage::where('id', $request->id)->first();
        $propertyImage->delete();
        $response['data'] = new ResourcePropertyImage($propertyImage);
        return response()->json($response);
    }
    public function show($propertyImageId)
    {
        $propertyImage = PropertyImage::where('id', $propertyImageId)->first();
        $active = 'cars';
        $breadCrumbs = [
            [
                'name' => 'Dashboard',
                'url' => url('/')
            ],
            [
                'name' => 'Property Images',
                'url' => url('admin/property-images'),
            ],
            [
                'name' => 'Property Image Details',
                'url' => url('admin/property-images-detail'),
                'active' => 'properties',
            ]
        ];
        return view('property_images_details', compact('propertyImage', 'active', 'breadCrumbs'));
    }
}
