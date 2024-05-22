@if($html)
    <div class="flex justify-center twitter-card">
        {!! $html !!}
    </div>
    <aside class="shortcode_nocookie">
        {!! config('shortcode-plus.nocookie.text') !!} - X.com
    </aside>
@else
    <p>Sorry, no tweets found.</p>
@endif
