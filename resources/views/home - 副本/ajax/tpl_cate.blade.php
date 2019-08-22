
@if($items)
    @foreach($items as $item)

        <li class="layui-nav-item" data-id="{{$item['id']}}">
            <a href="javascript:;">{{$item['title']}}</a>
            @if($item['child'])
            <dl class="layui-nav-child">
                @foreach($item['child'] as $item2)
                <dd><a href="#">{{$item2['title']}}</a></dd>
                @endforeach
            </dl>
            @endif
        </li>
    @endforeach
@endif

    <li class="layui-nav-px" id="style_sort">排序:
        <span id="style_sort_addtime" class="active" title="按时间先后排序" data-type="sort" data-sort="addtime"><i class="fa fa-clock-o"></i>更新时间</span>
        <span id="style_sort_addtime" title="按热度先后排序" data-type="sort" data-sort="click"><i class="fa fa-fire"></i>热度</span>
        <span id="style_sort_addtime" title="按收藏数先后排序" data-type="sort" data-sort="fav"><i class="fa fa-heart"></i>收藏数</span>
        <span id="style_search"><i class="fa fa-search"></i>搜索</span>
        <div class="search_div" style="display: none;"><input type="text" autocomplete="off" class="layui-input" value=""><button data-type="style" class="layui-btn layui-btn-normal">搜索</button></div>
    </li>