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
        return [
            'state' => ['required', Rule::in(SubscriberStateType::values())],
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|email_checker',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }
}
