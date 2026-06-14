<?php

namespace App\Filament\Concerns;

/**
 * Add to any Filament Resource to enforce spatie/laravel-permission checks.
 * Set $permissionPrefix on the resource class to match the permission names
 * defined in RolesPermissionsSeeder, e.g. 'posts', 'gallery', 'team-members'.
 *
 * Super admin bypasses all checks via Spatie's Gate::before hook.
 */
trait HasResourcePermissions
{
    public static function canAccess(): bool
    {
        $user = auth()->user();
        if (! $user) {
            return false;
        }
        if ($user->hasRole('super_admin')) {
            return true;
        }

        return $user->hasPermissionTo('view ' . static::$permissionPrefix);
    }

    public static function canCreate(): bool
    {
        $user = auth()->user();
        if (! $user) {
            return false;
        }
        if ($user->hasRole('super_admin')) {
            return true;
        }

        return $user->hasPermissionTo('create ' . static::$permissionPrefix);
    }

    public static function canEdit($record): bool
    {
        $user = auth()->user();
        if (! $user) {
            return false;
        }
        if ($user->hasRole('super_admin')) {
            return true;
        }

        return $user->hasPermissionTo('edit ' . static::$permissionPrefix);
    }

    public static function canDelete($record): bool
    {
        $user = auth()->user();
        if (! $user) {
            return false;
        }
        if ($user->hasRole('super_admin')) {
            return true;
        }

        return $user->hasPermissionTo('delete ' . static::$permissionPrefix);
    }

    public static function canDeleteAny(): bool
    {
        return static::canDelete(null);
    }
}
