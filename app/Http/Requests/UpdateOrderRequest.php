<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
        $rules = [
            'client_email'=> 'email|required',
            'partner'	  => 'required|min:2|max:250',
            'order_status'	  => 'integer'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'client_email.email'                  => 'Введите адрес в формате example@mail.com',
            'client_email.required'                  => 'Поле Email Клиента обязательно для заполнения',
            'partner.required'                     => 'Поле Партнер обязательно для заполнения',
            'partner.min'                     => 'Поле должно быть не короче 2 символов',
            'partner.max'                     => 'Поле должно быть не длиннее 250 символов',
            'order_status.integer'                     => 'В поле статус заказа должны быть только цифры',
        ];
    }
}
