<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        //ファイルが存在するか
        if ($request->hasFile('upfile')) {
            //
        }
        //ファイルアップロードに成功したか
        if ($request->file('upfile')->isValid()) {
            //
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'upfile'=>'required | image',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'必須項目です',
            'image'=>'指定された画像ファイルしかアップできません'
        ];
    }
}
