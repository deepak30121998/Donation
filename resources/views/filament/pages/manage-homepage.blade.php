<x-filament-panels::page>
    <p style="font-size:0.875rem;color:#6b7280;margin-bottom:1rem;">
        Toggle sections on/off to show or hide them on the homepage.
        Click <strong>Edit</strong> to change a section's title, subtitle, or body text.
    </p>

    <div style="border:1px solid #e5e7eb;border-radius:0.75rem;overflow:hidden;">
        @forelse ($this->getSections() as $section)
            <div wire:key="section-{{ $section->id }}"
                 style="display:flex;align-items:center;gap:1rem;padding:0.875rem 1.25rem;background:#fff;border-bottom:1px solid #f3f4f6;">

                {{-- Order --}}
                <span style="font-size:0.75rem;color:#9ca3af;width:1.25rem;flex-shrink:0;font-family:monospace;">
                    {{ $section->order }}
                </span>

                {{-- Section info --}}
                <div style="flex:1;min-width:0;">
                    <p style="font-size:0.875rem;font-weight:600;color:#111827;margin:0;text-transform:capitalize;">
                        {{ str_replace('_', ' ', $section->section_key) }}
                    </p>
                    @if($section->title)
                        <p style="font-size:0.75rem;color:#6b7280;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            {{ $section->title }}
                        </p>
                    @endif
                </div>

                {{-- Status badge --}}
                @if($section->is_active)
                    <span style="display:inline-flex;align-items:center;padding:0.2rem 0.65rem;border-radius:9999px;font-size:0.7rem;font-weight:500;background:#dcfce7;color:#15803d;flex-shrink:0;">
                        Visible
                    </span>
                @else
                    <span style="display:inline-flex;align-items:center;padding:0.2rem 0.65rem;border-radius:9999px;font-size:0.7rem;font-weight:500;background:#f3f4f6;color:#6b7280;flex-shrink:0;">
                        Hidden
                    </span>
                @endif

                {{-- Toggle --}}
                <button wire:click="toggleSection({{ $section->id }})"
                        style="flex-shrink:0;padding:0.35rem 0.85rem;border-radius:0.5rem;font-size:0.75rem;font-weight:500;cursor:pointer;border:1px solid #e5e7eb;background:#f9fafb;color:#374151;">
                    {{ $section->is_active ? 'Hide' : 'Show' }}
                </button>

                {{-- Edit --}}
                <a href="{{ route('filament.admin.resources.page-sections.edit', $section->id) }}"
                   style="flex-shrink:0;padding:0.35rem 0.85rem;border-radius:0.5rem;font-size:0.75rem;font-weight:500;background:#eff6ff;color:#1d4ed8;text-decoration:none;border:1px solid #dbeafe;">
                    Edit
                </a>

            </div>
        @empty
            <div style="padding:2rem;text-align:center;font-size:0.875rem;color:#9ca3af;">
                No sections found.
            </div>
        @endforelse
    </div>
</x-filament-panels::page>
