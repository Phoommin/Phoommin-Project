<?php

namespace App\Http\Controllers;
use DB;
use App\adminModel;
use Illuminate\Http\Request;

class AdminModelController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function register(Request $request){
        // $this->validate($request,['firstname' => 'required', 'lastnamename' => 'required', 
        //      'tel' => 'required', 'email' => 'required', 
        //      'password' => 'required', 'user_type' => 'required']);
        $email = DB::select('select * from customer where email = ?',[$request->email]);
        if(empty($email))
        {
            $user = new adminModel;
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->jobs = $request->jobs;
            $user->tel = $request->tel;
            $user->email = $request->email;
            $user->password = $request->password;    
            $user->bio = " ";
            $user->img = "img_avatar.png";
            $user->website = " ";
            if($request->user_type == "teacher"){
                $user->status = 3;
                $user->type = "techer";
            }else{
                $user->status = 1;
                $user->type = "student";
            }
            $user->save();
            return redirect('home')->with('alertss', '<script>alert(\'สมัครสำเร็จ\');</script>');
        }
        else{
            $email = null;
            return redirect('register')->with('alerts', '<script>alert(\'Email ถูกใช้งานแล้ว\');</script>');
        }
}


    public function admin1()
    {
        $admin = DB::select('SELECT p.title, p.type, p.category, p.id_post, p.status,
        (SELECT COUNT(reports.report_point) FROM reports WHERE reports.id_post = p.id_post) AS c_report
        FROM posts AS p , reports AS r 
        GROUP BY p.id_post');
   

        return view('admin1',['admin' => $admin]);
    }

    public function admin2()
    {
        $admin = DB::table('customer')
        ->select('customer.id_user', 'customer.firstname'
        , 'customer.lastname', 'customer.email', 'customer.tel'
        , 'customer.jobs' , 'customer.type' , 'customer.img' , 'customer.status')
        ->where('customer.status' , 3)
        ->get();

        return view('admin2', compact('admin'));
    }

    public function approve($id)
    {
        DB::table('customer')
         ->where('id_user', $id)        
          ->update(['status' => 1]);

         return redirect('/admin2');  
    }

    public function noapprove($id)
    {

        DB::table('customer')
         ->where('id_user', $id)        
          ->update(['status' => 0]);

        return redirect('/admin2'); 
    }

    public function banupdate($id)
    {

        DB::table('posts')
         ->where('id_post', $id)        
         ->update(['status' => 0]);

        return redirect('/admin1');       
    }

    public function rebanupdate($id)
    {

        DB::table('posts')
         ->where('id_post', $id)        
          ->update(['status' => 1]);

        return redirect('/admin1');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\adminModel  $adminModel
     * @return \Illuminate\Http\Response
     */
    public function show(adminModel $adminModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\adminModel  $adminModel
     * @return \Illuminate\Http\Response
     */
    public function edit(adminModel $adminModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\adminModel  $adminModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, adminModel $adminModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\adminModel  $adminModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(adminModel $adminModel)
    {
        //
    }
}
