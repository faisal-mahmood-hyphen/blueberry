<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarImages\AddCarImageRequest;
use App\Http\Requests\CarImages\DeleteCarImageRequest;
use App\Http\Requests\CarImages\EditCarImageRequest;
use App\Http\Resources\ResourceCarImage;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\StatusEnum;


class CarImageController extends Controller
{
    public function index(Request $request,  $carId)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-image')) {
            abort(403, 'Unauthorized');
        }

        if (!$request->ajax()) {
            $active = 'cars';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Car Images',
                    'url' => url('admin/car-images'),
                    'active' => 'cars',
                ]
            ];
            return view('car_images', compact('active', 'breadCrumbs', 'permissions','carId'));
        } else {
            $carImages = CarImage::where('car_id',$carId);

            return DataTables::of($carImages)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->editColumn('make_primary', function ($data) {
                    return $data->make_primary == 1 ? 'Yes' : 'No';
                })
                ->editColumn('image', function ($data) {
                    if (!empty($data->image)) {
                        $data->src = asset('storage/images/car-images/' . $data->image);
                        return '<a href="'.$data->src.'" target="_blank"><img src="' . $data->src . '" alt="Property Image" height="75"/></a>';
                    }

                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $data->src = asset('storage/images/car-images/' . $data->image);
                    $html = "";

                    if (hasPermissions($permissions, 'edit-image')) { // Changed 'edit-role' to 'edit-brand'
                        $html .= "<a title='Edit Image' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                    }
                    if (hasPermissions($permissions, 'show-image')) {
                        $html .= '<a href="' . route('car.images.show', ['carImageId' => $data->id]) . '" class="btn btn-success m-1 show-record" data-id="' . $data->id . '"><i class="fas fa-eye"></i></a>';
                    }
                    if (hasPermissions($permissions, 'delete-image')) { // Changed 'delete-role' to 'delete-brand'
                        $html .= '<a title="Delete Image" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                    }
                    return $html;
                })->rawColumns(['actions', 'image'])->make(true);
        }
    }
    public function store(AddCarImageRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New Car Image added successfully!";
        $data = $request->all();
        unset($data['image']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'cars_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/car-images', $imageName);
            $data['image'] = $imageName;
        }
        $response['data'] = new ResourceCarImage(CarImage::create($data));
        return response()->json($response);
    }
    public function update(EditCarImageRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Car Image Updated successfully!";
        $data = $request->all();
        $carImage = CarImage::where('id', $request->id)->first();
        unset($data['image']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'cars_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/car-images', $imageName);
            $carImage->image = $imageName;
        }


        $carImage->alt_text = $data['alt_text'];
        $carImage->make_primary = $data['make_primary'];
        $carImage->save();

        $response['data'] = new ResourceCarImage($carImage);
        return response()->json($response);
    }
    public function destroy(DeleteCarImageRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Car Image Removed successfully!";
        $carImage = CarImage::where('id', $request->id)->first();
        $carImage->delete();
        $response['data'] = new ResourceCarImage($carImage);
        return response()->json($response);
    }
    public function show($carImageId)
    {
        $carImage = CarImage::where('id', $carImageId)->first();
        $active = 'cars';
        $breadCrumbs = [
            [
                'name' => 'Dashboard',
                'url' => url('/')
            ],
            [
                'name' => 'Car Images',
                'url' => url('admin/car-images'),
            ],
            [
                'name' => 'Car Image Details',
                'url' => url('admin/car-images-detail'),
                'active' => 'cars',
            ]
        ];
        return view('car_images_details', compact('carImage', 'active', 'breadCrumbs'));
    }


}
