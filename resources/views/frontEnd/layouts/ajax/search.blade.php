@if ($members)
    <div class="search_product">
        <ul>
            @foreach ($members as $value)
                <li>
                    <a href="{{ route('member.details', $value->id) }}">
                        <div class="search_img">
                            <img src="{{ asset($value->memberimage ? $value->memberimage->image_one : '') }}"
                                alt="" />
                        </div>
                        <div class="search_content">
                            <p class="price" style="font-weight: 600;margin-top: 5px;">আইডি নাম্বারঃ {{ $value->id ?? '---' }} </p>
                            <p class="name" style="font-weight: 600">{{ $value->fullName }}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
