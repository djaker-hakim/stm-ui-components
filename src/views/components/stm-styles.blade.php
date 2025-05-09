@props([
    'config' => [
        'theme' => 'standard',
        'primary' => '#4f46e5',
        'secondary' => '#9333ea',
        'accent' => '#fbbf24',
        'header' => '#1f2937',
        'text' => '#374151',
        'bg-1' => '#f3f4f6',
        'bg-2' => '#e5e7eb',
        'danger' => '#ef4444',
        'success' => '#22c55e',
        'warning' => '#f59e0b',
        'info' => '#3b82f6',
        'muted' => '#9ca3af',
    ]
])
@php
   use stm\UIcomponents\Support\Stm;
   
   Stm::styles()->setConfigs($config);
   $bg1 = 'bg-1';
   $bg2 = 'bg-2';

    $primary = Stm::styles()->primary;
    $secondary = Stm::styles()->secondary;
    $accent = Stm::styles()->accent;
    $bg1 = Stm::styles()->$bg1;
    $bg2 = Stm::styles()->$bg2;
    $header = Stm::styles()->header;
    $text = Stm::styles()->text;
    $danger = Stm::styles()->danger;
    $success = Stm::styles()->success;
    $warning = Stm::styles()->warning;
    $info = Stm::styles()->info;
    $muted = Stm::styles()->muted;


@endphp

<style>
    :root {
        --stm-ui-primary: {{ $primary }};
        --stm-ui-secondary: {{ $secondary }};
        --stm-ui-accent: {{ $accent }};
        --stm-ui-bg-1: {{ $bg1 }};
        --stm-ui-bg-2: {{ $bg2 }};
        --stm-ui-header: {{ $header }};
        --stm-ui-text: {{ $text }};
        --stm-ui-danger: {{ $danger }};
        --stm-ui-success: {{ $success }};
        --stm-ui-warning: {{ $warning }};
        --stm-ui-info: {{ $info }};
        --stm-ui-muted: {{ $muted }};
    }
</style>