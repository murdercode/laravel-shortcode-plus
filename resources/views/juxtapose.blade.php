<div class="juxtapose">
    @foreach($images as $image)
        <img src="{{ asset('storage/' . $image->src ) }}" alt="{{$image->title}}" class="w-full h-full object-cover" />
    @endforeach
</div>

<script src="https://cdn.knightlab.com/libs/juxtapose/latest/js/juxtapose.min.js"></script>
