<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class PositionDeleteRequest extends FormRequest
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
                    if (DB::table('employees')->select('position')->where('position', '=', $value)->count() > 0) {
                        return $fail('Нельзя удалять должность с которой связаны служащие');
                    }
                },
            ],
        ];
    }
}
