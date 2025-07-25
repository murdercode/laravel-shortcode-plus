<div class="w-full">
    <div class="flex flex-col md:flex-row gap-6 items-start">
        @if (isset($product['image']) && $product['image'])
            <div class="flex-none w-full md:w-48 max-w-48 text-center md:text-left">
                <img src="{{ $product['image'] }}" 
                     alt="{{ $product['title'] ?? 'Prodotto' }}"
                     loading="lazy"
                     class="w-full h-auto rounded-lg object-cover">
            </div>
        @endif
        
        <div class="flex-1 min-w-0">
            @if (isset($product['title']) && $product['title'])
                <h3 class="text-2xl font-bold text-gray-900 mb-3 leading-tight">{{ $product['title'] }}</h3>
            @endif
            
            @if (isset($product['description']) && $product['description'])
                <div class="text-gray-600 leading-relaxed mb-4">
                    {!! $product['description'] !!}
                </div>
            @endif
            
            <div class="mt-4">
                @if (isset($product['price']) && $product['price'])
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl font-bold text-red-500">{{ number_format($product['price'], 2, ',', '.') }}€</span>
                        @if (isset($product['original_price']) && $product['original_price'] && is_numeric($product['original_price']) && is_numeric($product['price']) && $product['original_price'] != $product['price'])
                            <span class="text-base text-gray-400 line-through">{{ number_format($product['original_price'], 2, ',', '.') }}€</span>
                            @php
                                $discount = round((($product['original_price'] - $product['price']) / $product['original_price']) * 100);
                            @endphp
                            <span class="bg-red-500 text-white px-2 py-1 rounded text-sm font-bold">-{{ $discount }}%</span>
                        @endif
                    </div>
                @endif
                
                @if (isset($product['link']) && $product['link'])
                    <div>
                        <a href="{{ $product['link'] }}" 
                           target="_blank" 
                           rel="noopener noreferrer sponsored"
                           class="inline-block px-8 py-3 bg-gradient-to-br from-blue-500 to-blue-700 text-white no-underline rounded-md font-bold text-lg transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-300">
                            {{ $product['cta_text'] ?? 'Visualizza offerta' }}
                        </a>
                    </div>
                @endif
            </div>
            
            @if (isset($product['additional_info']) && is_array($product['additional_info']) && count($product['additional_info']) > 0)
                <div class="mt-4 text-sm text-gray-600">
                    @foreach ($product['additional_info'] as $key => $value)
                        <div class="mb-1">
                            <strong class="font-medium">{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                            <span>{{ $value }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>