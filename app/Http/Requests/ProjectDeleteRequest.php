<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ProjectDeleteRequest extends FormRequest
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
            'id' => [
                function ($attribute, $value, $fail) {
                    if (DB::table('tasks')->select('project_id')->where('project_id', '=', $value)->count() > 0) {
                        return $fail('Нельзя удалять проект, содержащий задачи');
                    }
                },
            ],
        ];
    }
}
