<ul class="list-unstyled d-flex justify-content-around gap-3 mb-0 position-relative">
    <li>
        <a href="{{ Request::is('/') || Request::is('home') ? 'javascript:void(0)' : route('home') }}"
            class="d-flex align-items-center {{ Request::is('/') || Request::is('home') ? 'active' : '' }} flex-column gap-1 py-3">
            @if(Request::is('/') || Request::is('home'))
                <i class="bi bi-house-door-fill custom-icon"></i>
            @else
                <i class="bi bi-house-door custom-icon"></i>
            @endif
            <span>{{ translate('shopping') }}</span>
        </a>
    </li>
    <li>
        <a href="{{ Request::is('/categories-detail') || Request::is('categories-detail') ? 'javascript:void(0)' : route('categories-detail') }}"
            class="d-flex align-items-center {{ Request::is('/categories-detail') || Request::is('categories-detail') ? 'active' : '' }} flex-column gap-1 py-3">
            @if(Request::is('/categories-detail') || Request::is('categories-detail'))
                <i class="bi bi-collection-play-fill custom-icon"></i>
            @else
                <i class="bi bi-collection-play custom-icon"></i>
            @endif
            <span>{{ translate('explore') }}</span>
        </a>
    </li>
    <li>
        <a href="{{ Request::is('/parenting-user') || Request::is('parenting-user') ? 'javascript:void(0)' : route('parenting') }}"
            class="d-flex align-items-center {{ Request::is('/parenting-user') || Request::is('parenting-user') ? 'active' : '' }} flex-column gap-1 py-3">
            @if(Request::is('/parenting-user') || Request::is('parenting-user'))
                <i class="bi bi-chat-square-heart-fill custom-icon"></i>
            @else
                <i class="bi bi-chat-square-heart custom-icon"></i>
            @endif
            <span>{{ translate('parenting') }}</span>
        </a>
    </li>
    @if (auth('customer')->check())
        <li>
            {{-- <a href="{{ route('user-profile') }}"
                class="d-flex align-items-center {{ Request::is('/user-profile') || Request::is('user-profile') ? 'active' : '' }} flex-column gap-1 py-3">
                <i class="bi bi-person custom-icon"></i>
                <span>{{ translate('profile') }}</span>
            </a> --}}
            <a href="{{ route('user-profile') }}"
                class="d-flex align-items-center {{ Request::is('/user-profile') || Request::is('user-profile') ? 'active' : '' }} flex-column gap-1 py-3">
                @if(Request::is('/user-profile') || Request::is('user-profile'))
                    <i class="bi bi-person-fill custom-icon"></i>
                @else
                    <i class="bi bi-person custom-icon"></i>
                @endif
                <span>{{ translate('profile') }}</span>
            </a>

        </li>
    @else
        <li>
            <a href="javascript:"
                class="d-flex align-items-center {{ Request::is('/user-profile') || Request::is('user-profile') ? 'active' : '' }}   flex-column gap-1 py-3 customer_login_register_modal">
                <i class="bi bi-person custom-icon"></i>
                <span>{{ translate('profile') }}</span>
            </a>
        </li>
    @endif
    <li>
        <a href="{{ route('home') }}"
            class="d-flex align-items-center {{ Request::is('/home') || Request::is('home') ? 'active' : '' }} flex-column gap-1 py-3">
            <i class="bi bi-list custom-icon"></i>
            <span>{{ translate('menu') }}</span>
        </a>
    </li>


    {{-- below is previous work which has 4 buttons which are HOME WISHLIST CART COMPARE --}}


    {{-- <li>
        <a href="{{route('home')}}"
           class="d-flex align-items-center {{ (Request::is('/') || Request::is('home')) ? 'active':''}} flex-column gap-1 py-3">
            <i class="bi bi-house-door fs-18"></i>
            <span>{{translate('home')}}</span>
        </a>
    </li>
    @if (auth('customer')->check())
        <li>
            <a href="{{ route('wishlists') }}"
               class="d-flex align-items-center {{ Request::is('wishlists') ? 'active' : '' }} flex-column gap-1 py-3">
                <div class="position-relative">
                    <i class="bi bi-heart fs-18"></i>
                    <span class="app-count">
                        <span
                                class="wishlist_count_status">{{session()->has('wish_list')?count(session('wish_list')):0}}</span>
                    </span>
                </div>
                <span>{{ translate('wishlist') }}</span>
            </a>
        </li>
    @else
        <li>
            <a href="javascript:"
               class="d-flex align-items-center flex-column gap-1 py-3 customer_login_register_modal">
                <div class="position-relative">
                    <i class="bi bi-heart fs-18"></i>
                    <span class="app-count">0</span>
                </div>
                <span>{{ translate('wishlist') }}</span>
            </a>
        </li>
    @endif

    <li>
        @php($cart=\App\Utils\CartManager::get_cart())
        @if ($cart->count() > 0)
            @php($sub_total=0)
            @php($total_tax=0)
            @foreach ($cart as $cartItem)
                @php($sub_total+=($cartItem['price']-$cartItem['discount'])*(int)$cartItem['quantity'])
                @php($total_tax+=$cartItem['tax']*(int)$cartItem['quantity'])
            @endforeach
        @endif
        <div class="dropup position-static d-xl-none">
            <a href="javascript:" class="d-flex align-items-center flex-column gap-1 py-3" data-toggle="collapse"
               data-target="cart_dropdown">
                <div class="position-relative">
                    <i class="bi bi-bag fs-18"></i>
                    <span class="btn-status app-count">{{$cart->count()}}</span>
                </div>
                <span>{{translate('cart')}}</span>
            </a>

            <ul class="dropdown-menu scrollY-60 p-3 min-vw-100" id="cart_dropdown">
                @if ($cart->count() > 0)
                    @include('theme-views.layouts.partials._cart-data',['cart'=>$cart])
                    <li>
                        <div class="app-cart-subtotal">
                            <span class="text-base">{{translate('subtotal')}}</span>
                            <span class="cart_total_amount">{{\App\Utils\Helpers::currency_converter($sub_total)}}</span>
                        </div>

                        <div class="d-flex gap-3 mt-3">
                            @if ($web_config['guest_checkout_status'] || auth('customer')->check())
                                <a href="{{route('shop-cart')}}"
                                   class="btn btn-outline-base flex-grow-1">{{translate('view_all_cart_items')}}</a>
                                <a href="{{route('checkout-details')}}"
                                   class="btn btn-base flex-grow-1">{{translate('go_to_checkout')}}</a>
                            @else
                                <a href="javascript:"
                                   class="btn btn-outline-base flex-grow-1 customer_login_register_modal">{{translate('view_all_cart_items')}}</a>
                                <a href="javascript:"
                                   class="btn btn-base flex-grow-1 customer_login_register_modal">{{translate('go_to_checkout')}}</a>
                            @endif
                        </div>
                    </li>
                @else
                    <div class="widget-cart-item">
                        <h6 class="text-danger text-center m-0 p-2">
                            <i class="fa fa-cart-arrow-down"></i> {{translate('empty_Cart')}}
                        </h6>
                    </div>
                @endif
            </ul>
        </div>
    </li>

    @if (auth('customer')->check())
        <li>
            <a href="{{ route('product-compare.index') }}"
               class="d-flex align-items-center {{ Request::is('compare-list') ? 'active' : '' }} flex-column gap-1 py-3">
                <div class="position-relative">
                    <i class="bi bi-repeat fs-18"></i>
                    <span class="app-count compare_list_count_status top-0">
                        {{ session()->has('compare_list') ? count(session('compare_list')) : 0}}
                    </span>
                </div>
                <span>{{ translate('compare') }}</span>
            </a>
        </li>
    @else
        <li>
            <a href="javascript:"
               class="d-flex align-items-center text-dark flex-column gap-1 py-3 customer_login_register_modal">
                <div class="position-relative">
                    <i class="bi bi-repeat fs-18"></i>
                </div>
                <span>{{ translate('compare') }}</span>
            </a>
        </li>
    @endif --}}
</ul>
<style>
    .custom-icon {
        font-size: 18px;
    }
</style>
