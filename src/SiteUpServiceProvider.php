<?php

namespace FigoliQuinn\SiteUp;

use Illuminate\Support\ServiceProvider;
use FigoliQuinn\SiteUp\SiteUpChecker;

class SiteUpServiceProvider extends ServiceProvider
{

	public function boot()
	{
		
	}

	public function register()
	{
		$this->app->singleton('siteupchecker', function() {
			return new SiteUpChecker();
		});
	}

}
