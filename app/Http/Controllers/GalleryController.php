<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\GalleryRepositoryInterface;
use App\Models\GalleryCategory;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __construct(
        protected GalleryRepositoryInterface $galleryRepo,
    ) {}

    public function index(): View
    {
        return view('gallery.index', [
            'items'      => $this->galleryRepo->activeOrdered(),
            'categories' => GalleryCategory::active()->ordered()->get(),
        ]);
    }
}
