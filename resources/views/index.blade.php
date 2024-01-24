<section class="not-prose">
    @foreach($index as $item)
        <a href="#{{$item['id']}}"
        style="margin-left:
        {{$item['level'] == 3 ? '8px' : ''}}
        {{$item['level'] == 4 ? '16px' : ''}}; display: block"
        >
            {{$item['title']}}
        </a>

    @endforeach

</section>
