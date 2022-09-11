<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name'               => 'required|min:3|max:30|string',
            'product_price'              => 'required|integer',
            'product_quantity'           => 'required|integer',
            'product_description'        => 'required|min:3|max:50|string',
            'photo'                      => 'required',
            'filter'                     => 'required',
            'sub_category'               => 'required',
        ];
    }
}
