# Events and Customization

After the mode changes, the Livewire toggle dispatches a `dark-mode-toggled` browser event.

The event detail contains the new boolean value:

```json
{
    "darkMode": true
}
```

## Listen from Alpine

Use the `.window` modifier when an integration lives outside the toggle component.

```blade
<div
    x-data
    @dark-mode-toggled.window="console.log($event.detail.darkMode)"
>
    ...
</div>
```

For example, forward the selected mode to an embedded preview:

```blade
<iframe
    x-ref="preview"
    @dark-mode-toggled.window="
        $refs.preview.contentWindow.postMessage(
            { darkMode: $event.detail.darkMode },
            '*',
        )
    "
></iframe>
```

Validate message origins when receiving `postMessage` events across origins.

## Customize the toggle view

Create an application override at:

```text
resources/views/vendor/ux.dark-mode/livewire/toggle.blade.php
```

Keep these behaviors when replacing the markup:

- Trigger the Livewire `toggle` action.
- Entangle the `darkMode` property with the Alpine `darkMode` store.
- Update the store when `dark-mode-toggled` is dispatched.
- Give icon-only controls an accessible name.

```blade
<button
    type="button"
    wire:click="toggle"
    :aria-label="$darkMode ? __('Use light mode') : __('Use dark mode')"
    x-init="Alpine.store('darkMode', $wire.entangle('darkMode'))"
    @dark-mode-toggled="$store.darkMode = $event.detail.darkMode"
>
    {{ $darkMode ? __('Light mode') : __('Dark mode') }}
</button>
```

The `darkMode` property is locked. Change it through the component action rather than mutating it directly from
client-provided Livewire payloads.
