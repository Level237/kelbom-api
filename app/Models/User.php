<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\DeliveryPerson;
use App\Models\Stand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
     use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

     protected $fillable = [
        'phone_number',
        'password',
        'name'
    ];

    protected $hidden = [
        'password',
        'deleted_at',
    ];

     protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'last_login_at'    => 'datetime',
        'is_active'         => 'boolean',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function stand()
    {
        return $this->hasOne(Stand::class);
    }

    public function deliveryPerson()
    {
        return $this->hasOne(DeliveryPerson::class);
    }

    public function hasRoleName(string $role): bool
    {
        return $this->hasRole($role);
    }

    public function isSellerWithStand(): bool
    {
        return $this->hasRole('seller') && $this->seller && $this->seller->stand_name;
    }
}
