<?php

namespace Webudvikleren\CrudImages\Providers;

use Illuminate\Support\ServiceProvider;

class CrudImagesProvider extends ServiceProvider
{
	/**
	 * Bootstrap services.
	 * 
	 * @return void
	 */
	public function boot()
	{
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
		$this->loadTranslationsFrom(__DIR__ . '/../lang', 'crudimages');
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'crudimages');
		$this->mergeConfigFrom(
			__DIR__.'/../config/crudimages.php', 'crudimages'
		);
	}
}