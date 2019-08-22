
@if($items)
    @foreach($items as $item)
        <li class="rich_media_content" data-id="{{$item->id}}" data-vip="1" data-click="{{$item->clicks}}" data-fav="0" data-title="{{$item->title}}" data-time="{{$item->created_at}}" data-free="0" data-action="style" data-type="style" >
            <i class="fa fa-heart-o cursor-fav"></i>
            {!! $item->content !!}
        </li>
    @endforeach
@endif