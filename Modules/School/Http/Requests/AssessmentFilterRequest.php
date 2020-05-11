<?php

namespace Modules\School\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssessmentFilterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'major_id' => 'numeric|exists:majors,id',
            'group_id' => 'numeric|exists:groups,id',
            'room_id' => 'numeric|exists:rooms,id',
            'subject_id' => 'numeric|exists:subjects,id'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('school')->check();
    }
}
