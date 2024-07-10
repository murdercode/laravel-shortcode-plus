@php($randonString = Str::random(10))
<iframe src="{{ $widgetbayLink }}" allowfullscreen="true" scrolling="no"
        class="{{$height ? 'shortcode_widgetbay_list_' .$randonString : 'shortcode_widgetbay' }} _iub_cs_activate"
        frameborder="0" loading="lazy"
        style="width:100%;overflow-y:hidden;
        ">
</iframe>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const randomString = @json($randonString);
        const breakpoint = @json($height);
        const iframe = document.querySelector('.shortcode_widgetbay_list_' + randomString);
        if (iframe) {
            if (window.innerWidth < 768) {
                iframe.style.height = breakpoint.mobile + 'px';
            } else {
                iframe.style.height = breakpoint.desktop + 'px';
            }
        }
    });

</script>
