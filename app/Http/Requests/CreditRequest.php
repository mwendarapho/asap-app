<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditRequest extends FormRequest
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
            "credit_date" => "required | date | after_or_equal:today",
            "member_id" => "required ",
            "invoice_id" =>"required ",
            "credit_ref" => "required",
            "amount" => "required ",
        ];
    }
}
