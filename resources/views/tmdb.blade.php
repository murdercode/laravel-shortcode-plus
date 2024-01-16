<div class="shortcode_tmdb">

    <div class="shortcode_tmdb_bg">

        <div class="top-box flex">
            {{-- Poster--}}
            <div class="movie-poster">
                <img src="{{config('shortcode-plus.tmdb.image_base_uri')}}/w154{{$data->poster_path}}"
                     alt="Immagine di {{$data->title ?? $data->name}}" loading="lazy">
            </div>

            {{-- Movie Info --}}
            <div class="movie-info">

                {{--Title--}}
                <h3 class="dark:text-dark">
                    {{$data->title ?? $data->name}} ({{substr($data->release_date ?? $data->first_air_date, 0, 4)}})
                </h3>

                {{--Date--}}
                <span class="release-date">
                    {{ date('d/m/Y', strtotime($data->release_date ?? $data->first_air_date)) }} ({{$data->original_language}})
                </span>

                <div class="runtime-page-container flex">
                    {{--Runtime--}}
                    <div class="runtime">
                        @if(isset($data->runtime))
                            {{floor($data->runtime / 60)}}h {{$data->runtime % 60}}m
                        @endif

                        @if(isset($data->number_of_seasons))
                            {{$data->number_of_seasons}} stagioni
                        @endif
                    </div>

                    @if($moreLink)
                        <a href="{{$moreLink}}" class="go-to-page" target="_blank">
                            <span>Vai alla scheda</span>
                        </a>
                    @endif
                </div>

                {{--Genres--}}
                <div class="genres">
                    @foreach($data->genres as $genre)
                        <span>{{$genre->name}}</span>,
                    @endforeach
                </div>

            </div>
        </div>

        <div class="bottom-box">
            <p class="text-gray-700">
                {{Str::limit($data->overview, 160)}}
            </p>

                <div class="justwatch-box">
                @if(config('shortcode-plus.tmdb.justwatch_api_key'))
                    <div data-jw-widget data-api-key="{{config('shortcode-plus.tmdb.justwatch_api_key')}}"
                         data-object-type="{{$type}}"
                         data-id="{{$id}}"
                         data-id-type="tmdb"
                         data-scale="0.8"
                         data-offer-label="price"
                         data-no-offers-message="Non ancora disponibile per la visione."
                         data-theme="light">
                    </div>
                    <div class="not-prose">
                        <a target="_blank" data-original="https://www.justwatch.com" href="https://www.justwatch.com/it">
                            <img src="https://widget.justwatch.com/assets/JW_logo_black_10px.svg" width="90px" height="20px" alt="JustWatch" loading="lazy"/>
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{--    <div class="movie-poster-backdrop" style="background-image:url('{{config('shortcode-plus.tmdb.image_base_uri')}}/w780{{$data->backdrop_path}}')"></div>--}}
        <img src="{{config('shortcode-plus.tmdb.image_base_uri') . '/w780' . $data->backdrop_path}}" alt="Immagine di {{$data->title ?? $data->name}}"
             class="movie-poster-backdrop" loading="lazy">

</div>
