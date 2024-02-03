@if(isset($product))
    @php($overallRating = getOverallRating($product->reviews))
    <div class="flash_deal_product rtl get-view-by-onclick" data-link="{{ route('product',$product->slug) }}">
        @if($product->discount > 0)
            <span class="for-discount-value p-1 pl-2 pr-2">
            @if ($product->discount_type == 'percent')
                    {{round($product->discount,(!empty($decimal_point_settings) ? $decimal_point_settings: 0))}}%
                @elseif($product->discount_type =='flat')
                    {{ webCurrencyConverter(amount: $product->discount) }}
                @endif {{translate('off')}}
        </span>
        @endif
        <div class=" d-flex">
            <div class="d-flex align-items-center justify-content-center p-12px">
                <div class="flash-deals-background-image">
                    <img class="__img-125px" alt=""
                         src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/'.$product['thumbnail'], type: 'product') }}">
                </div>
            </div>
            <div class="flash_deal_product_details pl-3 pr-3 pr-1 d-flex mt-3">
                <div>
                    <div>
                        <a href="{{route('product',$product->slug)}}"
                           class="flash-product-title text-capitalize fw-semibold">
                            {{ Str::limit($product['name'], 23) }}
                        </a>
                    </div>
                    @if($overallRating[0] != 0 )
                        <div class="flash-product-review">
                            @for($inc=1;$inc<=5;$inc++)
                                @if ($inc <= (int)$overallRating[0])
                                    <i class="tio-star text-warning"></i>
                                @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                    <i class="tio-star-half text-warning"></i>
                                @else
                                    <i class="tio-star-outlined text-warning"></i>
                                @endif
                            @endfor
                            <label class="badge-style2">
                                ( {{$product->reviews->count()}} )
                            </label>
                        </div>
                    @endif
                    <div class="d-flex flex-wrap gap-8 align-items-center row-gap-0">
                        @if($product->discount > 0)
                            <del class="category-single-product-price">
                                {{ webCurrencyConverter(amount: $product->unit_price) }}
                            </del>
                        @endif
                        <span class="flash-product-price text-dark fw-semibold">
                            {{ webCurrencyConverter(amount: $product->unit_price - getProductDiscount(product: $product, price: $product->unit_price)) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
