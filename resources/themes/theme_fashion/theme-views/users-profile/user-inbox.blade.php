@extends('theme-views.layouts.app')

@section('title', translate('my_inbox').' | '.$web_config['name']->value.' '.translate('ecommerce'))

@section('content')
    <section class="user-profile-section section-gap pt-0">
        <div class="container" style="display: flex;flex-direction: row;">
            <div style="width: 20%; " class="d-none d-md-block">
                @php
                    $customer_info = \App\Utils\customer_info();
                @endphp
                <div class="user-author-info mt-4">
                    <img loading="lazy" alt="{{ translate('profile') }}"
                        src="{{ getValidImage(path: 'storage/app/public/profile/' . $customer_info->image, type: 'avatar') }}">
                    <div class="content">
                        <h4 class="name mb-lg-2">{{ $customer_info->f_name }} {{ $customer_info->l_name }}</h4>
                        <span>{{ translate('joined') }} {{ date('d M, Y', strtotime($customer_info->created_at)) }}</span>
                    </div>
                </div>
                @php($wish_list_count = \App\Models\Wishlist::where('customer_id', auth('customer')->user()->id)->whereHas('wishlistProduct')->count())
                <ul class="nav nav-tabs nav--tabs-3 justify-content-start mb-0 d-none d-md-block mt-4">
                    <li class="nav-item">
                        <a href="{{ route('user-profile') }}"
                            class="nav-link {{ Request::is('user-profile') || Request::is('user-account') || Request::is('account-address-*') ? 'active' : '' }}">{{ translate('profile') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('account-oder') }}"
                            class="nav-link {{ Request::is('account-oder*') || Request::is('account-order-details*') || Request::is('refund-details*') || Request::is('track-order/order-wise-result-view*') ? 'active' : '' }}">{{ translate('my_order') }}
                            ({{ auth('customer')->user()->orders->count() }})</a>
                    </li>
                    <li class="nav-item">

                        <a href="{{ route('wishlists') }}"
                            class="nav-link {{ Request::is('wishlists') ? 'active' : '' }}">{{ translate('my_wishlist') }}
                            ({{ $wish_list_count }})</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product-compare.index') }}"
                            class="nav-link {{ Request::is('product-compare/index') ? 'active' : '' }}">{{ translate('my_compare_list') }}</a>
                    </li>
                    @if ($web_config['wallet_status'] == 1)
                        <li class="nav-item">
                            <a href="{{ route('wallet') }}"
                                class="nav-link {{ Request::is('wallet') || Request::is('loyalty') ? 'active' : '' }} ">{{ translate('my_wallet') }}</a>
                        </li>
                    @endif
                    @if ($web_config['loyalty_point_status'] == 1 && $web_config['wallet_status'] != 1)
                        <li class="nav-item">
                            <a href="{{ route('loyalty') }}"
                                class="nav-link {{ Request::is('loyalty') ? 'active' : '' }} ">{{ translate('my_wallet') }}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('chat', ['type' => 'seller']) }}"
                            class="nav-link {{ Request::is('chat/seller') || Request::is('chat/delivery-man') ? 'active' : '' }}">{{ translate('inbox') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('account-tickets') }}"
                            class="nav-link {{ Request::is('account-tickets') || Request::is('support-ticket*') ? 'active' : '' }}">{{ translate('support') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('my-child.list') }}"
                            class="nav-link {{ Request::is('my-child') || Request::is('my-child*') ? 'active' : '' }}">{{ translate('my_child') }}</a>
                    </li>

                    @if ($web_config['ref_earning_status'])
                        <li class="nav-item">
                            <a href="{{ route('refer-earn') }}"
                                class="nav-link {{ Request::is('refer-earn') || Request::is('refer-earn*') ? 'active' : '' }}">{{ translate('refer_&_Earn') }}</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ route('user-coupons') }}"
                            class="nav-link {{ Request::is('user-coupons') || Request::is('user-coupons*') ? 'active' : '' }}">{{ translate('coupons') }}</a>
                    </li>

                </ul>
            </div>
            <div style="width: 80%;">
            @include('theme-views.partials._profile-aside')
            <div class="tab-pane" id="inbox">
                <div class="__chat-area">
                    <div class="__chat-menu">
                        <h5 class="title">{{ translate('messages') }}</h5>
                        <form class="position-relative search--group mb-2">
                            <button type="submit" class="btn floating-icon"><i class="bi bi-search"></i></button>
                            <input type="text" id="myInput" class="form-control btn-pill --block-size-35"
                                   placeholder="{{ translate('search') }}...">
                        </form>
                        <ul class="nav nav-tabs nav--tabs-3">
                            <li class="nav-item">
                                <a href="{{route('chat', ['type' => 'seller'])}}"
                                   class="nav-link {{Request::is('chat/seller')?'active':''}}">{{ translate('vendor') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('chat', ['type' => 'delivery-man'])}}"
                                   class="text-capitalize nav-link {{Request::is('chat/delivery-man')? 'active':''}}">{{ translate('delivery_man') }}</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active ">
                                <ul class="nav nav-tabs nav-tabs-menu">
                                    @if (isset($unique_shops))
                                        @foreach($unique_shops as $key=>$shop)
                                            @php($type = $shop->delivery_man_id ? 'delivery-man' : 'seller')
                                            @php($unique_id = $shop->delivery_man_id ?? $shop->shop_id)
                                            <div class="nav-item">
                                                <a href="javascript:"
                                                   data-linkpath="{{route('chat', ['type' => $type])}}/?id={{$unique_id}}"
                                                   class="thisIsALinkElement chat_list nav-link {{($last_chat->delivery_man_id==$unique_id || $last_chat->shop_id==$unique_id) ? 'active' : ''}}"
                                                   id="user_{{$unique_id}}">

                                                    @if($shop->delivery_man_id)
                                                        <img loading="lazy" class="img" alt="{{ translate('user') }}"
                                                             src="{{ getValidImage(path: 'storage/app/public/delivery-man/'.$shop->image, type: 'avatar') }}">
                                                    @else
                                                        <img loading="lazy" class="img" alt="{{ translate('user') }}"
                                                             src="{{ getValidImage(path: 'storage/app/public/shop/'.$shop->image, type: 'shop') }}">
                                                    @endif

                                                    <div class="content">
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="name "
                                                                id="{{$unique_id}}">{{$shop->f_name? $shop->f_name. ' ' . $shop->l_name: $shop->name}}
                                                            </h5>
                                                            <span
                                                                class="date">{{date('M d',strtotime($shop->created_at))}}</span>
                                                        </div>
                                                        <div class="msg mt-1">
                                                            {{$shop->seller_email ?: $shop->email}}
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="__chat-content">
                        @if(isset($last_chat))
                            <div class="tab-content">
                                <div class="tab-pane fade show active ">
                                    <div class="__chat-content-header">
                                        <a href="javascript:" class="chat-author">
                                            @if($last_chat->deliveryMan)
                                                <img loading="lazy" class="img" alt="{{ translate('user') }}"
                                                     src="{{ getValidImage(path: 'storage/app/public/delivery-man/'.($last_chat->deliveryMan->image), type: 'avatar') }}">
                                            @else
                                                <img loading="lazy" class="img" alt="{{ translate('user') }}"
                                                     src="{{ getValidImage(path: 'storage/app/public/shop/'.($last_chat->shop->image), type: 'shop') }}">
                                            @endif

                                            <div class="content">
                                                <h5 class="name mt-11">{{$last_chat->deliveryMan?$last_chat->deliveryMan->f_name.' '.$last_chat->deliveryMan->l_name : $last_chat->shop->name  }}</h5>

                                            </div>
                                        </a>
                                    </div>
                                    <div class="__chat-content-body scroll_msg" id="show_msg">
                                        <ul class="__chat-content-body-messages msg_history">
                                            @if (isset($chattings))
                                                @foreach($chattings as $key => $chat)

                                                    @if ($chat->sent_by_seller?: $chat->sent_by_delivery_man)
                                                        <li class="incoming">
                                                            @if($chat->sent_by_delivery_man)
                                                                <img loading="lazy" class="img" alt="{{ translate('user') }}"
                                                                     src="{{ getValidImage(path: 'storage/app/public/delivery-man/'.$chat->image, type: 'avatar') }}">
                                                            @else
                                                                <img loading="lazy" class="img" alt="{{ translate('user') }}"
                                                                     src="{{ getValidImage(path: 'storage/app/public/shop/'.$chat->image, type: 'shop') }}">
                                                            @endif

                                                            <div class="msg-area">
                                                                @if($chat->message)
                                                                    <div class="msg">
                                                                        {{$chat->message}}
                                                                    </div>
                                                                @endif

                                                                @if (json_decode($chat['attachment']) !=null)
                                                                    <div class="d-flex flex-wrap g-2 gap-2 justify-content-start">
                                                                        @foreach (json_decode($chat['attachment']) as $index => $photo)
                                                                            @if(file_exists(base_path("storage/app/public/chatting/".$photo)))
                                                                                <img loading="lazy" src="{{ getValidImage(path: "storage/app/public/chatting/".$photo, type: 'product') }}" height="100"
                                                                                class="rounded" alt="{{ translate('verification') }}">
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                @endif

                                                                @if ($chat->created_at->diffInDays(\Carbon\Carbon::now()) < 7)
                                                                    <small class="date">{{ date('D h:i:A',strtotime($chat->created_at)) }}</small>
                                                                @else
                                                                    <small class="date">{{ date('d M Y h:i:A',strtotime($chat->created_at)) }}</small>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @else
                                                        <li class="outgoing" id="outgoing_msg">
                                                            <div class="msg-area">
                                                                @if($chat->message)
                                                                <div class="msg">
                                                                    {{$chat->message}}
                                                                </div>
                                                                @endif

                                                                @if (json_decode($chat['attachment']) !=null)
                                                                    <div class="d-flex flex-wrap g-2 gap-2 justify-content-start">
                                                                        @foreach (json_decode($chat['attachment']) as $index => $photo)
                                                                            @if(file_exists(base_path("storage/app/public/chatting/".$photo)))
                                                                                <img loading="lazy" src="{{ getValidImage(path: "storage/app/public/chatting/".$photo, type: 'product') }}" height="100"
                                                                                class="rounded" alt="{{ translate('verification') }}">
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                @endif

                                                                @if ($chat->created_at->diffInDays(\Carbon\Carbon::now()) < 7)
                                                                    <small class="date">{{ date('D h:i:A',strtotime($chat->created_at)) }}</small>
                                                                @else
                                                                    <small class="date">{{ date('d M Y h:i:A',strtotime($chat->created_at)) }}</small>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endForeach
                                                <div id="down"></div>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="__chat-content-footer">
                                <form id="myForm">
                                    @csrf
                                    <div id="view" class="view-img"></div>
                                    <div class="d-flex align-items-center">
                                        @if( Request::is('chat/seller') )
                                            <input type="text" id="hidden_value" hidden
                                                   value="{{$last_chat->shop_id}}" name="">
                                            @if($last_chat->shop)
                                                <input type="text" id="seller_value" hidden
                                                       value="{{$last_chat->shop->seller_id}}" name="">
                                            @endif
                                        @elseif( Request::is('chat/delivery-man') )
                                            <input type="text" id="hidden_value_dm" hidden
                                                   value="{{$last_chat->delivery_man_id}}" name="">
                                        @endif

                                        <textarea class="form-control ps-4 w-0 flex-grow-1" id="msgInputValue"
                                                  placeholder="{{translate('start_a_new_message')}}"></textarea>

                                        <button type="submit" class="btn ms-1" id="msgSendBtn">
                                            <img loading="lazy" src="{{ theme_asset('assets/img/icons/reply.png') }}" alt="{{ translate('reply') }}">
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="text-center pt-5 w-100">
                                <div class="text-center mb-5">
                                    <img loading="lazy" src="{{ theme_asset('assets/img/icons/nodata.svg') }}" alt="{{ translate('no_conversation_found') }}">
                                    <h5 class="my-3 pt-1 text-muted">
                                        {{translate('no_conversation_found')}}!
                                    </h5>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <span class="messages-storage"
        data-messagesroute="{{ route('messages_store') }}"
        data-textnow="{{ translate('now') }}">
    </span>
@endsection

@push('script')
<script src="{{ theme_asset('assets/js/user-inbox.js') }}"></script>
@endpush
