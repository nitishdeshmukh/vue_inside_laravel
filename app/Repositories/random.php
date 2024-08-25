Repository

<?php

// namespace App\Repositories;

use App\Models\StaffFeedback;
use App\Models\Event;
use App\Models\DropdownCategory;
use App\Models\StaffFeedbackResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffFeedbackRepository
{

    public function fetchStaffFeedback(int $data): object
    {
        $staffFeedback = StaffFeedback::where('report_id', $data)
        ->with('staffFeedbackResponseDetails')->first();

        return $staffFeedback;
    }

    public function fetchAll(array $filters, $perPage): array
    {
        $query = StaffFeedback::query();

        if (!empty($filters)) {
            foreach ($filters as $column => $value) {
                if (!empty($value) && !is_null($value) && $value != 'null') {
                    if ($column === 'staffName') {
                        $query->staffName($value);
                    }    
                    elseif ($column === 'eventName') {
                        $query->eventName($value);
                    }
                    elseif ($column === 'feedbackType') {
                        $query->feedbackType($value);
                    }
                    elseif ($column === 'submissionTimeRange') {
                        $dates = explode(',', $value);
                        if (count($dates) == 2) {
                            $query->submissionTimeRange($dates[0], $dates[1]);
                        }
                    }
                }
            }
        }

        if(array_key_exists('sortMethod', $filters)){
            if($filters['sortMethod'] == 'timestamp'){
                $query->orderBy('submission_timestamp', 'asc');
            }
            elseif($filters['sortMethod'] == 'ratingHighToLow'){
                $query->orderBy('rating', 'desc');
            }
            elseif($filters['sortMethod'] == 'ratingLowToHigh'){
                $query->orderBy('rating', 'asc');
            } 
            else{
                $query->orderBy('submission_timestamp', 'desc');
            }
        }
        else {
            $query->orderBy('submission_timestamp', 'desc');
        }

        $exportableFeedbacks = $query->get();
        $feedbacks = $query->paginate($perPage);
        $totalFeedbackCount = StaffFeedback::count();
        $positiveFeedbackCount = StaffFeedback::where('feedback_type', 1)->count();
        $negativeFeedbackCount = StaffFeedback::where('feedback_type', 0)->count();

        return [
            'feedbacks' => $feedbacks,
            'exportableFeedbacks' => $exportableFeedbacks,
            'total_feedback_count' => $totalFeedbackCount,
            'positive_feedback_count' => $positiveFeedbackCount,
            'negative_feedback_count' => $negativeFeedbackCount
        ];
    }

    public function createOrUpdate(array $data, StaffFeedback $staffFeedback = null): ?StaffFeedback
    {
        $checkstaffFeedback = $staffFeedback;
    
        if ($staffFeedback === null) {
            $staffFeedback = new StaffFeedback;
        }
    
        $md5String = $data['firstname'] . $data['feedbackType'] . $data['feedbackStatement'] . $data['staffRecommendation'] . $data['submissionTimestamp'] . date("d-m-Y H:i:s");
        $reportHashID = md5($md5String);
    
        $user = Auth::user();
        $staffFeedback->firstname = $data['firstname'];
        $staffFeedback->lastname = $data['lastname'];
        $staffFeedback->event = $data['event'];
        $staffFeedback->user_id = $user->id;
        $staffFeedback->feedback_type = $data['feedbackType'];
        $staffFeedback->rating = $data['rating'];
        $staffFeedback->feedback_statement = $data['feedbackStatement'];
        $staffFeedback->staff_recommendation = $data['staffRecommendation'];
        $staffFeedback->submission_timestamp = $data['submissionTimestamp'];
        $staffFeedback->report_hash_id = $reportHashID;
        $staffFeedback->save();
    
        foreach ($data['questions'] as $question) {
            $staffFeedbackResponse = new StaffFeedbackResponse;
            $staffFeedbackResponse->report_id = $staffFeedback->report_id;
            $staffFeedbackResponse->question_number = $question['questionNumber'];
            $staffFeedbackResponse->question_type = $question['questionType'];
            $staffFeedbackResponse->question_text = $question['questionText'];
            $staffFeedbackResponse->question_answer = $question['questionAnswer'];
            $staffFeedbackResponse->question_rating = $question['questionRating'];
            $staffFeedbackResponse->comment = $question['comment'];
            $staffFeedbackResponse->save();
        }
    
        return $staffFeedback;
    }
    
    public function fetchEvents(array $filters): object
    {
        $query = Event::query();

        if (!empty($filters)) {
            foreach ($filters as $column => $value) {
                if (!empty($value) && !is_null($value) && $value != 'null') {
                    if ($column === 'createdAtFilter') {
                        $query->getEventsFromLastOneMonth($value);
                    }
                    elseif ($column === 'name') {
                        $query->eventName($value);
                    }
                }
            }
        }

        $query->orderBy('name', 'asc');
        return $query->get();
    }

    public function fetchStaffRecommendations(): object
    {
        $query = DropdownCategory::where('category', 'staff_feedback-staff_recommendation');

        $query->orderBy('id', 'asc');
        return $query->get();
    }
    
}    