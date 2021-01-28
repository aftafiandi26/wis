<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'actived', 'access_id', 'employes_id', 'department_id'
    ];

   // protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
   
    public function accesses()
    {
        return $this->belongsTo(Models\Access::class, 'access_id');
    } 

    public function employee()
    {
        return $this->belongsTo(Models\Employes::class, 'employes_id');
    }

    public function department()
    {       
          return $this->belongsTo(Models\Department::class, 'department_id');
    }
}
