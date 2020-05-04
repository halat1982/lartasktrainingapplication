<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Symfony\Component\Console\Input\Input;

class EmployeeCreateRequest extends FormRequest
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
        //dd(Carbon::parse()->diffInYears($this->request->get('birthday_date'))               );
        return [
            'last_name' => 'required|min:2|max:150',
            'first_name' => 'nullable|min:2|max:150',
            'second_name' => 'nullable|min:2|max:150',
            'position' => 'required|integer|exists:positions,id',
            'birthday_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse()->diffInYears($value) < 18) {
                        return $fail('Возраст должен быть не младше 18');
                    }
                },
            ],
            'email' => 'required|email',
            'phone' => 'required'
        ];
    }


}
