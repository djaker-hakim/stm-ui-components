{{-- 
    attributes: tailwindcss, animatecss, config
        tailwindcss: is for applying talwindcss cdn (bool) default false
        animatecss: is for applying the animation library (bool) default true
        config: is an array of theme, primary, secondary, accent, heading, text, bg-1, bg-2, danger, success, warning, info, muted, border
            theme: is to change your default theme to all component if available
            primary, secondary, accent, heading, text, bg-1, bg-2, danger, success, warning, info, muted, border: css color varibales that will be used for all components 
--}}


@props([
    'tailwindcss' => false,
    'animatecss' => true,
    'config' => []
])
@php
   use stm\UIcomponents\Support\Stm;
   
   // default values
    $config['theme'] ??= 'standard';
    $config['primary'] ??= '#3b82f6';
    $config['secondary'] ??= '#64748b';
    $config['accent'] ??= '#10b981';
    $config['heading'] ??= '#111827';
    $config['text'] ??= '#1f2937';
    $config['bg-1'] ??= '#ffffff';
    $config['bg-2'] ??= '#f9fafb';
    $config['danger'] ??= '#ef4444';
    $config['success'] ??= '#22c55e';
    $config['warning'] ??= '#f59e0b';
    $config['info'] ??= '#3b82f6';
    $config['muted'] ??= '#9ca3af';
    $config['border'] ??= '#94a3b8';


   Stm::styles()->setConfigs($config);
   $bg1 = 'bg-1';
   $bg2 = 'bg-2';

    $primary = Stm::styles()->primary;
    $secondary = Stm::styles()->secondary;
    $accent = Stm::styles()->accent;
    $bg1 = Stm::styles()->$bg1;
    $bg2 = Stm::styles()->$bg2;
    $heading = Stm::styles()->heading;
    $text = Stm::styles()->text;
    $danger = Stm::styles()->danger;
    $success = Stm::styles()->success;
    $warning = Stm::styles()->warning;
    $info = Stm::styles()->info;
    $muted = Stm::styles()->muted;
    $border = Stm::styles()->border;


@endphp
@if ($tailwindcss)
    <!-- TAILWIND CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
@endif

@if ($animatecss)
    <!-- animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endif
<style>
    :root {
        --stm-color-primary: {{ $primary }};
        --stm-color-secondary: {{ $secondary }};
        --stm-color-accent: {{ $accent }};
        --stm-color-bg-1: {{ $bg1 }};
        --stm-color-bg-2: {{ $bg2 }};
        --stm-color-header: {{ $heading }};
        --stm-color-text: {{ $text }};
        --stm-color-danger: {{ $danger }};
        --stm-color-success: {{ $success }};
        --stm-color-warning: {{ $warning }};
        --stm-color-info: {{ $info }};
        --stm-color-muted: {{ $muted }};
        --stm-color-border: {{ $border }};
    }

    [x-cloak] {
            display: none !important;
    }

    body {
        color: var(--stm-color-text);
    }

    
    /* animation section  */
    @keyframes progress-bar {
        0% {
            left: -33%;
        }
        100% {
            left: 100%;
        }
    }
    .animate-progress-bar {
        animation: progress-bar 1200ms infinite linear;
    }
</style>