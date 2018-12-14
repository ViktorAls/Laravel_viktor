<?php

namespace App\Http\Controllers;

use App\Organizations;
use App\Workers;
use Illuminate\Http\Request;
use App\Facade\XmlService;

class CompanyController extends Controller
{
	
	public function xmlLoading(Request $request){
		if($request->isMethod('post')){
			if($request->hasFile('file')) {
				$answer = XmlService::treatmentFile($request);
				return redirect('/')->with($answer['type'],$answer['message']);
			}
		}
	}
	
	// все организации
	public function index(Request $request)
	{
		$all = Organizations::with('workers')->paginate(10);
		return view('company.all',compact('all'));
	}
	
	//просмотр одной организация
	public function oneOrganization($id)
	{
		$one_organization = Organizations::with('workers')->where('id', '=', $id)->whereNotNull('id')->firstOrFail();
		return view('company.one',compact('one_organization'));
	}
	
	//удаление организации
	public function delete( Request $request, $id){
		if ($request->isMethod('post')){
			try {
				if($organization = \App\Organizations::find($id)){
					$organization->delete();
					return redirect('/')->with('success', 'Организация удалена.');
				} else 	abort(404);
			} catch (Exception $e){
				abort(404,$e->getMessage());
			}
		} else {
			 abort('404');
		}
	}
	
}
