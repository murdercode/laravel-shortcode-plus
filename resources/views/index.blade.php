<ul class="shortcode_index">
    @foreach($index as $item)
        <li class="level-{{ $item['level'] }}">
            <a href="#{{$item['id']}}">
                {{html_entity_decode($item['title'])}}
            </a>

            @foreach($item['childrens'] as $firstChildren)
                <ul class="ul-level-{{ $firstChildren['level'] }}">
                    <li class="level-{{ $firstChildren['level'] }}">
                        <a href="#{{$firstChildren['id']}}">
                            {{html_entity_decode($firstChildren['title'])}}
                        </a>

                        @if(isset($firstChildren['childrens']))
                            @foreach($firstChildren['childrens'] as $secondChildren)
                                <ul class="ul-level-{{ $secondChildren['level'] }}">
                                    <li class="level-{{ $secondChildren['level'] }}">
                                        <a href="#{{$secondChildren['id']}}">
                                            {{html_entity_decode($secondChildren['title'])}}
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        @endif

                    </li>

                </ul>

            @endforeach

        </li>

    @endforeach
</ul>
