@if(isset($widgetbayLink))
    <iframe src="{{ $widgetbayLink }}" allowfullscreen="true" scrolling="no"
            class="shortcode_widgetbay _iub_cs_activate" frameborder="0" height="420" loading="lazy" style="width:100%;overflow-y:hidden;"></iframe>
@else

{{--   TODO: Il Widgetbox è completo, bisogna solo condizionare {!! $oembed->css !!}, in modo che venga generato una sola volta.
        Ho provato con uno script JS, ma non funziona.
        La soluzione, concordata al momento, è quella di importare il CSS direttamente sui portali (in app.css), con un @import.
        Bisogna capire però come gestire su Widgetbay, perché il CSS viene generato su un blade.
  --}}

{{--    {!! $oembed->css !!}--}}

    <div class="not-prose" style="max-width: 750px">
        {!! $oembed->html !!}
    </div>
@endif

