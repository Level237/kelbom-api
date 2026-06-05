<?php

namespace App\Http\Resources\Stand;

use App\Http\Resources\Stand\StandResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'stand'              => new StandResource($this->resource),
            'credits'            => $this->whenLoaded('buyleadCredits', fn () => [
                'available' => $this->buyleadCredits->available_credits,
                'total_purchased' => $this->buyleadCredits->total_purchased,
                'total_consumed'  => $this->buyleadCredits->total_consumed,
            ]),
            'active_subscription' => $this->whenLoaded('activeSubscription', fn () => [
                'plan_name'  => $this->activeSubscription->plan_name,
                'plan_slug'  => $this->activeSubscription->plan_slug,
                'end_date'   => $this->activeSubscription->end_date->toIso8601String(),
                'auto_renew' => $this->activeSubscription->auto_renew,
            ]),
            'stats'              => [
                'total_products'     => $this->whenCounted('products'),
                'active_products'    => $this->whenCounted('activeProducts'),
                'total_leads_viewed' => $this->total_leads_viewed,
                'total_leads_won'    => $this->total_leads_won,
                'win_rate'           => $this->total_leads_viewed > 0
                    ? round(($this->total_leads_won / $this->total_leads_viewed) * 100, 1)
                    : 0,
                'rating_avg'         => (float) $this->rating_avg,
                'total_reviews'      => $this->total_reviews,
            ],
            'recent_leads'       => SellerLeadResource::collection($this->whenLoaded('recentSellerLeads')),
            'top_products'       => ProductResource::collection($this->whenLoaded('topProducts')),
        ];
    }
}
