<?php

namespace App\Http\Resources\Stand;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'id'                => $this->id,
            'stand_name'        => $this->stand_name,
            'slug'              => $this->slug,
            'description'       => $this->description,
            'logo_url'          => $this->logo_url,
            'cover_url'         => $this->cover_url,
            'website_url'       => $this->website_url,
            'whatsapp_number'   => $this->whatsapp_number,
            'is_verified'       => $this->is_verified,
            'rating_avg'        => (float) $this->rating_avg,
            'total_reviews'     => $this->total_reviews,
            'contact_email'     => $this->contact_email,
            'contact_phone'     => $this->contact_phone,
            'full_address'      => $this->full_address,
            'city'              => $this->city,
            'country'           => $this->country,
            'latitude'          => $this->latitude ? (float) $this->latitude : null,
            'longitude'         => $this->longitude ? (float) $this->longitude : null,
            'total_products'    => $this->whenCounted('products'),
            'active_products'   => $this->whenCounted('activeProducts'),
            'total_leads_viewed' => $this->total_leads_viewed,
            'total_leads_won'   => $this->total_leads_won,
            'has_active_subscription' => $this->whenLoaded('activeSubscription', fn () => $this->activeSubscription !== null),
            'user'              => $this->whenLoaded('user', fn () => [
                'full_name'  => $this->user->first_name . ' ' . $this->user->last_name,
                'avatar_url' => $this->user->avatar_url,
            ]),
            'created_at'        => $this->created_at->toIso8601String(),
        ];
    }
}
