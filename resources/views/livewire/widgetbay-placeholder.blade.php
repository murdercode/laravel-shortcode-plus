@php
    // Estima il numero di prodotti dal link (conta le virgole + 1)
    $estimatedProducts = substr_count($link, ',') + 1;
    // Auto-detect layout basato sul numero stimato
    $skeletonLayout = $estimatedProducts === 1 ? 'hero' : ($estimatedProducts <= 3 ? 'compact' : 'vertical');
@endphp

<div class="widgetbay-lazy-placeholder widgetbay-skeleton-{{ $skeletonLayout }}" 
     data-estimated-products="{{ $estimatedProducts }}">



    @if ($skeletonLayout === 'hero')
        {{-- Hero skeleton: singolo prodotto in evidenza --}}
        <div class="skeleton-hero-container">
            <div class="skeleton-hero-image"></div>
            <div class="skeleton-hero-content">
                <div class="skeleton-hero-title"></div>
                <div class="skeleton-hero-description"></div>
                <div class="skeleton-hero-price"></div>
                <div class="skeleton-hero-button"></div>
            </div>
        </div>
    @elseif ($skeletonLayout === 'compact')
        {{-- Compact skeleton: griglia di prodotti --}}
        <div class="skeleton-compact-grid" style="--skeleton-count: {{ min($estimatedProducts, 3) }}">
            @for ($i = 0; $i < min($estimatedProducts, 3); $i++)
                <div class="skeleton-compact-item">
                    <div class="skeleton-compact-image"></div>
                    <div class="skeleton-compact-title"></div>
                    <div class="skeleton-compact-description"></div>
                    <div class="skeleton-compact-pricing">
                        <div class="skeleton-compact-price"></div>
                        <div class="skeleton-compact-button"></div>
                    </div>
                </div>
            @endfor
        </div>
    @else
        {{-- Vertical skeleton: lista verticale --}}
        <div class="skeleton-vertical-header">
            <div class="skeleton-vertical-title"></div>
            <div class="skeleton-vertical-count"></div>
        </div>
        <div class="skeleton-vertical-list">
            @for ($i = 0; $i < min($estimatedProducts, 5); $i++)
                <div class="skeleton-vertical-item">
                    <div class="skeleton-vertical-image"></div>
                    <div class="skeleton-vertical-content">
                        <div class="skeleton-vertical-product-title"></div>
                        <div class="skeleton-vertical-description"></div>
                        <div class="skeleton-vertical-meta"></div>
                    </div>
                    <div class="skeleton-vertical-pricing">
                        <div class="skeleton-vertical-price"></div>
                        <div class="skeleton-vertical-cta"></div>
                    </div>
                </div>
            @endfor
        </div>
        @if ($estimatedProducts > 5)
            <div class="skeleton-vertical-footer">
                <div class="skeleton-vertical-toggle"></div>
            </div>
        @endif
    @endif
    
    <p class="lazy-loading-text">
        Caricamento {{ $estimatedProducts === 1 ? 'prodotto' : ($estimatedProducts . ' prodotti') }}...
    </p>
    
    <script>
    console.log('Placeholder loaded for:', @json($link));
    console.log('Alpine.js available:', typeof Alpine !== 'undefined');
    </script>
    

    <style>
/* Base Skeleton Styles */
.widgetbay-lazy-placeholder {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 1rem;
    margin: 1rem 0;
    background: #ffffff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Skeleton Animation */
@keyframes skeleton-loading {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}

.skeleton-base {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

/* Hero Skeleton Layout */
.skeleton-hero-container {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.skeleton-hero-image {
    flex: 0 0 200px;
    height: 150px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 8px;
}

.skeleton-hero-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.skeleton-hero-title {
    height: 28px;
    width: 80%;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-hero-description {
    height: 60px;
    width: 100%;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-hero-price {
    height: 32px;
    width: 150px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-hero-button {
    height: 44px;
    width: 180px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 6px;
}

/* Compact Skeleton Layout */
.skeleton-compact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-bottom: 1rem;
}

.skeleton-compact-item {
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    padding: 0.75rem;
    background: #fafafa;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.skeleton-compact-image {
    height: 80px;
    width: 120px;
    margin: 0 auto;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-compact-title {
    height: 20px;
    width: 90%;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-compact-description {
    height: 40px;
    width: 100%;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-compact-pricing {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 0.5rem;
}

.skeleton-compact-price {
    height: 24px;
    width: 80px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-compact-button {
    height: 32px;
    width: 90px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

/* Vertical Skeleton Layout */
.skeleton-vertical-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e0e0e0;
}

.skeleton-vertical-title {
    height: 24px;
    width: 200px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-vertical-count {
    height: 20px;
    width: 80px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 12px;
}

.skeleton-vertical-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.skeleton-vertical-item {
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    background: white;
    padding: 0.75rem;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.skeleton-vertical-image {
    flex: 0 0 80px;
    height: 60px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-vertical-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.skeleton-vertical-product-title {
    height: 20px;
    width: 70%;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-vertical-description {
    height: 32px;
    width: 100%;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-vertical-meta {
    height: 16px;
    width: 80%;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-vertical-pricing {
    flex: 0 0 auto;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.5rem;
}

.skeleton-vertical-price {
    height: 22px;
    width: 70px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-vertical-cta {
    height: 28px;
    width: 60px;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

.skeleton-vertical-footer {
    text-align: center;
    margin-top: 1rem;
    padding-top: 0.75rem;
    border-top: 1px solid #e0e0e0;
}

.skeleton-vertical-toggle {
    height: 20px;
    width: 150px;
    margin: 0 auto;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
    border-radius: 4px;
}

/* Loading Text */
.lazy-loading-text {
    color: #666;
    font-style: italic;
    margin-top: 1rem;
    font-size: 0.9rem;
    text-align: center;
}

/* Responsive Design */
@media (max-width: 768px) {
    .skeleton-hero-container {
        flex-direction: column;
    }
    
    .skeleton-hero-image {
        flex: none;
        width: 100%;
        max-width: 200px;
        margin: 0 auto;
    }
    
    .skeleton-compact-grid {
        grid-template-columns: 1fr;
    }
    
    .skeleton-vertical-item {
        flex-direction: column;
        text-align: center;
    }
    
    .skeleton-vertical-image {
        flex: none;
        width: 120px;
        margin: 0 auto;
    }
    
    .skeleton-vertical-pricing {
        align-items: center;
    }
}
    </style>
</div>