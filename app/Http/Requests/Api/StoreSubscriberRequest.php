<?php

namespace App\Http\Requests\Api;

use App\Models\Enums\SubscriberStateType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubscriberRequest extends FormRequest
{
    public $validator = null;

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
        // The email_checker flag is the package to validate the domain - it relies on making an mxrecord call but its buggy atm so i have commented it out of the rules
        return [
            'state' => ['required', Rule::in(SubscriberStateType::values())],
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255'//|email_checker',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }
}
