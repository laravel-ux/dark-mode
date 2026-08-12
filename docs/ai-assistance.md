# AI Assistance

Laravel UX Dark Mode includes a Laravel Boost skill that teaches supported coding agents how to integrate and debug
the package.

## What the skill covers

The `laravel-ux-dark-mode-development` skill provides package-specific guidance for:

- Placing `@darkModeScripts` early enough to avoid a theme flash.
- Rendering and customizing the `ux.dark-mode::toggle` component.
- Preserving session-backed state and the locked Livewire property.
- Using the Alpine `darkMode` store and `dark-mode-toggled` event.
- Building accessible custom appearance controls.
- Testing persistence, root-class synchronization, and event behavior.

## Discover the skill

List the skills Laravel Boost can discover in the current project:

```shell
php artisan boost:list-skills
```

For an existing Boost installation, discover newly available package skills:

```shell
php artisan boost:update --discover
```

Because the skill ships with the package, its guidance stays aligned with the installed dark-mode API.
