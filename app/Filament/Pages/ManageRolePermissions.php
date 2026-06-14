<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\CheckboxList;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class ManageRolePermissions extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationLabel = 'Role Permissions';

    protected static ?string $title = 'Role Permissions';

    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 95;

    protected string $view = 'filament.pages.manage-role-permissions';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    // ── Permission groups ──────────────────────────────────────────────────
    private static function groups(): array
    {
        return [
            'Posts'         => ['view posts', 'create posts', 'edit posts', 'delete posts', 'publish posts'],
            'Services'      => ['view services', 'create services', 'edit services', 'delete services'],
            'Programs'      => ['view programs', 'create programs', 'edit programs', 'delete programs'],
            'Causes'        => ['view causes', 'create causes', 'edit causes', 'delete causes'],
            'Team Members'  => ['view team-members', 'create team-members', 'edit team-members', 'delete team-members'],
            'Testimonials'  => ['view testimonials', 'create testimonials', 'edit testimonials', 'delete testimonials'],
            'Gallery'       => ['view gallery', 'create gallery', 'edit gallery', 'delete gallery'],
            'FAQs'          => ['view faqs', 'create faqs', 'edit faqs', 'delete faqs'],
            'Donations'     => ['view donations', 'create donations', 'edit donations', 'delete donations'],
            'Contact'       => ['view contact-submissions', 'delete contact-submissions'],
            'Newsletter'    => ['view newsletter-subscribers', 'delete newsletter-subscribers'],
            'Page Sections' => ['view page-sections', 'edit page-sections'],
            'Site Counters' => ['view site-counters', 'edit site-counters'],
            'Settings'      => ['view settings', 'edit settings'],
            'Users'         => ['view users', 'create users', 'edit users', 'delete users'],
        ];
    }

    private static function managedRoles(): array
    {
        return ['admin', 'editor', 'author', 'viewer'];
    }

    // ── Form ──────────────────────────────────────────────────────────────
    public function mount(): void
    {
        $fill = [];

        foreach (self::managedRoles() as $roleName) {
            $role = Role::findByName($roleName);
            $rolePermissions = $role->permissions->pluck('name')->toArray();

            foreach (self::groups() as $group => $perms) {
                $key = $roleName . '__' . $this->groupKey($group);
                $fill[$key] = array_values(array_intersect($rolePermissions, $perms));
            }
        }

        $this->form->fill($fill);
    }

    public function form(Schema $form): Schema
    {
        $roleTabs = [];

        foreach (self::managedRoles() as $roleName) {
            $sections = [];

            foreach (self::groups() as $group => $perms) {
                $key = $roleName . '__' . $this->groupKey($group);
                $options = array_combine($perms, array_map(fn ($p) => ucwords(explode(' ', $p)[0]), $perms));

                $sections[] = Section::make($group)
                    ->compact()
                    ->schema([
                        CheckboxList::make($key)
                            ->hiddenLabel()
                            ->options($options)
                            ->columns(min(count($perms), 5))
                            ->gridDirection('row'),
                    ]);
            }

            $roleTabs[] = Tabs\Tab::make(ucfirst($roleName))
                ->schema($sections);
        }

        return $form
            ->components([
                Tabs::make('Roles')
                    ->tabs($roleTabs)
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    // ── Save ──────────────────────────────────────────────────────────────
    public function save(): void
    {
        $data = $this->form->getState();

        foreach (self::managedRoles() as $roleName) {
            $role = Role::findByName($roleName);
            $selected = [];

            foreach (self::groups() as $group => $perms) {
                $key = $roleName . '__' . $this->groupKey($group);
                $selected = array_merge($selected, $data[$key] ?? []);
            }

            $role->syncPermissions($selected);
        }

        // Flush Spatie's permission cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Notification::make()
            ->title('Permissions saved!')
            ->success()
            ->send();
    }

    private function groupKey(string $group): string
    {
        return strtolower(str_replace(' ', '_', $group));
    }
}
