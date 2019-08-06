<?php
namespace FigoliQuinn\SiteUp\Facades;

use Illuminate\Support\Facades\Facade;

class SiteUpChecker extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'siteupchecker';
	}
}
