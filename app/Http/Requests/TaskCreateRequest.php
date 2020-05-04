<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id' => 'required|exists:projects,id|numeric',
            'title' => 'required|min:5|max:150',
            'description' => 'required|string|max:500|min:10',
            'start_date' => 'date',
            'rate_time' => 'required|numeric',
            'status' => 'required|numeric'
        ];
    }
}
