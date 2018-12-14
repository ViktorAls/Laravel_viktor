<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 07.12.2018
	 * Time: 0:37
	 */
	
	namespace App\Http\Controllers;
	
	
	use App\Workers;
	use Illuminate\Http\Request;
	
	class WorkerController extends Controller
	{
		const SUCCESS ='success';
		// сохранить рабочего
		public function save(Request $request){
			$this->validate($request,['firstname'=>'required','middlename'=>'required','inn'=>'required|unique:workers','lastname'=>'required','snils'=>'required|unique:workers','birthday'=>'required|date']);
			$worker = new Workers();
			$worker->fill([
				Workers::firstname => $request->input('firstname'),
				Workers::middlename => $request->input('middlename'),
				Workers::lastname => $request->input('lastname'),
				Workers::inn => (int)$request->input('inn'),
				Workers::snils => (int)$request->input('snils'),
				Workers::birthday => $request->input('birthday'),
				Workers::organizations_id => (int) $request->input('id'),
			]);
			
			$worker->save();
			return redirect('/organization/'.$request->input('id'))->with(self::SUCCESS,'Работник успешно сохранён.');
		}
		// удалить рабочего
		public function delete (Request $request,$id,$organization){
			if ($request->isMethod('post')){
				\App\Workers::destroy([$id]);
				return redirect('/organization/'.$organization)->with(self::SUCCESS,'Работник успешно удалён.');
			}else {
				abort('404');
			}
		}
		
		// просмотреть рабочего
		public function worker($id){
			$one_user = Workers::where('id','=',$id)->firstOrFail();
			return view('working.info',compact('oneUser'));
		}
	}