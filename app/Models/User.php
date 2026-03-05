<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'permissions',
        'profile_photo_path',
        'avatar',
        'phone_number',
        'gender',
        'dob',
        'pob',
        'current_address',
        'bio',
        'latitude',
        'longitude',
        'location_updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'permissions' => 'array',
            'location_updated_at' => 'datetime',
        ];
    }

    public function assignedOrders()
    {
        // A driver can be assigned many orders
        return $this->hasMany(\App\Models\Order::class, 'driver_id');
    }

    public function orders()
    {
        // A customer can place many orders
        return $this->hasMany(\App\Models\Order::class, 'customer_id');
    }

    /**
     * Get all reviews written by the user.
     */
    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class);
    }

    /**
     * Get all helpful votes by the user.
     */
    public function helpfulVotes()
    {
        return $this->hasMany(\App\Models\ReviewHelpful::class);
    }

    /**
     * Check if the user is an Admin or Super User
     */
    public function isAdmin()
    {
        return in_array($this->role, ['admin', 'super_user']);
    }

    /**
     * Check if the user is Staff
     */
    public function isStaff()
    {
        return $this->role === 'staff';
    }

    /**
     * Check if the user is a Driver
     */
    public function isDriver()
    {
        return $this->role === 'driver';
    }

    /**
     * Check if the user is a Customer
     */
    public function isCustomer()
    {
        return $this->role === 'customer' || $this->role === null;
    }

    /**
     * Check if the user has a specific permission.
     * Admins automatically have access to everything.
     * Staff members need explicit permissions assigned (or get defaults).
     */
    public function hasPermission($permission)
    {
        // 1. SuperAdmin & Admin Override: If they are the main admin, always return true.
        if ($this->role === 'admin' || $this->role === 'super_user') {
            return true;
        }

        // 2. STAFF DEFAULT PERMISSIONS: If staff has no permissions array or empty array,
        // give them basic default permissions to prevent empty dashboard issue
        if ($this->role === 'staff') {
            // If permissions is null or empty, treat them as having basic permissions
            // This fixes existing staff members who were created without permissions
            if (empty($this->permissions)) {
                $defaultStaffPermissions = [
                    'manage_inventory',
                    'manage_categories',
                    'manage_orders',
                    'process_orders',
                    'manage_customers',
                    // Note: view_reports is NOT included by default - must be explicitly assigned
                    // This ensures menu items only appear when admin explicitly grants access
                ];
                return in_array($permission, $defaultStaffPermissions);
            }
            // If they have permissions set, use those
            if (is_array($this->permissions)) {
                return in_array($permission, $this->permissions);
            }
            return false;
        }

        // 3. For other roles (driver, customer), check their permissions array
        if (!is_array($this->permissions)) {
            return false;
        }

        return in_array($permission, $this->permissions);
    }

    /**
     * Check if user can access a specific module (alias for hasPermission).
     */
    public function canAccess($permission)
    {
        return $this->hasPermission($permission);
    }
}
