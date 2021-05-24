<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Session;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
Use Redirect;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function post($id){
        header('content-type:text/html; charset=utf-8');
        $getPost = DB::table('posts')
                ->join('customer','customer.id_user','posts.id_user')
                ->where([['posts.id_post',$id],['posts.status','<>',0]])
                ->get();
        $getAns = DB::select('SELECT a.id_ans, a.date_time_ans, a.message, c.firstname, c.lastname, a.id_user,
            (SELECT COUNT(ca.con_status_ans) FROM confirm_ans AS ca WHERE a.id_ans = ca.id_ans ) AS firm,
            (SELECT COUNT(v.score) FROM vote_ans AS v WHERE v.score = 1 AND a.id_ans = v.id_ans) AS v_like,
            (SELECT COUNT(v.score) FROM vote_ans AS v WHERE v.score = -1 AND a.id_ans = v.id_ans) AS v_dislike
            FROM answers AS a, customer AS c
            WHERE a.id_post = ? AND a.id_user = c.id_user AND a.status <> 0',[$id]);
        $getCom = DB:: select('SELECT cm.id_ans,cm.message, c.firstname, c.lastname, c.id_user 
            FROM comments AS cm, customer AS c 
            WHERE cm.id_user = c.id_user');
        if(Session::get('id_user') != null){
            $check_is_con = DB:: select('SELECT a.id_ans FROM answers AS a, confirm_ans AS cm 
                WHERE a.id_post = ? AND cm.id_user = ? AND a.id_ans = cm.id_ans',[$id,Session::get('id_user')]);
            $check_like = DB:: select('SELECT a.id_ans, vm.score FROM answers AS a, vote_ans AS vm 
                WHERE a.id_post = ? AND vm.id_user = ? AND a.id_ans = vm.id_ans ',[$id,Session::get('id_user')]);
            $check_report = DB::table('reports')->where([['id_post',$id],['id_user',Session::get('id_user')]])->exists();
        }else{
            $check_is_con = DB:: select('SELECT a.id_ans FROM answers AS a, confirm_ans AS cm 
                WHERE a.id_post = ? AND cm.id_user = ? AND a.id_ans = cm.id_ans',[$id,0]);
            $check_like = DB:: select('SELECT a.id_ans, vm.score FROM answers AS a, vote_ans AS vm 
                WHERE a.id_post = ? AND vm.id_user = ? AND a.id_ans = vm.id_ans ',[$id,0]);
            $check_report = DB::table('reports')->where([['id_post',$id],['id_user',0]])->exists();
        }
        
        return view('view_post',['getPost' => $getPost,'getAns' => $getAns, 'getCom' => $getCom, 'check_is_con'=>$check_is_con, 'check_like'=>$check_like, 'check_report'=>$check_report]);
    }
    //delete post by id
    public function delete_post($id){
        $post_del = DB::update('update posts set status = 0 where id_post = ?', [$id]);
        return redirect()->route('home');
    }
    //insert answers
    public function insert_ans(Request $request){
        $detail=$request->summernote;//รับค่าจาก messageInput
        $dom = new \domdocument();
        $dom->loadHtml('<?xml encoding="UTF-8">'.$detail);
        //ดึงเอาส่วนที่เป็นรูปภาพมาจาก summernote
        $images = $dom->getelementsbytagname('img');
        //ลูปรูปภาพและทำการเข้ารหัสรูปภาพ
        foreach($images as $k => $img){
        $data = $img->getattribute('src');
        list($type, $data) = explode(';', $data);
        list(, $data)= explode(',', $data);
        $data = base64_decode($data);
        //ตั้งชื่อรูปภาพใหม่โดยอ้างอิงจากเวลา
        $image_name= time().$k.'.png';
        //อัพโหลดภาพไปยัง public
        $path = public_path() .'../images/'. $image_name;
        //ทำการอัพโหลดภาพ
        file_put_contents($path, $data);
        $img->removeattribute('src');
        $img->setattribute('src',"../images/". $image_name);
        }
        $detail = $dom->savehtml();
        $value = $request->session()->get('id_user');
        $time_now = Carbon::now()->timezone('GMT+7');
        $insert_ans = DB::insert('insert into answers(date_time_ans,id_post,id_user,status,message) values (?,?,?,?,?)',
                      [$time_now->toDateTimeString(), $request->id_post, $value, 1, $detail]);
        return back()->withInput();
    }
    //delete answers
    public function delete_ans($id){
        $ans_del = DB::update('update answers set status = 0 where id_ans = ?', [$id]);
        return back()->withInput();
    }
    //Form edit answers
    public function form_edit_ans($id){
        $value = Session::get('id_user');
        // วิธีselect ข้อมูล เขียนแบบนี้ ตรงเครื่องหมาย ? ก็คล้ายๆกับ %d หรือ%s ใน C ที่มันจะเป็นเหมือนตัวไว้รับต่าจากตัวแปล
        $show_ans = DB::select('select message, id_ans, id_post 
                                from answers 
                                where id_ans = ? AND id_user = ?',[$id,$value]);//อันนี้คือค่าที่จะใส่ใน ? 
        return view('form_edit_ans',['show_ans_view'=>$show_ans]); // วิธีเอาออกใน view กะเขียนแบบนี้
    }
    //edit answers
    public function edit_ans(Request $request){
        $detail=$request->summernote;//รับค่าจาก messageInput
        $dom = new \domdocument();
        $dom->loadHtml('<?xml encoding="UTF-8">'.$detail);
        //ดึงเอาส่วนที่เป็นรูปภาพมาจาก summernote
        $images = $dom->getelementsbytagname('img');
        //ลูปรูปภาพและทำการเข้ารหัสรูปภาพ
        foreach($images as $k => $img){
            $data = $img->getattribute('src');
            if (preg_match('/data:images/', $data)) {
                list($type, $data) = explode(';', $data);
                list(, $data)= explode(',', $data);
                $data = base64_decode($data);
                //ตั้งชื่อรูปภาพใหม่โดยอ้างอิงจากเวลา
                $image_name= time().$k.'.png';
                //อัพโหลดภาพไปยัง public
                $path = public_path() .'../images/'. $image_name;
                //ทำการอัพโหลดภาพ
                file_put_contents($path, $data);
                $img->removeattribute('src');
                $img->setattribute('src',"../images/". $image_name);
            }
        }
        $detail = $dom->savehtml();
        $time_now = Carbon::now()->timezone('GMT+7');
        $update_ans = DB::update('update answers set message = ?, date_time_ans = ? where id_ans = ?',[$detail,$time_now,$request->id_ans]);
        return Redirect::action('Controller@post', $request->id_post);
        
    }
    //confirm ans
    public function confirm_ans($id){
        $value = Session::get('id_user');
        $confirm_ans = DB::insert('insert into confirm_ans(con_status_ans,id_ans,id_user) values (?,?,?)', [1,$id,$value]);
        return back()->withInput();
    }
    //dislike ans
    public function dislike_ans($id){
        $value = Session::get('id_user');
        $dislike_ans = DB::insert('insert into vote_ans(score,id_ans,id_user) values (?,?,?)', [-1,$id,$value]);
        return back()->withInput();
    }
    //like ans
    public function like_ans($id){
        $value = Session::get('id_user');
        $like_ans = DB::insert('insert into vote_ans(score,id_ans,id_user) values (?,?,?)', [1,$id,$value]);
        return back()->withInput();
    }
    //comment
    public function comments(Request $request){
        $value = Session::get('id_user');
        $com = DB::insert('insert into comments(id_ans,id_user,message) values(?,?,?)',[$request->id_ans,$value,$request->com]);
        return back()->withInput();
    }
    //report post
    public function report_post($id){
        $value = Session::get('id_user');
        $report = DB::insert('insert into reports(id_post,id_user,report_point) values(?,?,?)', [$id,$value,1]);
        return back()->withInput();
    }
    // update like ans
    public function update_like_ans($id){
        $value = Session::get('id_user');
        $like_ans = DB::update('update vote_ans set score =? where id_ans = ? AND id_user =?', [1,$id,$value]);
        return back()->withInput();
    }
    //update_dislike_ans
    public function update_dislike_ans($id){
        $value = Session::get('id_user');
        $like_ans = DB::update('update vote_ans set score =? where id_ans = ? AND id_user =?', [-1,$id,$value]);
        return back()->withInput();
    }

    //----------------------------------------------------------------------------
    //view Article
    public function article($id){
        $getArticle = DB::select('SELECT p.*, c.firstname, c.lastname,
            (SELECT COUNT(cp.con_status_post) FROM confirm_post AS cp WHERE p.id_post = cp.id_post ) AS firm,
            (SELECT COUNT(v.score) FROM vote_post AS v WHERE v.score = 1 AND p.id_post = v.id_post) AS v_like,
            (SELECT COUNT(v.score) FROM vote_post AS v WHERE v.score = -1 AND p.id_post = v.id_post) AS v_dislike
            FROM posts AS p, customer AS c
            WHERE p.id_post = ? AND p.id_user = c.id_user AND p.status <> 0',[$id]);
        if(Session::get('id_user') != null){
            $check_con_article = DB::table('confirm_post')->where([['id_post',$id],['id_user',Session::get('id_user')]])->exists();
            $check_like_article = DB:: select('SELECT vm.score FROM posts AS p, vote_post AS vm 
                WHERE p.id_post = ? AND vm.id_user = ? AND p.id_post = vm.id_post ',[$id,Session::get('id_user')]);
            $check_report = DB::table('reports')->where([['id_post',$id],['id_user',Session::get('id_user')]])->exists();
        }else{
            $check_con_article = DB::table('confirm_post')->where([['id_post',$id],['id_user',0]])->exists();
            $check_like_article = DB:: select('SELECT vm.score FROM posts AS p, vote_post AS vm 
                WHERE p.id_post = ? AND vm.id_user = ? AND p.id_post = vm.id_post ',[$id,0]);
            $check_report = DB::table('reports')->where([['id_post',$id],['id_user',0]])->exists();
        }
        return view('view_article',['getArticle'=>$getArticle, 'check_con_article'=>$check_con_article,'check_like_article'=>$check_like_article,'check_report'=>$check_report]);
    }
    //delete article by id
    public function delete_article($id){
        $post_del = DB::update('update posts set status = 0 where id_post = ?', [$id]);
        return redirect()->route('home');
    }
    //confirm article
    public function confirm_article($id){
        $value = Session::get('id_user');
        $confirm_article = DB::insert('insert into confirm_post(con_status_post,id_post,id_user) values (?,?,?)', [1,$id,$value]);
        return back()->withInput();
    }
    //dislike article
    public function dislike_article($id){
        $value = Session::get('id_user');
        $dislike_ans = DB::insert('insert into vote_post(score,id_post,id_user) values (?,?,?)', [-1,$id,$value]);
        return back()->withInput();
    }
    //like article
    public function like_article($id){
        $value = Session::get('id_user');
        $like_ans = DB::insert('insert into vote_post(score,id_post,id_user) values (?,?,?)', [1,$id,$value]);
        return back()->withInput();
    }
    //update dislike article
    public function update_dislike_article($id){
        $value = Session::get('id_user');
        $like_ans = DB::update('update vote_post set score =? where id_post = ? AND id_user =?', [-1,$id,$value]);
        return back()->withInput();
    }
    //update dislike article
    public function update_like_article($id){
        $value = Session::get('id_user');
        $like_ans = DB::update('update vote_post set score =? where id_post = ? AND id_user =?', [1,$id,$value]);
        return back()->withInput();
    }
}
