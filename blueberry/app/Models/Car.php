<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'year',
        'mileage',
        'country_id',
        'state_id',
        'city_id',
        'regional_specs',
        'steering_side',
        'is_car_insured',
        'image',
        'view_360_url',
        'fuel_type',
        'body_condition',
        'mechanical_condition',
        'exterior_color',
        'interior_color',
        'warranty',
        'doors',
        'cylinders',
        'transmission_type',
        'seating_capacity',
        'horse_power',
        'engine_capacity',
        'climate_control',
        'cooled_seats',
        'dvd_player',
        'front_wheel_drive',
        'keyless_entry',
        'leather_seats',
        'navigation_system',
        'parking_sensors',
        'premium_sound_system',
        'rear_view_camera',
        '4_wheel_drive',
        'air_conditioning',
        'alarm/anti-theft_system',
        'all_wheel_drive',
        'all_wheel_steering',
        'am/fm_radio',
        'anti-lock_brakes/abs',
        'aux_audio_in',
        'bluetooth_system',
        'body_kit',
        'brush_guard',
        'cassette_player',
        'cd_player',
        'cruise_control',
        'dual_exhaust',
        'fog_lights',
        'front_airbags',
        'heat',
        'heated_seats',
        'keyless_start',
        'moonroof',
        'n2o_system',
        'off-road_kit',
        'off-road_tyres',
        'performance_tyres',
        'power_locks',
        'power_mirrors',
        'power_seats',
        'power_steering',
        'power_sunroof',
        'power_windows',
        'premium_lights',
        'premium_paint',
        'premium_wheels/rims',
        'racing_seats',
        'rear_wheel_drive',
        'roof_rack',
        'satellite_radio',
        'side_airbags',
        'spoiler',
        'sunroof',
        'tiptronic_gears',
        'vhs_player',
        'winch',
        'brand_id',
        'model_id',
        'trim_id',
        'body_type_id',
        'price',
        'phone',
        'purpose',
        'created_by',
        'updated_by',
        'deleted_by'
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
    public function model()
    {
        return $this->belongsTo(Model::class, 'model_id');
    }
    public function trim()
    {
        return $this->belongsTo(Trim::class, 'trim_id');
    }

}
