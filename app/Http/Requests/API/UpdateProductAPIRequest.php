<?php

namespace App\Http\Requests\API;

use App\Models\Product;
use InfyOm\Generator\Request\APIRequest;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class UpdateProductAPIRequest extends APIRequest
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
    public function rules(Request $request )
    {
        $rules = Product::$rules;
        $rules['slug'] = array(
            'required',
            'string',
            'max:255',
            Rule::unique('products', 'slug')->ignore($request->id)
        );
        return $rules;
    }
}
