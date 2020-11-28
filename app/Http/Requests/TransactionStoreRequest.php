<?php

namespace App\Http\Requests;

use App\Rules\AvailableAmount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TransactionStoreRequest extends FormRequest
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
            'money' => ['required', 'integer', new AvailableAmount],
            'recipient_user_id' => 'required|integer|exists:App\Models\User,id',
            'date_start' => 'sometimes|nullable|date|after:'. now(),
            'message' => 'nullable|max:255'
        ];
    }

    public function messages()
    {
        return [
            'date_start.after' => 'Дата выполнения перевода должна быть больше или равна текущей!',
        ];
    }
}
