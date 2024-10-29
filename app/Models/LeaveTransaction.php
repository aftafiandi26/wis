<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeaveTransaction extends Model
{
    use HasFactory;

    protected $table = "leave_transactions";

    protected $guarded = [];

    /**
     * Get all of the comments for the LeaveTransaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function role_employee(): HasMany
    {
        return $this->hasMany(Employes::class, 'id', 'employee_id');
    }

    public function role_user(): HasMany
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function getLeaveCategory()
    {
        return LeaveCategory::find($this->leave_category_id)->value('name');
    }

    public function employee($id)
    {
        $query = Employes::find($id);

        return $query;
    }

    public function parmStatusApproved($id)
    {
        if ($id === 1) {
            $return = "Approved";
        }
        if ($id === 2) {
            $return = "Disapproved";
        }
        if ($id === 0) {
            $return = "Pending";
        }

        return $return;
    }
}
