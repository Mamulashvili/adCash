<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockStoreRequest extends FormRequest
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
            'name' => 'required|unique:stocks|max:255',
            'price'=> 'required|numeric',
            'accentColor'=> 'required',
            'bgColor'=> 'required',
            'file' => 'mimes:jpg,jpeg,png|max:2048'
        ];
    }
}
