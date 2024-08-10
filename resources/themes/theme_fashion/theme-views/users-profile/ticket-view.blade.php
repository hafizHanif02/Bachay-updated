@extends('theme-views.layouts.app')

@section('title', translate('support_ticket_inbox').' | '.$web_config['name']->value.' '.translate('ecommerce'))

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
            <div class="card ov-hidden border-0 shadow-sm">
                <div class="bg-section rounded d-flex gap-3 flex-wrap align-items-start justify-content-between p-3 ">
                    <div class="media flex-wrap gap-3">
                        <div class="rounded-circle overflow-hidden width-5-312rem">
                            <img loading="lazy"
                                 src="{{getValidImage(path: 'storage/app/public/profile'.\App\Utils\customer_info()->image,type: 'avatar')}}"
                                 class="rounded w-100 other-store-logo " alt="{{ translate('products') }}">
                        </div>
                        <div class="media-body">
                            <div class="d-flex flex-column gap-1">
                                <div class="d-flex gap-2 align-items-center">
                                    <h6 class="">{{ \App\Utils\customer_info()->f_name }}
                                        &nbsp{{ \App\Utils\customer_info()->l_name }}</h6>
                                    <span
                                        @if($ticket->priority == 'Urgent')
                                            class="badge bg-danger rounded-pill"
                                        @elseif($ticket->priority == 'High')
                                            class="badge bg-warning rounded-pill"
                                        @elseif($ticket->priority == 'Medium')
                                            class="badge bg-primary rounded-pill"
                                        @else
                                            class="badge bg-base rounded-pill"
                                        @endif
                                        >{{ translate($ticket->priority) }}</span>
                                </div>
                                <div class="fs-12 text-muted">{{ \App\Utils\customer_info()['email'] }}</div>
                                <div class="d-flex flex-wrap align-items-center column-gap-4">
                                    <div class="d-flex align-items-center gap-2 gap-md-3">
                                        <div class="fw-bold">{{translate('status')}}:</div>
                                        <span
                                            class="{{$ticket->status ==  'open' ? ' text-info ' : 'text-danger'}} fw-semibold">{{ translate($ticket->status) }}</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 gap-md-3">
                                        <div class="fw-bold">{{translate('priority')}}:</div>
                                        <span
                                            @if($ticket->priority == 'Urgent')
                                                class="text-danger fw-bold"
                                            @elseif($ticket->priority == 'High')
                                                class="text-warning fw-bold "
                                            @elseif($ticket->priority == 'Medium')
                                                class="text-primary fw-bold"
                                            @else
                                                class="text-success fw-bold"
                                            @endif> {{ translate($ticket->priority) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($ticket->status != 'close')
                        <a href="{{route('support-ticket.close',[$ticket['id']])}}"
                           class="btn btn-outline-danger">{{ translate('close_this_ticket') }}</a>
                    @endif
                </div>

                <div class="__chat-content-body msg_history">
                    <ul class="__chat-content-body-messages ">
                        <li class="outgoing">
                            <div class="msg-area">
                                <div class="msg">
                                    {{ $ticket['description']}}
                                </div>
                                <small class="date">{{ date('D h:i:A',strtotime($ticket['created_at'])) }}</small>
                            </div>
                        </li>
                        @foreach($ticket->conversations as $conversation)
                            @if($conversation['admin_id'] != null)
                                <li class="incoming">
                                    @php($admin=$conversation->adminInfo)
                                    <img loading="lazy"
                                        src="{{ getValidImage(path: 'storage/app/public/admin/'.($admin['image'] ?? ''), type: 'avatar') }}"
                                        class="img mb-2" alt="{{ translate('user') }}">
                                    <div class="msg-area">
                                        @if($conversation['admin_message'])
                                            <div class="msg">
                                                {{ $conversation['admin_message']}}
                                            </div>
                                        @endif
                                        @if ($conversation['attachment'] !=null && count(json_decode($conversation['attachment'])) > 0)
                                            <div class="d-flex flex-wrap g-2 gap-2 justify-content-start">
                                                @foreach (json_decode($conversation['attachment']) as $key => $photo)
                                                    @if(file_exists(base_path("storage/app/public/support-ticket/".$photo)))
                                                    <img src="{{ getValidImage(path: 'storage/app/public/support-ticket/'.$photo, type: 'product') }}"
                                                    height="100" class="rounded" alt="{{ translate('ticket') }}">
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif

                                        <small class="date">{{ date('D h:i:A',strtotime($conversation['created_at'])) }}</small>
                                    </div>
                                </li>
                            @else
                                <li class="outgoing">
                                    <div class="msg-area">
                                        @if($conversation['customer_message'])
                                        <div class="msg">
                                            {{ $conversation['customer_message']}}
                                        </div>
                                        @endif
                                        @if ($conversation['attachment'] !=null && count(json_decode($conversation['attachment'])) > 0)
                                            <div class="d-flex flex-wrap g-2 gap-2 justify-content-end">
                                                @foreach (json_decode($conversation['attachment']) as $key => $photo)
                                                    @if(file_exists(base_path("storage/app/public/support-ticket/".$photo)))
                                                    <img src="{{ getValidImage(path: 'storage/app/public/support-ticket/'.$photo, type: 'product') }}"
                                                    height="100" class="rounded" alt="{{ translate('ticket') }}">
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                        <small class="date">{{ date('D h:i:A',strtotime($conversation['created_at'])) }}</small>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="bg-section p-3">
                    <form action="{{route('support-ticket.comment',[$ticket['id']])}}" method="post">
                        @csrf
                        <div id="view" class="view-img"></div>
                        <div class="d-flex align-items-center">
                            <textarea
                                class="form-control ps-4 w-0 flex-grow-1" id="msgInputValueTicket" name="comment"
                                placeholder="{{translate('start_typing')}}"></textarea>
                            <button type="submit" class="btn ms-1">
                                <img loading="lazy" src="{{theme_asset('assets/img/icons/reply.png')}}" alt="{{ translate('comment') }}">
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>

    </section>
@endsection

@push('script')
<script src="{{ theme_asset('assets/js/ticket-view.js') }}"></script>
@endpush



