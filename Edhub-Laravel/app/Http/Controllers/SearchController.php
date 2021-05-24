<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class SearchController extends Controller
{
    public function index(){

        return view('index');
    }

    public function searchName(Request $req)
    {
        $search = $req->get('term');

        $result = DB::table('customer')
        ->where('firstname','LIKE','%'.$search.'%')
        ->orWhere('lastname','LIKE','%'.$search.'%')
        ->get();

        return response()->json($result);
    }

    public function searchTitle(Request $req)
    {
        $search = $req->get('term');

        $res = DB::table('posts')
        ->where('title','LIKE','%'.$search.'%')->get();

        return response()->json($res);

        // return response()->json(['fullName'=>$result,'title'=>$res2]);
    }

    public function search_result(Request $req){
        $type = $req->list_result;
        $search = $req->search;
        $keyword = '%'.$search.'%';
        
        if($type=='name'){
            $name = explode(" ",$search);
            if(count($name) >=2){
                $select_name =  DB::select('SELECT * from customer where firstname LIKE ? AND lastname LIKE ?',[$name[0],$name[1]]);
            }else{
                $select_name =  DB::select('SELECT * from customer where firstname LIKE ? OR lastname LIKE ?',[$name[0],$name[0]]);
            }
            
        }else{
            $select_name =  DB::select('SELECT * from customer where firstname LIKE ? OR lastname LIKE ?',[$keyword,$keyword]);
        }
    
        $select_title = DB::select('SELECT p.id_post, p.title, p.date_time_post, p.category, p.id_user, c.firstname, c.lastname,
        (SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = p.id_post AND a.status = 1) as ansCount,
        (SELECT COUNT(vp.score) FROM vote_post as vp WHERE vp.id_post = p.id_post AND vp.score = 1) as score, p.status, p.type
            FROM posts AS p INNER JOIN customer AS c ON p.id_user = c.id_user
            WHERE p.title LIKE ? ORDER BY p.id_post DESC',[$keyword]);
        

        Session::put('sname',$select_name);
        Session::put('stitle', $select_title);
        return view('searchResult',['select_name'=>$select_name,'select_title'=>$select_title]);
    }
}