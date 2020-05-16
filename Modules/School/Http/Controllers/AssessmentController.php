<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Modules\School\Entities\UjianJawaban;
use Modules\School\Http\Requests\AssessmentFilterRequest;
use Modules\School\Transformers\RecapResource;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return Response
     */
    public function recap(AssessmentFilterRequest $request)
    {
        $examResult = UjianJawaban::with('participant')->has('participant');
        $examResult->whereHas('participant', function ($query) use ($request) {
            $query->where('school_id', auth('school')->id());
        });

        if ($request->has('group_id')) {
            $examResult->whereHas('participant', function ($query) use ($request) {
                $query->where('group_id', $request->group_id);
            });
        }

        if ($request->has('major_id')) {
            $examResult->whereHas('participant', function ($query) use ($request) {
                $query->where('major_id', $request->major_id);
            });
        }

        if ($request->has('room_id')) {
            $examResult->whereHas('participant', function ($query) use ($request) {
                $query->where('room_id', $request->room_id);
            });
        }

        if ($request->has('subject_id')) {
            $examResult->where('subject_id', $request->subject_id);
        }

        $examResult = $examResult->orderBy('skor', 'desc')->get();
        
        return RecapResource::collection($examResult);
    }
}
