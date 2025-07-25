<div class="w-full">
    <div class="flex flex-col items-start gap-6 md:flex-row md:items-center">
        @if (isset($product['image']) && $product['image'])
            <div class="flex-none w-full text-center md:w-48 md:max-w-48 md:text-left">
                <img alt="{{ $product['title'] ?? 'Prodotto' }}" 
                     width="160" 
                     height="160" 
                     class="object-contain object-center h-full !my-0 m-auto rounded-lg mix-blend-multiply" 
                     loading="lazy" 
                     decoding="async" 
                     src="{{ $product['image'] }}">
            </div>
        @endif
        
        <div class="flex-1 min-w-0">
            @if (isset($product['title']) && $product['title'])
                <h3 class="!mb-3 text-2xl font-black tracking-tight text-gray-900 line-clamp-2 md:truncate">{{ $product['title'] }}</h3>
            @endif
        
            
            <div class="mt-4">
                @if (isset($product['price']) && $product['price'])
                    <div class="flex items-center justify-between gap-3 mb-4">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl font-bold text-gray-900">{{ number_format($product['price'], 2, ',', '.') }}€</span>
                            @if (isset($product['original_price']) && $product['original_price'] && is_numeric($product['original_price']) && is_numeric($product['price']) && $product['original_price'] != $product['price'])
                                <span class="text-base text-gray-600 line-through">{{ number_format($product['original_price'], 2, ',', '.') }}€</span>
                                @php
                                    $discount = round((($product['original_price'] - $product['price']) / $product['original_price']) * 100);
                                @endphp
                                <span class="px-2 py-1 text-sm font-bold text-white bg-red-500 rounded">-{{ $discount }}%</span>
                            @endif
                        </div>
                        
                        @if (isset($product['link']) && $product['link'])
                            <div class="flex-shrink-0">
                                <a href="{{ $product['link'] }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer sponsored"
                                   class="!no-underline inline-block px-6 py-2 bg-red-500 text-white no-underline rounded-md font-bold text-base transition-all duration-300 hover:bg-red-600 hover:shadow-lg">
                                    <span class="hidden md:inline">Vedi su </span>{{ $product['shop_name'] ?? 'Shop' }}
                                </a>
                            </div>
                        @endif
                    </div>
                @elseif (isset($product['link']) && $product['link'])
                    <div class="flex justify-end">
                        <a href="{{ $product['link'] }}" 
                           target="_blank" 
                           rel="noopener noreferrer sponsored"
                           class="!no-underline inline-block px-6 py-2 bg-red-500 text-white no-underline rounded-md font-bold text-base transition-all duration-300 hover:bg-red-600 hover:shadow-lg">
                            <span class="hidden md:inline">Vedi su </span>{{ $product['shop_name'] ?? 'Shop' }}
                        </a>
                    </div>
                @endif
            </div>
            
        </div>
    </div>
</div>