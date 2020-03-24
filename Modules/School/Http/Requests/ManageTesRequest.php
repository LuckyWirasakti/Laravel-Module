<?php

namespace Modules\School\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManageTesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'group_id' => 'required|numeric|max:10',
            'major_id' => 'required|numeric|max:10',
            'subject_id' => 'required|numeric|max:10',
            'duration_work' => 'required',
            'hours_implementation' => 'required',
            'sync_date' => 'required',
            'date_implementation' => 'required',
            'day' => 'required'
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
