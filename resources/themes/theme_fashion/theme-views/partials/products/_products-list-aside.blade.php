<div class="close-sidebar d-lg-none">
    <i class="bi bi-x-lg"></i>
</div>

<div class="filter-header d-none d-lg-flex justify-content-between align-items-center">
    <h5 class="subtitle text-base"><i class="bi bi-funnel"></i><span>{{ translate('filter') }}</span></h5>
    <button type="button" class="btn btn-soft-base fashion_products_list_form_reset">
        <i class="bi bi-arrow-repeat"></i> {{ translate('reset') }}
    </button>
</div>

@if(!Request::is('/'))
    <div class="d-lg-none mb-4 text-capitalize">
        <h5 class="mb-2">{{ translate('filter_by') }}</h5>
        <div class="position-relative select2-prev-icon d-lg-none">
            <i class="bi bi-sort-up"></i>
            <select class="select2-init-js form-control size-40px filter_select_input filter_by_product_list_mobile"
                    name="sort_by" data-primary_select="{{translate('sort_by')}} : {{translate('default')}}">
                <option value="default">{{translate('sort_by')}} : {{translate('default')}}</option>
                <option value="latest" {{ request('data_from') == 'latest' ? 'selected':'' }}>{{translate('sort_by')}}
                    : {{translate('latest')}}</option>
                <option value="a-z">{{translate('sort_by')}} : {{translate('a_to_z_order')}}</option>
                <option value="z-a">{{translate('sort_by')}} : {{translate('z_to_a_Order')}}</option>
                <option value="low-high">{{translate('sort_by')}} : {{translate('low_to_high_price')}}
                </option>
                <option value="high-low">{{translate('sort_by')}} : {{translate('high_to_low_price')}}
                </option>
            </select>
        </div>
    </div>
@endif

@isset($categories)
    <div class="widget">
        <div class="widget-header open">
            <h5 class="title text-capitalize">{{ translate('all_categories') }}</h5>
            <div class="chevron-icon">
                <i class="bi bi-chevron-down"></i>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-body-inner">
                <div class="all-categories">

                    @foreach($categories as $category)
                        <div class="form--check">
                            <label class="form--check-inner category_class_for_tag_{{ $category['id'] }}">
                                <input type="checkbox" name="category[]"
                                       value="{{$category['id']}}" {{request('data_from')=='category' && $category['id']==request('id')?'checked' :''}}>
                                <span class="check-icon"><i class="bi bi-check"></i></span>
                                <span class="form-check-label">{{$category['name']}}</span>
                                <span class="badge badge-soft-base ms-auto">{{ isset($category->product_count)?$category->product_count:'0' }}</span>
                            </label>
                            @if ($category->childes->count() > 0)
                                <div class="form-check-subgroup">
                                    @foreach($category->childes as $child)
                                        <div class="form--check">
                                            <label class="form--check-inner category_class_for_tag_{{ $child['id'] }}">
                                                <input type="checkbox" name="category[]" value="{{$child['id']}}">
                                                <span class="check-icon"><i class="bi bi-check"></i></span>
                                                <span class="form-check-label">{{$child['name']}}</span>
                                                <span class="badge badge-soft-base ms-auto">{{ isset($child->sub_category_product_count)?$child->sub_category_product_count:'0' }}</span>
                                            </label>
                                            @if ($child->childes->count() > 0)
                                                <div class="form-check-subgroup">
                                                    @foreach($child->childes as $ch)
                                                        <div class="form--check">
                                                            <label class="form--check-inner category_class_for_tag_{{ $ch['id'] }}">
                                                                <input type="checkbox" name="category[]"
                                                                       value="{{$ch['id']}}">
                                                                <span class="check-icon"><i
                                                                            class="bi bi-check"></i></span>
                                                                <span class="form-check-label">{{$ch['name']}}</span>
                                                                <span class="badge badge-soft-base ms-auto">{{ isset($ch->sub_sub_category_product_count)?$ch->sub_sub_category_product_count:'0' }}</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endisset

@if($web_config['brand_setting'])
    @php($brands = isset($brands) ? $brands : \App\Utils\BrandManager::get_active_brands())
    @isset($brands)
        <div class="widget">
            <div class="widget-header open">
                <h5 class="title">{{ translate('brands') }}</h5>
                <div class="chevron-icon">
                    <i class="bi bi-chevron-down"></i>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-body-inner">
                    <div class="all-brands">
                        @foreach($brands as $brand)
                            <div class="form--check">
                                <label class="form--check-inner brand_class_for_tag_{{ $brand['id'] }}">
                                    <input type="checkbox" name="brand[]"
                                           value="{{ $brand['id'] }}" {{request('data_from')=='brand' && $brand['id']==request('id')?'checked' :''}}>
                                    <span class="check-icon"><i class="bi bi-check"></i></span>
                                    <span class="form-check-label">{{ $brand['name'] }}</span>
                                    <span class="badge badge-soft-base ms-auto">{{ (isset($brand->count)?$brand->count:$brand->brand_products_count) ?? 0 }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endisset
@endif


<div class="widget">
    <div class="widget-header open">
        <h5 class="title text-capitalize">{{ translate('price_range') }}</h5>
        <div class="chevron-icon">
            <i class="bi bi-chevron-down"></i>
        </div>
    </div>
    <div class="widget-body">
        <div class="widget-body-inner">
            <div class="price-range-slider px-3">
                <div id="input-slider"></div>
                <div class="d-flex justify-content-between mt-3">
                    <div>{{session('currency_symbol')}}{{ translate('0.00') }}</div>
                    <div>{{session('currency_symbol')}}{{ translate('10,00000') }}</div>
                </div>
            </div>
        </div>
    </div>
    <input type="number" class="form-control" name="price_min" id="price-range-start" hidden>
    <input type="number" class="form-control" name="price_max" id="price-range-end" hidden>
</div>

<div class="widget">
    <div class="widget-header open">
        <h5 class="title text-capitalize">{{ translate('by_review_rating') }}</h5>
        <div class="chevron-icon">
            <i class="bi bi-chevron-down"></i>
        </div>
    </div>
    <div class="widget-body">
        <div class="widget-body-inner">
            <div class="review-rating-group">
                <label>
                    <input type="checkbox" name="rating[]" value="1">
                    <span class="review_class_for_tag_1">
                        <i class="bi bi-star-fill text-star"></i>
                        <span>1</span>
                    </span>
                </label>
                <label>
                    <input type="checkbox" name="rating[]" value="2">
                    <span class="review_class_for_tag_2">
                        <i class="bi bi-star-fill text-star"></i>
                        <span>2</span>
                    </span>
                </label>
                <label>
                    <input type="checkbox" name="rating[]" value="3">
                    <span class="review_class_for_tag_3">
                        <i class="bi bi-star-fill text-star"></i>
                        <span>3</span>
                    </span>
                </label>
                <label>
                    <input type="checkbox" name="rating[]" value="4">
                    <span class="review_class_for_tag_4">
                        <i class="bi bi-star-fill text-star"></i>
                        <span>4</span>
                    </span>
                </label>
                <label>
                    <input type="checkbox" name="rating[]" value="5">
                    <span class="review_class_for_tag_5">
                        <i class="bi bi-star-fill text-star"></i>
                        <span>5</span>
                    </span>
                </label>
            </div>
        </div>
    </div>
</div>
@foreach($mergedChoices as $key => $filter)
    <div class="widget">
        <div class="widget-header open">
            <h5 class="title">{{$filter['title']}}</h5>
            <div class="chevron-icon">
                <i class="bi bi-chevron-down"></i>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-body-inner">
                <div class="all-brands">
                        @foreach($filter['options'] as $options)
                        <div class="form--check">
                            <label class="form--check-inner brand_class_for_tag_gender">
                                <input type="checkbox" name="{{$filter['title']}}[]"
                                    value="{{ $options }}" >
                                <span class="check-icon"><i class="bi bi-check"></i></span>
                                <span class="form-check-label">{{ $options }}</span>
                            </label>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>  
    <hr/>
@endforeach

<!-- @isset($colors)
    <div class="widget">
        <div class="widget-header open">
            <h5 class="title">{{ translate('color') }}</h5>
            <div class="chevron-icon">
                <i class="bi bi-chevron-down"></i>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-body-inner">
                <div class="check-color-group">
                    @foreach ($colors as $color)
                        <label>
                            <input type="checkbox" name="colors[]" value="{{ $color }}">
                            <span style="--base:{{ $color }}">
                        <i class="bi bi-check"></i>
                    </span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endisset

{{-- Gender --}}
<div class="widget">
    <div class="widget-header open">
        <h5 class="title">Gender</h5>
        <div class="chevron-icon">
            <i class="bi bi-chevron-down"></i>
        </div>
    </div>
    <div class="widget-body">
        <div class="widget-body-inner">
            <div class="all-brands">
                    <div class="form--check">
                        <label class="form--check-inner brand_class_for_tag_gender">
                            <input type="checkbox" name="gender[]"
                                   value="unisex" >
                            <span class="check-icon"><i class="bi bi-check"></i></span>
                            <span class="form-check-label">Unisex</span>
                            {{-- <span class="badge badge-soft-base ms-auto">{{ (isset($gender->count)?$gender->count:$gender->gender_products_count) ?? 0 }}</span> --}}
                        </label>
                    </div>
                    <div class="form--check">
                        <label class="form--check-inner brand_class_for_tag_gender">
                            <input type="checkbox" 
                            @if(isset($genders))
                            {{ $genders == 'male' ? 'checked' : '' }}
                            @endif
                            name="gender[]"
                                   value="male" >
                            <span class="check-icon"><i class="bi bi-check"></i></span>
                            <span class="form-check-label">Boy</span>
                            {{-- <span class="badge badge-soft-base ms-auto">{{ (isset($gender->count)?$gender->count:$gender->gender_products_count) ?? 0 }}</span> --}}
                        </label>
                    </div>
                    <div class="form--check">
                        <label class="form--check-inner brand_class_for_tag_gender">
                            <input type="checkbox"
                            @if(isset($genders))
                            {{ $genders == 'female' ? 'checked' : '' }}
                            @endif
                            name="gender[]"
                                   value="female" >
                            <span class="check-icon"><i class="bi bi-check"></i></span>
                            <span class="form-check-label">Girl</span>
                            {{-- <span class="badge badge-soft-base ms-auto">{{ (isset($gender->count)?$gender->count:$gender->gender_products_count) ?? 0 }}</span> --}}
                        </label>
                    </div>
            </div>
        </div>
    </div>
</div>  


{{-- Size --}}
@isset($sizes)
<div class="widget">
    <div class="widget-header open">
        <h5 class="title">Size</h5>
        <div class="chevron-icon">
            <i class="bi bi-chevron-down"></i>
        </div>
    </div>
    <div class="widget-body">
        <div class="widget-body-inner">
            <div class="all-brands">
                    @foreach($sizes as $size)
                    <div class="form--check">
                        <label class="form--check-inner brand_class_for_tag_gender">
                            <input type="checkbox" name="size[]"
                                   value="{{ $size }}" >
                            <span class="check-icon"><i class="bi bi-check"></i></span>
                            <span class="form-check-label">{{ $size }}</span>
                            {{-- <span class="badge badge-soft-base ms-auto">{{ (isset($gender->count)?$gender->count:$gender->gender_products_count) ?? 0 }}</span> --}}
                        </label>
                    </div>
                    @endforeach
            </div>
        </div>
    </div>
</div>  
@endisset -->
