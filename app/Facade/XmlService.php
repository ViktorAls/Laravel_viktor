<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 14.12.2018
	 * Time: 10:06
	 */
	
	namespace App\Facade;
	
	
	use Illuminate\Support\Facades\Facade;
	
	class XmlService extends Facade
	{
		protected static function getFacadeAccessor()
		{
			return 'XmlLoading';
		}
	}