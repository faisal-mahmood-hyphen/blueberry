<?php

namespace App\Http\Controllers;

use App\Enums\CarPurposeEnum;
use App\Enums\StatusEnum;
use App\Enums\VehicleFeatureEnum;
use App\Http\Requests\Cars\AddCarRequest;
use App\Http\Requests\Cars\EditCarRequest;
use App\Http\Requests\Cars\DeleteCarRequest;
use App\Http\Resources\ResourceCar;
use App\Models\BodyType;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CarController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();

            return $next($request);
        });
    }


    public function index(Request $request)
    {


        $permissions = getAuthUserModulePermissions();


        if (!hasPermissions($permissions, 'read-car')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if (!$request->ajax()) {
            $active = 'cars';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Cars',
                    'url' => url('admin/cars'),
                    'active' => 'cars',
                ]
            ];
            $countries = Country::where('status', StatusEnum::ACTIVE)->get();
            $statuses = StatusEnum::values();
            $features = VehicleFeatureEnum::values();
            $carPurposes = CarPurposeEnum::values();
            $brands = Brand::where('status', StatusEnum::ACTIVE)->get();
            $bodyTypes = BodyType::where('status', StatusEnum::ACTIVE)->get();
            return view('cars', compact('active', 'breadCrumbs', 'permissions', 'statuses', 'countries', 'features', 'brands', 'bodyTypes', 'carPurposes'));
        } else {
            $model = Car::query();
            if ($this->user->role != 'admin') {

                $model->where('created_by', $this->user->id);
            }


            return DataTables::of($model)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->editColumn('image', function ($data) {
                    if (!empty($data->image)) {
                        return '<img src="' . $data->src . '" alt="Car Image" width="75"/>';
                    }

                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $data->src = asset('storage/images/cars/' . $data->image);
                    $html = "";
                    $selectedFeatures = [];
                    $features = VehicleFeatureEnum::values();
                    foreach ($features as $feature) {
                        $featureColumn = strtolower(str_replace(' ', '_', $feature));
                        if (isset($data->$featureColumn) && $data->$featureColumn == 1) {
                            $selectedFeatures[$featureColumn] = 1;
                        }
                    }
                    $data->selectedFeatures = $selectedFeatures;
                    if (hasPermissions($permissions, 'edit-car')) {
                        $html .= "<a title='Edit Car' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                    }
                    if (hasPermissions($permissions, 'show-car')) {
                        $html .= '<a href="' . route('cars.show', ['carId' => $data->id]) . '" class="btn btn-success m-1 show-record" data-id="' . $data->id . '"><i class="fas fa-eye"></i></a>';
                    }
                    if (hasPermissions($permissions, 'show-car')) {
                        $html .= '<a href="' . route('car.images.index', ['carId' => $data->id]) . '" class="btn btn-success m-1 show-record" data-id="' . $data->id . '"><i class="fas fa-images"></i></a>';
                    }
                    if (hasPermissions($permissions, 'delete-car')) {
                        $html .= '<a title="Delete Car" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                    }
                    return $html;
                })->rawColumns(['actions', 'image'])->make(true);
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCarRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New Car added successfully!";

        $request->merge(['created_by' => $this->user->id]);
        $data = $request->all();
        unset($data['image']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'cars_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/cars', $imageName);
            $data['image'] = $imageName;
        }
        $response['data'] = new ResourceCar(Car::create($data));
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditCarRequest $request)
    {
//        dd($request->all());
        $response['status'] = true;
        $response['message'] = "Car Updated successfully!";
        $data = $request->all();
        $car = Car::where('id', $request->id)->first();
        unset($data['image']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'cars_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/cars', $imageName);
            $car->image = $imageName;
        }

        $carFields = [
            'title', 'year', 'mileage', 'country_id', 'state_id', 'city_id', 'regional_specs',
            'steering_side', 'is_car_insured', 'image', 'view_360_url', 'fuel_type', 'body_condition',
            'mechanical_condition', 'exterior_color', 'interior_color', 'warranty', 'doors', 'cylinders',
            'transmission_type', 'seating_capacity', 'horse_power', 'engine_capacity', 'climate_control',
            'cooled_seats', 'dvd_player', 'front_wheel_drive', 'keyless_entry', 'leather_seats',
            'navigation_system', 'parking_sensors', 'premium_sound_system', 'rear_view_camera',
            '4_wheel_drive', 'air_conditioning', 'alarm/anti-theft_system', 'all_wheel_drive',
            'all_wheel_steering', 'am/fm_radio', 'anti-lock_brakes/abs', 'aux_audio_in',
            'bluetooth_system', 'body_kit', 'brush_guard', 'cassette_player', 'cd_player', 'cruise_control',
            'dual_exhaust', 'fog_lights', 'front_airbags', 'heat', 'heated_seats', 'keyless_start',
            'moonroof', 'n2o_system', 'off-road_kit', 'off-road_tyres', 'performance_tyres',
            'power_locks', 'power_mirrors', 'power_seats', 'power_steering', 'power_sunroof',
            'power_windows', 'premium_lights', 'premium_paint', 'premium_wheels/rims',
            'racing_seats', 'rear_wheel_drive', 'roof_rack', 'satellite_radio', 'side_airbags',
            'spoiler', 'sunroof', 'tiptronic_gears', 'vhs_player', 'winch', 'brand_id', 'model_id',
            'trim_id', 'body_type_id', 'phone', 'price', 'purpose',
        ];

        foreach ($carFields as $field) {
            if (array_key_exists($field, $data)) {
                $car->$field = $data[$field];
            }
        }

        $car->description = $data['description'];
        $car->updated_by =$this->user->id;
        $car->save();

        $response['data'] = new ResourceCar($car);
        return response()->json($response);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteCarRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Car Removed successfully!";
        $car = Car::where('id', $request->id)->first();
        $car->deleted_by =$this->user->id;
        $car->save();
        $car->delete();
        $response['data'] = new ResourceCar($car);
        return response()->json($response);
    }

    public function show($carId)
    {
        $car = Car::where('id', $carId)->first();
        $active = 'cars';
        $breadCrumbs = [
            [
                'name' => 'Dashboard',
                'url' => url('/')
            ],
            [
                'name' => 'Cars',
                'url' => url('admin/cars'),
            ],
            [
                'name' => 'Cars Details',
                'url' => url('admin/car-detail'),
                'active' => 'cars',
            ]
        ];
        return view('car_details', compact('car', 'active', 'breadCrumbs'));
    }


}
