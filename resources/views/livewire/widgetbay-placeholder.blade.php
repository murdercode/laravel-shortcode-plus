@php
    // Estima il numero di prodotti dal link (conta le virgole + 1)
    $estimatedProducts = substr_count($link, ',') + 1;
    // Auto-detect layout basato sul numero stimato
    $skeletonLayout = $estimatedProducts === 1 ? 'hero' : ($estimatedProducts <= 3 ? 'compact' : 'vertical');
@endphp

<div class="border border-gray-300 rounded-lg p-4 my-4 bg-white shadow-sm widgetbay-skeleton-{{ $skeletonLayout }}" 
     data-estimated-products="{{ $estimatedProducts }}">



    @if ($skeletonLayout === 'hero')
        {{-- Hero skeleton: singolo prodotto in evidenza --}}
        <div class="flex flex-col md:flex-row gap-6 items-start mb-4">
            <div class="flex-none w-full md:w-48 max-w-48 h-36 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded-lg"></div>
            <div class="flex-1 flex flex-col gap-3">
                <div class="h-7 w-4/5 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
                <div class="h-16 w-full bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
                <div class="h-8 w-40 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
                <div class="h-11 w-44 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded-md"></div>
            </div>
        </div>
    @elseif ($skeletonLayout === 'compact')
        {{-- Compact skeleton: griglia di prodotti --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4" style="--skeleton-count: {{ min($estimatedProducts, 3) }}">
            @for ($i = 0; $i < min($estimatedProducts, 3); $i++)
                <div class="border border-gray-300 rounded-md p-3 bg-gray-50 flex flex-col gap-2">
                    <div class="h-20 w-32 mx-auto bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
                    <div class="h-5 w-11/12 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
                    <div class="h-10 w-full bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
                    <div class="flex justify-between items-center gap-2">
                        <div class="h-6 w-20 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
                        <div class="h-8 w-24 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
                    </div>
                </div>
            @endfor
        </div>
    @else
        {{-- Vertical skeleton: lista verticale --}}
        <div class="flex justify-between items-center mb-4 pb-2 border-b-2 border-gray-300">
            <div class="h-6 w-48 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
            <div class="h-5 w-20 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded-full"></div>
        </div>
        <div class="flex flex-col space-y-3">
            @for ($i = 0; $i < min($estimatedProducts, 5); $i++)
                <div class="border border-gray-300 rounded-md bg-white p-3 flex flex-col md:flex-row items-start gap-4">
                    <div class="flex-none w-20 h-16 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded self-center md:self-start"></div>
                    <div class="flex-1 flex flex-col gap-2">
                        <div class="h-5 w-3/4 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
                        <div class="h-8 w-full bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
                        <div class="h-4 w-4/5 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
                    </div>
                    <div class="flex-none flex flex-col items-end gap-2 text-center md:text-right">
                        <div class="h-6 w-16 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
                        <div class="h-7 w-14 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
                    </div>
                </div>
            @endfor
        </div>
        @if ($estimatedProducts > 5)
            <div class="text-center mt-4 pt-3 border-t border-gray-300">
                <div class="h-5 w-36 mx-auto bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 bg-[length:200%_100%] animate-pulse bg-[position:200%_0] rounded"></div>
            </div>
        @endif
    @endif
    
    <p class="text-gray-600 italic mt-4 text-sm text-center">
        Caricamento {{ $estimatedProducts === 1 ? 'prodotto' : ($estimatedProducts . ' prodotti') }}...
    </p>
    
    <script>
    console.log('Placeholder loaded for:', @json($link));
    console.log('Alpine.js available:', typeof Alpine !== 'undefined');
    </script>
</div>