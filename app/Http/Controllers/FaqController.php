<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $categories = FaqCategory::with([
            'faqs' => fn ($q) => $q->where('is_active', true)->orderBy('order'),
        ])->orderBy('order')->get();

        return view('faqs.index', [
            'categories' => $categories,
        ]);
    }
}
