<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'        => $this->name,
            'email'             => $this->email,
            'phone_number'      => $this->phone_number,
            'avatar_url'        => $this->avatar_url,
            'phone_verified'    => ! is_null($this->phone_verified_at),
            'roles'             => $this->whenLoaded('roles', fn () => $this->getRoleNames()),
            'seller'            => $this->whenLoaded('seller'),
            'delivery_person'   => $this->whenLoaded('deliveryPerson'),
            'created_at'        => $this->created_at->toIso8601String(),
        ];
    }
}
