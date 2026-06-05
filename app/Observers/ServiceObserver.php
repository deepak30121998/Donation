<?php

namespace App\Observers;

use App\Models\Service;
use Illuminate\Support\Facades\Artisan;

class ServiceObserver
{
    public function saved(Service $service): void
    {
        Artisan::call('view:clear');
    }

    public function deleted(Service $service): void
    {
        Artisan::call('view:clear');
    }
}
