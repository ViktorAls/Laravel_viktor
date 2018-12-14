<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 14.12.2018
	 * Time: 0:57
	 */
	
	namespace App\Service;
	
	
	use App\Organizations;
	use App\Workers;
	use Illuminate\Http\Request;
	
	class xmlLoading
	{
		const SUCCESS ='success';
		const ERROR ='error';
		
		private function saveUserBD($workerData,$idOrganization){
			$worker = new Workers();
			$worker->fill([
				Workers::firstname => $workerData[Workers::firstname ],
				Workers::middlename => $workerData[Workers::middlename],
				Workers::lastname => $workerData[Workers::lastname],
				Workers::inn => (int)$workerData[Workers::inn],
				Workers::snils => (int)$workerData[Workers::snils],
				Workers::organizations_id => $idOrganization,
			]);
			$worker->save();
		}
		
		private function saveOrganizationBD($organizationData){
			$org = new Organizations();
			$org->fill([
				Organizations::NAME => $organizationData[Organizations::NAME],
				Organizations::OGRM => $organizationData[Organizations::OGRM],
				Organizations::OKTMO => $organizationData[Organizations::OKTMO]
			]);
			$org->save();
		}
		
		//проверка через бд (запросами)
		private function xmlDB($xml)
		{
			$answer = 'Работники: ';
			$error = 0;
			foreach ($xml->org as $value) {
				if (!Organizations::where(Organizations::OGRM, '=', $value[Organizations::OGRM])
											->orWhere(Organizations::OKTMO, '=', $value[Organizations::OKTMO])
											->first()) {
					$this->saveOrganizationBD($value);
				}
				$organization = Organizations::where(Organizations::OGRM, '=', $value[Organizations::OGRM])->first();
				foreach ($value->user as $oneUser) {
					if (!Workers::where(Workers::inn, '=', $oneUser[Workers::inn])
										->orWhere(Workers::snils, '=', $oneUser[Workers::snils])
										->first()) {
						$this->saveUserBD($oneUser,$organization['id']);
					} else {
						++$error;
						$answer .= ' ' . $oneUser[Workers::lastname].
							       ' ' . $oneUser[Workers::firstname].
							       ' ' . $oneUser[Workers::middlename].',';
					}
				}
			}
			return ['error' => $error, 'message' => $answer . 'уже работают.'];
		}
		
		//проверка используя массив
		private function xmlArray($xml){
			$answer='Работники: ';
			$error = 0;
			$organizations = Organizations::all()->toArray();
			$users = Workers::all()->toArray();
			$ogrn_oktm = array_column($organizations, Organizations::OKTMO,Organizations::OGRM);
			$snils_inn = array_column($users, Workers::inn,Workers::snils);
			foreach ($xml->org as $organization){
				$ogrn = (string)$organization[Organizations::OGRM];
				$oktmo = (string)$organization[Organizations::OKTMO];
				if (!array_key_exists( $ogrn,$ogrn_oktm) && !array_search($oktmo,$ogrn_oktm)){
					$this->saveOrganizationBD($organization);
					$ogrn_oktm +=[(string)$organization[Organizations::OGRM] =>(string)$organization[Organizations::OKTMO]];
				}
				
				$organization = Organizations::where(Organizations::OGRM, '=', $organization[Organizations::OGRM])->first();
				
				foreach ($organization->user as $oneUser){
					$snils = (string)$oneUser[Workers::snils];
					$inn = (string)$oneUser[Workers::inn];
					if (!array_key_exists($snils,$snils_inn) && !array_search($inn,$snils_inn)){
						$this->saveUserBD($oneUser,$organization['id']);
						$snils_inn += [(string)$oneUser[Workers::snils] =>(string)$oneUser[Workers::inn]];
					} else {
						++$error;
						$answer .= ' '.$oneUser[Workers::lastname].' '.$oneUser[Workers::firstname].' '.$oneUser[Workers::middlename].',';
					}
				}
			}
			return ['error'=>$error,'message'=>$answer.'уже работают.'];
		}
		
		// Обработка файла
		public function treatmentFile (Request $request){
			$file = $request->file('file');
			if ($file->getClientOriginalExtension() == 'xml') {
				$dir = public_path() . '/xml/';
				$name = uniqid('xml_').'.'.$file->getClientOriginalExtension();
				$file->move($dir,$name);
				$xml = simplexml_load_file($dir.$name);
				if(!isset($xml->org[0])) {
					$result = ['type'=>self::ERROR,'message'=>'Не найдены данные для заполнения. Выбирите другой файл'];
				} else {
					if ($request->input('option')=='db'){
						$answer = $this->xmlDB($xml);
					} else {
						$answer = $this->xmlArray($xml);
					}
					if( $answer['error'] > 0){
						$result =['type'=>self::SUCCESS, 'message'=>$answer['message']];
					} else {
						$result = ['type'=>self::SUCCESS,'message'=>'Все прошло успешно'];
					}
				}
				return $result;
			}else {
				return $result = ['type'=>self::ERROR,'message'=>'Не верное расширение файла.'];
			}
		}
		
	}