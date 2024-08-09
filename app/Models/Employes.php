<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employes extends Model
{
    use HasFactory;

    protected $table = "employes";

    protected $guarded = [];

    public function fullname()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function role_department(): HasMany
    {
        return $this->hasMany(Department::class, 'id', 'department_id');
    }

    public function department()
    {
        $query = Department::find($this->department_id);

        return $query->name;
    }
}
