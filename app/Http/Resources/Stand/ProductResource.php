<?php

namespace App\Http\Resources\Stand;

use App\Http\Resources\Stand\ProductImageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'slug'               => $this->slug,
            'name'               => $this->name,
            'description'        => $this->description,
            'price'              => $this->price,
            'formatted_price'    => $this->formatted_price,
            'compare_at_price'   => $this->compare_at_price,
            'formatted_compare_at_price' => $this->formatted_compare_at_price,
            'discount_percentage' => $this->discount_percentage,
            'min_order_quantity' => $this->min_order_quantity,
            'unit'               => $this->unit,
            'specifications'     => $this->specifications,
            'main_image_url'     => $this->main_image_url,
            'status'             => $this->status,
            'views_count'        => $this->views_count,
            'inquiries_count'    => $this->inquiries_count,
            'category'           => $this->whenLoaded('category', fn () => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ]),
            'images'             => ProductImageResource::collection($this->whenLoaded('images')),
            'created_at'         => $this->created_at->toIso8601String(),
            'updated_at'         => $this->updated_at->toIso8601String(),
        ];
    }
}
