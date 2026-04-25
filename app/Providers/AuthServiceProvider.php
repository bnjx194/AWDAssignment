<?php

namespace App\Providers;

use App\Models\Listing;
use App\Models\Property;
use App\Models\Transaction;
use App\Models\User;
use App\Policies\PropertyPolicy;
use App\Policies\TransactionPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Property::class => PropertyPolicy::class,
        Transaction::class => TransactionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('purchase-listing', function (User $user, Listing $listing) {
            if ($listing->status !== 'active') {
                return Response::deny('This listing is no longer available.');
            }

            if ($user->id === $listing->seller_id) {
                return Response::deny('You cannot purchase your own listing.');
            }

            return Response::allow();
        });
    }
}
