<div class="relative w-full overflow-hidden transition-all duration-300 bg-white shadow-xl not-prose rounded-xl group">
    {{-- Link assoluto con play button sempre visibile --}}
    <a href="{{ $trivia->route }}" class="absolute inset-0 z-30 hover:!bg-transparent">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-[100%] md:-translate-y-1/2
             bg-red-500 text-white px-6 py-3 rounded-full shadow-xl group-hover:scale-110 transition-transform duration-300">
            <span class="text-lg font-bold whitespace-nowrap">Gioca ora!</span>
        </div>
    </a>

    <div class="relative">
        <div class="absolute inset-0 z-10 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        <img src="{{ $trivia->cover_image }}?width=991"
             srcset="
                 {{ $trivia->cover_image }}?width=607 640w,
                 {{ $trivia->cover_image }}?width=735 768w,
                 {{ $trivia->cover_image }}?width=991 1024w,
                 {{ $trivia->cover_image }}?width=834 1025w,
             "
             loading="lazy"
             alt="{{ $trivia->topic }}"
             class="w-full aspect-[9/12] md:aspect-[16/9] object-cover group-hover:scale-105 group-hover:translate-y-1 transition-all duration-500">

        {{-- Timer Badge --}}
        <div class="absolute z-20 space-y-1 top-4 right-4 text-end">
            <div
                class="inline-flex items-center gap-2 px-3 py-1 text-sm font-semibold text-white bg-red-500 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $trivia->answers_count }} domande
            </div>

            @if ($trivia->timer)
                <div
                    class="flex items-center gap-1 px-3 py-1 text-sm font-semibold text-white rounded-full bg-white/20 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $trivia->timer }}s per domanda
                </div>
            @endif

        </div>


        {{-- Content --}}
        <div
            class="absolute bottom-0 left-0 right-0 z-20 p-8 text-white bg-gradient-to-t from-black/80 via-black/40 to-transparent">
            @if ($trivia->close_date)
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-2 py-1 text-xs border rounded-md bg-white/20 backdrop-blur-sm border-white/10">
                        Si chiuderà {{ Carbon\Carbon::parse($trivia->close_date)->diffForHumans() }}
                    </span>
                </div>
            @endif

            <div class="flex flex-col gap-4">
                <h2
                    class="text-3xl md:text-4xl font-bold after:!hidden !m-0 leading-tight transition-transform duration-300">
                    {{ $trivia->topic }}
                </h2>

                <div class="flex items-center gap-4 text-sm text-white/70">
                    <span>Metti alla prova le tue conoscenze!</span>
                    <span class="flex items-center gap-1 pl-4 border-l border-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        {{ $trivia->played_count ?? 0 }} partecipazioni
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
