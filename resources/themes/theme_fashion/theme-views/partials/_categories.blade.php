<section class="most-visited-category section-gap pb-0 text-center pt-3">
    <div class="container-fluid">
        <div class="section-title-3 mb-0">
            {{-- <div class="mb-32px"> --}}
            {{-- <h2 class="title mx-auto mb-0 text-capitalize">{{ translate('most_visited_categories') }}</h2> --}}
            <h2 class="title mx-auto mb-3 text-capitalize">{{ translate('our_categories') }}</h2>

            {{-- </div> --}}
        </div>

        <div class="most-visited-category-wrapper align-items-center row">
            @foreach ($most_visited_categories as $key => $item)
                {{-- @if ($key != 0 && $key < 8) --}}
                    <div class="col">
                        <a href="{{ route('categories.detail', $item->name) }}"
                            class="most-visited-item d-block text-center ">
                            <img loading="lazy" alt="{{ translate('category') }}"
                                src="{{ getValidImage(path: 'storage/app/public/category/' . $item->icon, type: 'category') }}"
                                class="img-fluid mb-2">
                            <h4 class="title">{{ $item->name }}</h4>
                            <h4 class="title2">Category</h4>
                            <!-- <div class="cont">
                                <h6 class="text-white font-semibold text-uppercase">{{ $item->name }}</h6>
                                <span>{{ $item->product_count }} {{ translate('product') }}</span>
                                <i class="bi bi-eye-fill"></i>
                            </div> -->
                        </a>
                    </div>
                {{-- @endif --}}
            @endforeach

            <div class="col">
                        <a href="{{ route('categories.detail', $item->name) }}"
                            class="most-visited-item d-block text-center ">
                            <img loading="lazy" alt="{{ translate('category') }}"
                                src="https://bachay.com/public/assets/images/staticImages/girl0to6.png"
                                class="img-fluid mb-2">
                            <h4 class="title">0-6 Months</h4>
                            <h4 class="title2">Girls Fashion</h4>
                            <!-- <div class="cont">
                                <h6 class="text-white font-semibold text-uppercase">{{ $item->name }}</h6>
                                <span>{{ $item->product_count }} {{ translate('product') }}</span>
                                <i class="bi bi-eye-fill"></i>
                            </div> -->
                        </a>
            </div>
            <div class="col">
                        <a href="{{ route('categories.detail', $item->name) }}"
                            class="most-visited-item d-block text-center ">
                            <img loading="lazy" alt="{{ translate('category') }}"
                                src="https://bachay.com/public/assets/images/staticImages/boy0to6.png"
                                class="img-fluid mb-2">
                            <h4 class="title">0-6 Months</h4>
                            <h4 class="title2">Boys Fashion</h4>
                            <!-- <div class="cont">
                                <h6 class="text-white font-semibold text-uppercase">{{ $item->name }}</h6>
                                <span>{{ $item->product_count }} {{ translate('product') }}</span>
                                <i class="bi bi-eye-fill"></i>
                            </div> -->
                        </a>
            </div>
            <div class="col">
                        <a href="{{ route('categories.detail', $item->name) }}"
                            class="most-visited-item d-block text-center ">
                            <img loading="lazy" alt="{{ translate('category') }}"
                                src="https://bachay.com/public/assets/images/staticImages/girl6to24.png"
                                class="img-fluid mb-2">
                            <h4 class="title">6-24 Months</h4>
                            <h4 class="title2">Girls Fashion</h4>
                            <!-- <div class="cont">
                                <h6 class="text-white font-semibold text-uppercase">{{ $item->name }}</h6>
                                <span>{{ $item->product_count }} {{ translate('product') }}</span>
                                <i class="bi bi-eye-fill"></i>
                            </div> -->
                        </a>
            </div>
            
        </div>

        <div class="most-visited-category-wrapper align-items-center row">
           
            <div class="col">
                        <a href="{{ route('categories.detail', $item->name) }}"
                            class="most-visited-item d-block text-center ">
                            <img loading="lazy" alt="{{ translate('category') }}"
                                src="https://bachay.com/public/assets/images/staticImages/girl2to4.png"
                                class="img-fluid mb-2">
                            <h4 class="title">2-4 Years</h4>
                            <h4 class="title2">Girls Fashion</h4>
                            <!-- <div class="cont">
                                <h6 class="text-white font-semibold text-uppercase">{{ $item->name }}</h6>
                                <span>{{ $item->product_count }} {{ translate('product') }}</span>
                                <i class="bi bi-eye-fill"></i>
                            </div> -->
                        </a>
            </div>
            <div class="col">
                        <a href="{{ route('categories.detail', $item->name) }}"
                            class="most-visited-item d-block text-center ">
                            <img loading="lazy" alt="{{ translate('category') }}"
                                src="https://bachay.com/public/assets/images/staticImages/boy6to24.png"
                                class="img-fluid mb-2">
                            <h4 class="title">6-24 Months</h4>
                            <h4 class="title2">Boys Fashion</h4>
                            <!-- <div class="cont">
                                <h6 class="text-white font-semibold text-uppercase">{{ $item->name }}</h6>
                                <span>{{ $item->product_count }} {{ translate('product') }}</span>
                                <i class="bi bi-eye-fill"></i>
                            </div> -->
                        </a>
            </div>
            <div class="col">
                        <a href="{{ route('categories.detail', $item->name) }}"
                            class="most-visited-item d-block text-center ">
                            <img loading="lazy" alt="{{ translate('category') }}"
                                src="https://bachay.com/public/assets/images/staticImages/boy2to4.png"
                                class="img-fluid mb-2">
                            <h4 class="title">2-4 Years</h4>
                            <h4 class="title2">Boys Fashion</h4>
                            <!-- <div class="cont">
                                <h6 class="text-white font-semibold text-uppercase">{{ $item->name }}</h6>
                                <span>{{ $item->product_count }} {{ translate('product') }}</span>
                                <i class="bi bi-eye-fill"></i>
                            </div> -->
                        </a>
            </div>
            <div class="col">
                        <a href="{{ route('categories.detail', $item->name) }}"
                            class="most-visited-item d-block text-center ">
                            <img loading="lazy" alt="{{ translate('category') }}"
                                src="https://bachay.com/public/assets/images/staticImages/girl4to6.png"
                                class="img-fluid mb-2">
                            <h4 class="title">4-6 Years</h4>
                            <h4 class="title2">Girls Fashion</h4>
                            <!-- <div class="cont">
                                <h6 class="text-white font-semibold text-uppercase">{{ $item->name }}</h6>
                                <span>{{ $item->product_count }} {{ translate('product') }}</span>
                                <i class="bi bi-eye-fill"></i>
                            </div> -->
                        </a>
            </div>
            <div class="col">
                        <a href="{{ route('categories.detail', $item->name) }}"
                            class="most-visited-item d-block text-center ">
                            <img loading="lazy" alt="{{ translate('category') }}"
                                src="https://bachay.com/public/assets/images/staticImages/boy4to6.png"
                                class="img-fluid mb-2">
                            <h4 class="title">4-6 Years</h4>
                            <h4 class="title2">Boys Fashion</h4>
                            <!-- <div class="cont">
                                <h6 class="text-white font-semibold text-uppercase">{{ $item->name }}</h6>
                                <span>{{ $item->product_count }} {{ translate('product') }}</span>
                                <i class="bi bi-eye-fill"></i>
                            </div> -->
                        </a>
            </div>

            <div class="col">
                        <a href="{{ route('categories.detail', $item->name) }}"
                            class="most-visited-item d-block text-center ">
                            <img loading="lazy" alt="{{ translate('category') }}"
                                src="https://bachay.com/public/assets/images/staticImages/toys&bags.png"
                                class="img-fluid mb-2">
                            <h4 class="title">Toys & Bags</h4>
                            <h4 class="title2">Kids Toys</h4>
                            <!-- <div class="cont">
                                <h6 class="text-white font-semibold text-uppercase">{{ $item->name }}</h6>
                                <span>{{ $item->product_count }} {{ translate('product') }}</span>
                                <i class="bi bi-eye-fill"></i>
                            </div> -->
                        </a>
            </div>

            <div class="col">
                        <a href="{{ route('categories.detail', $item->name) }}"
                            class="most-visited-item d-block text-center ">
                            <img loading="lazy" alt="{{ translate('category') }}"
                                src="https://bachay.com/public/assets/images/staticImages/inOutDoor.png"
                                class="img-fluid mb-2">
                            <h4 class="title">In/Out Doors</h4>
                            <h4 class="title2">Kids Toys</h4>
                            <!-- <div class="cont">
                                <h6 class="text-white font-semibold text-uppercase">{{ $item->name }}</h6>
                                <span>{{ $item->product_count }} {{ translate('product') }}</span>
                                <i class="bi bi-eye-fill"></i>
                            </div> -->
                        </a>
            </div>
            
        </div>
        
    </div>
</section>
