<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app['config']['arb.mode'] = Setting::where('key', 'ARB_MODE')->first()->value;
        $this->app['config']['arb.redirect.success'] = Setting::where('key', 'ARB_REDIRECT_SUCCESS')->first()->value;
        $this->app['config']['arb.redirect.fail'] = Setting::where('key', 'ARB_REDIRECT_FAIL')->first()->value;

        $this->app['config']['sms.SMS_API_KEY'] = Setting::where('key', 'SMS_API_KEY')->first()->value;
        $this->app['config']['sms.SMS_USER_SENDER'] = Setting::where('key', 'SMS_USER_SENDER')->first()->value;
        $this->app['config']['sms.SMS_USER_NAME'] = Setting::where('key', 'SMS_USER_NAME')->first()->value;
        $this->app['config']['sms.SMS_SEND_URL'] = Setting::where('key', 'SMS_SEND_URL')->first()->value;


    }
}
