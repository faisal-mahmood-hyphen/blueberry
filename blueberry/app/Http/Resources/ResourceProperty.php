<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceProperty extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'youtube_url' => $this->youtube_url,
            'phone_number' => $this->phone_number,
            'price' => $this->price,
            'description' => $this->description,
            'size' => $this->size,
            'ready_by_date' => $this->ready_by_date,
            'total_closing_fee' => $this->total_closing_fee,
            'developer_name' => $this->developer_name,
            'annual_community_fee' => $this->annual_community_fee,
            'is_it_furnished' => $this->is_it_furnished,
            'property_reference_id' => $this->property_reference_id,
            'seller_transfer_fee' => $this->seller_transfer_fee,
            'buyer_transfer_fee' => $this->buyer_transfer_fee,
            'maintenance_fee' => $this->maintenance_fee,
            'occupancy_status' => $this->occupancy_status,
            'tour_360_url' => $this->tour_360_url,
            'conference_room' => $this->conference_room,
            'available_networking' => $this->available_networking,
            'an_agent' => $this->an_agent,
            'landlord_name' => $this->landlord_name,
            'neighbourhood' => $this->neighbourhood,
            'location' => $this->location,
            'integrate_the_map' => $this->integrate_the_map,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'purpose' => $this->purpose,
            'maids_room' => $this->maids_room,
            'study' => $this->study,
            'central_ac_heating' => $this->central_ac_heating,
            'concierge_service' => $this->concierge_service,
            'balcony' => $this->balcony,
            'private_garden' => $this->private_garden,
            'private_pool' => $this->private_pool,
            'private_gym' => $this->private_gym,
            'private_jacuzzi' => $this->private_jacuzzi,
            'shared_pool' => $this->shared_pool,
            'shared_spa' => $this->shared_spa,
            'shared_gym' => $this->shared_gym,
            'security' => $this->security,
            'maid_service' => $this->maid_service,
            'covered_parking' => $this->covered_parking,
            'built_in_wardrobes' => $this->built_in_wardrobes,
            'walk_in_closet' => $this->walk_in_closet,
            'built_in_kitchen_appliances' => $this->built_in_kitchen_appliances,
            'view_of_water' => $this->view_of_water,
            'view_of_landmark' => $this->view_of_landmark,
            'pets_allowed' => $this->pets_allowed,
            'double_glazed_windows' => $this->double_glazed_windows,
            'day_care_center' => $this->day_care_center,
            'electricity_backup' => $this->electricity_backup,
            'first_aid_medical_center' => $this->first_aid_medical_center,
            'service_elevators' => $this->service_elevators,
            'prayer_room' => $this->prayer_room,
            'laundry_room' => $this->laundry_room,
            'broadband_internet' => $this->broadband_internet,
            'satellite_cable_tv' => $this->satellite_cable_tv,
            'business_center' => $this->business_center,
            'intercom' => $this->intercom,
            'atm_facility' => $this->atm_facility,
            'kids_play_area' => $this->kids_play_area,
            'reception_waiting_room' => $this->reception_waiting_room,
            'maintenance_staff' => $this->maintenance_staff,
            'cctv_security' => $this->cctv_security,
            'cafeteria_or_canteen' => $this->cafeteria_or_canteen,
            'shared_kitchen' => $this->shared_kitchen,
            'facilities_for_disabled' => $this->facilities_for_disabled,
            'storage_areas' => $this->storage_areas,
            'cleaning_services' => $this->cleaning_services,
            'barbeque_area' => $this->barbeque_area,
            'lobby_in_building' => $this->lobby_in_building,
            'waste_disposal' => $this->waste_disposal,
            'available_furnished' => $this->available_furnished,
            'available_networked' => $this->available_networked,
            'dining_in_building' => $this->dining_in_building,
            'retail_in_building' => $this->retail_in_building,
            'image' => asset('storage/images/properties/'.$this->image),
            'created_at' => $this->created_at->format('d F, Y H:i'),
            'updated_at' => $this->updated_at->format('d F, Y H:i'),
            // Add more attributes as needed
        ];
    }
}
