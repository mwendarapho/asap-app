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
            'lname'=> 'nullable',
            'mobile'=> 'nullable| numeric',
            'address'=> 'nullable',
            'email'=> 'nullable | email',
            'dob'=> 'nullable | date | before:-18 years',
            'spouse_name'=>'nullable ',
            'spouse_mobile'=>'nullable | numeric',
            'joined_on'=> 'nullable | date | before_or_equal:today',
            'left_on'=> 'nullable | date | after_or_equal:joined_on',

        ];
    }
}
