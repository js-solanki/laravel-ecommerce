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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $productId = $this->route('product');
        return [
            //
             // Product table validation rules
             'product_name' => 'required|string|max:255',
             'description' => 'nullable|string',
             'price' => 'required|numeric|min:0',
             'quantity_available' => 'required|integer|min:0',
             'weight'=>'nullable',
             'sku' => 'required|string|max:255|unique:products,sku,' . $productId,
             'brand' => 'required|nullable|string|max:255',
             'manufacturer' => 'nullable|string|max:255',
             'images' => 'nullable|array',
             'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'status' => 'required|in:0,1',
 
             // Product categories table validation rules
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ];
    }
}
