<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            // My Routes

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/theme.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/frontend.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/addon.php'));

            if (paytmRoute()) {
                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/paytm.php'));
            }

            if (quizRoute()) {
                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/quiz.php'));
            }

            if (zoomRoute()) {
                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/zoom.php'));
            }

            if (forumRoute()) {
                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/forum.php'));
            }

            if (certificate()) {
                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/certificate.php'));
            }

            if (subscriptionRoute()) {
                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/subscription.php'));
            }

            if (couponRoute()) {
                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/coupon.php'));
            }

            if (walletRoute()) {
                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/wallet.php'));
            }
            if (gamesRoute()) {
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group(base_path('routes/games.php'));
            }
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
