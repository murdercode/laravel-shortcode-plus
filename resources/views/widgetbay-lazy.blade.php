<div class="widgetbay-lazy-container">
    @livewire('widgetbay-renderer', ['link' => $link, 'layout' => $layout ?? 'default'], key('widgetbay-' . md5($link . ($layout ?? 'default'))))

    <style>
.widgetbay-lazy-container {
    margin: 1rem 0;
}
</style>
</div>


