@foreach ($productReviews as $item)
<li class="mb-4 border-bottom pb-3">
    <div class="d-flex align-items-center">
        <img loading="lazy" alt="{{ translate('profile') }}" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;"
             src="{{ getValidImage(path: 'storage/app/public/profile/'.(isset($item->user) ? $item->user->image : ''), type: 'avatar') }}">
        <div>
            <h6 class="mb-1 font-weight-bold">
                @if($item->user)
                    <span class="text-capitalize">{{ $item->user->f_name }} {{ $item->user->l_name }}</span>
                @else
                    <span class="text-capitalize">{{ translate('user_not_exist') }}</span>
                @endif
            </h6>
            <span class="d-flex align-items-center">
                @php
                    $rating = $item->rating; // Assuming rating is a number like 4.5 or 3
                    $fullStars = floor($rating); // Number of full stars
                    $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0; // Whether to show a half star
                    $emptyStars = 5 - ($fullStars + $halfStar); // Number of empty stars
                @endphp
                
                {{-- Display full stars --}}
                @for ($i = 0; $i < $fullStars; $i++)
                    <i class="bi bi-star-fill text-warning"></i>
                @endfor

                {{-- Display half star if needed --}}
                @if ($halfStar)
                    <i class="bi bi-star-half text-warning"></i>
                @endif

                {{-- Display empty stars --}}
                @for ($i = 0; $i < $emptyStars; $i++)
                    <i class="bi bi-star text-muted"></i>
                @endfor
            </span>
        </div>
    </div>

    <div class="content-area mt-3">
        <p class="mb-3 review-comment-id{{ $item['id'] }}-primary">
            @if(mb_strlen(strip_tags(str_replace('&nbsp;', ' ', $item->comment))) > 450)
                {{ Str::limit(strip_tags(str_replace('&nbsp;', ' ', $item->comment)), 450) }}
                <span class="text-primary cursor-pointer fw-bold read-more-current-review" data-element=".review-comment-id{{ $item['id'] }}">{{ translate('read_more') }}</span>
            @else
                {!! $item->comment !!}
            @endif
        </p>

        <p class="mb-3 review-comment-id{{ $item['id'] }}-hidden d-none">
            {!! $item->comment !!}
        </p>

        @if(isset($item->attachment) && !empty(json_decode($item->attachment)))
        <div class="products-comments-img d-flex flex-wrap gap-2 mt-2">
            @foreach (json_decode($item->attachment) as $img)
                <a href="{{ getValidImage(path: 'storage/app/public/review/'.$img, type: 'product') }}" class="custom-image-popup d-inline-block border rounded overflow-hidden" style="width: 80px; height: 80px; object-fit: cover;">
                    <img loading="lazy" class="w-100 h-100" src="{{ getValidImage(path: 'storage/app/public/review/'.$img, type: 'product') }}" alt="{{$item->name}}">
                </a>
            @endforeach
        </div>
        @endif
    </div>
</li>
@endforeach
