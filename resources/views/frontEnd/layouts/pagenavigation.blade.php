<div class="page-navigation">
    <ul>
        @foreach($footer_left as $key=>$value)
        <li><a href="{{route('page.show',['slug'=>$value->slug])}}">{{$value->name}}</a></li>
        @endforeach
        @foreach($footer_right as $key=>$value)
        <li><a href="{{route('page.show',['slug'=>$value->slug])}}">{{$value->name}}</a></li>
        @endforeach
        <li><a href="{{route('contact')}}">যোগাযোগ করুন</a></li>
    </ul>
</div>