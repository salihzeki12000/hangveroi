<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider {
    public function register()
    {
        config([
            'laravellocalization.supportedLocales' => [
            'vi'  => array( 'name' => 'Vietnamese', 'script' => 'Latn', 'native' => 'Tiếng Việt'),
            'en'  => array( 'name' => 'English', 'script' => 'Latn', 'native' => 'English' ),
            ],

            'laravellocalization.useAcceptLanguageHeader' => true,

            'laravellocalization.hideDefaultLocaleInURL' => true
            ]);
    }

}