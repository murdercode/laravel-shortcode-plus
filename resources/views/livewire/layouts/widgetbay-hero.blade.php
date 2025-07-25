<div class="relative w-full">
    <div class="flex flex-col items-start gap-6 md:flex-row md:items-center">
        @if (isset($product['image']) && $product['image'])
            <div class="flex-none w-full text-center md:w-48 md:max-w-48 md:text-left">
                <img alt="{{ $product['title'] ?? 'Prodotto' }}" 
                     width="160" 
                     height="160" 
                     class="object-contain object-center h-40 !my-0 m-auto rounded-lg mix-blend-multiply dark:mix-blend-normal"
                     loading="lazy" 
                     decoding="async" 
                     src="{{ $product['image'] }}">
            </div>
        @endif
        
        <div class="flex-1 w-full">
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
                    <div class="mb-2">
                        <img src="{{ $logoData['src'] }}" alt="{{ $logoData['alt'] }}" width="48" height="14" loading="lazy" class="!my-0">
                    </div>
                @endif
            @endif
            @if (isset($product['title']) && $product['title'])
                <h3 class="!mt-0 !mb-3 text-2xl font-black tracking-tight text-gray-900 dark:text-zinc-100 line-clamp-2 md:truncate">{{ $product['title'] }}</h3>
            @endif
        
            
            <div class="mt-4">
                @if (isset($product['price']) && $product['price'])
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl font-bold text-gray-900 dark:text-zinc-100">{{ number_format($product['price'], 2, ',', '.') }}€</span>
                            @if (isset($product['original_price']) && $product['original_price'] && is_numeric($product['original_price']) && is_numeric($product['price']) && $product['original_price'] != $product['price'])
                                @php
                                    $discount = round((($product['original_price'] - $product['price']) / $product['original_price']) * 100);
                                @endphp
                                @if ($discount > 20)
                                    <span class="hidden text-base text-gray-600 line-through md:inline dark:text-zinc-400">{{ number_format($product['original_price'], 2, ',', '.') }}€</span>
                                    <span class="text-sm font-bold text-red-500">-{{ $discount }}%</span>
                                @endif
                            @endif
                        </div>
                        
                        @if (isset($product['link']) && $product['link'])
                            <div class="flex-shrink-0">
                                <a href="{{ $product['link'] }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer sponsored"
                                   class="!no-underline inline-block px-6 py-2 bg-red-600 text-white no-underline rounded-full font-medium text-base transition-all duration-300 hover:bg-red-500 hover:shadow-lg text-sm">
                                    <span class="hidden md:inline">Vedi su </span><span class="capitalize">{{ $product['shop_label'] ?? 'Shop' }}</span>
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
            
            @if (isset($product['additional_info']) && is_array($product['additional_info']) && count($product['additional_info']) > 0)
                <div class="mt-4 text-sm text-gray-600 dark:text-zinc-400">
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
    <a class="stretched-link" href="{{ $product['link'] ?? '#' }}" target="_blank" rel="noopener noreferrer sponsored"></a>
</div>