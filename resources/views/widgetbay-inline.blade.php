<div class="widgetbay-inline-content" data-widget-link="{{ $link }}">
    @if (isset($widgetData['title']))
        <h3 class="widgetbay-title">{{ $widgetData['title'] }}</h3>
    @endif
    
    @if (isset($widgetData['description']))
        <div class="widgetbay-description">
            {!! $widgetData['description'] !!}
        </div>
    @endif
    
    @if (isset($widgetData['image']))
        <div class="widgetbay-image">
            <img src="{{ $widgetData['image'] }}" 
                 alt="{{ $widgetData['title'] ?? 'Widget content' }}"
                 loading="lazy"
                 class="img-fluid">
        </div>
    @endif
    
    @if (isset($widgetData['price']))
        <div class="widgetbay-price">
            <span class="price-label">Prezzo:</span>
            <span class="price-value">{{ $widgetData['price'] }}</span>
        </div>
    @endif
    
    @if (isset($widgetData['link']))
        <div class="widgetbay-actions">
            <a href="{{ $widgetData['link'] }}" 
               target="_blank" 
               rel="noopener noreferrer sponsored"
               class="btn btn-primary widgetbay-cta">
                {{ $widgetData['cta_text'] ?? 'Visualizza offerta' }}
            </a>
        </div>
    @endif
    
    @if (isset($widgetData['additional_info']) && is_array($widgetData['additional_info']))
        <div class="widgetbay-additional-info">
            @foreach ($widgetData['additional_info'] as $key => $value)
                <div class="info-item">
                    <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                    {{ $value }}
                </div>
            @endforeach
        </div>
    @endif

    <style>
.widgetbay-inline-content {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 1rem;
    margin: 1rem 0;
    background: #f9f9f9;
}

.widgetbay-title {
    margin-bottom: 0.5rem;
    color: #333;
    font-size: 1.25rem;
}

.widgetbay-description {
    margin-bottom: 1rem;
    color: #666;
    line-height: 1.6;
}

.widgetbay-image img {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
    margin-bottom: 1rem;
}

.widgetbay-price {
    margin: 1rem 0;
    font-weight: bold;
    font-size: 1.1rem;
}

.price-label {
    color: #666;
    margin-right: 0.5rem;
}

.price-value {
    color: #007bff;
    font-size: 1.2rem;
}

.widgetbay-actions {
    margin-top: 1rem;
}

.widgetbay-cta {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
    transition: background-color 0.3s;
    border: none;
    cursor: pointer;
}

.widgetbay-cta:hover {
    background-color: #0056b3;
    text-decoration: none;
    color: white;
}

.widgetbay-additional-info {
    margin-top: 1rem;
    font-size: 0.9rem;
    color: #666;
}

.info-item {
    margin-bottom: 0.25rem;
}

.widgetbay-error {
    padding: 1rem;
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    border-radius: 4px;
    margin: 1rem 0;
}
</style>

</div>

