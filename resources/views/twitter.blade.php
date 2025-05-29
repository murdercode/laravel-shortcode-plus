@if($html)
    <div class="flex justify-center twitter-card">
        {!! $html !!}
    </div>
    @include('shortcode-plus::components.paywall')
@else
    <p>Sorry, no tweets found.</p>
@endif
