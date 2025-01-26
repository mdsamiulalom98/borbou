<link rel="stylesheet" href="{{ asset('public/backEnd/') }}/assets/libs/dropify/css/dropify.min.css" />
@php
    $memberimage = App\Models\Memberimage::where('member_id', Auth::guard('member')->user()->id)->first();
@endphp
@if ($memberimage->image_one)
    <div class="image-div">
        <a data-id="{{ $memberimage->id }}" class="member-image member-image-one">
            ডিলিট করুন
        </a>
        <img src="{{ asset($memberimage->image_one) }}" />
    </div>
@else
    <input type="file" name="image_one" id="image_one" data-plugins="dropify"
        class="dropify @error('image_one') is-invalid @enderror" required />
    @error('image_one')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    @endif @if ($memberimage->image_two)
        <div class="image-div">
            <a data-id="{{ $memberimage->id }}" class="member-image member-image-two">
                ডিলিট করুন
            </a>
            <img src="{{ asset($memberimage->image_two) }}" />
        </div>
    @else
        <input type="file" name="image_two" id="image_two" data-plugins="dropify"
            class="dropify @error('image_two') is-invalid @enderror" required />
        @error('image_two')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        @endif @if ($memberimage->image_three)
            <div class="image-div">
                <a data-id="{{ $memberimage->id }}" class="member-image member-image-three">
                    ডিলিট করুন
                </a>
                <img src="{{ asset($memberimage->image_three) }}" />
            </div>
        @else
            <input type="file" name="image_three" id="image_three" data-plugins="dropify"
                class="dropify @error('image_three') is-invalid @enderror" required />
            @error('image_three')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        @endif


        <script src="{{ asset('public/frontEnd/js/jquery-3.6.3.min.js') }}"></script>
        <script src="{{ asset('public/backEnd/') }}/assets/libs/dropify/js/dropify.min.js"></script>
        <script>
            $('.dropify').dropify();
        </script>
        <script>
            $('.member-image-one').on('click', function() {
                var id = $(this).data('id');
                if (id) {
                    $.ajax({
                        cache: 'false',
                        type: "GET",
                        url: "{{ url('member/delete-image-one') }}/" + id,
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                console.log("success");
                                return photo_load();
                            }
                        },

                    });
                }
            });

            $('.member-image-two').on('click', function() {
                var id = $(this).data('id');
                // alert(id);
                if (id) {
                    $.ajax({
                        cache: 'false',
                        type: "GET",
                        url: "{{ url('member/delete-image-two') }}/" + id,
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                console.log("success");
                                return photo_load();
                            }
                        },

                    });
                }
            });

            $('.member-image-three').on('click', function() {
                var id = $(this).data('id');
                if (id) {
                    $.ajax({
                        cache: 'false',
                        type: "GET",
                        url: "{{ url('member/delete-image-three') }}/" + id,
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                console.log("success");
                                return photo_load();
                            }
                        },

                    });
                }
            });

            function photo_load() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('photos.load') }}",
                    success: function(data) {
                        if (data) {
                            $("#editPhotos").html(data);
                        } else {
                            $("#editPhotos").empty();
                        }
                    },
                });
            }
        </script>
