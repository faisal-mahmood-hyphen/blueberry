<?php

namespace App\Http\Controllers;

use App\Enums\PropertyFeatureEnum;
use App\Http\Requests\Properties\AddPropertyRequest;
use App\Http\Requests\Properties\DeletePropertyRequest;
use App\Http\Requests\Properties\EditPropertyRequest;
use App\Http\Resources\ResourceCar;
use App\Http\Resources\ResourceProperty;
use App\Models\Category;
use App\Models\Country;
use App\Models\Property;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\PropertyPurposeEnum;
use App\Enums\StatusEnum;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        $user=auth()->user();
        if (!hasPermissions($permissions, 'read-property')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if (!$request->ajax()) {
            $active = 'properties';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Property',
                    'url' => url('admin/properties'),
                    'active' => 'properties',
                ]
            ];
            $countries = Country::where('status', StatusEnum::ACTIVE)->get();
            $categories = Category::whereNull('parent_id')->where('status', StatusEnum::ACTIVE)->where('feature_id', 1)->get();
            $propertyPurposes = PropertyPurposeEnum::values();
            $features = PropertyFeatureEnum::values();
            $statuses = StatusEnum::values();
            return view('properties', compact('active', 'breadCrumbs', 'permissions', 'propertyPurposes', 'categories', 'countries', 'features', 'statuses'));
        } else {
            $model = property::query();
            if (auth()->user()->role != 'admin') {

                $model->where('created_by', $user->id)->where('updated_by', $user->id);
            }

            return DataTables::of($model)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->editColumn('image', function ($data) {
                    if (!empty($data->image)) {
                        $data->src = asset('storage/images/properties/' . $data->image);
                        return '<img src="' . $data->src . '" alt="Property Image" width="75"/>';
                    }

                })
                ->addColumn('actions', function ($data) use ($permissions) {

                    $html = "";
                    $selectedFeatures = [];
                    $features = PropertyFeatureEnum::values();
                    foreach ($features as $feature) {
                        $featureColumn = strtolower(str_replace(' ', '_', $feature));
                        if (isset($data->$featureColumn) && $data->$featureColumn == 1) {
                            $selectedFeatures[$featureColumn] = 1;
                        }
                    }
                    $data->selectedFeatures = $selectedFeatures;
                    if (hasPermissions($permissions, 'edit-property')) {
                        $html .= "<a title='Edit Property' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                    }
                    if (hasPermissions($permissions, 'show-property')) {
                        $html .= '<a href="' . route('property.images.index', ['propertyId' => $data->id]) . '" class="btn btn-success m-1 show-record" data-id="' . $data->id . '"><i class="fas fa-images"></i></a>';
                    }
                    if (hasPermissions($permissions, 'delete-property')) {
                        $html .= '<a title="Delete Property" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                    }
                    return $html;
                })->rawColumns(['actions', 'image'])->make(true);
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddPropertyRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New Property added successfully!";
        $data = $request->all();
        unset($data['image']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'properties_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/properties', $imageName);
            $data['image'] = $imageName;

        }
        $response['data'] = new ResourceProperty(Property::create($data));
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditPropertyRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Property Updated successfully!";
        $data = $request->all();
        $properties = Property::where('id', $request->id)->first();
        unset($data['image']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'properties_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/properties', $imageName);
            $properties->image = $imageName;
        }
        $propertieFields = [
            'id',
            'title',
            'image',
            'youtube_url',
            'phone_number',
            'price',
            'size',
            'ready_by_date',
            'total_closing_fee',
            'developer_name',
            'annual_community_fee',
            'is_it_furnished',
            'property_reference_id',
            'seller_transfer_fee',
            'buyer_transfer_fee',
            'maintenance_fee',
            'occupancy_status',
            'tour_360_url',
            'available_furnished',
            'available_networking',
            'dining_in_building',
            'retail_in_building',
            'an_agent',
            'landlord_name',
            'neighbourhood',
            'location',
            'integrate_the_map',
            'category_id',
            'sub_category_id',
            'country_id',
            'state_id',
            'city_id',
            'purpose',
            'maids_room',
            'study',
            'central_ac_heating',
            'concierge_service',
            'balcony',
            'private_garden',
            'private_pool',
            'private_gym',
            'private_jacuzzi',
            'shared_pool',
            'shared_spa',
            'shared_gym',
            'security',
            'maid_service',
            'covered_parking',
            'built_in_wardrobes',
            'walk_in_closet',
            'built_in_kitchen_appliances',
            'view_of_water',
            'view_of_landmark',
            'pets_allowed',
            'double_glazed_windows',
            'day_care_center',
            'electricity_backup',
            'first_aid_medical_center',
            'service_elevators',
            'prayer_room',
            'laundry_room',
            'broadband_internet',
            'satellite_cable_tv',
            'business_center',
            'intercom',
            'atm_facility',
            'kids_play_area',
            'reception_waiting_room',
            'maintenance_staff',
            'cctv_security',
            'cafeteria_or_canteen',
            'shared_kitchen',
            'facilities_for_disabled',
            'storage_areas',
            'cleaning_services',
            'barbeque_area',
            'lobby_in_building',
            'waste_disposal',
            'conference_room',
            'available_networked',
            'dining_in_building',
            'retail_in_building',
        ];

        foreach ($propertieFields as $field) {
            if (array_key_exists($field, $data)) {
                $properties->$field = $data[$field];
            }
        }
        $properties->description = $data['description'];
        $properties->save();
        $response['data'] = new ResourceProperty($properties);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeletePropertyRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Property Removed successfully!";
        $property = Property::where('id', $request->id)->first();
        $property->delete();
        $response['data'] = new ResourceProperty($property);
        return response()->json($response);
    }

}
