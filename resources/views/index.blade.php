<ul class="shortcode_index">

    @foreach($index as $item)
            <li class="level-{{ $item['level'] }}">
                <a href="#{{$item['id']}}">
                    {{$item['title']}}
                </a>
            </li>

    @endforeach

</ul>
