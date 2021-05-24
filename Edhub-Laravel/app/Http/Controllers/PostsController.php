<?php
namespace App\Http\Controllers;
//use Illuminate\Support\Facades\DB;
use App\posts;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use DB;
use Illuminate\Routing\Redirecto;
class PostsController extends Controller {
    public function home(){
        $QApost = DB::table('posts')
            ->join('customer','posts.id_user','customer.id_user')    
            ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post AND a.status = 1) as ansCount'), 'posts.status', 'posts.type')
            ->groupBy('posts.id_post')
            ->having('posts.status','=',1)
            ->having('posts.type','=','กระทู้')
            ->orderBy('ansCount','desc')
            ->take(3)
            ->get();

        $Blogpost = DB::table('posts')
            ->join('customer','posts.id_user','customer.id_user')       
            ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
            ->groupBy('posts.id_post')
            ->having('posts.status','=',1)
            ->having('posts.type','=','บทความ')
            ->orderBy('score','desc')
            ->take(3)
            ->get();

        $customer = DB::select('SELECT c.id_user, c.firstname, c.lastname, c.bio, c.img, SUM(c.score) as totalScore FROM (SELECT customer.*, SUM(score) AS score FROM posts INNER JOIN customer ON posts.id_user = customer.id_user INNER JOIN vote_post ON vote_post.id_post = posts.id_post GROUP BY posts.id_post) c GROUP BY c.id_user LIMIT 3');

        /*$popularCategory = DB::table('posts')
            ->select('category',DB::raw('COUNT(category) as count'))
            ->groupBy('category')
            ->orderBy('count','desc')
            ->take(3)
            ->get();*/

        $popularCategory = DB::select('SELECT category, COUNT(category) as count FROM (SELECT * FROM posts WHERE type = \'กระทู้\') p GROUP BY category ORDER BY count DESC' );

        return view('home')
            ->with('showQA', $QApost)
            ->with('showBlog', $Blogpost)
            ->with('popularPerson', $customer)
            ->with('popularCategory', $popularCategory);
    }

    public function math(){
        $QApost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')    
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post AND a.status = 1) as ansCount'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','กระทู้')
        ->having('posts.category','=','Mathematics')
        ->orderBy('ansCount','desc')
        ->take(3)
        ->get();

    $Blogpost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')       
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','บทความ')
        ->having('posts.category','=','Mathematics')
        ->orderBy('score','desc')
        ->take(3)
        ->get();
        return view('math')
            ->with('showQA', $QApost)
            ->with('showBlog', $Blogpost);
    }

    public function science(){
        $QApost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')    
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post AND a.status = 1) as ansCount'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','กระทู้')
        ->having('posts.category','=','Science')
        ->orderBy('ansCount','desc')
        ->take(3)
        ->get();

    $Blogpost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')       
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','บทความ')
        ->having('posts.category','=','Science')
        ->orderBy('score','desc')
        ->take(3)
        ->get();

        return view('science')
            ->with('showQA', $QApost)
            ->with('showBlog', $Blogpost);
    }

    public function social(){
        $QApost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')    
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post AND a.status = 1) as ansCount'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','กระทู้')
        ->having('posts.category','=','Social')
        ->orderBy('ansCount','desc')
        ->take(3)
        ->get();

    $Blogpost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')       
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','บทความ')
        ->having('posts.category','=','Social')
        ->orderBy('score','desc')
        ->take(3)
        ->get();

        return view('social')
            ->with('showQA', $QApost)
            ->with('showBlog', $Blogpost);
    }

    public function language(){
        $QApost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')    
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post AND a.status = 1) as ansCount'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','กระทู้')
        ->having('posts.category','=','Language')
        ->orderBy('ansCount','desc')
        ->take(3)
        ->get();

    $Blogpost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')       
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','บทความ')
        ->having('posts.category','=','Language')
        ->orderBy('score','desc')
        ->take(3)
        ->get();

        return view('language')
            ->with('showQA', $QApost)
            ->with('showBlog', $Blogpost);
    }

    public function arts(){
        $QApost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')    
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post AND a.status = 1) as ansCount'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','กระทู้')
        ->having('posts.category','=','Arts')
        ->orderBy('ansCount','desc')
        ->take(3)
        ->get();

    $Blogpost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')       
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','บทความ')
        ->having('posts.category','=','Arts')
        ->orderBy('score','desc')
        ->take(3)
        ->get();

        return view('arts')
            ->with('showQA', $QApost)
            ->with('showBlog', $Blogpost);
    }


    //All Post Method
    public function homeAllPost(){
        $showAllPost = DB::table('posts')
            ->join('customer','posts.id_user','customer.id_user')     
            ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post AND a.status = 1) as ansCount'), 'posts.status', 'posts.type')
            ->groupBy('posts.id_post')
            ->having('posts.status','=',1)
            ->having('posts.type','=','กระทู้')
            ->orderBy('posts.id_post','desc')
            ->get();
        return view('homeAllPost')
            ->with('showAllPost', $showAllPost);
    }
    public function mathAllPost(){
        $showAllPost = DB::table('posts')
            ->join('customer','posts.id_user','customer.id_user')     
            ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post AND a.status = 1) as ansCount'), 'posts.status', 'posts.type')
            ->groupBy('posts.id_post')
            ->having('posts.status','=',1)
            ->having('posts.type','=','กระทู้')
            ->having('posts.category','=','Mathematics')
            ->orderBy('posts.id_post','desc')
            ->get();
        return view('mathAllPost')
            ->with('showAllPost', $showAllPost);
    }

    public function scienceAllPost(){
        $showAllPost = DB::table('posts')
            ->join('customer','posts.id_user','customer.id_user')     
            ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post AND a.status = 1) as ansCount'), 'posts.status', 'posts.type')
            ->groupBy('posts.id_post')
            ->having('posts.status','=',1)
            ->having('posts.type','=','กระทู้')
            ->having('posts.category','=','Science')
            ->orderBy('posts.id_post','desc')
            ->get();
        return view('scienceAllPost')
            ->with('showAllPost', $showAllPost);
    }

    public function socialAllPost(){
        $showAllPost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')     
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post AND a.status = 1) as ansCount'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','กระทู้')
        ->having('posts.category','=','Social')
        ->orderBy('posts.id_post','desc')
        ->get();
        return view('socialAllPost')
            ->with('showAllPost', $showAllPost);
    }

    public function languageAllPost(){
        $showAllPost = DB::table('posts')
            ->join('customer','posts.id_user','customer.id_user')     
            ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post AND a.status = 1) as ansCount'), 'posts.status', 'posts.type')
            ->groupBy('posts.id_post')
            ->having('posts.status','=',1)
            ->having('posts.type','=','กระทู้')
            ->having('posts.category','=','Language')
            ->orderBy('posts.id_post','desc')
            ->get();
        return view('languageAllPost')
            ->with('showAllPost', $showAllPost);
    }

    public function artsAllPost(){
        $showAllPost = DB::table('posts')
            ->join('customer','posts.id_user','customer.id_user')     
            ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post AND a.status = 1) as ansCount'), 'posts.status', 'posts.type')
            ->groupBy('posts.id_post')
            ->having('posts.status','=',1)
            ->having('posts.type','=','กระทู้')
            ->having('posts.category','=','Arts')
            ->orderBy('posts.id_post','desc')
            ->get();
        return view('artsAllPost')
            ->with('showAllPost', $showAllPost);
    }

    //All Blog Method
    public function homeAllBlog(){
        $Blogpost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')       
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','บทความ')
        ->orderBy('posts.id_post','desc')
        ->get();

        return view('homeAllBlog')
            ->with('showAllBlog', $Blogpost);
    }

    public function mathAllBlog(){
        $Blogpost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')       
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','บทความ')
        ->having('posts.category','=','Mathematics')
        ->orderBy('posts.id_post','desc')
        ->get();

        return view('mathAllBlog')
            ->with('showAllBlog', $Blogpost);
    }

    public function scienceAllBlog(){
        $Blogpost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')       
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','บทความ')
        ->having('posts.category','=','Science')
        ->orderBy('posts.id_post','desc')
        ->get();
        return view('scienceAllBlog')
            ->with('showAllBlog', $Blogpost);
    }

    public function socialAllBlog(){
        $Blogpost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')       
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','บทความ')
        ->having('posts.category','=','Social')
        ->orderBy('posts.id_post','desc')
        ->get();

        return view('socialAllBlog')
            ->with('showAllBlog', $Blogpost);
    }

    public function languageAllBlog(){
        $Blogpost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')       
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','บทความ')
        ->having('posts.category','=','Language')
        ->orderBy('posts.id_post','desc')
        ->get();

        return view('languageAllBlog')
            ->with('showAllBlog', $Blogpost);
    }

    public function artsAllBlog(){
        $Blogpost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')       
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','บทความ')
        ->having('posts.category','=','Arts')
        ->orderBy('posts.id_post','desc')
        ->get();

        return view('artsAllBlog')
            ->with('showAllBlog', $Blogpost);
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $actdate = Carbon::now()->timezone('GMT+7');
        $userid = Session::get('id_user');
        if(empty($userid)){
            return view('register');
        }else{
            $detail=$request->summernote;//รับค่าจาก messageInput
            $dom = new \domdocument();
            $dom->loadHtml('<?xml encoding="UTF-8">'.$detail);
            //ดึงเอาส่วนที่เป็นรูปภาพมาจาก summernote
            $images = $dom->getelementsbytagname('img');
            //ลูปรูปภาพและทำการเข้ารหัสรูปภาพ
            foreach($images as $k => $img){
                $data = $img->getattribute('src');
                if(preg_match('/data:images/',$data)){
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
            $posts = new posts;
            $posts->message = $detail;
            $posts->title = $request->dataheading;
            $posts->type = "กระทู้";
            $posts->date_time_post = $actdate;
            $posts->status = 1;
            $posts->id_user = Session::get('id_user');
            $posts->category = $request->selectcategory;
            $posts->tags = $request->topic;
            $posts->save();
            $maxid = DB::table('posts')->max('id_post');
            // return view('post',compact('summernote'));
            return redirect()->route('post', ['id' => $maxid]);
        }

    }

    public function store2(Request $request)
    {
        $actdate = Carbon::now()->timezone('GMT+7');
        $userid = Session::get('id_user');
        if(empty($userid)){
            return view('register');
        }else{
        $detail=$request->summernote;//รับค่าจาก messageInput
        $dom = new \domdocument();
        $dom->loadHtml('<?xml encoding="UTF-8">'.$detail);
        //ดึงเอาส่วนที่เป็นรูปภาพมาจาก summernote
        $images = $dom->getelementsbytagname('img');
        //ลูปรูปภาพและทำการเข้ารหัสรูปภาพ
        foreach($images as $k => $img){
            $data = $img->getattribute('src');
            if(preg_match('/data:images/',$data)){
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
        $posts = new posts;
        $posts->message = $detail;
        $posts->title = $request->dataheading;
        $posts->type = "บทความ";
        $posts->date_time_post = $actdate;
        $posts->status = 1;
        $posts->id_user = Session::get('id_user');
        $posts->category = $request->selectcategory;
        $posts->tags = $request->topic;
        $posts->save();
        $maxid = DB::table('posts')->max('id_post');
        // return view('article',compact('summernote'));
        return redirect()->route('article', ['id' => $maxid]);
    }
}

    public function edit($id)
    {
        $file = posts::all();
        $post = $file->where('id_post',$id)->first();
       // dd($post);
        return view('edit',compact('post','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $actdate = Carbon::now()->timezone('GMT+7');
        $userid = Session::get('id_user');
        $detail=$request->summernote;//รับค่าจาก messageInput
        $dom = new \domdocument();
        $dom->loadHtml('<?xml encoding="UTF-8">'.$detail);
        //ดึงเอาส่วนที่เป็นรูปภาพมาจาก summernote
        $images = $dom->getelementsbytagname('img');
        //ลูปรูปภาพและทำการเข้ารหัสรูปภาพ
        foreach($images as $k => $img){
            $data = $img->getattribute('src');
            if(preg_match('/data:images/', $data)) {
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
        $file = posts::all();
        $posts = $file->where('id_post',$id)->first();

        $ww = $posts->type;
        $update_post = DB::update('update posts 
            set message = ?,title=?, date_time_post = ?, category = ? ,tags = ?  
            where id_post = ?',[$detail,$request->dataheading,$actdate,$request->selectcategory,$request->topic,$posts->id_post]);
        if($ww == "กระทู้"){
            return redirect()->action(
                'Controller@post', ['id' => $posts->id_post]
            );
        }else{
            return redirect()->action(
                'Controller@article', ['id' => $posts->id_post]
            );
        }
        
    }

    public function general(){
        $QApost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')    
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post) as ansCount'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','กระทู้')
        ->having('posts.category','=','General')
        ->orderBy('ansCount','desc')
        ->take(3)
        ->get();

    $Blogpost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')       
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','บทความ')
        ->having('posts.category','=','General')
        ->orderBy('score','desc')
        ->take(3)
        ->get();
        return view('general')
            ->with('showQA', $QApost)
            ->with('showBlog', $Blogpost);
    }

    public function generalAllPost(){
        $showAllPost = DB::table('posts')
            ->join('customer','posts.id_user','customer.id_user')     
            ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_ans) FROM answers as a WHERE a.id_post = posts.id_post) as ansCount'), 'posts.status', 'posts.type')
            ->groupBy('posts.id_post')
            ->having('posts.status','=',1)
            ->having('posts.type','=','กระทู้')
            ->having('posts.category','=','General')
            ->orderBy('posts.id_post','desc')
            ->get();
        return view('generalAllPost')
            ->with('showAllPost', $showAllPost);
    }
    
    public function generalAllBlog(){
        $Blogpost = DB::table('posts')
        ->join('customer','posts.id_user','customer.id_user')       
        ->select('posts.id_post','posts.title','posts.date_time_post','posts.category','customer.firstname','customer.lastname', DB::raw('(SELECT COUNT(a.id_vote_post) FROM vote_post as a WHERE a.id_post = posts.id_post AND a.score = 1) as score'), 'posts.status', 'posts.type')
        ->groupBy('posts.id_post')
        ->having('posts.status','=',1)
        ->having('posts.type','=','บทความ')
        ->having('posts.category','=','General')
        ->orderBy('posts.id_post','desc')
        ->get();

        return view('generalAllBlog')
            ->with('showAllBlog', $Blogpost);
    }
}