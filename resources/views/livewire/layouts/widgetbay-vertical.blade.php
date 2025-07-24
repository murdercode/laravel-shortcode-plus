<div class="widgetbay-vertical-layout">
    <div class="vertical-header">
        <h3 class="vertical-title">Prodotti consigliati</h3>
        <span class="product-count">{{ count($products) }} {{ count($products) === 1 ? 'prodotto' : 'prodotti' }}</span>
    </div>
    
    <div class="vertical-list">
        @foreach ($products as $index => $product)
            <div class="vertical-item {{ $index >= 3 ? 'vertical-item-collapsible' : '' }}" data-index="{{ $index }}" {{ $index >= 3 ? 'style=display:none;' : '' }}>
                <div class="vertical-item-content">
                    @if (isset($product['image']) && $product['image'])
                        <div class="vertical-image">
                            <img src="{{ $product['image'] }}" 
                                 alt="{{ $product['title'] ?? 'Prodotto' }}"
                                 loading="lazy"
                                 class="img-fluid">
                        </div>
                    @endif
                    
                    <div class="vertical-details">
                        @if (isset($product['title']) && $product['title'])
                            <h4 class="vertical-product-title">{{ $product['title'] }}</h4>
                        @endif
                        
                        @if (isset($product['description']) && $product['description'])
                            <div class="vertical-description">
                                {{ \Illuminate\Support\Str::limit(strip_tags($product['description']), 100) }}
                            </div>
                        @endif
                        
                        @if (isset($product['additional_info']) && is_array($product['additional_info']))
                            <div class="vertical-meta">
                                @foreach (array_slice($product['additional_info'], 0, 2) as $key => $value)
                                    <span class="meta-item">
                                        <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <div class="vertical-pricing">
                        @if (isset($product['price']) && $product['price'])
                            <div class="price-container">
                                <div class="current-price">{{ $product['price'] }}€</div>
                                @if (isset($product['original_price']) && $product['original_price'] && $product['original_price'] != $product['price'])
                                    <div class="original-price">{{ $product['original_price'] }}€</div>
                                    @php
                                        $discount = round((($product['original_price'] - $product['price']) / $product['original_price']) * 100);
                                    @endphp
                                    @if ($discount > 0)
                                        <div class="discount-badge">-{{ $discount }}%</div>
                                    @endif
                                @endif
                            </div>
                        @endif
                        
                        @if (isset($product['link']) && $product['link'])
                            <div class="vertical-actions">
                                <a href="{{ $product['link'] }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer sponsored"
                                   class="btn btn-outline-primary btn-sm vertical-cta">
                                    {{ $product['cta_text'] ?? 'Vedi' }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    @if (count($products) > 3)
        <div class="vertical-footer" x-data="{ expanded: false }">
            <button class="btn btn-link btn-sm vertical-toggle" 
                    @click="expanded = !expanded; 
                            document.querySelectorAll('.vertical-item-collapsible').forEach(item => {
                                item.style.display = expanded ? 'block' : 'none';
                            })">
                <span x-show="!expanded">Mostra tutti i {{ count($products) }} prodotti</span>
                <span x-show="expanded">Mostra meno</span>
            </button>
        </div>
    @endif
</div>