<?php

namespace App\Http\Requests;

use App\Traits\CalculatorTrait;
use App\Traits\ResponseHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class ProductAddRequest extends Request
{
    use CalculatorTrait, ResponseHandler;
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'category_id' => 'required',
            'gender' => 'required',
            'product_type' => 'required',
            'digital_product_type' => 'required_if' . ':' . 'product_type' . ',==,' . 'digital',
            'digital_file_ready' => 'required_if' . ':' . 'digital_product_type' . ',==,' . 'ready_product' . '|' . 'mimes' . ':jpg,jpeg,png,gif,zip,pdf',
            'unit' => 'required_if' . ':' . 'product_type' . ',==,' . 'physical',
            'image' => 'required',
            'tax' => 'required' . '|' . 'min' . ':0',
            'tax_model' => 'required',
            'unit_price' => 'required' . '|' . 'numeric' . '|' . 'gt' . ':0',
//            'purchase_price' => 'required' . '|' . 'numeric' . '|' . 'gt' . ':0',
            'discount' => 'required' . '|' . 'gt' . ':-1',
            'shipping_cost' => 'required_if' . ':' . 'product_type' . ',==,' . 'physical' . '|' . 'gt' . ':-1',
            'code' => 'required' . '|' . 'numeric' . '|' . 'min' . ':1|' . 'digits_between' . ':6,20|' . 'unique' . ':products',
            'minimum_order_qty' => 'required' . '|' . 'numeric' . '|' . 'min' . ':1',
        ];
    }

    public function messages(): array
    {
        return [
            'image' . '.' . 'required' => translate('product_thumbnail_is_required!'),
            'category_id' . '.' . 'required' => translate('category_is_required!'),
            'unit' . '.' . 'required_if' => translate('unit_is_required!'),
            'code' . '.' . 'min' => translate('code_must_be_positive!'),
            'code' . '.' . 'digits_between' => translate('code_must_be_minimum_6_digits!'),
            'minimum_order_qty' . '.' . 'required' => translate('minimum_order_quantity_is_required!'),
            'minimum_order_qty' . '.' . 'min' => translate('minimum_order_quantity_must_be_positive!'),
            'digital_file_ready' . '.' . 'required_if' => translate('ready_product_upload_is_required!'),
            'digital_file_ready' . '.' . 'mimes' => translate('ready_product_upload_must_be_a_file_of_type') . ':' . 'pdf, zip, jpg, jpeg, png, gif.',
            'digital_product_type' . '.' . 'required_if' => translate('digital_product_type_is_required!'),
            'shipping_cost' . '.' . 'required_if' => translate('shipping_cost_is_required!')
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (!$this->has('colors_active') && !$this->file('images')) {
                    $validator->errors()->add(
                        'images', translate('product_images_is_required') . '!'
                    );
                }

                if (getWebConfig(name: 'product_brand') && empty($this->brand_id)) {
                    $validator->errors()->add(
                        'brand_id', translate('brand_is_required') . '!'
                    );
                }

                if ($this['product_type'] == 'physical' && $this['unit_price'] <= $this->getDiscountAmount(price: $this['unit_price'] ?? 0, discount: $this['discount'], discountType: $this['discount_type'])) {
                    $validator->errors()->add(
                        'unit_price', translate('discount_can_not_be_more_or_equal_to_the_price') . '!'
                    );
                }

                if (is_null($this['name'][array_search('EN', $this['lang'])])) {
                    $validator->errors()->add(
                        'name', translate('name_field_is_required') . '!'
                    );
                }

                $productImagesCount = 0;
                if ($this->has('colors_active') && $this->has('colors') && count($this['colors']) > 0) {
                    foreach ($this['colors'] as $color) {
                        $color_ = str_replace('#', '', $color);
                        $image = 'color_image_' . $color_;
                        if ($this->file($image)) {
                            $productImagesCount++;
                        }
                    }

                    if ($productImagesCount != count($this['colors'])) {
                        $validator->errors()->add(
                            'images', translate('color_images_is_required') . '!'
                        );
                    }
                }
            }
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $this->errorProcessor($validator)]));
    }
}
