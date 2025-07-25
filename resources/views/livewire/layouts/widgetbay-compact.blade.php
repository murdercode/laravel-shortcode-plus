<div class="w-full">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-2" style="--product-count: {{ count($products) }};">
        @foreach ($products as $index => $product)
            <div class="border border-gray-300 rounded-md p-3 bg-gray-50 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md" data-index="{{ $index }}">
                @if (isset($product['image']) && $product['image'])
                    <div class="mb-2 text-center">
                        <img src="{{ $product['image'] }}" 
                             alt="{{ $product['title'] ?? 'Prodotto' }}"
                             loading="lazy"
                             class="w-full max-w-30 h-auto rounded object-cover mx-auto">
                    </div>
                @endif
                
                <div>
                    @if (isset($product['title']) && $product['title'])
                        <h4 class="text-base font-bold text-gray-900 mb-2 leading-tight">{{ $product['title'] }}</h4>
                    @endif
                    
                    @if (isset($product['description']) && $product['description'])
                        <div class="text-sm text-gray-600 leading-relaxed mb-3">
                            {{ \Illuminate\Support\Str::limit(strip_tags($product['description']), 80) }}
                        </div>
                    @endif
                    
                    <div class="flex justify-between items-center flex-wrap gap-2">
                        @if (isset($product['price']) && $product['price'])
                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-red-500">{{ $product['price'] }}€</span>
                                @if (isset($product['original_price']) && $product['original_price'] && $product['original_price'] != $product['price'])
                                    <span class="text-sm text-gray-400 line-through">{{ $product['original_price'] }}€</span>
                                    @php
                                        $discount = round((($product['original_price'] - $product['price']) / $product['original_price']) * 100);
                                    @endphp
                                    @if ($discount > 0)
                                        <span class="bg-red-500 text-white px-1.5 py-0.5 rounded text-xs font-bold inline-block w-fit">-{{ $discount }}%</span>
                                    @endif
                                @endif
                            </div>
                        @endif
                        
                        @if (isset($product['link']) && $product['link'])
                            <div>
                                <a href="{{ $product['link'] }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer sponsored"
                                   class="px-4 py-2 bg-blue-500 text-white no-underline rounded text-sm font-bold transition-colors hover:bg-blue-700">
                                    Vedi su {{ $product['shop_name'] ?? 'Shop' }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>