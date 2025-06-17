# Introduction

**stm-ui-components** is a modern UI library built to speed up development in Laravel applications. It provides a set of **pre-built components** that combine the power of **Laravel Blade components**, **Alpine.js**, and **TailwindCSS**.

This library is designed to reduce the repetitive and time-consuming work involved in building everyday interface elements. If a component typically takes you an hour to build, with `stm-ui-components` it can take as little as **2 minutes**.

## Why stm-ui-components?

- 🚀 **Fast Development** – Focus on building features, not rebuilding UI.
- ⚙️ **Laravel-native** – Uses the Laravel component system for seamless integration.
- 🎨 **TailwindCSS-powered** – Fully styled using utility-first classes.
- 🧠 **Alpine.js support** – Adds interactivity without leaving HTML.
- 🔗 **CDN Ready** – No complex setup; Tailwind and Alpine load via CDN.

## Who is it for?

This library is primarily built for use in Laravel projects. At the moment, it is developed and maintained for internal use by **me and my team**, but may later expand to broader usage.

## What’s included?

- A growing collection of reusable UI components (buttons, modals, alerts, tables, etc.)
- Integrated Alpine.js behavior for interactive components
- TailwindCSS for styling consistency and flexibility

# Guide

- [Installation](#installation)
- [Usage](#usage)
- [Component Overview](#components-overview)
- [Form Components](#form-components)
- [UI Components](#ui-components)
- [Master Components](#master-components)
- [`$stm` Global Controller Object](#stm-global-controller-object)

# Installation

## Requirements

To use **Stm UI Components**, ensure your Laravel project meets the following requirements:

- **Laravel**: ^10.x or higher
- **PHP**: ^8.1 or higher

Install the package via Composer:

```bash
composer require djaker-hakim/stm-ui-components
```

# Usage

To use the Stm UI Components library in your Laravel Blade templates, you need to include the necessary styles and scripts, then use any component with the `x-stm::` prefix.

1. **Include styles**  
   Use `<x-stm::styles />` in the `<head>` section of your HTML to include the component styles. If you're using Tailwind CSS, set the `:tailwindcss` attribute to `true`.

2. **Use components**  
   Components are prefixed with `x-stm::` and follow Blade component syntax. For example:  
   `<x-stm::button>Click Me</x-stm::button>`

3. **Include scripts**  
   Use `<x-stm::scripts />` before the closing `</body>` tag to include the required JavaScript (Alpine.js and any component logic).

---

## Notes

- All components require `<x-stm::scripts />` to function properly.
- Tailwind CSS must be included for components to render correctly when using Tailwind-based themes.

---

## Example

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Include Stm styles and Tailwind CSS --}}
    <x-stm::styles :tailwindcss="true" />
    <title>Stm UI Components</title>
</head>
<body>

    {{-- Using a button component --}}
    <x-stm::button size="md">
        Click Me
    </x-stm::button>

    {{-- Include Alpine.js and component interactivity --}}
    <x-stm::scripts />
</body>
</html>
```


# Components Overview

All `stm-ui-components` are designed to be **flexible**, **configurable**, and **easy to use** out of the box.

Each component accepts a set of **attributes** that fall into two main categories:

## 1. Component Attributes

These are specific to `stm-ui-components`. They control the behavior, style, and structure of the component. Examples include:

- `theme`
- `config`
- `color`
- `size`

## 2. Standard HTML Attributes

All standard HTML attributes are supported and passed directly to the rendered HTML element. Examples:

- `class`
- `style`
- `disabled`
- `type`
- `href`

You can use both types of attributes together to customize your component precisely as needed.

## Theme Attribute

The `theme` attribute allows you to control the styling preset applied to any component. It accepts the following values:

### `standard` (default)
### `stm`

Applies the default, minimal styles.

```blade
<x-stm::button theme="standard">Click Me</x-stm::button>
```

### `custom`

This mode gives you **full control** over the component’s appearance. When using `theme="custom"`, you are expected to provide your own styles either through:

- The `config` attribute *(recommended for most components)*
- The `class` attribute *(when directly targeting the root element)*

You can also **extend or override** the built-in themes by adding additional classes via either the `config` or `class` attributes, depending on how the component is structured.

## Style Component

The style system in `stm-ui-components` is designed to be configurable and theme-aware. The following attributes are used globally or per component to control styles dynamically:

### Available Attributes

#### `tailwindcss` (boolean)  
Enables the TailwindCSS CDN if needed.  
- **Default:** `false`  
- **Usage:**  
  
<x-stm-style tailwindcss="true" />

#### `animatecss` (boolean)

Controls whether [Animate.css](https://animate.style) animations are included via CDN.

- **Default:** `true`
- **Usage:**

```blade
<x-stm::style animatecss="false" />
```

#### `config` (array)  
A configuration array used to define global styling options and color variables for all components.

### Example
    
```blade
<x-stm::style :config="[
    'theme' => 'stm',
    'primary' => '#2563eb',
    'secondary' => '#6b7280',
    'accent' => '#f59e0b',
    'heading' => '#111827',
    'text' => '#374151',
    'bg-1' => '#ffffff',
    'bg-2' => '#f9fafb',
    'danger' => '#ef4444',
    'success' => '#10b981',
    'warning' => '#facc15',
    'info' => '#3b82f6',
    'muted' => '#9ca3af',
    'border' => '#e5e7eb',
]" />
```

### Color Usage by Component

| Component     | Colors Used                    |
|---------------|---------------------------------|
| `checkbox`    | `accent`, `muted`              |
| `error`       | `danger`                       |
| `file`        | `accent`, `bg-1`, `muted`      |
| `input`       | `accent`, `muted`, `bg-2`, `danger` |
| `number`      | `accent`, `muted`, `bg-2`, `danger` |
| `password`    | `accent`, `muted`, `bg-2`, `danger` |
| `radio`       | `accent`, `muted`              |
| `search`      | `accent`, `muted`, `bg-2`, `danger` |
| `select`      | `accent`, `muted`, `bg-2`, `danger` |
| `switch`      | `accent`, `muted`              |
| `textarea`    | `accent`, `muted`, `bg-2`, `danger` |
| `button`      | `bg-1`, `accent`               |
| `collapse`    | `bg-2`                         |
| `dropdown`    | `bg-2`                         |
| `modal`       | `bg-1`                         |
| `navbar`      | `bg-2`                         |
| `pagination`  | `accent`, `bg-1`, `muted`      |
| `progressbar` | `accent`                       |
| `sidebar`     | `bg-2`                         |
| `spinner`     | `accent`                       |
| `table`       | `bg-1`, `accent`, `bg-2`, `muted` |
| `tabs`        | `bg-1`, `accent`, `muted`      |
| `datatable`   | `muted`, `accent`              |


## Script Component

The `<x-stm::script>` component is used to include **Alpine.js** and its optional plugins via CDN. It is configurable using the `config` attribute.

### Attributes

#### `config` (array)

A configuration array for loading JavaScript-related assets.

##### Available Keys:

| Key        | Type    | Default | Description                                  |
|------------|---------|---------|----------------------------------------------|
| `alpinejs` | boolean | `true`  | Controls whether Alpine.js and its plugins are loaded via CDN. |

#### Example:
```blade
<x-stm::script :config="[
    'alpinejs' => true
]" />
```
> ℹ️ Set `alpinejs` to `false` if Alpine.js is already loaded in your app or managed separately.

---

# Form Components 

Below is a list of available form components. Click any component to view its detailed documentation.

- [Checkbox](#checkbox)
- [Error](#error)
- [File](#file)
- [Input](#input)
- [Number](#number)
- [Password](#password)
- [Radio](#radio)
- [Search](#search)
- [Select](#select)
- [Switch](#switch)
- [Textarea](#textarea)

# Checkbox

The `<x-stm::checkbox/>` component is a customizable checkbox form element that supports theming, sizing, and advanced styling through configuration.

## Attributes

### `theme`
- Type: `string`
- Options: `standard`, `custom`
- Default: `'standard'`
- Description: Defines the visual theme for the checkbox.

### `color`
- Type: `string`
- Description: Sets the color of the checkbox. Accepts any valid CSS color (e.g., `#fff`, `var(--stm-color-primary)`, etc.).

### `size`
- Type: `string`
- Options: `sm`, `md`, `lg`
- Description: Controls the size of the checkbox.

### `config`
- Type: `array`
- Description: Used to apply custom styles when `theme="custom"` or to override parts of the default theme.

#### `config` keys:

| Key            | Description                              |
|----------------|------------------------------------------|
| `containerClass` | CSS classes for the outer wrapper        |
| `labelClass`     | CSS classes for the label text           |
| `inputClass`     | CSS classes for the native checkbox input |
| `iconClass`      | CSS classes for the checkbox icon (if any) |

## Example

```blade
<x-stm::checkbox 
    theme="custom"
    color="accent"
    size="md"
    :config="[
        'containerClass' => 'flex items-center gap-2',
        'labelClass' => 'text-muted',
        'inputClass' => 'border border-accent',
        'iconClass' => 'text-accent'
    ]"
/>
```
# Error

The `<x-stm::error/>` component is used to display validation or custom error messages in form components. It supports theming, sizing, and can be controlled dynamically via its API.

## Attributes

### `id`
- Type: `string`
- Description: Identifier for targeting the component programmatically via its API.

### `theme`
- Type: `string`
- Default: `'standard'`
- Description: Visual theme applied to the error message. Supports `'standard'`, `'stm'`, or `'custom'`.

### `color`
- Type: `string`
- Description: Defines the color of the error message (commonly uses `--stm-color-danger` color from theme config).

### `size`
- Type: `string`
- Options: `sm`, `md`, `lg`
- Description: Sets the size of the error message text.

### `class`
- Type: `string`
- Description: Custom classes applied directly to the component for styling.

### `message`
- Type: `string`
- Description: Initial message to be displayed before any dynamic updates.

## API Methods

You can control the component dynamically using Alpine.js by its `id`:

### `setMessage(message)`
Sets a new error message.

```js
$stm.component('component-id').setMessage('Email is required')
```

### `reset()`
Clears the current message.

```js
$stm.component('component-id').reset();
```
## Example

```blade
<x-stm::error 
    id="emailError"
    theme="standard"
    color="red"
    size="sm"
    class="mt-1"
    message="This field is required"
/>
```
# File

The `<x-stm::file/>` component is a styled file input that supports theming, sizing, and customizable colors for better UI consistency.

## Attributes

### `theme`
- Type: `string`
- Options: `'standard'`, `'stm'`
- Default: `'standard'`
- Description: Sets the visual theme of the component.

### `color`
- Type: `string`
- Description: Defines the primary color used for borders, text, and icons. Accepts any valid CSS color (e.g., `#fff`, `var(--stm-color-primary)`, etc.).

### `backgroundColor`
- Type: `string`
- Description: Sets the background color of the file input. Accepts any valid CSS color (e.g., `#fff`, `var(--stm-color-primary)`, etc.)

### `size`
- Type: `string`
- Options: `sm`, `md`, `lg`
- Description: Controls the size of the component, including padding, font-size, and icon size.

### `class`
- Type: `string`
- Description: Custom classes to further style or position the component.

## Example

```blade
<x-stm::file 
    theme="stm" 
    color="#fff" 
    backgroundColor="blue" 
    size="md" 
    class="w-full"
/>
```

# Input

The `<x-stm::input/>` component is a customizable text input field designed for consistent theming and sizing across your application.

## Attributes

### `theme`
- Type: `string`
- Options: `'standard'`, `'stm'`
- Default: `'standard'`
- Description: Determines the styling theme applied to the input. `'standard'` offers a neutral look, while `'stm'` applies your library's custom styling.

### `color`
- Type: `string`
- Description: Sets the input's accent color (borders, focus ring, etc.). Accepts any valid CSS color (e.g., `#fff`, `var(--stm-color-accent)`, etc.).

### `size`
- Type: `string`
- Options: `sm`, `md`, `lg`
- Description: Adjusts the size of the input, including padding, font size, and height.

### `class`
- Type: `string`
- Description: Additional Tailwind CSS classes to style or position the component.

## Example

```blade
<x-stm::input 
    theme="stm" 
    color="accent" 
    size="md" 
    class="w-full"
    placeholder="Enter your email"
/>
```
# Number

The `<x-stm::number/>` component is a numeric input field styled to match your UI library. It supports theming, sizing, and custom colors for visual consistency.

## Attributes

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Selects the design theme applied to the component.

### `color`
- Type: `string`  
- Description: Defines the accent or border color for the input. Accepts any valid CSS color (e.g., `#fff`, `var(--stm-color-accent)`, etc.).

### `size`
- Type: `string`  
- Options: `sm`, `md`, `lg`  
- Description: Controls the overall size of the input including font, spacing, and height.

### `class`
- Type: `string`  
- Description: Tailwind CSS utility classes to extend or override default styling.

## Example

```blade
<x-stm::number 
    theme="stm" 
    color="accent" 
    size="lg" 
    class="w-32"
    placeholder="Enter quantity"
/>
```
# Password

The `<x-stm::password/>` component provides a styled and interactive password input field. It supports theming, size control, visibility toggling, and custom styling through the `config` attribute.

## Attributes

### `id`
- Type: `string`  
- Description: Identifier for targeting the component programmatically via its API.

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Defines the visual theme of the component.

### `color`
- Type: `string`  
- Description: Accent color used for borders or focus state.

### `size`
- Type: `string`  
- Options: `sm`, `md`, `lg`  
- Description: Sets the component size (padding, font size, etc.).

### `class`
- Type: `string`  
- Description: classes for additional styling or layout control.

### `config`
- Type: `array`  
- Description: Configuration options to customize behavior and appearance.

#### `config` Keys:

| Key         | Type     | Description |
|-------------|----------|-------------|
| `state`     | `string` | Initial visibility state (`'show'` or `'hide'`) |
| `showButton`| `boolean`| Whether to display the toggle show/hide button |
| `style`     | `array`  | Styling classes for the toggle icon (`iconClass`) |

## API Methods

You can control password visibility via Alpine.js or JavaScript by referencing the component using its `id`.

### `show()`
Reveals the password.

### `hide()`
Hides the password.

### `toggle()`
Toggles visibility between shown and hidden.

## Example

```blade
<x-stm::password 
    id="passwordField"
    theme="stm"
    color="accent"
    size="md"
    class="w-full"
    :config="[
        'state' => 'hide',
        'showButton' => true,
        'style' => [
            'iconClass' => 'text-accent hover:text-primary'
        ]
    ]"
/>
```
# Radio

The `<x-stm::radio>` component is a styled radio input that supports theming and flexible styling via the `config` attribute.

## Attributes

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Defines the visual style preset for the component.

### `color`
- Type: `string`  
- Description: Sets the accent color for the radio input (e.g., `accent`, `primary`, `danger`, etc.).

### `config`
- Type: `array`  
- Description: Allows you to override default styling by customizing specific parts of the component.

#### `config['style']` keys:

| Key             | Description                                      |
|------------------|--------------------------------------------------|
| `containerClass` | Custom class for the outer container             |
| `lableClass`     | Custom class for the `<label>` element           |
| `inputClass`     | Custom class for the radio input itself          |
| `iconClass`      | Custom class for the optional check icon (if any)|

## Example

```blade
<x-stm::radio 
    theme="standard"
    color="accent"
    :config="[
        'style' => [
            'containerClass' => 'flex items-center gap-2',
            'lableClass' => 'text-sm text-muted',
            'inputClass' => 'rounded-full border-accent focus:ring-accent',
            'iconClass' => 'text-accent'
        ]
    ]"
/>
```
# Search

The `<x-stm::search>` component is a customizable search input that includes optional icon support and theme styling. It provides flexibility through sizing and a `config` object for fine-grained control over layout and design.

## Attributes

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Selects the component's theme. Use `'standard'` for a minimal base or `'stm'` for a branded UI look.

### `color`
- Type: `string`  
- Description: Sets the accent color (border, focus ring, or icon). Accepts values like `accent`, `primary`, `danger`, etc.

### `size`
- Type: `string`  
- Options: `sm`, `md`, `lg`  
- Description: Controls the component's overall size (padding, font, and height).

### `config`
- Type: `array`  
- Description: Used to customize styling for different parts of the component.

#### `config['style']` keys:

| Key             | Description                                 |
|------------------|---------------------------------------------|
| `containerClass` | Tailwind classes for the outer wrapper      |
| `inputClass`     | Tailwind classes for the search input field |
| `iconClass`      | Tailwind classes for the search icon        |

## Example

```blade
<x-stm::search 
    theme="stm" 
    color="accent" 
    size="md"
    :config="[
        'style' => [
            'containerClass' => 'flex items-center gap-2 border rounded',
            'inputClass' => 'w-full px-3 py-2',
            'iconClass' => 'text-accent'
        ]
    ]"
/>
```
# Select

The `<x-stm::select>` component renders a styled dropdown (select input) with theming, sizing, and Alpine.js-based API access. It's useful for consistent select inputs across your UI.

## Attributes

### `id`
- Type: `string`  
- Description: A unique identifier for accessing the component’s API (e.g., with Alpine.js).

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Defines the component's theme style.

### `color`
- Type: `string`  
- Description: Sets the accent color of the select input (e.g., borders, focus ring).

### `size`
- Type: `string`  
- Options: `sm`, `md`, `lg`  
- Description: Controls the visual size of the component.

### `class`
- Type: `string`  
- Description: Additional CSS classes to style or position the component.

### `options`
- Type: `array`  
- Description: An associative array of options where the **key** is the value of the `<option>` and the **value** is the label shown to the user.  

### `selected`
- Type: `string`
- Description: The key of the option to be selected initially.

## API Methods

You can retrieve the currently selected value via JavaScript using:

### `getSelected()`
Returns the value of the selected option.

```blade
<x-stm::select 
    id="themeSelect"
    theme="stm" 
    color="blue" 
    size="md" 
    :options="[
        'light' => 'Light Mode',
        'dark' => 'Dark Mode'
    ]" 
    selected="dark"
/>
```
# Switch

The `<x-stm::switch/>` component is a toggle-style input used to represent boolean values (on/off). It supports themes, sizing, and custom styling through the `config` attribute.

## Attributes

### `theme`
- Type: `string`  
- Options: `'standard'`  
- Default: `'standard'`  
- Description: Sets the visual theme of the switch component.

### `color`
- Type: `string`  
- Description: Defines the active (checked) color for the switch.

### `size`
- Type: `string`  
- Options: `sm`, `md`, `lg`  
- Description: Adjusts the size of the switch.

### `config`
- Type: `array`  
- Description: Customizes styles for each part of the component.

#### `config['style']` keys:

| Key              | Description                                  |
|------------------|----------------------------------------------|
| `containerClass` | Classes for the wrapper                      |
| `lableClass`     | Classes for the label (if present)           |
| `inputClass`     | Classes for the input (switch itself)        |

## Example

```blade
<x-stm::switch 
    theme="standard" 
    color="accent" 
    size="md"
    :config="[
        'style' => [
            'containerClass' => '',
            'lableClass' => '',
            'inputClass' => ''
        ]
    ]"
/>
```

# Textarea

The `<x-stm::textarea></x-stm::textarea>` component provides a styled multiline text input area. It supports theming, sizing, and custom styling to fit seamlessly with your UI.

## Attributes

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Sets the visual style of the textarea.

### `color`
- Type: `string`  
- Description: Defines the accent color used for borders, focus, and highlights.

### `size`
- Type: `string`  
- Options: `sm`, `md`, `lg`  
- Description: Controls the spacing, font size, and padding of the textarea.

### `class`
- Type: `string`  
- Description: Additional Tailwind CSS classes to apply to the textarea for layout or style customization.

## Example

```blade
<x-stm::textarea 
    theme="stm" 
    color="accent" 
    size="md" 
    class="w-full resize-none"
></x-stm::textarea>
```
# UI Components 

Below is a list of available UI components. Click any component to view its detailed documentation.

- [Alert](#alert)
- [Avatar](#Avatar)
- [Button](#button)
- [Collapse](#collapse)
- [Dropdown](#dropdown)
- [Modal](#modal)
- [Navbar](#navbar)
- [Pagination](#pagination)
- [Progressbar](#progressbar)
- [Sidebar](#sidebar)
- [Spinner](#spinner)
- [Table](#table)
- [Tabs](#tabs)


# Alert 

The `<x-stm::alert></x-stm::alert>` component is a flexible and customizable alert system that allows dynamic messages and styles with full JavaScript API support.

---

## Attributes

### `id`
- **Type:** `string`
- **Description:** Identifier for the component to use with the JavaScript API and events.

### `theme`
- **Type:** 
- **options:** `'standard'`, `'stm'`
- **Description:** Determines the visual theme of the alert.

### `color`
- **Type:** `string`
- **Description:** Sets the base color for the alert.

### `config`
An object that defines the alert's behavior and style.

| Key        | Type      | Description |
|------------|-----------|-------------|
| `state`    | `boolean` | Controls the visibility (open/close state) of the alert. |
| `position` | `string` | Sets the alignment of the alert on the screen. |
| `style`    | `array`  | Styling options for the alert container and box. See `style` details below. |
| `animation`| `array`/`string` | Controls the animation behavior of the alert. See `animation` details below. |

---

### `config['style']`
| Key             | Type     | Description |
|------------------|----------|-------------|
| `containerClass` | `string` | Custom classes for the outer container of the alert. |
| `alertClass`     | `string` | Custom classes for the alert box itself. |

---

### `config['animation']`
| Key       | Type     | Description |
|------------|----------|-------------|
| `enter`    | `string` | Enter animation class (e.g., `'fadeInDown'`) from animate.css. |
| `leave`    | `string` | Leave animation class (e.g., `'fadeOutUp'`) from animate.css. |
| `duration` | `string` | Duration of the animation (e.g., `'300ms'`). |

> **Note:** Due to Blade component limitations, use `x-transition:enter=""` instead of shorthand like `x-transition` or `x-transition.scale`.
---

## API Methods

Use the following methods to control the alert via JavaScript.

| Method          | Description |
|-----------------|-------------|
| `error(msg)`    | Set alert message and mode to `'error'` |
| `warn(msg)`     | Set alert message and mode to `'warning'` |
| `success(msg)`  | Set alert message and mode to `'success'` |
| `info(msg)`     | Set alert message and mode to `'info'` |
| `setContent(msg, mode)` | Set alert message and mode dynamically |
| `open()`        | Show the alert |
| `close()`       | Hide the alert |
| `toggle()`      | Toggle alert visibility |
| `openTmp(duration)` | Open alert temporarily (default: 4000ms) |

---

## Modes

Valid modes for setting content or style:

- `error`
- `warning`
- `info`
- `success`

---

## Events

You can control the alert component via custom Alpine events:

| Event Name     | Description |
|----------------|-------------|
| `open-alert`   | Opens the alert |
| `close-alert`  | Closes the alert |
| `toggle-alert` | Toggles alert visibility |

### Example:
```js
$dispatch('open-alert', { id: 'alert-1' });
```
> **Note:** You must include the id of the component in the event payload. Otherwise, it will affect all alert components.

## Example

```blade
<x-stm::alert 
    id="alert-1"
    theme="stm"
    :config="[
        'state' => false,
        'position' => 'center',
        style: [
            'containerClass' => 'mt-4',
            'alertClass' => 'text-white'
        ],
        'animation' => [
            'enter' => 'fadeInDown',
            'leave' => 'fadeOutUp',
            'duration' => '300ms'
        ]
    ]"
></x-stm::alert>
```
# Avatar

The `<x-stm::avatar/>` component displays a user image or placeholder with support for theming, sizing, and custom styling.

## Attributes

### `theme`
- Type: `string`  
- Options: `'standard'`  
- Default: `'standard'`  
- Description: Sets the visual style of the avatar.

### `size`
- Type: `string`  
- Options: `'sm'`, `'md'`, `'lg'`, or any valid CSS size (e.g. `'100px'`, `'5rem'`, `'20%'`)  
- Description: Controls the avatar’s width and height. Supports both predefined sizes and custom values.

### `class`
- Type: `string`  
- Description: Additional CSS classes to apply to the avatar for layout or style customization.

## Example

```blade
<x-stm::avatar 
    theme="standard" 
    size="80px" 
    class="shadow-md"
/>
```

# Button Component

The `<x-stm::button></x-stm::button>` component provides a styled and flexible button element with support for themes, color customization, variants, and sizes.

## Attributes

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Sets the visual theme of the button.

### `color`
- Type: `string`  
- Description: Sets the text and border color of the button.

### `backgroudColor`
- Type: `string`  
- Description: Sets the background color of the button.

### `variant`
- Type: `string`  
- Options: `'solid'`, `'outline'`, `'elevated'`  
- Default: `'solid'`  
- Description: Determines the button style variant.

### `size`
- Type: `string`  
- Options: `'sm'`, `'md'`, `'lg'`  
- Description: Controls the padding, font size, and overall dimensions of the button.

### `class`
- Type: `string`  
- Description: Additional Tailwind CSS classes to apply to the button for layout or style customization.

## Example

```blade
<x-stm::button 
    theme="stm" 
    color="white" 
    backgroudColor="primary" 
    variant="elevated" 
    size="md" 
    class="font-medium"
>Click Me</x-stm::button>
```
# Collapse

The `<x-stm::collapse></x-stm::collapse>` component provides a toggleable section that can expand or collapse content. It supports theming, color customization, and JavaScript control via API or events.

## Attributes

### `id`
- Type: `string`  
- Description: Unique identifier for the component used with JavaScript API and event control.

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Sets the visual theme of the collapse container.

### `color`
- Type: `string`  
- Description: Defines the text or border color of the collapse component.

### `backgroundColor`
- Type: `string`  
- Description: Defines the background color of the collapse content area.

### `class`
- Type: `string`  
- Description: Additional CSS classes to apply for layout or style customization.

### `config`
- Type: `array`  
- Description: Configuration options for the component behavior.

#### `state`
- Type: `boolean`  
- Description: Controls the initial open/closed state of the collapse.

---

## API Methods

Use the following methods through the JavaScript component API:

| Method     | Description                   |
|------------|-------------------------------|
| `open()`   | Opens the collapse.           |
| `close()`  | Closes the collapse.          |
| `toggle()` | Toggles the open/close state. |

---

## Events

You can control the collapse via Alpine.js custom events:

| Event Name       | Description                  |
|------------------|------------------------------|
| `open-collapse`  | Opens the specified collapse. |
| `close-collapse` | Closes the specified collapse. |
| `toggle-collapse`| Toggles the collapse.         |

### Example:
```js
dispatch('open-collapse', { id: 'collapse-1' });
```
**Note:** Always include the `id` of the component in the event payload. If omitted, the event will affect all collapse components.

## Example

```blade
<x-stm::collapse 
    id="collapse-1"
    theme="stm"
    color="gray"
    backgroundColor="white"
    :config="['state' => false]"
    class="shadow-md"
>
    <div class="p-4">
        Collapsible content goes here.
    </div>
</x-stm::collapse>
```
# Dropdown

The `<x-stm::dropdown></x-stm::dropdown>` component provides a configurable dropdown menu with support for positioning, animations, theming, and programmatic control.

## Attributes

### `id`
- Type: `string`  
- Description: Unique identifier for the component used with JavaScript API and event control.

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Sets the visual theme of the dropdown.

### `color`
- Type: `string`  
- Description: Defines the text or border color of the dropdown content.

### `backgroundColor`
- Type: `string`  
- Description: Sets the background color of the dropdown menu.

### `class`
- Type: `string`  
- Description: Additional Tailwind CSS classes for layout or style customization.

### `config`
- Type: `array`  
- Description: Configuration options for behavior, positioning, and interactivity.

#### `buttonId`
- Type: `string`  
- Description: ID of the button that toggles the dropdown.

#### `state`
- Type: `boolean`  
- Description: Controls the initial open/closed state of the dropdown.

#### `position`
- Type: `string`  
- Options:
  - **Bottom:** `'bottom'`, `'bottom-start'`, `'bottom-end'`  
  - **Top:** `'top'`, `'top-start'`, `'top-end'`  
  - **Left:** `'left'`, `'left-start'`, `'left-end'`  
  - **Right:** `'right'`, `'right-start'`, `'right-end'`  
- Description: Controls where the dropdown appears relative to the trigger button.

#### `offset`
- Type: `number`  
- Default: `5`  
- Description: The space (in pixels) between the button and the dropdown menu.

#### `clickOutside`
- Type: `boolean`  
- Default: `true`  
- Description: Whether clicking outside should close the dropdown.

#### `animation`
- Type: `string` or `array`  
- Options: `'none'` or array of `enter`, `leave`, and `duration`  
- Description: Controls the enter and leave animations.

##### `enter`
- Type: `string`  
- Example: `'fadeInDown'` (from animate.css)

##### `leave`
- Type: `string`  
- Example: `'fadeOutUp'` (from animate.css)

##### `duration`
- Type: `string`  
- Example: `'300ms'`

> **Note:** Due to Blade component limitations, use `x-transition:enter=""` syntax instead of shorthand directives like `x-transition` or `x-transition.scale`.

---

## API Methods

| Method     | Description                   |
|------------|-------------------------------|
| `open()`   | Opens the dropdown.           |
| `close()`  | Closes the dropdown.          |
| `toggle()` | Toggles the dropdown state.   |

---

## Events

You can control the dropdown using Alpine.js custom events:

| Event Name       | Description                     |
|------------------|---------------------------------|
| `open-dropdown`  | Opens the specified dropdown.   |
| `close-dropdown` | Closes the specified dropdown.  |
| `toggle-dropdown`| Toggles the dropdown.           |

### Example:
```js
$dispatch('open-dropdown', { id: 'dropdown-1' });
```

> **Note:** Always include the `id` of the component in the event payload. If omitted, the event will affect all dropdown components.

## Example

```blade
<x-stm::dropdown 
    id="dropdown-1"
    theme="stm"
    color="text-white"
    backgroundColor="bg-primary"
    class="rounded shadow-lg"
    :config="[
        'buttonId' => 'dropdown-button',
        'state' => false,
        'position' => 'bottom-end',
        'offset' => 8,
        'clickOutside' => true,
        'animation' => [
            'enter' => 'fadeInDown',
            'leave' => 'fadeOutUp',
            'duration' => '300ms'
        ]
    ]"
>
    <div class="p-4">Dropdown content here</div>
</x-stm::dropdown>
```
# Modal

The `<x-stm::modal></x-stm::modal>` component provides a customizable modal dialog with support for theming, animations, click outside behavior, and programmatic control.

## Attributes

### `id`
- Type: `string`  
- Description: Unique identifier for the component, used with the API and events.

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Sets the visual theme of the modal.

### `color`
- Type: `string`  
- Description: Sets the text or border color of the modal content.

### `backgroundColor`
- Type: `string`  
- Description: Sets the background color of the modal content container.

### `class`
- Type: `string`  
- Description: Additional CSS classes to apply for layout or style customization.

### `config`
- Type: `array`  
- Description: Configuration array for modal behavior and appearance.

#### `state`
- Type: `boolean`  
- Default: `false`  
- Description: Controls the initial open/closed state of the modal.

#### `clickOutside`
- Type: `boolean`  
- Default: `true`  
- Description: Enables or disables closing the modal when clicking outside the content area.

#### `backdrop`
- Type: `string`  
- Options: `'none'`, `'dark'`, `'light'`, `'blur'`  
- Description: Controls the appearance of the modal backdrop.

#### `style`
- Type: `array`  
- Description: Nested array for internal modal styling.

##### `backdropClass`
- Type: `string`  
- Description: Custom classes applied to the backdrop element.

#### `animation`
- Type: `'string'` or `array`
- options: `'none'` or `array`  
- Description: Defines the modal's animations.

##### `enter`
- Type: `string`  
- Example: `'fadeInUp'` (from animate.css)

##### `leave`
- Type: `string`  
- Example: `'fadeOutDown'` (from animate.css)

##### `duration`
- Type: `string`  
- Example: `'200ms'`

> **Note:** Due to Blade component limitations, use `x-transition:enter=""` syntax instead of `x-transition` or `x-transition.scale`.

---

## API Methods

| Method     | Description                  |
|------------|------------------------------|
| `open()`   | Opens the modal.             |
| `close()`  | Closes the modal.            |
| `toggle()` | Toggles the modal state.     |

---

## Events

Use Alpine.js custom events to control the modal:

| Event Name     | Description                     |
|----------------|---------------------------------|
| `open-modal`   | Opens the specified modal.      |
| `close-modal`  | Closes the specified modal.     |
| `toggle-modal` | Toggles the modal state.        |

### Example:
```js
$dispatch('open-modal', { id: 'modal-1' });
```

> **Note:** Always include the id of the component in the event payload. If omitted, the event will affect all modal components.

## Example

```blade
<x-stm::modal 
    id="modal-1"
    theme="stm"
    color="black"
    backgroundColor="white"
    class="shadow-xl"
    :config="[
        'state' => false,
        'clickOutside' => true,
        'backdrop' => 'blur',
        'style' => [
            'backdropClass' => ''
        ],
        'animation' => [
            'enter' => 'fadeInUp',
            'leave' => 'fadeOutDown',
            'duration' => '200ms'
        ]
    ]"
>
    <div class="p-6">
        Modal content goes here.
    </div>
</x-stm::modal>
```

# Navbar

The `<x-stm::navbar></x-stm::navbar>` component provides a customizable navigation bar with support for theming, sticky behavior, and custom styling.

## Attributes

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Sets the visual theme of the navbar.

### `color`
- Type: `string`  
- Description: Defines the text or icon color inside the navbar.

### `backgroundColor`
- Type: `string`  
- Description: Sets the background color of the navbar.

### `class`
- Type: `string`  
- Description: Additional Tailwind CSS classes to apply to the navbar for layout or style customization.

### `config`
- Type: `array`  
- Description: Configuration array for navbar behavior.

#### `sticky`
- Type: `boolean`  
- Default: `false`  
- Description: Enables or disables sticky positioning for the navbar.

## Slots

### `start`
- Description: Slot at the start of the navbar. mostly used for Brand.

### `center`
- Description: Slot at the center of the navbar. used for Title or Menu.

### `end`
- Description: Slot at the end of the navbar. used for Buttons or Menu.

---

## Example

```blade
<x-stm::navbar 
    theme="stm"
    color="white"
    backgroundColor="lightgary"
    class="shadow-md"
    :config="[
        'sticky' => true
    ]"
>
    <x-slot::start>
        Brand
    </x-slot::start>

    <x-slot::center>
        Title
    </x-slot::center>

    <x-slot::end>
        Menu
    </x-slot::end>

</x-stm::navbar>
```
# Pagination

The `<x-stm::pagination />` component provides a dynamic and customizable pagination interface, with API methods and event hooks for advanced integration.

## Attributes

### `id`
- Type: `string`  
- Description: Unique identifier for the component, used with the API and events.

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Sets the visual theme of the pagination.

### `color`
- Type: `string`  
- Description: Defines the color used for active or focused items.

### `backgroundColor`
- Type: `string`  
- Description: Sets the background color for pagination buttons.

### `size`
- Type: `string`  
- Options: `sm`, `md`, `lg`  
- Description: Controls the size and spacing of the pagination buttons.

### `config`
- Type: `array`  
- Description: Configuration array for pagination behavior and appearance.

#### `pages`
- Type: `number`  
- Description: Total number of pages to display.

#### `currentPage`
- Type: `number`  
- Default: `1`  
- Description: The currently selected page.

#### `limit`
- Type: `number`  
- Default: `5`  
- Description: Number of page buttons to show at once.

#### `style`
- Type: `array`  
- Description: Style customization for internal pagination elements.

##### `containerClass`
- Type: `string`  
- Description: Classes applied to the pagination container.

##### `itemClass`
- Type: `string`  
- Description: Classes applied to each pagination button.

##### `activeItemClass`
- Type: `string`  
- Description: Classes applied to the currently active page.

##### `leftArrowClass`
- Type: `string`  
- Description: Classes applied to the left (previous) arrow.

##### `rightArrowClass`
- Type: `string`  
- Description: Classes applied to the right (next) arrow.

---

## API Methods

| Method            | Description                            |
|-------------------|----------------------------------------|
| `setLimit()`      | Sets the number of visible page buttons. |
| `setTotalPages()` | Updates the total number of pages.     |
| `selectPage()`    | Selects a specific page.               |
| `next()`          | Goes to the next page.                 |
| `prev()`          | Goes to the previous page.             |

---

## Events

| Event         | Description                                  |
|---------------|----------------------------------------------|
| `change-page` | Dispatched when the page changes.            |

### Example
```html
x-on:change-page.window="doSomething($event.detail)"
```
detail object:
```js
{
  id: 'pagination-1',
  page: 3
}
```
## Example

```blade
<x-stm::pagination 
    id="pagination-1"
    theme="stm"
    color="gray"
    backgroundColor="blue"
    size="md"
    :config="[
        'pages' => 20,
        'currentPage' => 1,
        'limit' => 7,
        'style' => [
            'containerClass' => 'flex gap-2',
            'itemClass' => 'px-3 py-1 border rounded',
            'activeItemClass' => 'bg-accent text-white',
            'leftArrowClass' => 'text-muted',
            'rightArrowClass' => 'text-muted'
        ]
    ]"
/>
```

# Progressbar

The `<x-stm::progressbar/>` component provides a customizable progress indicator with support for theming, sizing, animations, and percentage labels.

## Attributes

### `id`
- Type: `string`  
- Description: Unique identifier for the component, used with API methods.

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Sets the visual theme of the progress bar.

### `color`
- Type: `string`  
- Description: Sets the color of the progress fill.

### `size`
- Type: `string`  
- Options: `xs`, `sm`, `md`, `lg`  
- Description: Controls the height and visual size of the progress bar.

### `config`
- Type: `array`  
- Description: Configuration array for progress behavior and styles.

#### `progress`
- Type: `number` or `string`  
- Default: `0`  
- Description: Sets the initial progress value. Use `'infinite'` for an animated loading effect.

#### `duration`
- Type: `string`  
- Description: Transition speed when changing progress, e.g. `'300ms'`.

#### `pourcentage`
- Type: `string`  
- Options: `'none'`, `'start'`, `'center'`, `'end'`  
- Default: `'none'`  
- Description: Controls the position of the percentage label inside the bar.

#### `style`
- Type: `array`  
- Description: Custom styling for internal parts of the component.

##### `labelClass`
- Type: `string`  
- Description: Classes applied to the label text.

##### `containerClass`
- Type: `string`  
- Description: Classes applied to the outer container of the progress bar.

##### `fillClass`
- Type: `string`  
- Description: Classes applied to the filled portion of the bar.

##### `pourcentageClass`
- Type: `string`  
- Description: Classes applied to the percentage label.

---

## API Methods

| Method         | Description                          |
|----------------|--------------------------------------|
| `setProgress()`| Updates the progress value.          |
| `setLabel()`   | Sets or updates the label text.      |
| `setDuration()`| Changes the transition duration.     |

---

> **Note:** To enable an **infinite loading animation**, set `progress` to `'infinite'`.

---

## Example

```blade
<x-stm::progressbar 
    id="progress-1"
    theme="stm"
    color="blue"
    size="md"
    :config="[
        'progress' => 35,
        'duration' => '400ms',
        'pourcentage' => 'center',
        'style' => [
            'labelClass' => 'text-xs text-gray-700',
            'containerClass' => 'rounded-full bg-gray-200',
            'fillClass' => 'rounded-full',
            'pourcentageClass' => 'text-white text-sm font-semibold'
        ]
    ]"
/>
```

# Sidebar

The `<x-stm::sidebar></x-stm::sidebar>` component provides a responsive, configurable sidebar with customizable width, height, and behavior. It supports breakpoints, clickOutside handling, and external event control.

## Attributes

### `id`
- Type: `string`  
- Description: Unique identifier for the component, used with API and events.

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Sets the visual theme of the sidebar.

### `color`
- Type: `string`  
- Description: Sets the text or icon color inside the sidebar.

### `backgroundColor`
- Type: `string`  
- Description: Sets the background color of the sidebar.

### `class`
- Type: `string`  
- Description: Additional CSS classes to style the sidebar.

### `config`
- Type: `array`  
- Description: Configuration array for sidebar behavior and layout.

#### `state`
- Type: `boolean`  
- Default: `true`  
- Description: Initial visibility state of the sidebar.

#### `maxWidth`
- Type: `string`  
- Default: `'200px'`  
- Description: The width of the sidebar when expanded.

#### `minWidth`
- Type: `string`  
- Default: `'0px'`  
- Description: The minimum width when collapsed (useful for persistent collapsed mode in large screens).

#### `height`
- Type: `string`  
- Default: `'100dvh'`  
- Description: Height of the sidebar.

#### `position`
- Type: `string`  
- Options: `'left'`, `'right'`  
- Description: Sidebar opening direction.

#### `breakpoint`
- Type: `array`  
- Description: Behavior at certain screen widths.

##### `width`
- Type: `string`  
- Description: Minimum screen width before applying breakpoint behavior.

##### `clickOutside`
- Type: `boolean`  
- Description: Enables closing the sidebar when clicking outside (at breakpoint).

---

## API Methods

| Method     | Description                      |
|------------|----------------------------------|
| `open()`   | Opens the sidebar.               |
| `close()`  | Closes the sidebar.              |
| `toggle()` | Toggles the sidebar state.       |

---

## Events

| Event            | Description                                 |
|------------------|---------------------------------------------|
| `open-sidebar`   | Opens a specific sidebar.                   |
| `close-sidebar`  | Closes a specific sidebar.                  |
| `toggle-sidebar` | Toggles a specific sidebar.                 |

### Example

```js
$dispatch('open-sidebar', { id: 'sidebar-1' })
```
> **Note:** Always include the component id when dispatching events; otherwise, the event will apply to all sidebar components.

## Usage Note
When using a button outside the sidebar to trigger it, make sure to stop event propagation to prevent interference with clickOutside logic:

```html
<button @click.stop="$dispatch('toggle-sidebar', { id: 'sidebar-1' })">Toggle Sidebar</button>
```
## Example

```blade
<x-stm::sidebar 
    id="sidebar-1"
    theme="stm"
    color="white"
    backgroundColor="gray"
    class="shadow-lg"
    :config="[
        'state' => true,
        'maxWidth' => '250px',
        'minWidth' => '80px',
        'height' => '100dvh',
        'position' => 'left',
        'breakpoint' => [
            'width' => '768px',
            'clickOutside' => true
        ]
    ]"
>
    <ul>
        <li>Dashboard</li>
        <li>Settings</li>
        ...
    </ul>
<x-stm::sidebar>
```

# Spinner

The `<x-stm::spinner/>` component provides a simple and customizable loading spinner. It supports theming, sizing, and color options to match your UI design.

## Attributes

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Sets the visual style of the spinner.

### `color`
- Type: `string`  
- Description: Sets the spinner color.

### `size`
- Type: `string`  
- Options: `'sm'`, `'md'`, `'lg'`, or any valid size value like `'100px'`, `'20rem'`, etc.  
- Description: Defines the width and height of the spinner.

### `class`
- Type: `string`  
- Description: Additional Tailwind CSS classes to style or position the spinner.

---

## Example

```blade
<x-stm-spinner 
    theme="stm" 
    color="text-primary" 
    size="md" 
    class="mx-auto"
/>
```

# Table

The `<x-stm::table></x-stm::table>` component is a fully customizable, responsive data table that supports sorting, selection, mobile card view, and more. It adapts to both desktop and mobile layouts using a `view` mode and provides comprehensive styling and configuration options.

---

## Attributes

### `id`
- Type: `string`  
- Description: Unique identifier for the component, used with API and events.

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Sets the table's visual style.

### `color`
- Type: `string`  
- Description: Text or icon color inside the table.

### `backgroundColor`
- Type: `string`  
- Description: Sets the table's background color.

### `data`
- Type: `array`  
- Description: The table rows data array.

### `config`
- Type: `array`  
- Description: Main configuration options.

---

## Config Options

### `sortable`
- Type: `boolean`  
- Default: `true`  
- Description: Enables column sorting.

### `selectable`
- Type: `boolean`  
- Default: `false`  
- Description: Enables row selection with checkboxes.

### `selectAllBtn`
- Type: `boolean`  
- Default: `true`  
- Description: Shows a “Select All” checkbox.

### `view`
- Type: `string`  
- Options: `'auto'`, `'desktop'`, `'mobile'`  
- Default: `'auto'`  
- Description: Controls responsive display behavior.

### `emptyMessage`
- Type: `string`  
- Default: `'no data found'`  
- Description: Message displayed when no data is available.

---

## `table` Subconfig

### `headers`
- Type: `array`  
- Description: Table headers in the form `['key' => 'Label']`.

### `style`
- Type: `array`  
- Description: Style options for the desktop table.

| Key                  | Type     | Description                                |
|----------------------|----------|--------------------------------------------|
| `lightColor`         | `string` | Color used for hover and stripe effect     |
| `width`, `height`    | `string` | Table dimensions (e.g., `'800px'`)         |
| `stickyHeader`       | `bool`   | Fixes the header during scroll             |
| `hoverable`          | `bool`   | Enables row hover effect                   |
| `striped`            | `bool`   | Enables alternating row stripes            |
| `bordered`           | `bool`   | Enables table borders                      |
| `tableContainerClass`, `tableClass`, `theadClass`, `tbodyClass`, `trClass`, `thClass`, `tdClass` | `string` | Tailwind CSS classes for styling |

---

## `card` Subconfig (for Mobile View)

### `cardHeader`
- Type: `array`  
- Description: Headers shown in mobile card view (subset of `headers`).

### `style`
- Type: `array`  
- Description: Style options for mobile layout.

| Key              | Description                                     |
|------------------|-------------------------------------------------|
| `mTableClass`    | Wrapper class for mobile table container        |
| `mTheadClass`    | Class for mobile table head                     |
| `mTbodyClass`    | Class for mobile body container                 |
| `mTrClass`       | Class for mobile row                            |
| `mThClass`       | Class for mobile label header                   |
| `mTdClass`       | Class for mobile value container                |
| `cardClass`      | Main card wrapper class                         |
| `chClass`        | Card header class                               |
| `cdClass`        | Card data/content class                         |


## Slots

### `action`
- Description: Slot for action buttons per row. You get access to the row object (e.g., `row.id`, `row.name`, etc.).

### `loader`
- Description: Slot for custom loader when loading is `true`.
---

## API Methods

| Method            | Description                                          |
|-------------------|------------------------------------------------------|
| `setupData(data)` | Initializes the data                                 |
| `setData(data)`   | set or updates the data                              |
| `removeSelect()`  | Disables row selection                               |
| `showSelect()`    | Enables row selection                                |
| `toggleSelect()`  | Toggles row selection availability                   |
| `getSelection()`  | Returns selected rows                                |

---

## API Properties

### `loading`
- Type: `boolean`  
- Default: `false`  
- Description: Set to `true` to show loading state.

---

## Example

```blade
<x-stm::table
    id="users"
    theme="stm"
    color="text-gray-900"
    backgroundColor="bg-white"
    :data="$users"
    :config="[
        'sortable' => true,
        'selectable' => true,
        'view' => 'auto',
        'emptyMessage' => 'No users found',
        'table' => [
            'headers' => ['name' => 'Full Name', 'email' => 'Email'],
            'style' => [
                'hoverable' => true,
                'striped' => true,
                'tableClass' => 'w-full',
            ]
        ],
        'card' => [
            'cardHeader' => ['name' => 'Full Name'],
            'style' => [
                'cardClass' => 'shadow-md'
            ]
        ]
    ]"
>
     <x-slot:action>
        <button class="btn-sm" @click="edit(row.id)">Edit</button>
    </x-slot:action>

    <x-slot:loader>
        <x-stm-spinner color="accent" size="md" />
    </x-slot:loader>
</x-stm::table>
```

# Tabs 
The `<x-stm::tabs></x-stm::tabs>` component creates an accessible and themeable tab interface with support for enabling/disabling specific tabs and custom styling.

---

## Attributes

### `id`
- Type: `string`  
- Description: Unique identifier for the component, used for programmatic control.

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Sets the visual theme of the tab interface.

### `color`
- Type: `string`  
- Description: Accent or primary color applied to active tab styles.

### `backgroundColor`
- Type: `string`  
- Description: Background color of the active tab.

### `data`
- Type: `array`  
- Description: Array of tab definitions. Each item should include keys: `label`, `value`, `target`, and optionally `disabled`.

### `config`
- Type: `array`  
- Description: Configuration for custom styles.

#### `style`

| Key               | Type     | Description                                       |
|-------------------|----------|---------------------------------------------------|
| `tabClass`        | `string` | Classes applied to each tab                      |
| `activeTabClass`  | `string` | Classes applied to the active tab                |
| `containerClass`  | `string` | Wrapper class for the entire tabs container      |

---

## API Methods

| Method               | Description                                        |
|----------------------|----------------------------------------------------|
| `activate(value)`    | Activates a tab by its `value`                     |
| `disable(value)`     | Disables a specific tab                            |
| `enable(value)`      | Enables a specific tab                             |

---

## Example

```blade
<x-stm::tabs 
    id="main-tabs"
    theme="stm"
    color="accent"
    backgroundColor="bg-white"
    :data="[
        ['label' => 'Profile', 'value' => 'profile', 'target' => '#profile', 'disabled' => false],
        ['label' => 'Settings', 'value' => 'settings', 'target' => '#settings', 'disabled' => false]
    ]"
    :config="[
        'style' => [
            'tabClass' => 'px-4 py-2 text-sm',
            'activeTabClass' => 'font-bold border-b-2 border-accent',
            'containerClass' => 'flex space-x-4 border-b'
        ]
    ]"
>
    <div id="profile">Profile Tab</div>
    <div id="settings">Settings Tab</div>
</x-stm::tabs>
```

# Master Components

Below is a list of available Master components. Click any component to view its detailed documentation.

- [Datatable](#datatable)

# Datatable

The `<x-stm::datatable></x-stm::datatable>` component provides an advanced table interface with pagination, sorting, selection, column control, and search functionality.

---

## Attributes

### `id`
- Type: `string`  
- Description: Unique identifier for the component, used for API access.

### `theme`
- Type: `string`  
- Options: `'standard'`, `'stm'`  
- Default: `'standard'`  
- Description: Sets the component's styling theme.

### `color`
- Type: `string`  
- Description: Defines the component's accent color.

### `backgroundColor`
- Type: `string`  
- Description: Sets the background color of the component.

### `data`
- Type: `array`  
- Description: Array of table row objects to be displayed.

### `config`
- Type: `array`  
- Description: Configuration options for table behavior and appearance.

#### `navigation`
| Key              | Type         | Description                                                  |
|------------------|--------------|--------------------------------------------------------------|
| `searchable`     | `bool`       | Enables the search input. Default: `true`                    |
| `perPageOptions` | `array`      | Dropdown values for items per page. Ex: `['10'=>'10']`       |
| `columns`        | `bool`       | Enable/disable column visibility toggle. Default: `true`     |

#### `sortable`
- Type: `bool`  
- Description: Enable sorting by clicking column headers. Default: `true`

#### `selectable`
- Type: `bool`  
- Description: Allow selection of individual table rows. Default: `false`

#### `selectAllBtn`
- Type: `bool`  
- Description: Display the select-all button. Default: `true`

#### `view`
- Type: `string`  
- Options: `'auto'`, `'desktop'`, `'mobile'`  
- Default: `'auto'`  
- Description: Controls the view mode for responsive behavior.

#### `emptyMessage`
- Type: `string`  
- Description: Message to display when there's no data. Default: `'no data found'`

#### `table`

| Key                | Type     | Description                                                  |
|--------------------|----------|--------------------------------------------------------------|
| `headers`          | `array`  | Table column headers. Key = field, Value = label             |
| `style`            | `array`  | Table appearance settings (see table style below)            |

##### `table.style`

| Key                   | Type     | Description                                                  |
|------------------------|----------|--------------------------------------------------------------|
| `lightColor`           | `string` | Color used for hover and stripes                             |
| `width`, `height`      | `string` | Dimensions of the table. Ex: `'800px'`                       |
| `stickyHeader`         | `bool`   | Enable sticky table header. Default: `false`                 |
| `hoverable`            | `bool`   | Highlight rows on hover. Default: `true`                     |
| `striped`              | `bool`   | Display zebra-stripes. Default: `false`                      |
| `bordered`             | `bool`   | Add borders to cells. Default: `false`                       |
| `tableContainerClass`, `tableClass`, `theadClass`, `tbodyClass`, `trClass`, `thClass`, `tdClass` | `string` | classes for styling the table layout |

#### `card`

| Key                | Type     | Description                                                  |
|--------------------|----------|--------------------------------------------------------------|
| `cardHeader`        | `array`  | Headers to display in mobile view                            |
| `style`             | `array`  | Styling classes for card layout in mobile view               |

##### `card.style`

| Key                   | Type     | Description                                                  |
|------------------------|----------|--------------------------------------------------------------|
| `mTableClass`, `mTheadClass`, `mTbodyClass`, `mTrClass`, `mThClass`, `mTdClass` | `string` | Mobile-specific table classes                             |
| `cardClass`, `chClass`, `cdClass` | `string` | Card container, header, and content classes                |

#### `pagination`

| Key        | Type     | Description                                        |
|------------|----------|----------------------------------------------------|
| `limit`    | `number` | Max visible page links. Default: `5`               |
| `style`    | `array`  | Classes for pagination UI styling                  |

##### `pagination.style`

| Key              | Type     | Description                            |
|------------------|----------|----------------------------------------|
| `containerClass` | `string` | Wrapper class for pagination           |
| `itemClass`      | `string` | Pagination link classes                |
| `activeItemClass`| `string` | Classes for the active page link       |
| `leftArrowClass` | `string` | Left arrow icon/button class           |
| `rightArrowClass`| `string` | Right arrow icon/button class          |

---

## Slots

| Slot     | Description                                      |
|----------|--------------------------------------------------|
| `button` | Add custom buttons to the top navigation          |
| `action` | Slot for row-level action buttons inside the table. You have access to each `row` object. |

---

## API

### Properties

| Property     | Description                             |
|--------------|-----------------------------------------|
| `table`      | Access to the inner table component      |
| `pagination` | Access to the inner pagination component |

### Methods

| Method              | Description                                            |
|---------------------|--------------------------------------------------------|
| `setData(data)`     | Load or update the component's dataset                 |
| `setSearch(string)` | Set search input manually via JavaScript               |
| `setPerPage(number)`| Set number of items per page programmatically          |

---

## Example

```blade
<x-stm-datatable 
    id="my-datatable"
    theme="stm"
    color="primary"
    backgroundColor="white"
    :data="$rows"
    :config="[
        'navigation' => [
            'searchable' => true,
            'perPageOptions' => ['10' => '10', '20' => '20'],
            'columns' => true
        ],
        'sortable' => true,
        'selectable' => true,
        'view' => 'auto',
        'emptyMessage' => 'No data found',
        'table' => [
            'headers' => ['name' => 'Name', 'email' => 'Email'],
            'style' => ['hoverable' => true, 'striped' => true]
        ],
        'pagination' => [
            'limit' => 5,
            'style' => ['containerClass' => 'mt-4 flex justify-center']
        ]
    ]"
>
    <x-slot:button>
        <x-stm::button variant="solid" size="sm">Add User</x-stm::button>
    </x-slot:button>

    <x-slot:action>
        <x-stm::button size="sm" @click="edit(row.id)">Edit</x-stm::button>
    </x-slot:action>
</x-stm::datatable>
```


# `$stm` Global Controller Object

The `$stm` object is a global controller that manages and interacts with all STM UI components via their APIs. It provides a unified way to control components dynamically.

---

## 📘 Overview

`$stm` enables programmatic access to UI components by their IDs. It helps in managing state, visibility, and access to each registered component's API.

---

## 🔧 Available Methods

- [component(id)](#componentid)
- [allComponents()](#allComponents)
- [open(id)](#openid)
- [close(id)](#closeid)
- [toggle(id)](#toggleid)
- [getState(id)](#getstateid)

### `component(id)`
Returns the API object of a component by its `id`.

```js
const modal = $stm.component('myModal');
modal.open(); // Calls the open method of the component
```

### `allComponents()`
Returns an array of all registered component instances.

```js
$stm.allComponents();
```

### `open(id)`
Returns an array of all registered component instances.

```js
$stm.open('model-1');
```

### `close(id)`
Returns an array of all registered component instances.

```js
$stm.close('sidebar-1');
```

### `toggle(id)`
Returns an array of all registered component instances.

```js
$stm.toggle('dropdown-1');
```

### `getState(id)`
Returns an array of all registered component instances.

```js
$stm.getState('collapse-1');
```

> **Note:** If your component is nested or rendered conditionally, you must use Alpine.js's `$nextTick()` to ensure the component is fully loaded before invoking `$stm` methods.

```js
$nextTick(() => {
    $stm.open('nestedModal');
});
```

## Summary

- Use `$stm` for centralized component control.

- Always ensure components are mounted using `$nextTick()` in nested/conditional cases.

- Each component must have a unique `id` to interact with via `$stm`.