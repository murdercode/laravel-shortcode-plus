@if($html)
	<div class="flex justify-center twitter-card" style="height: 764px">
	    {!! $html !!}
    </div>

    <style>
        .twitter-card blockquote{
            display: none;
        }
    </style>
@else
	<p>Sorry, no tweets found.</p>
@endif
