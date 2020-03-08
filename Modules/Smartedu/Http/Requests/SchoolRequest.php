<?php

namespace Modules\Smartedu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191',
            'province_id' => 'required|numeric',
            'regency_id' => 'required|numeric',
            'level_id' => 'required|numeric',
            'username' => 'required|max:6',
            'password' => 'required|max:6',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('api')->check();
    }
}
