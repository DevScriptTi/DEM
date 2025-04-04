<?php

namespace App\Providers;

use App\Models\Api\Users\Admin;
use App\Models\Api\Users\Doctor;
use App\Models\Api\Users\DoctorHelper;
use App\Models\Api\Users\Pharmacy;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        Relation::morphMap([
            'admin' => Admin::class,
            'pharmacy' => Pharmacy::class,
            'user' => User::class ,
            'doctor' => Doctor::class,
            'doctor-helper' => DoctorHelper::class
        ]);

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
