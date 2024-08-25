Model file 

<?php

// namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class StaffFeedback extends Model
{
    use HasFactory;
    protected $table = 'staff_feedbacks';
    protected $primaryKey = 'report_id';
    protected $fillable = ['firstname', 'lastname', 'event', 'user_id', 'feedback_type', 'rating', 'feedback_statement', 'staff_recommendation', 'submission_timestamp', 'report_hash_id'];
    public $timestamps = true;

    public function setUpdatedAt($value)
    {
        if ($this->exists) {
            $this->attributes['updated_at'] = $value;
        }
    }

    public function staffFeedbackResponseDetails()
    {
        return $this->hasMany(StaffFeedbackResponse::class, 'report_id', 'report_id');
    }

    public function countFeedbackReports()
    {
        return $this->hasOne(StaffFeedbackResponse::class, 'report_id', 'report_id');
    }

    public function scopeStaffName($query, $value)
    {
        $query->where(function ($query) use ($value) {
            $parts = explode(' ', $value);
            foreach ($parts as $part) {
                $query->where(function ($query) use ($part) {
                    $query->where('staff_feedbacks.firstname', 'like', '%' . $part . '%')
                        ->orWhere('staff_feedbacks.lastname', 'like', '%' . $part . '%');
                });
            }
        });
    
        return $query;
    }
    
    public function scopeSubmissionTimeRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('submission_timestamp', [$startDate, $endDate]);
    }

    public function scopeEventName($query, $value)
    {
        return $query->where('staff_feedbacks.event', 'like', '%' . $value . '%');
    }

    public function scopeFeedbackType($query, $value)
    {
        if ($value == 'negative') {
            return $query->where('staff_feedbacks.feedback_type', 0);
        } elseif ($value == 'positive') {
            return $query->where('staff_feedbacks.feedback_type', 1);
        }
    }

}