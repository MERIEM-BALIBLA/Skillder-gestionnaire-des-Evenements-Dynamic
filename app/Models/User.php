<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function skills() {
        return $this->belongsToMany(Skill::class, 'user_skill', 'user_id', 'skill_id');
    }


    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    // public function annoucements() {
    //     return $this->belongsToMany(Annoucment::class, 'annoucement_user', 'annoucement_id', 'user_id ');
    // }
    public function annoucements() {
        return $this->belongsToMany(Annoucment::class, 'annoucement_user', 'user_id', 'annoucement_id');
    }
    
}
