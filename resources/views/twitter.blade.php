@if($html)
	<div class="flex justify-center twitter-card" style="min-height: 764px">
	    {!! $html !!}
    </div>
@else
	<p>Sorry, no tweets found.</p>
@endif
