@if($html)
    <div class="flex justify-center bsky-card">
        {!! $html !!}
    </div>
    <aside class="shortcode_nocookie">
        {!! config('shortcode-plus.nocookie.text') !!} - bsky.app
    </aside>
@else
    <p>Sorry, no post found.</p>
@endif
