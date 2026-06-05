<?php

namespace App\Providers;

use App\Contracts\Repositories\CauseRepositoryInterface;
use App\Contracts\Repositories\DonationRepositoryInterface;
use App\Contracts\Repositories\FaqRepositoryInterface;
use App\Contracts\Repositories\GalleryRepositoryInterface;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Repositories\ProgramRepositoryInterface;
use App\Contracts\Repositories\ServiceRepositoryInterface;
use App\Contracts\Repositories\TeamMemberRepositoryInterface;
use App\Contracts\Repositories\TestimonialRepositoryInterface;
use App\Contracts\Services\ContactServiceInterface;
use App\Contracts\Services\DonationServiceInterface;
use App\Repositories\EloquentCauseRepository;
use App\Repositories\EloquentDonationRepository;
use App\Repositories\EloquentFaqRepository;
use App\Repositories\EloquentGalleryRepository;
use App\Repositories\EloquentPostRepository;
use App\Repositories\EloquentProgramRepository;
use App\Repositories\EloquentServiceRepository;
use App\Repositories\EloquentTeamMemberRepository;
use App\Repositories\EloquentTestimonialRepository;
use App\Services\ContactService;
use App\Services\DonationService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repository bindings
        $this->app->bind(PostRepositoryInterface::class, EloquentPostRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, EloquentServiceRepository::class);
        $this->app->bind(ProgramRepositoryInterface::class, EloquentProgramRepository::class);
        $this->app->bind(CauseRepositoryInterface::class, EloquentCauseRepository::class);
        $this->app->bind(TeamMemberRepositoryInterface::class, EloquentTeamMemberRepository::class);
        $this->app->bind(TestimonialRepositoryInterface::class, EloquentTestimonialRepository::class);
        $this->app->bind(GalleryRepositoryInterface::class, EloquentGalleryRepository::class);
        $this->app->bind(FaqRepositoryInterface::class, EloquentFaqRepository::class);
        $this->app->bind(DonationRepositoryInterface::class, EloquentDonationRepository::class);

        // Service bindings
        $this->app->bind(DonationServiceInterface::class, DonationService::class);
        $this->app->bind(ContactServiceInterface::class, ContactService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
