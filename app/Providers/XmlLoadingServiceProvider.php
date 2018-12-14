<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 14.12.2018
	 * Time: 9:59
	 */
	
	namespace App\Providers;
	
	
	use Illuminate\Support\ServiceProvider;
	
	class XmlLoadingServiceProvider extends ServiceProvider
	{
		public function register()
		{
			$this->app->bind('XmlLoading','App\Service\xmlLoading');
		}
	}