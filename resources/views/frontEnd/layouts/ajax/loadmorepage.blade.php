@foreach($members as $key=>$value)
<div class="col-sm-4">
    <div class="seach-item">
        <a href="{{ route('member.details',$value->id) }}">
            <div class="prof_image">                                    
                <div class="meter">
                    <span style="width: 60%;">60% Match</span>
                </div>
                <div class="f-img">
                    <img src="{{ asset($value->memberimage?$value->memberimage->image_one:'')}}" alt="" />
                </div>
            </div>
            <div class="f-info">
                <span class="member-id">আইডি নাম্বারঃ <span class="count-number">{{ App\Converter\enandbn\BanglaConverter::en2bn($value->id)}}</span></span>
                <span class="name">{{ $value->fullName ?? '' }}</span>
                
            </div>
            <div class="person-info">
                <div class="p-details">
                    <ul>
                        <li class="residence">
                            <!--<p class="ml-text">বৈবাহিক অবস্থাঃ </p>-->
                            <p class="st-text">{{$value->basicinfo ? $value->basicinfo->maritalstatus ? $value->basicinfo->maritalstatus->title:'' : ''}} </p>
                        </li>
                        
                        <li class="residence">
                            <!--<p class="ml-text">বয়সঃ </p>-->
                            <p class="st-text">{{ App\Converter\enandbn\BanglaConverter::en2bn($value->basicinfo?$value->basicinfo->age:'') }} বছর</p>
                        </li>
                        
                         <li class="religion">
                            <!--<p class="ml-text">ধর্মঃ</p>-->
                            <p class="st-text">{{$value->basicinfo?$value->basicinfo->religion->title:''}}</p>
                        </li>
                        
                        <li class="residence">
                            <!--<p class="ml-text">পেশাঃ </p>-->
                            <p class="st-text longest">{{ $value->careerinfo ? $value->careerinfo->profession ? $value->careerinfo->profession->title : '' : '' }}</p>
                        </li>
                        
                       
                    
                        <li class="religion">
                            <!--<p class="ml-text">বিভাগঃ</p>-->
                            <p class="st-text">{{$value->basicinfo->division->title??''}}</p>
                        </li>
                        
                    
                        <li class="residence">
                            <!--<p class="ml-text">দেশঃ </p>-->
                            <p class="st-text">{{ $value->basicinfo ? $value->basicinfo->recidency->title : '' }}</p>
                        </li>
                        
                    
                        
                    </ul>
                </div>
                
            </div>
        </a>
    </div>
</div>
@if ($key % 3 == 2)
    <div class="col-sm-12 my-4">
        <div class="google_ads text-center ">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2119341173001568"
                crossorigin="anonymous"></script>
            <!-- Home page -->
            <ins class="adsbygoogle" style="display:block"
                data-ad-client="ca-pub-2119341173001568" data-ad-slot="2722493229"
                data-ad-format="auto" data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || [])
                .push({});
            </script>
        </div>
    </div>
@endif
@endforeach