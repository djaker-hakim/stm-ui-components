@props([
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

<style>
    :root {
        --stm-ui-primary: {{ $primary }};
        --stm-ui-secondary: {{ $secondary }};
        --stm-ui-accent: {{ $accent }};
        --stm-ui-bg-1: {{ $bg1 }};
        --stm-ui-bg-2: {{ $bg2 }};
        --stm-ui-header: {{ $heading }};
        --stm-ui-text: {{ $text }};
        --stm-ui-danger: {{ $danger }};
        --stm-ui-success: {{ $success }};
        --stm-ui-warning: {{ $warning }};
        --stm-ui-info: {{ $info }};
        --stm-ui-muted: {{ $muted }};
        --stm-ui-border: {{ $border }};
    }

    body {
        color: var(--stm-ui-text);
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