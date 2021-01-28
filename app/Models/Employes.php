<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employes extends Model
{
    // protected $table = 'employes';

    protected $guarded = [];   

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    } 

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function getPhoto()
    {
    	if (substr($this->photo, 0, 5) == 'https') {
    		return $this->photo; 
    	}

    	if ($this->photo) {
    		return asset($this->photo);
    	}

    	return 'https://via.placeholder.com/150x200.png?text=No+Cover';
    }

    public function getFullName()
    {
       return "{$this['first_name']} {$this['last_name']}";
    }
}
