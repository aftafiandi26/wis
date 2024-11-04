<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveTransaction extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "leave_transactions";

    protected $guarded = [];

    /**
     * Get all of the comments for the LeaveTransaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function role_employee(): BelongsTo
    {
        return $this->belongsTo(Employes::class, 'employee_id', 'id');
    }

    public function role_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function role_leave_category(): BelongsTo
    {
        return $this->belongsTo(LeaveCategory::class, 'leave_category_id', 'id');
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
