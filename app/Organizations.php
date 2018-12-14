<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organizations extends Model
{
	const NAME = 'displayName';
	const OGRM = 'ogrn';
	const OKTMO = 'oktmo';
	
	 public function workers(){
	    return $this->hasMany('App\Workers');
	 }
	
	 public $timestamps = false;
	
	 protected $fillable = [self::NAME,
				            self::OGRM,
			                self::OKTMO
	 ];
	
	public function delete()
	{
		$this->workers()->delete();
		return parent::delete();
	}
}
