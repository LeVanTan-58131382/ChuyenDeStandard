<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            //
            'name' => 'required:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required:users,password',
            'phone' => 'required:users,phone',
            // tên trường =>'ko để trống|ko trùng: tên bảng, tên thuộc tính' tất cả viết sát vào nhau
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập họ tên!',
            'email.required' => 'Bạn chưa nhập email!',
            'email.unique' => 'Email này đã tồn tại!',
            'password.required' => 'Bạn chưa nhập password!'
        ]; 
    }
}
