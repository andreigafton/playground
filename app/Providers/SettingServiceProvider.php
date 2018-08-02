<?php

namespace App\Providers;

use App\Setting;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!\App::runningInConsole() && count(\Schema::getColumnListing('settings'))) {
            // get all settings from the database
            $settings = Setting::all();

            // bind all settings to the Laravel config, so you can call them like
            // Config::get('settings.contact_email')
            foreach ($settings as $key => $setting) {
                \Config::set('settings.'.$setting->slug, $setting->value);
            }
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
