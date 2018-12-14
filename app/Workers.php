<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @property firstname
 * @property middlename
 * @property lastname
 * @property birthday
 * @property inn
 * @property snils
 * @property organizations_id
 */
class Workers extends Model
{
	const firstname = 'firstname';
	const middlename = 'middlename';
	const lastname = 'lastname';
	const birthday = 'birthday';
	const inn ='inn';
	const snils = 'snils';
	const organizations_id = 'organizations_id';
	
	
	//убрать время обновления
	public $timestamps = false;
	// поля для массового сохранения
	protected $fillable = [ self::firstname,
							self::middlename,
							self::lastname,
							self::birthday,
							self::inn,
							self::snils,
							self::organizations_id
	];
	
	public function organization(){
  
		return $this->belongsTo('App\Organizations','organizations_id','id');
	}
	
}
