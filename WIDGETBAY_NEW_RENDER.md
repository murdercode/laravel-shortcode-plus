
# WidgetBay New Render System

Questo documento descrive il nuovo sistema di rendering per gli shortcode WidgetBay che utilizza Livewire per un'esperienza più dinamica e performante.

## Configurazione

Per abilitare il nuovo sistema di rendering, modifica il file di configurazione `config/shortcode-plus.php`:

```php
'widgetbay' => [
    'endpoint' => 'https://widgetbay.3labs.it/widgetbox',
    'use_new_render' => true, // Abilita il nuovo rendering con Livewire
],
```

## Funzionalità

### Nuovo Sistema (Livewire)
- ✅ Rendering dinamico server-side
- ✅ Cache intelligente dei dati
- ✅ Gestione errori migliorata
- ✅ Caricamento asincrono
- ✅ Retry automatico in caso di errore
- ✅ UI/UX più fluida
- ✅ SEO-friendly

### Sistema Tradizionale (iframe)
- ✅ Backward compatibility
- ✅ Funzionamento consolidato
- ❌ Dipendenza da iframe
- ❌ Meno controllo sulla UI

## Dipendenze

Il nuovo sistema richiede:

1. **Livewire** (`^2.0|^3.0`)
2. **Laravel WidgetBay Package** (privato)

```json
{
    "require": {
        "livewire/livewire": "^2.0|^3.0",
        "the-3labs-team/laravel-widgetbay": "*"
    }
}
```

## Utilizzo

Lo shortcode rimane identico:

```
[widgetbay link="https://example.com/product"]
[widgetbay id="12345"]
```

Il sistema sceglierà automaticamente il metodo di rendering basato sulla configurazione `use_new_render`.

## API Integration

Il nuovo sistema utilizza il pacchetto `laravel-widgetbay` per connettersi all'API:

```php
use The3LabsTeam\LaravelWidgetbay\Facades\Widgetbay;

$data = Widgetbay::make()->getByLink($link);
```

## Cache

I dati vengono automaticamente cachati per 1 ora per migliorare le performance:

- Cache key: `widgetbay_` + MD5 del link
- TTL: 3600 secondi (1 ora)
- Invalidazione automatica in caso di retry

## Gestione Errori

Il nuovo sistema include una gestione degli errori migliorata:

- Visualizzazione di messaggi di errore user-friendly
- Pulsante di retry per tentare nuovamente il caricamento
- Logging automatico degli errori per debug

## Styling

Il componente include stili CSS di base che possono essere personalizzati:

```css
.widgetbay-renderer { /* Container principale */ }
.widgetbay-loading { /* Stato di caricamento */ }
.widgetbay-error { /* Stato di errore */ }
.widgetbay-content { /* Contenuto del widget */ }
```

## Testing

Esegui i test per verificare il funzionamento:

```bash
composer test
```

I test includono:
- Rendering tradizionale
- Nuovo rendering con Livewire
- Estrazione dei link dai shortcode
- Gestione degli errori
