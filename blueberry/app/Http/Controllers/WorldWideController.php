<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;

use App\Http\Requests\WorldWide\EditCountryRequest;
use App\Http\Requests\WorldWide\EditStateRequest;
use App\Http\Requests\WorldWide\EditCityRequest;
use App\Http\Resources\ResourceCity;
use App\Http\Resources\ResourceCountry;
use App\Http\Resources\ResourceState;
use App\Models\City;
use App\Models\Country;
use App\Models\State;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class WorldWideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-country')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if (!$request->ajax()) {
            $active = 'countries';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Countries',
                    'url' => url('admin/countries'),
                    'active' => 'countries',
                ]
            ];
            return view('countries', compact(
                'active',
                'breadCrumbs',
                'permissions',
            ));
        } else {
            $model = Country::query();

            return DataTables::of($model)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->editColumn('name', function ($data) {
                    return ucwords($data->name);
                })
                ->addColumn('status', function ($data) use ($permissions) {
                    $html = "";

                    if (hasPermissions($permissions, 'edit-country')) {
                        if($data->status == StatusEnum::ACTIVE){
                            $html .= '<input type="checkbox" class="status-checkbox" data-id="'.$data->id.'" name="status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                        }else{
                            $html .= '<input type="checkbox" class="status-checkbox" data-id="'.$data->id.'" name="status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                        }

                    }

                    return $html;
                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $html = "";

                    if (hasPermissions($permissions, 'read-state')) {
                        $html .= "<a title='".ucwords($data->name)." States' class='btn btn-primary m-1 edit-record' href='".route('worldwild.states',['countryId'=>$data->id])."' ><i class='fas fa-landmark'></i></a>";
                    }

                    return $html;
                })
                ->rawColumns(['status','actions'])->make(true);
        }

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(EditCountryRequest $request)
    {

        $response['status'] = true;
        $data = $request->all();
        $country = Country::where('id', $request->id)->first();
        $country->status = $data['status'];
        $country->save();
        $response['message'] = ucwords($country->name). " Country {$country->status} successfully!";
        $response['data'] = new ResourceCountry($country);
        return response()->json($response);
    }


    /**
     * Display a listing of the resource.
     */
    public function indexState(Request $request, $countryId)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-state')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if (!$request->ajax()) {
            $active = 'countries';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Countries',
                    'url' => url('admin/countries'),
                ],
                [
                    'name' => 'States',
                    'url' => url('admin/states'),
                    'active' => 'states',
                ]
            ];
            return view('states', compact(
                'active',
                'breadCrumbs',
                'permissions',
                'countryId',
            ));
        } else {
            $model = State::query()->where('country_id',$countryId);

            return DataTables::of($model)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->editColumn('name', function ($data) {
                    return ucwords($data->name);
                })
                ->addColumn('status', function ($data) use ($permissions) {
                    $html = "";

                    if (hasPermissions($permissions, 'edit-state')) {
                        if($data->status == StatusEnum::ACTIVE){
                            $html .= '<input type="checkbox" class="status-checkbox" data-id="'.$data->id.'" name="status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                        }else{
                            $html .= '<input type="checkbox" class="status-checkbox" data-id="'.$data->id.'" name="status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                        }

                    }

                    return $html;
                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $html = "";

                    if (hasPermissions($permissions, 'read-city')) {
                        $html .= "<a title='".ucwords($data->name)." Cities ' class='btn btn-primary m-1 edit-record' href='".route('worldwild.cities',['countryId'=>$data->country_id,'stateId'=>$data->id])."' ><i class='fas fa-city'></i></a>";
                    }

                    return $html;
                })
                ->rawColumns(['status','actions'])->make(true);
        }

    }



    /**
     * Update the specified resource in storage.
     */
    public function updateState(EditStateRequest $request)
    {

        $response['status'] = true;
        $data = $request->all();
        $state = State::where('id', $request->id)->first();
        $state->status = $data['status'];
        $state->save();
        $response['message'] = ucwords($state->name)." State {$state->status} successfully!";
        $response['data'] = new ResourceState($state);
        return response()->json($response);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexCity(Request $request, $countryId, $stateId)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-city')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if (!$request->ajax()) {
            $active = 'countries';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Countries',
                    'url' => url('admin/countries'),
                ],
                [
                    'name' => 'States',
                    'url' => url('admin/states/'.$countryId),
                ],
                [
                    'name' => 'Cities',
                    'url' => url('admin/cities/'.$countryId.'/'.$stateId),
                    'active' => 'cities',
                ]
            ];
            return view('cities', compact(
                'active',
                'breadCrumbs',
                'permissions',
                'countryId',
                'stateId',
            ));
        } else {
            $model = City::query()->where('state_id',$stateId);

            return DataTables::of($model)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->editColumn('name', function ($data) {
                    return ucwords($data->name);
                })
                ->addColumn('status', function ($data) use ($permissions) {
                    $html = "";

                    if (hasPermissions($permissions, 'edit-city')) {
                        if($data->status == StatusEnum::ACTIVE){
                            $html .= '<input type="checkbox" class="status-checkbox" data-id="'.$data->id.'" name="status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                        }else{
                            $html .= '<input type="checkbox" class="status-checkbox" data-id="'.$data->id.'" name="status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                        }

                    }

                    return $html;
                })
                ->rawColumns(['status','actions'])->make(true);
        }

    }



    /**
     * Update the specified resource in storage.
     */
    public function updateCity(EditCityRequest $request)
    {

        $response['status'] = true;
        $data = $request->all();
        $city = City::where('id', $request->id)->first();
        $city->status = $data['status'];
        $city->save();
        $response['message'] = ucwords($city->name)." City {$city->status} successfully!";
        $response['data'] = new ResourceCity($city);
        return response()->json($response);
    }

    public function getStates(Request $request)
    {
        $states = State::where('status',StatusEnum::ACTIVE);
        if($request->has('country_id')){
            $states->where('country_id',$request->country_id);
        }

        return $states->get();
    }
    public function getCities(Request $request)
    {
        $cities = City::where('status',StatusEnum::ACTIVE);
        if($request->has('state_id')){
            $cities->where('state_id',$request->state_id);
        }

        return $cities->get();
    }



}
