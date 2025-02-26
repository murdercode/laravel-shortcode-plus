@if($html)
    <div class="flex justify-center bsky-card">
        {!! $html !!}
    </div>
@else
    <p>Sorry, no post found.</p>
@endif
