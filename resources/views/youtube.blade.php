@if($youtubeId)
	<span class="shortcode_youtube">
    <iframe class="aspect-video" src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}&autoplay=1" srcdoc="<style>*{padding:0;margin:0;overflow:hidden}html,body{height:100%}img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 0.5em black}</style><a href=https://www.youtube-nocookie.com/embed/{{ $youtubeId }}?autoplay=1><img style='object-fit:cover;height:100%;width:100%' loading='lazy' src=https://i.ytimg.com/vi_webp/{{ $youtubeId }}/hqdefault.webp alt='{{ $youtubeId }}'
        loading=lazy><span>▶</span></a>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;
        picture-in-picture" allowfullscreen title="{{ $youtubeId }}"></iframe>
</span>
@endif
