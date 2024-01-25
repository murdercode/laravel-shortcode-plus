<ul class="shortcode_index">
    @foreach($index as $item)
        <li class="level-{{ $item['level'] }}">
            <a href="#{{$item['id']}}">
                {{$item['title']}}
            </a>
        </li>

        @foreach($item['childrens'] as $firstChildren)
            <ul>
                <li class="level-{{ $firstChildren['level'] }}">
                    <a href="#{{$firstChildren['id']}}">
                        {{$firstChildren['title']}}
                    </a>
                </li>

                @if(isset($firstChildren['childrens']))
                    @foreach($firstChildren['childrens'] as $secondChildren)
                        <ul>
                            <li class="level-{{ $secondChildren['level'] }}">
                                <a href="#{{$secondChildren['id']}}">
                                    {{$secondChildren['title']}}
                                </a>
                            </li>
                        </ul>
                    @endforeach
                @endif

            </ul>

        @endforeach

   @endforeach
</ul>
