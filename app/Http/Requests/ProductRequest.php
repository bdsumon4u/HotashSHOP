<?php

namespace App\Http\Requests;

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
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:products',
            'description' => 'required',
            'categories' => 'required|array',
            'brand' => 'required|integer',
            'price' => 'required|integer',
            'selling_price' => 'required|integer',
            'sku' => 'required|unique:products',
            'should_track' => 'sometimes|integer',
            'stock_count' => 'nullable|required_if:should_track,1|integer',
            'is_active' => 'sometimes|boolean',
            'base_image' => 'required|integer',
            'additional_images' => 'sometimes|array',
        ];

        if (! $this->isMethod('POST')) {
            $rules['slug'] = 'required|max:255|unique:products,id,'.$this->route('product')->id;
            $rules['sku'] = 'required|unique:products,id,'.$this->route('product')->id;
        }

        return $rules;
    }
}
