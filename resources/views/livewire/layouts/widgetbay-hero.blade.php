<div class="widgetbay-hero-layout">
    <div class="hero-container">
        @if (isset($product['image']) && $product['image'])
            <div class="hero-image">
                <img src="{{ $product['image'] }}" 
                     alt="{{ $product['title'] ?? 'Prodotto' }}"
                     loading="lazy"
                     class="img-fluid hero-img">
            </div>
        @endif
        
        <div class="hero-content">
            @if (isset($product['title']) && $product['title'])
                <h3 class="hero-title">{{ $product['title'] }}</h3>
            @endif
            
            @if (isset($product['description']) && $product['description'])
                <div class="hero-description">
                    {!! $product['description'] !!}
                </div>
            @endif
            
            <div class="hero-pricing">
                @if (isset($product['price']) && $product['price'])
                    <div class="price-container">
                        <span class="current-price">{{ number_format($product['price'], 2, ',', '.') }}€</span>
                        @if (isset($product['original_price']) && $product['original_price'] && is_numeric($product['original_price']) && is_numeric($product['price']) && $product['original_price'] != $product['price'])
                            <span class="original-price">{{ number_format($product['original_price'], 2, ',', '.') }}€</span>
                            @php
                                $discount = round((($product['original_price'] - $product['price']) / $product['original_price']) * 100);
                            @endphp
                            <span class="discount-badge">-{{ $discount }}%</span>
                        @endif
                    </div>
                @endif
                
                @if (isset($product['link']) && $product['link'])
                    <div class="hero-actions">
                        <a href="{{ $product['link'] }}" 
                           target="_blank" 
                           rel="noopener noreferrer sponsored"
                           class="btn btn-primary btn-lg hero-cta">
                            {{ $product['cta_text'] ?? 'Visualizza offerta' }}
                        </a>
                    </div>
                @endif
            </div>
            
            @if (isset($product['additional_info']) && is_array($product['additional_info']) && count($product['additional_info']) > 0)
                <div class="hero-additional-info">
                    @foreach ($product['additional_info'] as $key => $value)
                        <div class="info-item">
                            <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                            <span>{{ $value }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>