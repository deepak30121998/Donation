<?php

namespace App\ViewModels;

use App\Models\Service;
use Illuminate\Support\Collection;

class ServiceViewModel
{
    public function __construct(
        public readonly Service $service,
        public readonly Collection $allServices,
    ) {}

    public function otherServices(): Collection
    {
        return $this->allServices->where('id', '!=', $this->service->id)->values();
    }

    public function nextService(): ?Service
    {
        $ids = $this->allServices->pluck('id')->toArray();
        $currentIndex = array_search($this->service->id, $ids);

        return $currentIndex !== false && isset($ids[$currentIndex + 1])
            ? $this->allServices->firstWhere('id', $ids[$currentIndex + 1])
            : null;
    }

    public function prevService(): ?Service
    {
        $ids = $this->allServices->pluck('id')->toArray();
        $currentIndex = array_search($this->service->id, $ids);

        return $currentIndex > 0
            ? $this->allServices->firstWhere('id', $ids[$currentIndex - 1])
            : null;
    }

    public function toArray(): array
    {
        return [
            'service'  => $this->service,
            'services' => $this->allServices,
        ];
    }
}
