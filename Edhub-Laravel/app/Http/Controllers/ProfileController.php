<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\Request;
use DB;
use Session;
class ProfileController extends Controller
{
    public function login_check(Request $request)
    {
        $Email = $request->u;		 
        $Password = $request->p;	
        
        $user = DB::select("select * from customer where email= ? and password= ? ",[$Email,$Password]);
        $admin = DB::select("select * from admins where email= ? and password= ? ",[$Email,$Password]);
        //$check = DB::select("select * from customer where email= ? and password= ? ",[$Email,$Password])->exists();
        if (empty($user) && empty($admin)){
            return redirect()->back()->with('alert', '<script type=\'text/javascript\'>alert(\'Email or Password invalid\');</script>');
        }elseif(!empty($admin)){
            foreach($admin as $row){		
                Session::put('id_admin', $row->id_admin);
                Session::put('email_admin', $row->email);
                return redirect()->action(
                    'AdminModelController@admin1'
                ); 
            }
        }
        elseif(!empty($user)){
            foreach($user as $row){		      
               if ($row->status==1){
                    Session::put('id_user', $row->id_user);
                    Session::put('user_type', $row->type);
                    Session::put('email', $row->email);
                   return back()->withInput();
               }
               elseif($row->status==3 || $row->status==0) {
                    return redirect()->back()->with('alert', '<script type=\'text/javascript\'>alert(\'ไม่สามารถเข้าสู่ระบบได้เนื่อง จากโดนระงับการใช้งาน หรือ กำลังตรวจสอบข้อมูล\');</script>');
               }
               
           }
           
        }
    }

    public function logout()
	 {
        Session::flush();
        return redirect()->action(
            'PostsController@home'
        );
	}

    public function index(){
        //$id = session()->get('id_user');

        $id = Session::get('id_user');
        $post = "กระทู้";
        $article = "บทความ";
        $profile = DB::select('SELECT * FROM customer WHERE id_user = ?',[$id]);

        $get_type_articles = DB::select('SELECT p.id_post, p.title, p.date_time_post, p.category, p.id_user, c.firstname, c.lastname,
        (SELECT COUNT(vp.score) FROM vote_post as vp
        WHERE vp.id_post = p.id_post AND vp.score = 1) as score, p.status, p.type
        FROM posts AS p INNER JOIN customer AS c ON p.id_user = c.id_user
        WHERE p.id_user = ? AND p.type = ? ORDER BY p.id_post DESC', [$id,$article]);

        $get_type_posts = DB::select('SELECT p.id_post, p.title, p.date_time_post, p.category, p.id_user, c.firstname, c.lastname,
        (SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = p.id_post AND a.status = 1) as ansCount,
        p.status, p.type
                FROM posts AS p INNER JOIN  customer AS c
                ON p.id_user = c.id_user
                WHERE p.id_user = ? AND p.type = ?
                ORDER BY p.id_post DESC', [$id,$post]);

        return view('profile',['info'=>$profile,'get_type_posts'=>$get_type_posts,'get_type_articles'=>$get_type_articles]);
    }

    public function profile($id){

        $post = "กระทู้";
        $article = "บทความ";
        $profiles = DB::select('SELECT * FROM customer WHERE id_user = ?',[$id]);
       
        $get_type_articles = DB::select('SELECT p.id_post, p.title, p.date_time_post, p.category, p.id_user, c.firstname, c.lastname,
        (SELECT COUNT(vp.score) FROM vote_post as vp
        WHERE vp.id_post = p.id_post AND vp.score = 1) as score, p.status, p.type
        FROM posts AS p INNER JOIN customer AS c ON p.id_user = c.id_user
        WHERE p.id_user = ? AND p.type = ? ORDER BY p.id_post DESC', [$id,$article]);

        $get_type_posts = DB::select('SELECT p.id_post, p.title, p.date_time_post, p.category, p.id_user, c.firstname, c.lastname,
        (SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = p.id_post) as ansCount,
        p.status, p.type
                FROM posts AS p INNER JOIN  customer AS c
                ON p.id_user = c.id_user
                WHERE p.id_user = ? AND p.type = ?
                ORDER BY p.id_post DESC', [$id,$post]);
        return view('profile',['info'=>$profiles, 'get_type_posts'=>$get_type_posts, 'get_type_articles'=>$get_type_articles]);
    }

    public function editProfile($id){
        $user = DB::select('SELECT * FROM customer WHERE id_user = ?',[$id]);
        return view('edit_profile',['info'=>$user]);
    }

    public function update(Request $req){
        $error = "hello";
        if ($req->hasFile('fileImg') != null) {
            $this->validate($req, [
                'fileImg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image = $req->file('fileImg');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $name);
        }else{
            $name = $req->phodo;
        }
            $id = Session::get('id_user');
            $fname = $req->firstname;
            $lname  = $req->lastname;
            $email = $req->email;
            $pwd = $req->password;
            $tel = $req->tel;
            $jobs = $req->job;
            $fl = $name;
            $bio = $req->bio;
            $web = $req->web;
            DB::update('update customer set firstname = ?,
            lastname  = ?,
            email = ?,
            password = ?,
            tel = ?,
            jobs = ?,
            img = ?,
            bio = ?,
            website = ?  WHERE id_user = ? ',[$fname,$lname,$email,$pwd,$tel,$jobs,$fl,$bio,$web ,$id]);


            return redirect()->action('ProfileController@index');
    }


}
