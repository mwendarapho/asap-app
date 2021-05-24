<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'fname'=> 'required',
            'lname'=> 'required',
            'mobile'=> 'required| numeric| unique:members',
            'address'=> 'nullable',
            'email'=> 'required | email| unique:members',
            'dob'=> 'required | date | before:-18 years',
            'spouse_name'=>'nullable ',
            'spouse_mobile'=>'nullable | numeric|unique:members',
            'joined_on'=> 'required | date | before_or_equal:today',
            'left_on'=> 'nullable | date | after_or_equal:today',

        ];
    }
}
