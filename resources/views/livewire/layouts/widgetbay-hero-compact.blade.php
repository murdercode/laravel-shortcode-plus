<div class="relative w-full mb-2">
    <div class="flex items-center gap-4">
        @if (isset($product['image']) && $product['image'])
            <div class="flex-none w-16 h-16 md:w-20 md:h-20">
                <img alt="{{ $product['title'] ?? 'Prodotto' }}" 
                     width="80" 
                     height="80" 
                     class="object-contain object-center w-full h-full !my-0 rounded-lg mix-blend-multiply dark:mix-blend-normal"
                     loading="lazy" 
                     decoding="async" 
                     src="{{ $product['image'] }}">
            </div>
        @endif
        
        <div class="flex-1 min-w-0">
            @if (isset($product['shop_name']))
                @php
                    $shopName = strtolower($product['shop_name']);
                    $logoData = null;
                    
                    if ($shopName === 'amazon') {
                        $logoData = [
                            'src' => (isset($product['isPrimeExclusive']) && $product['isPrimeExclusive']) 
                                ? 'https://widgetbay.3labs.it/assets/images/logo-amazon-prime.svg'
                                : 'https://widgetbay.3labs.it/assets/images/logo-amazon.svg',
                            'alt' => (isset($product['isPrimeExclusive']) && $product['isPrimeExclusive']) 
                                ? 'Amazon Prime Logo' 
                                : 'Amazon Logo'
                        ];
                    } elseif ($shopName === 'ebay') {
                        $logoData = [
                            'src' => 'https://widgetbay.3labs.it/assets/images/logo-ebay.svg',
                            'alt' => 'eBay Logo'
                        ];
                    } elseif ($shopName === 'instantgaming') {
                        $logoData = [
                            'src' => 'https://widgetbay.3labs.it/assets/images/logo-instantgaming.svg',
                            'alt' => 'Instant Gaming Logo'
                        ];
                    } elseif ($shopName === 'aliexpress') {
                        $logoData = [
                            'src' => 'https://widgetbay.3labs.it/assets/images/logo-aliexpress.svg',
                            'alt' => 'AliExpress Logo'
                        ];
                    }
                @endphp
                
                @if ($logoData)
                    <div class="mb-1">
                        <img src="{{ $logoData['src'] }}" alt="{{ $logoData['alt'] }}" width="32" height="9" loading="lazy" class="!my-0">
                    </div>
                @endif
            @endif
            
            @if (isset($product['title']) && $product['title'])
                <h3 class="!mt-0 !mb-2 text-lg font-bold tracking-tight !leading-5 text-gray-900 dark:text-zinc-100 line-clamp-2">{{ $product['title'] }}</h3>
            @endif
        </div>
        
        <div class="flex-none text-right">
            @if (isset($product['price']) && $product['price'])
                <div class="mb-2">
                    <span class="text-xl font-bold text-gray-900 dark:text-zinc-100">{{ number_format($product['price'], 2, ',', '.') }}€</span>
                    @if (isset($product['original_price']) && $product['original_price'] && is_numeric($product['original_price']) && is_numeric($product['price']) && $product['original_price'] != $product['price'])
                        @php
                            $discount = round((($product['original_price'] - $product['price']) / $product['original_price']) * 100);
                        @endphp
                        @if ($discount > 20)
                            <div class="text-sm">
                                <span class="text-gray-600 line-through dark:text-zinc-400">{{ number_format($product['original_price'], 2, ',', '.') }}€</span>
                                <span class="ml-1 font-bold text-red-500">-{{ $discount }}%</span>
                            </div>
                        @endif
                    @endif
                </div>
            @endif
            
            @if (isset($product['link']) && $product['link'])
                <a href="{{ $product['link'] }}" 
                   target="_blank" 
                   rel="noopener noreferrer sponsored"
                   class="!no-underline inline-block px-4 py-1.5 bg-red-600 text-white rounded-full font-medium text-sm transition-all duration-300 hover:bg-red-500 hover:shadow-lg">
                    <span class="hidden sm:inline">Vedi su </span><span class="capitalize">{{ $product['shop_label'] ?? 'Shop' }}</span>
                </a>
            @endif
        </div>
    </div>
    <a class="stretched-link" href="{{ $product['link'] ?? '#' }}" target="_blank" rel="noopener noreferrer sponsored"></a>
</div>