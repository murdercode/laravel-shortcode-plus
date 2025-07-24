<div class="widgetbay-compact-layout">
    <div class="compact-grid" style="--product-count: {{ count($products) }};">
        @foreach ($products as $index => $product)
            <div class="compact-item" data-index="{{ $index }}">
                @if (isset($product['image']) && $product['image'])
                    <div class="compact-image">
                        <img src="{{ $product['image'] }}" 
                             alt="{{ $product['title'] ?? 'Prodotto' }}"
                             loading="lazy"
                             class="img-fluid">
                    </div>
                @endif
                
                <div class="compact-content">
                    @if (isset($product['title']) && $product['title'])
                        <h4 class="compact-title">{{ $product['title'] }}</h4>
                    @endif
                    
                    @if (isset($product['description']) && $product['description'])
                        <div class="compact-description">
                            {{ \Illuminate\Support\Str::limit(strip_tags($product['description']), 80) }}
                        </div>
                    @endif
                    
                    <div class="compact-pricing">
                        @if (isset($product['price']) && $product['price'])
                            <div class="price-container">
                                <span class="current-price">{{ $product['price'] }}€</span>
                                @if (isset($product['original_price']) && $product['original_price'] && $product['original_price'] != $product['price'])
                                    <span class="original-price">{{ $product['original_price'] }}€</span>
                                    @php
                                        $discount = round((($product['original_price'] - $product['price']) / $product['original_price']) * 100);
                                    @endphp
                                    @if ($discount > 0)
                                        <span class="discount-badge">-{{ $discount }}%</span>
                                    @endif
                                @endif
                            </div>
                        @endif
                        
                        @if (isset($product['link']) && $product['link'])
                            <div class="compact-actions">
                                <a href="{{ $product['link'] }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer sponsored"
                                   class="btn btn-primary btn-sm compact-cta">
                                    {{ $product['cta_text'] ?? 'Vedi offerta' }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>