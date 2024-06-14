
<div class="tagcloud">
    @foreach($countries as $country)
        <a onclick="getIdReceiver({!! $country->id !!})" id="{!! $country->id !!}"
           data-id="{!! $country->id !!}" data-name="{!! $country->iso3 !!}" data-img="{!! asset("storage/".$country->flag) !!}">
            <img width="50" src="{!! asset("storage/".$country->flag) !!}" alt=""/>
            <span>{!! $country->iso3 !!}</span></a>
    @endforeach
</div>
