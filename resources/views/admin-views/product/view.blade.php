@extends('layouts.back-end.app')

@section('title', translate('product_Preview'))

@section('content')
    <div class="content container-fluid text-start">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-10 mb-3">
            <div class="">
                <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                    <img src="{{ asset('public/assets/back-end/img/inhouse-product-list.png') }}" alt="">
                    {{ translate('product_details') }}
                </h2>
            </div>
        </div>

        <div class="card card-top-bg-element">
            <div class="card-body">
                <div class="d-flex flex-wrap flex-lg-nowrap gap-3 justify-content-between">
                    <div class="media flex-wrap flex-sm-nowrap gap-3">

                        <a class="aspect-1 float-left overflow-hidden"
                           href="{{ productImagePath('thumbnail') }}/{{ $product['thumbnail']}}"
                           data-lightbox="mygallery">
                            <img class="avatar avatar-170 rounded-0"
                                 src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/'. $product['thumbnail'],type: 'backend-product') }}"
                                 alt="">
                        </a>

                        <div class="d-block">
                            <div class="d-flex flex-wrap flex-sm-nowrap align-items-start gap-2 mb-2 min-h-50">

                                @if ($product->product_type == 'physical' && $product->color_image)
                                    @foreach (json_decode($product->color_image) as $key => $photo)
                                        <a class="aspect-1 float-left overflow-hidden"
                                           href="{{ getValidImage(path: 'storage/app/public/product/'.$photo->image_name, type: 'backend-product') }}"
                                           data-lightbox="mygallery">
                                            <img width="50" alt=""
                                                 src="{{ getValidImage(path: 'storage/app/public/product/'.$photo->image_name, type: 'backend-product') }}">
                                        </a>
                                    @endforeach
                                @else
                                    @foreach (json_decode($product->images) as $key => $photo)
                                        <a class="aspect-1 float-left overflow-hidden"
                                           href="{{ getValidImage(path: 'storage/app/public/product/'.$photo, type: 'backend-product') }}"
                                           data-lightbox="mygallery">
                                            <img width="50" alt=""
                                                 src="{{ getValidImage(path: 'storage/app/public/product/'.$photo, type: 'backend-product') }}">
                                        </a>
                                    @endforeach
                                @endif

                                @if ($product->denied_note && $product['request_status'] == 2)
                                    <div class="alert alert-danger bg-danger-light py-2" role="alert">
                                        <strong>{{ translate('note') }} :</strong> {{ $product->denied_note}}
                                    </div>
                                @endif
                            </div>

                            <div class="d-block">
                                <div class="d-flex">
                                    <h2 class="mb-2 pb-1 text-gulf-blue">{{ $product['name']}}</h2>
                                    <a class="btn btn-outline--primary btn-sm square-btn mx-2 w-auto h-25"
                                       title="{{ translate('edit') }}"
                                       href="{{ route('admin.products.update', [$product['id']]) }}">
                                        <i class="tio-edit"></i>
                                    </a>
                                </div>
                                <div class="d-flex gap-3 flex-wrap mb-3 lh-1">
                                    <span class="text-dark">
                                        {{ count($product->orderDetails) }} {{ translate('orders') }}
                                    </span>
                                    <span class="border-left"></span>
                                    <div class="review-hover position-relative cursor-pointer d-flex gap-2 align-items-center">
                                        <i class="tio-star"></i>
                                        <span>
                                            {{ count($product->rating)>0 ? number_format($product->rating[0]->average, 2, '.', ' '):0 }}
                                        </span>

                                        <div class="review-details-popup">
                                            <h6 class="mb-2">{{ translate('rating') }}</h6>
                                            <div class="">
                                                <ul class="list-unstyled list-unstyled-py-2 mb-0">
                                                    @php($total = $product->reviews->count())

                                                    <li class="d-flex align-items-center font-size-sm">
                                                        @php($five = getRatingCount($product['id'], 5))
                                                        <span
                                                            class="{{ Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3' }}">
                                                            {{ translate('5') }} {{ translate('star') }}
                                                        </span>
                                                        <div class="progress flex-grow-1">
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{ $total == 0 ? 0 : ($five/$total)*100 }}%;"
                                                                 aria-valuenow="{{ $total == 0 ? 0 : ($five/$total)*100 }}"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <span
                                                            class="{{ Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3' }}">{{ $five }}</span>
                                                    </li>

                                                    <li class="d-flex align-items-center font-size-sm">
                                                        @php($four=getRatingCount($product['id'],4))
                                                        <span
                                                            class="{{ Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3' }}">{{ translate('4') }} {{ translate('star') }}</span>
                                                        <div class="progress flex-grow-1">
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{ $total == 0 ? 0 : ($four/$total)*100}}%;"
                                                                 aria-valuenow="{{ $total == 0 ? 0 : ($four/$total)*100}}"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <span
                                                            class="{{ Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3' }}">{{ $four }}</span>
                                                    </li>

                                                    <li class="d-flex align-items-center font-size-sm">
                                                        @php($three=getRatingCount($product['id'],3))
                                                        <span
                                                            class="{{ Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}">{{ translate('3') }} {{ translate('star') }}</span>
                                                        <div class="progress flex-grow-1">
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{ $total == 0 ? 0 : ($three/$total)*100 }}%;"
                                                                 aria-valuenow="{{ $total == 0 ? 0 : ($three/$total)*100 }}"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <span
                                                            class="{{ Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">{{ $three }}</span>
                                                    </li>

                                                    <li class="d-flex align-items-center font-size-sm">
                                                        @php($two=getRatingCount($product['id'],2))
                                                        <span
                                                            class="{{ Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}">{{ translate('2') }} {{ translate('star') }}</span>
                                                        <div class="progress flex-grow-1">
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{ $total == 0 ? 0 : ($two/$total)*100}}%;"
                                                                 aria-valuenow="{{ $total == 0 ? 0 : ($two/$total)*100}}"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <span
                                                            class="{{ Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">{{ $two }}</span>
                                                    </li>

                                                    <li class="d-flex align-items-center font-size-sm">
                                                        @php($one=getRatingCount($product['id'],1))
                                                        <span
                                                            class="{{ Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}">{{ translate('1') }} {{ translate('star') }}</span>
                                                        <div class="progress flex-grow-1">
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{ $total == 0 ? 0 : ($one/$total)*100}}%;"
                                                                 aria-valuenow="{{ $total == 0 ? 0 : ($one/$total)*100}}"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <span class="{{ Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">{{ $one }}</span>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <span class="border-left"></span>
                                    <span class="text-dark">
                                        {{ $product->reviews_count }} {{ translate('ratings') }}
                                    </span>
                                    <span class="border-left"></span>
                                    <span class="text-dark">
                                        {{ $product->reviews->whereNotNull('comment')->count() }} {{ translate('reviews') }}
                                    </span>
                                </div>

                                @if ($productActive)
                                    <a href="{{ route('product', $product['slug']) }}"
                                       class="btn btn-outline--primary mr-1" target="_blank">
                                        <i class="tio-globe"></i>
                                        {{ translate('view_live') }}
                                    </a>
                                @endif
                                @if($product->digital_file_ready && file_exists(base_path('storage/app/public/product/digital-product/'.$product->digital_file_ready)))
                                    <a href="{{ asset('storage/app/public/product/digital-product/'.$product->digital_file_ready) }}"
                                       class="btn btn-outline--primary mr-1" title="Download" download>
                                        <i class="tio-download"></i>
                                        {{ translate('download') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($product['added_by'] == 'seller' && ($product['request_status'] == 0 || $product['request_status'] == 1))
                        <div class="d-flex justify-content-sm-end flex-wrap gap-2 mb-3">
                            <div>
                                <button class="btn btn-danger px-5" data-toggle="modal" data-target="#publishNoteModal">
                                    {{ translate('reject') }}
                                </button>
                            </div>
                            <div>
                                @if($product['request_status'] == 0)
                                    <a href="{{ route('admin.products.approve-status', ['id'=>$product['id']]) }}"
                                       class="btn btn-success px-5">
                                        {{ translate('approve') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                    @if($product['added_by'] == 'seller' && ($product['request_status'] == 2))
                        <div class="d-flex justify-content-sm-end flex-wrap gap-2 mb-3">
                            <div>
                                <button class="btn btn-danger px-5">
                                    {{ translate('rejected') }}
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <hr>

                <div class="d-flex gap-3 flex-wrap">
                    <div class="border p-3 w-170">
                        <div class="d-flex flex-column mb-1">
                            <h6 class="font-weight-normal">{{ translate('total_sold') }} :</h6>
                            <h3 class="text-primary fs-18">{{ $product['qtySum'] }}</h3>
                        </div>
                        <div class="d-flex flex-column">
                            <h6 class="font-weight-normal">{{ translate('total_sold_amount') }} :</h6>
                            <h3 class="text-primary fs-18">
                                {{setCurrencySymbol(amount: usdToDefaultCurrency(amount: ($product['priceSum'] * $product['qtySum']) - $product['discountSum'])) }}
                            </h3>
                        </div>
                    </div>

                    <div class="row gy-3 flex-grow-1">
                        <div class="col-sm-6 col-xl-4">
                            <h4 class="mb-3">{{ translate('general_information') }}</h4>

                            <div class="pair-list">
                                <div>
                                    <span class="key text-nowrap">{{ translate('brand') }}</span>
                                    <span>:</span>
                                    <span class="value">
                                        {{isset($product->brand) ? $product->brand->default_name : translate('brand_not_found') }}
                                    </span>
                                </div>

                                <div>
                                    <span class="key text-nowrap">{{ translate('category') }}</span>
                                    <span>:</span>
                                    <span class="value">
                                        {{isset($product->category) ? $product->category->default_name : translate('category_not_found') }}
                                    </span>
                                </div>

                                <div>
                                    <span class="key text-nowrap">{{ translate('product_type') }}</span>
                                    <span>:</span>
                                    <span class="value">{{ translate($product->product_type) }}</span>
                                </div>
                                @if($product->product_type == 'physical')
                                    <div>
                                        <span class="key text-nowrap">{{ translate('current_Stock') }}</span>
                                        <span>:</span>
                                        <span class="value">{{ $product->current_stock}}</span>
                                    </div>
                                @endif
                                <div>
                                    <span class="key text-nowrap">{{ translate('SKU') }}</span>
                                    <span>:</span>
                                    <span class="value">{{ $product->code}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <h4 class="mb-3">{{ translate('price_information') }}</h4>

                            <div class="pair-list">
                                <div>
                                    <span class="key text-nowrap">{{ translate('purchase_price') }}</span>
                                    <span>:</span>
                                    <span class="value">
                                        {{setCurrencySymbol(amount: usdToDefaultCurrency(amount: $product->purchase_price), currencyCode: getCurrencyCode()) }}
                                    </span>
                                </div>

                                <div>
                                    <span class="key text-nowrap">{{ translate('unit_price') }}</span>
                                    <span>:</span>
                                    <span class="value">
                                        {{setCurrencySymbol(amount: usdToDefaultCurrency(amount: $product->unit_price), currencyCode: getCurrencyCode()) }}
                                    </span>
                                </div>

                                <div>
                                    <span class="key text-nowrap">{{ translate('tax') }}</span>
                                    <span>:</span>
                                    @if ($product->tax_type =='percent')
                                        <span class="value">
                                            {{ $product->tax}}% ({{ $product->tax_model}})
                                        </span>
                                    @else
                                        <span class="value">
                                            {{setCurrencySymbol(amount: usdToDefaultCurrency(amount: $product->tax)) }} ({{ $product->tax_model }})
                                        </span>
                                    @endif
                                </div>
                                @if($product->product_type == 'physical')
                                    <div>
                                        <span class="key text-nowrap">{{ translate('shipping_cost') }}</span>
                                        <span>:</span>
                                        <span class="value">
                                            {{setCurrencySymbol(amount: usdToDefaultCurrency(amount: $product->shipping_cost)) }}
                                            @if ($product->multiply_qty == 1)
                                                ({{ translate('multiply_with_quantity') }})
                                            @endif
                                        </span>
                                    </div>
                                @endif
                                @if($product->discount > 0)
                                    <div>
                                        <span class="key text-nowrap">{{ translate('discount') }}</span>
                                        <span>:</span>
                                        @if ($product->discount_type == 'percent')
                                            <span class="value">{{ $product->discount }}%</span>
                                        @else
                                            <span class="value">
                                                {{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $product->discount), currencyCode: getCurrencyCode()) }}
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if ($product->product_type == 'physical' && count($product->choice_options) >0 || count(json_decode($product->colors)) >0 )
                            <div class="col-sm-6 col-xl-4">
                                <h4 class="mb-3">{{ translate('available_variations') }}</h4>

                                <div class="pair-list">
                                    @if ($product->choice_options != null)
                                    
                                        @foreach ($product->choice_options as $key => $value)
                                            <div>
                                                @if (!empty($value['options']))
                                                    <span class="key text-nowrap">{{ $value['title'] }}</span>
                                                    <span>:</span>
                                                    <span class="value">
                                                    @foreach ($value['options'] as $index => $option)
                                                        {{ $option }}
                                                        @if ($index === array_key_last(($value['options'])))
                                                            @break
                                                        @endif
                                                        ,
                                                    @endforeach
                                                </span>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif

                                    @if ($productColors != null)
                                        <div>
                                            <span class="key text-nowrap">{{ translate('color') }}</span>
                                            <span>:</span>
                                            <span class="value">
                                                @foreach ($productColors as $key => $color)
                                                    {{ $key }}
                                                    @if ($key === array_key_last($productColors))
                                                        @break
                                                    @endif
                                                    ,
                                                @endforeach
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="table-responsive datatable-custom">
                <table
                    class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100 text-start">
                    <thead class="thead-light thead-50 text-capitalize">
                    <tr>
                        <th>{{ translate('SL') }}</th>
                        <th>{{ translate('reviewer') }}</th>
                        <th>{{ translate('rating') }}</th>
                        <th>{{ translate('review') }}</th>
                        <th>{{ translate('date') }}</th>
                        <th>{{ translate('action') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($reviews as $key=>$review)
                        @if(isset($review->customer))
                            <tr>
                                <td>{{ $reviews->firstItem()+$key}}</td>
                                <td>
                                    <a class="d-flex align-items-center"
                                       href="{{ route('admin.customer.view',[$review['customer_id']]) }}">
                                        <div class="avatar rounded">
                                            <img class="avatar-img"
                                                 src="{{ getValidImage(path: 'storage/app/public/profile/'.$review->customer->image,type: 'backend-basic') }}"
                                                 alt="">
                                        </div>
                                        <div class="{{ Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">
                                            <span class="d-block h5 text-hover-primary mb-0">
                                                {{ $review->customer['f_name']." ".$review->customer['l_name']}}
                                                <i class="tio-verified text-primary" data-toggle="tooltip"
                                                   data-placement="top" title="Verified Customer"></i>
                                            </span>
                                            <span class="d-block font-size-sm text-body">
                                                {{ $review->customer->email ?? "" }}
                                            </span>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2 text-primary">
                                        <i class="tio-star"></i>
                                        <span>{{ $review->rating }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-wrap max-w-400 min-w-200">
                                        <p>
                                            {{ $review['comment']}}
                                        </p>
                                        @if(json_decode($review->attachment))
                                            @foreach (json_decode($review->attachment) as $img)
                                                <a class="aspect-1 float-left overflow-hidden"
                                                   href="{{ asset('storage/app/public/review') }}/{{ $img}}"
                                                   data-lightbox="mygallery">
                                                    <img class="p-2" width="60" height="60"
                                                         src="{{ getValidImage(path: 'storage/app/public/review/'.$img,type: 'backend-basic') }}">
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    {{date('d M Y H:i:s',strtotime($review['updated_at'])) }}
                                </td>
                                <td>
                                    <form
                                        action="{{ route('admin.reviews.status', [$review['id'], $review->status ? 0 : 1]) }}"
                                        method="get" id="reviews-status{{ $review['id']}}-form">
                                        <label class="switcher mx-auto">
                                            <input type="checkbox" class="switcher_input toggle-switch-message"
                                                   name="status"
                                                   id="reviews-status{{ $review['id'] }}" value="1"
                                                   {{ $review['status'] == 1 ? 'checked' : '' }}
                                                   data-modal-id="toggle-status-modal"
                                                   data-toggle-id="reviews-status{{ $review['id'] }}"
                                                   data-on-image="customer-reviews-on.png"
                                                   data-off-image="customer-reviews-off.png"
                                                   data-on-title="{{ translate('Want_to_Turn_ON_Customer_Reviews') }}"
                                                   data-off-title="{{ translate('Want_to_Turn_OFF_Customer_Reviews') }}"
                                                   data-on-message="<p>{{ translate('if_enabled_anyone_can_see_this_review_on_the_user_website_and_customer_app') }}</p>"
                                                   data-off-message="<p>{{ translate('if_disabled_this_review_will_be_hidden_from_the_user_website_and_customer_app') }}</p>">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-responsive mt-4">
                <div class="px-4 d-flex justify-content-lg-end">
                    {!! $reviews->links() !!}
                </div>
            </div>

            @if(count($reviews)==0)
                <div class="text-center p-4">
                    <img class="mb-3 w-160" src="{{ asset('public/assets/back-end/svg/illustrations/sorry.svg') }}"
                         alt="">
                    <p class="mb-0">{{ translate('no_data_to_show') }}</p>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="publishNoteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ translate('denied_note') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-group" action="{{ route('admin.products.deny', ['id'=>$product['id']]) }}"
                      method="post">
                    @csrf
                    <div class="modal-body">
                        <textarea class="form-control" name="denied_note" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('close') }}
                        </button>
                        <button type="submit" class="btn btn--primary">{{ translate('save_changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
