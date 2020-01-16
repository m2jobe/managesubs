<?php

namespace App\Http\Requests\Api;

use App\Models\Enums\FieldType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFieldRequest extends FormRequest
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
            'type' => ['required', Rule::in(FieldType::values())],
            'title' => 'required|string|max:255',
            'subscriber_id' => 'required',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }
}
