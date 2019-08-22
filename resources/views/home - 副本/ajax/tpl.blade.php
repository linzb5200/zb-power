
@if($tpl_data)
    @foreach($tpl_data as $item)
        <li class="rich_media_content" data-id="{{$item->id}}" data-vip="1" data-click="{{$item->clicks}}" data-fav="0" data-title="{{$item->title}}" data-time="{{$item->created_at}}" data-free="0" >
            {!! $item->content !!}
        </li>
    @endforeach
@endif