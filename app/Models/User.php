<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPassword;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'facebook_id',
        'google_id',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        ];
    }

    // Middlewares
    public function isAdmin(){
        return $this->role === 0;
    }

    public function isCustomer(){
        return $this->role === 1;
    }

    public function isOwner(){
        return $this->role === 2;
    }

    public function sendPasswordResetNotification($token){
        $this->notify(new CustomResetPassword($token));
    }

    // Relationship with Listing
    // public function listings(){
    //     return $this->hasMany(Listing::class, 'added_by');
    // }
    public function listings(){
        return $this->hasMany(Listing::class);
    }

    // Relations
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
