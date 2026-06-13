<x-filament-panels::page>

<style>
.mh-wrap {
    border: 1px solid #e5e7eb;
    border-radius: 0.75rem;
    overflow: hidden;
}
.mh-row {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.875rem 1.25rem;
    background: #ffffff;
    border-bottom: 1px solid #f3f4f6;
}
.mh-row:last-child { border-bottom: none; }
.mh-order {
    font-size: 0.72rem;
    color: #9ca3af;
    width: 1.25rem;
    flex-shrink: 0;
    font-family: monospace;
    text-align: center;
}
.mh-info { flex: 1; min-width: 0; }
.mh-key {
    font-size: 0.875rem;
    font-weight: 600;
    color: #111827;
    margin: 0;
    text-transform: capitalize;
}
.mh-title {
    font-size: 0.75rem;
    color: #6b7280;
    margin: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.mh-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.2rem 0.65rem;
    border-radius: 9999px;
    font-size: 0.7rem;
    font-weight: 500;
    flex-shrink: 0;
}
.mh-badge-visible { background: #dcfce7; color: #15803d; }
.mh-badge-hidden  { background: #f3f4f6; color: #6b7280; }
.mh-btn {
    flex-shrink: 0;
    padding: 0.35rem 0.85rem;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    font-weight: 500;
    cursor: pointer;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    color: #374151;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}
.mh-btn-edit {
    background: #eff6ff;
    color: #1d4ed8;
    border-color: #dbeafe;
}
.mh-empty {
    padding: 2rem;
    text-align: center;
    font-size: 0.875rem;
    color: #9ca3af;
}

/* ── Dark mode ── */
.dark .mh-wrap  { border-color: #374151; }
.dark .mh-row   { background: #111827; border-bottom-color: #1f2937; }
.dark .mh-order { color: #4b5563; }
.dark .mh-key   { color: #f3f4f6; }
.dark .mh-title { color: #6b7280; }
.dark .mh-badge-visible { background: rgba(21,128,61,0.2); color: #4ade80; }
.dark .mh-badge-hidden  { background: #1f2937; color: #6b7280; }
.dark .mh-btn   { background: #1f2937; border-color: #374151; color: #d1d5db; }
.dark .mh-btn-edit { background: rgba(29,78,216,0.15); border-color: rgba(29,78,216,0.3); color: #60a5fa; }
.dark .mh-empty { color: #4b5563; }
</style>

    <p style="font-size:0.875rem;color:#6b7280;margin-bottom:1rem;">
        Toggle sections on/off to show or hide them on the homepage.
        Click <strong>Edit</strong> to change a section's title, subtitle, or body text.
    </p>

    <div class="mh-wrap">
        @forelse ($this->getSections() as $section)
            <div wire:key="section-{{ $section->id }}" class="mh-row">

                <span class="mh-order">{{ $section->order }}</span>

                <div class="mh-info">
                    <p class="mh-key">{{ str_replace('_', ' ', $section->section_key) }}</p>
                    @if($section->title)
                        <p class="mh-title">{{ $section->title }}</p>
                    @endif
                </div>

                @if($section->is_active)
                    <span class="mh-badge mh-badge-visible">Visible</span>
                @else
                    <span class="mh-badge mh-badge-hidden">Hidden</span>
                @endif

                <button wire:click="toggleSection({{ $section->id }})" class="mh-btn">
                    {{ $section->is_active ? 'Hide' : 'Show' }}
                </button>

                <a href="{{ route('filament.admin.resources.page-sections.edit', $section->id) }}"
                   class="mh-btn mh-btn-edit">
                    Edit
                </a>

            </div>
        @empty
            <div class="mh-empty">No sections found.</div>
        @endforelse
    </div>

</x-filament-panels::page>
