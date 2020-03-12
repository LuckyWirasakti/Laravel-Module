<?php

namespace Modules\School\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SoalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_subject'    => 'required|numeric|max:10',
            'pertanyaan'    => 'required',
            'kunci'         => 'required',
            'pembahasan'    => 'required',
            'jawabanA'       => 'required',
            'jawabanB'       => 'required',
            'jawabanC'       => 'required',
            'jawabanD'       => 'required',
            'jawabanE'       => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
