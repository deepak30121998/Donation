<?php

namespace App\Contracts\Services;

use App\DTOs\ContactData;
use App\Models\ContactSubmission;

interface ContactServiceInterface
{
    public function store(ContactData $data): ContactSubmission;
}
