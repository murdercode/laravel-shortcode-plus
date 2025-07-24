<div class="widgetbay-renderer widgetbay-layout-{{ $layout }}" data-product-count="{{ $productCount }}">
    <style>
        /* CSS Custom Properties for easy theming */
:root {
    --widgetbay-primary: #007bff;
    --widgetbay-primary-hover: #0056b3;
    --widgetbay-accent: #e74c3c;
    --widgetbay-text: #333;
    --widgetbay-text-light: #666;
    --widgetbay-text-muted: #999;
    --widgetbay-border: #e0e0e0;
    --widgetbay-background: #ffffff;
    --widgetbay-background-alt: #fafafa;
    --widgetbay-shadow: 0 2px 4px rgba(0,0,0,0.1);
    --widgetbay-shadow-hover: 0 4px 12px rgba(0,123,255,0.3);
    --widgetbay-border-radius: 8px;
    --widgetbay-border-radius-sm: 4px;
    --widgetbay-transition: all 0.3s ease;
}

/* Base Widgetbay Renderer Styles */
.widgetbay-renderer {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 1rem;
    margin: 1rem 0;
    background: #ffffff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.widgetbay-error {
    text-align: center;
    padding: 1rem;
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    border-radius: 4px;
}

/* Hero Layout Styles */
.widgetbay-hero-layout {
    max-width: 100%;
}

.hero-container {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
}

.hero-image {
    flex: 0 0 200px;
    max-width: 200px;
}

.hero-img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    object-fit: cover;
}

.hero-content {
    flex: 1;
    min-width: 0;
}

.hero-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 0.75rem;
    line-height: 1.3;
}

.hero-description {
    color: #666;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.hero-pricing {
    margin-top: 1rem;
}

.price-container {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.current-price {
    font-size: 1.5rem;
    font-weight: bold;
    color: #e74c3c;
}

.original-price {
    font-size: 1rem;
    color: #999;
    text-decoration: line-through;
}

.discount-badge {
    background: #e74c3c;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.875rem;
    font-weight: bold;
}

.hero-cta {
    display: inline-block;
    padding: 0.75rem 2rem;
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.hero-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,123,255,0.3);
    text-decoration: none;
    color: white;
}

.hero-additional-info {
    margin-top: 1rem;
    font-size: 0.9rem;
    color: #666;
}

/* Compact Layout Styles */
.widgetbay-compact-layout {
    max-width: 100%;
}

.compact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-bottom: 0.5rem;
}

.compact-item {
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    padding: 0.75rem;
    background: #fafafa;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.compact-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.compact-image {
    margin-bottom: 0.5rem;
    text-align: center;
}

.compact-image img {
    width: 100%;
    max-width: 120px;
    height: auto;
    border-radius: 4px;
    object-fit: cover;
}

.compact-title {
    font-size: 1rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 0.5rem;
    line-height: 1.3;
}

.compact-description {
    font-size: 0.875rem;
    color: #666;
    line-height: 1.4;
    margin-bottom: 0.75rem;
}

.compact-pricing {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.compact-cta {
    padding: 0.5rem 1rem;
    background: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-size: 0.875rem;
    font-weight: bold;
    transition: background-color 0.3s;
    border: none;
    cursor: pointer;
}

.compact-cta:hover {
    background: #0056b3;
    text-decoration: none;
    color: white;
}

.compact-footer {
    text-align: center;
    padding-top: 0.5rem;
    border-top: 1px solid #e0e0e0;
    margin-top: 0.5rem;
}

/* Vertical Layout Styles */
.widgetbay-vertical-layout {
    max-width: 100%;
}

.vertical-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #007bff;
}

.vertical-title {
    font-size: 1.25rem;
    font-weight: bold;
    color: #333;
    margin: 0;
}

.product-count {
    font-size: 0.875rem;
    color: #666;
    background: #f0f0f0;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
}

.vertical-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.vertical-item {
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    background: white;
    transition: box-shadow 0.2s ease;
}

.vertical-item:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.vertical-item-content {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 0.75rem;
}

.vertical-image {
    flex: 0 0 80px;
    max-width: 80px;
}

.vertical-image img {
    width: 100%;
    height: auto;
    border-radius: 4px;
    object-fit: cover;
}

.vertical-details {
    flex: 1;
    min-width: 0;
}

.vertical-product-title {
    font-size: 1rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 0.25rem;
    line-height: 1.3;
}

.vertical-description {
    font-size: 0.875rem;
    color: #666;
    line-height: 1.4;
    margin-bottom: 0.5rem;
}

.vertical-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    font-size: 0.8rem;
    color: #888;
}

.meta-item {
    white-space: nowrap;
}

.vertical-pricing {
    flex: 0 0 auto;
    text-align: right;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.5rem;
}

.vertical-pricing .current-price {
    font-size: 1.1rem;
    font-weight: bold;
    color: #e74c3c;
}

.vertical-pricing .original-price {
    font-size: 0.875rem;
    color: #999;
    text-decoration: line-through;
}

.vertical-pricing .discount-badge {
    font-size: 0.75rem;
    padding: 0.125rem 0.375rem;
}

.vertical-cta {
    padding: 0.375rem 0.75rem;
    border: 1px solid #007bff;
    color: #007bff;
    background: transparent;
    text-decoration: none;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: bold;
    transition: all 0.3s;
    cursor: pointer;
}

.vertical-cta:hover {
    background: #007bff;
    color: white;
    text-decoration: none;
}

.vertical-footer {
    text-align: center;
    margin-top: 1rem;
    padding-top: 0.75rem;
    border-top: 1px solid #e0e0e0;
}

.vertical-toggle {
    background: none;
    border: none;
    color: #007bff;
    cursor: pointer;
    font-size: 0.875rem;
    text-decoration: underline;
}

.vertical-toggle:hover {
    color: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-container {
        flex-direction: column;
    }
    
    .hero-image {
        flex: none;
        max-width: 100%;
        text-align: center;
    }
    
    .compact-grid {
        grid-template-columns: 1fr;
    }
    
    .vertical-item-content {
        flex-direction: column;
        text-align: center;
    }
    
    .vertical-image {
        flex: none;
        max-width: 120px;
        align-self: center;
    }
    
    .vertical-pricing {
        align-items: center;
        text-align: center;
    }
}

/* Common Button Styles */
.btn {
    display: inline-block;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: all 0.15s ease-in-out;
    text-decoration: none;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}

.btn-lg {
    padding: 0.5rem 1rem;
    font-size: 1.125rem;
    line-height: 1.5;
    border-radius: 0.3rem;
}

.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
    text-decoration: none;
}

.btn-outline-primary {
    color: #007bff;
    border-color: #007bff;
    background-color: transparent;
}

.btn-outline-primary:hover {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}

.btn-link {
    font-weight: 400;
    color: #007bff;
    text-decoration: underline;
    background-color: transparent;
    border-color: transparent;
}

.btn-link:hover {
    color: #0056b3;
    text-decoration: underline;
}

/* Alert Styles */
.alert {
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
}

.alert-warning {
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeaa7;
}

/* Utility Classes */
.text-muted {
    color: #6c757d;
}

.img-fluid {
    max-width: 100%;
    height: auto;
}
    </style>

    @if ($error)
        <div class="widgetbay-error alert alert-warning">
            <h5>Contenuto non disponibile</h5>
            <p>{{ $errorMessage }}</p>
            <button wire:click="retry" class="btn btn-sm btn-outline-primary">
                Riprova
            </button>
        </div>
    @elseif ($widgetData && is_array($widgetData) && count($widgetData) > 0)
        @if ($layout === 'hero')
            @include('laravel-shortcode-plus::livewire.layouts.widgetbay-hero', ['product' => $widgetData[0]])
        @elseif ($layout === 'compact')
            @include('laravel-shortcode-plus::livewire.layouts.widgetbay-compact', ['products' => $widgetData])
        @elseif ($layout === 'vertical')
            @include('laravel-shortcode-plus::livewire.layouts.widgetbay-vertical', ['products' => $widgetData])
        @else
            {{-- Fallback a hero per singolo prodotto o compact per multipli --}}
            @if (count($widgetData) === 1)
                @include('laravel-shortcode-plus::livewire.layouts.widgetbay-hero', ['product' => $widgetData[0]])
            @else
                @include('laravel-shortcode-plus::livewire.layouts.widgetbay-compact', ['products' => $widgetData])
            @endif
        @endif
    @else
        <div class="widgetbay-error">
            <p>Widget non disponibile</p>
        </div>
    @endif
</div>
