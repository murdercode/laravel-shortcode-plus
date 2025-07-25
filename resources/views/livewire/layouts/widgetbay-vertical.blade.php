<div class="w-full">
    <div class="flex justify-between items-center mb-4 pb-2 border-b-2 border-blue-500">
        <h3 class="text-xl font-bold text-gray-900 m-0">Prodotti consigliati</h3>
        <span class="text-sm text-gray-600 bg-gray-100 px-2 py-1 rounded-full">{{ count($products) }} {{ count($products) === 1 ? 'prodotto' : 'prodotti' }}</span>
    </div>
    
    <div class="flex flex-col space-y-3">
        @foreach ($products as $index => $product)
            <div class="border border-gray-300 rounded-md bg-white transition-shadow hover:shadow-md" data-index="{{ $index }}">
                <div class="flex flex-col md:flex-row items-start gap-4 p-3">
                    @if (isset($product['image']) && $product['image'])
                        <div class="flex-none w-20 max-w-20 self-center md:self-start">
                            <img src="{{ $product['image'] }}" 
                                 alt="{{ $product['title'] ?? 'Prodotto' }}"
                                 loading="lazy"
                                 class="w-full h-auto rounded object-cover">
                        </div>
                    @endif
                    
                    <div class="flex-1 min-w-0">
                        @if (isset($product['title']) && $product['title'])
                            <h4 class="text-base font-bold text-gray-900 mb-1 leading-tight">{{ $product['title'] }}</h4>
                        @endif
                        
                        @if (isset($product['description']) && $product['description'])
                            <div class="text-sm text-gray-600 leading-relaxed mb-2">
                                {{ \Illuminate\Support\Str::limit(strip_tags($product['description']), 100) }}
                            </div>
                        @endif
                        
                        @if (isset($product['additional_info']) && is_array($product['additional_info']))
                            <div class="flex flex-wrap gap-4 text-xs text-gray-500">
                                @foreach (array_slice($product['additional_info'], 0, 2) as $key => $value)
                                    <span class="whitespace-nowrap">
                                        <strong class="font-medium">{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex-none text-right flex flex-col items-end md:items-end gap-2 text-center md:text-right">
                        @if (isset($product['price']) && $product['price'])
                            <div>
                                <div class="text-lg font-bold text-red-500">{{ $product['price'] }}€</div>
                                @if (isset($product['original_price']) && $product['original_price'] && $product['original_price'] != $product['price'])
                                    <div class="text-sm text-gray-400 line-through">{{ $product['original_price'] }}€</div>
                                    @php
                                        $discount = round((($product['original_price'] - $product['price']) / $product['original_price']) * 100);
                                    @endphp
                                    @if ($discount > 0)
                                        <div class="bg-red-500 text-white px-1.5 py-0.5 rounded text-xs font-bold">-{{ $discount }}%</div>
                                    @endif
                                @endif
                            </div>
                        @endif
                        
                        @if (isset($product['link']) && $product['link'])
                            <div>
                                <a href="{{ $product['link'] }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer sponsored"
                                   class="px-3 py-1.5 border border-blue-500 text-blue-500 bg-transparent no-underline rounded text-xs font-bold transition-all hover:bg-blue-500 hover:text-white">
                                    {{ $product['cta_text'] ?? 'Vedi' }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</div>