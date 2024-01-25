<section class="index not-prose">
    @foreach($index as $item)
        <a href="#{{$item['id']}}"
        style="
        {{$item['level'] == 3 ? 'margin-left: 15px; color: #313131;' : ''}}
        {{$item['level'] == 4 ? 'margin-left: 30px; color: #484848;' : ''}};"
        >
            {{$item['title']}}
        </a>

    @endforeach

</section>
