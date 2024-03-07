<section class="most-visited-category section-gap pb-0 text-center pt-3">
    <div class="container">
        <div class="section-title-3 mb-0">
            {{-- <div class="mb-32px"> --}}
            {{-- <h2 class="title mx-auto mb-0 text-capitalize">{{ translate('most_visited_categories') }}</h2> --}}
            <h2 class="title mx-auto mb-3 text-capitalize">{{ translate('our_categories') }}</h2>

            {{-- </div> --}}
        </div>

        <div class="most-visited-category-wrapper align-items-center row">
            @foreach ($most_visited_categories as $key => $item)
                {{-- @if ($key != 0 && $key < 8) --}}
                @if($item->id != '1')
                    <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                        <a href="{{ route('products', ['id' => $item->id, 'data_from' => 'category', 'page' => 1]) }}"
                            class="most-visited-item d-block text-center mb-4">
                            <img loading="lazy" alt="{{ translate('category') }}"
                                src="{{ getValidImage(path: 'storage/app/public/category/' . $item->icon, type: 'category') }}"
                                class="img-fluid mb-2">
                            <h4 class="title">{{ $item->name }}</h4>
                            <div class="cont">
                                <h6 class="text-white font-semibold text-uppercase">{{ $item->name }}</h6>
                                <span>{{ $item->product_count }} {{ translate('product') }}</span>
                                <i class="bi bi-eye-fill"></i>
                            </div>
                        </a>
                    </div>
                    @elseif($item->id == '1')
                    <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                        <a href="{{ route('categories.detail', $item->id) }}"
                            class="most-visited-item d-block text-center mb-4">
                            <img loading="lazy" alt="{{ translate('category') }}"
                                src="{{ getValidImage(path: 'storage/app/public/category/' . $item->icon, type: 'category') }}"
                                class="img-fluid mb-2">
                            <h4 class="title">{{ $item->name }}</h4>
                            <div class="cont">
                                <h6 class="text-white font-semibold text-uppercase">{{ $item->name }}</h6>
                                <span>{{ $item->product_count }} {{ translate('product') }}</span>
                                <i class="bi bi-eye-fill"></i>
                            </div>
                        </a>
                    </div>
                    @endif
                {{-- @endif --}}
            @endforeach
        </div>
        
    </div>
</section>
