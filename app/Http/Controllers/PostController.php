<?php
namespace App\Http\Controllers;
use App\test2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
	{
		$res=DB::table('test2s')->whereBetween('id',[1,2])->get();
		return $res;
	}
	public function show()
	{
		$ress=DB::table('test2s')->get();
		return view('post')->with('ress',$ress);
	}
	public function postdetails($id)
	{
		$ress=DB::table('test2s')->where('id','=',$id)->get();
		return view('postdetails')->with('ress',$ress);
	}
	public function add()
	{
		return view('addview');
	}
	public function insertdata(Request $request)
	{
		$teest=new test2;
		$teest->title=$request->input('title');
		$teest->descp=$request->input('desc');
		$teest->save();
		return redirect('/add');
	}
}
