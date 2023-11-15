@if(isset($widgetbayLink))
    <iframe src="{{ $widgetbayLink }}" allowfullscreen="true" scrolling="no"
            class="shortcode_widgetbay _iub_cs_activate" frameborder="0" height="420" loading="lazy" style="width:100%;overflow-y:hidden;"></iframe>
@else
    {!! $oembed->css !!}
    {!! $oembed->html !!}
@endif

