@props(['name', 'class' => 'h-5 w-5'])
@php
    $stroke = 'fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"';
@endphp
@if ($name === 'whatsapp')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
@elseif ($name === 'arrow-right')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
@elseif ($name === 'arrow-left')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>
@elseif ($name === 'arrow-up')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
@elseif ($name === 'check')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} stroke-width="2.25" aria-hidden="true" focusable="false"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>
@elseif ($name === 'plus')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} stroke-width="2" aria-hidden="true" focusable="false"><path d="M12 5v14M5 12h14"/></svg>
@elseif ($name === 'menu')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} stroke-width="2" aria-hidden="true" focusable="false"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
@elseif ($name === 'close')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} stroke-width="2" aria-hidden="true" focusable="false"><path d="M6 6l12 12M18 6L6 18"/></svg>
@elseif ($name === 'topology')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} stroke-width="2" aria-hidden="true" focusable="false"><circle cx="12" cy="5.5" r="2.5"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/><path d="M12 8v4.5M12 12.5l-5.2 4M12 12.5l5.2 4"/></svg>
@elseif ($name === 'router')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><rect x="3" y="12" width="18" height="7" rx="2"/><path d="M7 15.5h.01M11 15.5h.01M7 12V6M17 12V6M12 9.5a3.5 3.5 0 0 1 3.5-3M12 9.5a3.5 3.5 0 0 0-3.5-3"/></svg>
@elseif ($name === 'process')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M10 6h10M10 12h10M10 18h10M3.5 6l1.5 1.5L8 4.5M3.5 12l1.5 1.5L8 10.5M3.5 18l1.5 1.5L8 16.5"/></svg>
@elseif ($name === 'globe')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.7 3.8 5.7 3.8 9s-1.3 6.3-3.8 9c-2.5-2.7-3.8-5.7-3.8-9S9.5 5.7 12 3z"/></svg>
@elseif ($name === 'chat')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M21 11.5a8.5 8.5 0 0 1-12.4 7.5L3.5 20.5l1.5-4.6A8.5 8.5 0 1 1 21 11.5z"/><path d="M8.5 11.5h.01M12 11.5h.01M15.5 11.5h.01"/></svg>
@elseif ($name === 'shield')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M12 3l8 3v6c0 4.5-3.2 8-8 9-4.8-1-8-4.5-8-9V6l8-3z"/><path d="M8.5 12l2.5 2.5 4.5-5"/></svg>
@elseif ($name === 'clock')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
@elseif ($name === 'mail')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3.5 7l8.5 6 8.5-6"/></svg>
@elseif ($name === 'pin')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
@elseif ($name === 'search')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>
@elseif ($name === 'chevron-down')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M6 9l6 6 6-6"/></svg>
@elseif ($name === 'chevron-right')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M9 18l6-6-6-6"/></svg>
@elseif ($name === 'wifi')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M5 12.55a11 11 0 0 1 14.08 0M1.42 9a16 16 0 0 1 21.16 0M8.53 16.11a6 6 0 0 1 6.95 0M12 20h.01"/></svg>
@elseif ($name === 'gauge')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M12 14l3-3M3.34 19a10 10 0 1 1 17.32 0"/></svg>
@elseif ($name === 'network')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><rect x="9" y="2" width="6" height="6" rx="1"/><rect x="2" y="16" width="6" height="6" rx="1"/><rect x="16" y="16" width="6" height="6" rx="1"/><path d="M12 8v5M5 13h14M5 13v3M19 13v3"/></svg>
@elseif ($name === 'layers')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
@elseif ($name === 'cpu')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><path d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"/></svg>
@elseif ($name === 'phone')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
@elseif ($name === 'user')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
@elseif ($name === 'pencil' || $name === 'edit')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/><path d="M15 5l4 4"/></svg>
@elseif ($name === 'trash' || $name === 'delete')
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" {!! $stroke !!} aria-hidden="true" focusable="false"><path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M10 11v6M14 11v6"/></svg>
@endif
