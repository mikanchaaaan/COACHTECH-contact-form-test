<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ContactRequest extends FormRequest
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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'address' => ['required'],
            'category_id' => ['required'],
            'detail' => ['required', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => '名を入力してください',
            'last_name.required' => '姓を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'tel_high.digits_between' => '電話番号は5桁までの数字で入力してください',
            'tel_middle.digits_between' => '電話番号は5桁までの数字で入力してください',
            'tel_low.digits_between' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }

    // 電話番号関連のバリデーションは3つの枠のうち1つでもエラーが含まれる場合は1回だけエラーを出力する
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->only(['tel_high', 'tel_middle', 'tel_low']);

            // 電話番号が入力されてない場合にエラーメッセージを出力する
            if (empty($data['tel_high']) || empty($data['tel_middle']) || empty($data['tel_low'])) {
                $validator->errors()->add('tel', '電話番号を入力してください');
            }

            // 電話番号に半角英数字が含まれてる場合はエラーメッセージを出力する
            if (
                !preg_match('/^[a-zA-Z0-9]+$/', $data['tel_high'] ?? '') ||
                !preg_match('/^[a-zA-Z0-9]+$/', $data['tel_middle'] ?? '') ||
                !preg_match('/^[a-zA-Z0-9]+$/', $data['tel_low'] ?? '')
            ) {
                $validator->errors()->add('tel', '電話番号は半角英数字のみで入力してください');
            }

            // 電話番号に5桁以上の数字が含まれている場合にエラーメッセージを出力する
            if ((strlen($data['tel_high'] ?? '') < 1 || strlen($data['tel_high'] ?? '') > 5) ||
                (strlen($data['tel_middle'] ?? '') < 1 || strlen($data['tel_middle'] ?? '') > 5) ||
                (strlen($data['tel_low'] ?? '') < 1 || strlen($data['tel_low'] ?? '') > 5)
            ) {
                $validator->errors()->add('tel', '電話番号を5桁までの数字で入力してください');
            }


        });
    }
}
