@foreach($ids as $id)
    <div class="not-prose">
        <livewire:nova-survey :id="$id" />
    </div>
@endforeach

{{--
Required:
- Package: nova-survey-package on principal project
--}}
