<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'title',
        'image',
        'youtube_url',
        'phone_number',
        'price',
        'description',
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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
