<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
        <link rel="icon" href="{!! asset('images/Logo.png') !!}"/>
      <style>
        .bg-bluecolorheader {
            background: #7EC9C5 no-repeat padding-box;
        }
    </style>
        <title>Post</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F1C214;">
    @if(Session::get('email_admin') == null)
                    <a class="navbar-brand" href="{{url('home')}}">
                            <img src="{{asset('images/Logo.png')}}" width="100" height="40" alt="">
                          </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                  
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                          <a class="nav-link" href="{{url('Contact')}}">Contact<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                          <a class="nav-link" href="{{url('About_us')}}" >About us</a>
                        </li>
                        <li class="nav-item dropdown active">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Post
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('home/allpost')}}">All POST</a>
                            <a class="dropdown-item" href="{{url('general')}}">General</a>
                            <a class="dropdown-item" href="{{url('math')}}">Mathematics</a>
                            <a class="dropdown-item" href="{{url('science')}}">Science</a>
                            <a class="dropdown-item" href="{{url('social')}}">Social</a>
                            <a class="dropdown-item" href="{{url('language')}}">Language</a>
                            <a class="dropdown-item" href="{{url('arts')}}">Arts</a>
                          </div>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <font color="white">CretePost</font>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('showpost') }}">เขียนกระทู้</a>
                            <a class="dropdown-item" href="{{ url('showarticle') }}">เขียนบทความ</a>
                          </div>
                        </li> 
                      </ul>
 @else
 <a class="navbar-brand" href="#">
                            <img src="{{asset('images/Logo.png')}}" width="100" height="50" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                  
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                          <a class="nav-link" href="{{ url('admin1') }}"><font color="white"><b>ผู้ใช้ที่ถูกรายงาน</b></font><span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                          <a class="nav-link" href="{{ url('admin2') }}" ><b>อนุมัติอาจารย์</b></a>
                        </li>
                      </ul>
 @endif
                      <div class="col-6">
                          <div id="custom-search-input">
                          <form method="post" action="{{url('search_result')}}">
                          {{csrf_field()}}
                              <div class="input-group">
                                  <select  name="list_result" id="list_result" onclick="srmethod(this.value)">
                                      <option value="name">name</option>
                                      <option value="title" selected>title</option>
                                  </select>
                                  <input id="search" name="search" type="text" class="form-control" placeholder="Search" autofocus="on" required />&nbsp;&nbsp;
                                  <input type="image" src="{{asset('images\white-search-icon-png-27@2x.png')}}" height="35px" alt="Submit">
                              </div>
                              </form>
                          </div>
                      </div>
                  
                      <form class="form-group" method="post" action="{{url('login_c')}}">
                        @csrf
                      <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header text-center">
                              <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                              <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body mx-3">
                              <div class="md-form mb-5">
                                <i class="fas fa-envelope prefix grey-text"></i>
                                <input type="text" name="u" id="defaultForm-email" class="form-control validate" placeholder="Email" > 
                              </div>

                              <div class="md-form mb-4">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <input type="password" name="p" id="defaultForm-pass" class="form-control validate" placeholder="Password">
                              </div>

                            </div>
                              <div class="modal-footer d-flex justify-content-center">
                              <input class="btn btn-warning" type="submit" value="login">
                            </div>
                          </div>
                        </div>
                    </div>
                    </form>
                      <?php
                      $name = Session::get('email');
                      $name = Str::limit($name, 25);
                      $id = Session::get('id_user');
                        if($name != null){
                          echo "&nbsp;&nbsp;&nbsp;";
                          echo "<div class='btn-group dropleft'>";
                          echo "<a class='btn btn-dark dropdown-toggle' data-toggle='dropdown' id='dropdownMenuLink' data-display='static' aria-haspopup='true' aria-expanded='false' >
                               <font color='white'>$name</font></a>";
                          echo "<div class='dropdown-menu'>";
                          echo "<a class='dropdown-item' href='"; ?>{{url('profile')}} <?php echo "'>Profile</a>";
                          echo "<a class='dropdown-item' onclick='return myFunction()' href='"; ?>{{url('Logout')}} <?php echo "'>Logout</a>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                        }elseif(Session::get('email_admin') != null){
                          echo "&nbsp;&nbsp;&nbsp;";
                          echo "<div class='btn-group dropleft'>";
                          echo "<a class='btn btn-dark dropdown-toggle' data-toggle='dropdown' id='dropdownMenuLink' data-display='static' aria-haspopup='true' aria-expanded='false' >
                               <font color='white'>".Session::get('email_admin')."</font></a>";
                          echo "<div class='dropdown-menu'>";
                          echo "<a class='dropdown-item' onclick='return myFunction()' href='"; ?>{{url('Logout')}} <?php echo "'>Logout</a>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                        }else{  
                        echo "<a class='nav-link' href='#' data-toggle='modal' data-target='#modalLoginForm'  data-whatever='@mdo' style='color:black;'>Login</a>";
                        echo "<a class='btn btn-light my-2 my-sm-0' type='button' href='"; ?>{{url('register')}} <?php echo "'>Sign up</a>";
                        echo "</form>";
                        }
                        ?>
                    </div>
                  </nav>
                  @if (session('alert'))
                    {!! session('alert') !!}
                    <?php Session::flush(); ?>
                  @endif
    
<!-- Content -->
<br />
<div class="container">
@foreach($getPost as $row)
  <div class="row">
    <div class="bg-bluecolorheader col-12">
        <h3 class="text-secondary"> {{ $row->title }} </h3>
        <div class="row col-12">
            <h6 class="text-white">{{$row->category}} - {{$row->tags}} {{$row->date_time_post}} by<a href="{{ url('profiles',$row->id_user) }}" style="text-decoration: none; color:white;" title="ไปยังโปรไฟล์"> {{$row->firstname}} {{$row->lastname}}</a></h6>
            @if($row->id_user == Session::get('id_user'))
                <h6 class="text-white col text-right">
                    <a href="{{route('edit',$row->id_post)}}" style="text-decoration: none; color: white;">แก้ไข</a> &nbsp; 
                    <a href="{{ url('delete_post',$row->id_post) }}" onclick="return confirm_del()" style="text-decoration: none; color: white;">ลบ</a>
                </h6>
            @elseif(Session::get('id_user') != null)
                <h6 class="text-white col text-right">
                @if($check_report == false)
                    <a href="{{ url('report_post',$row->id_post) }}" onclick="return reports()" style="text-decoration: none; color: white;">Report</a>
                @else
                    <b class="text-secondary">Reported</b>
                @endif
                </h6>
            @endif       
        </div> 
    </div>
  </div>
  <div class="row">
    <div class="alert alert-info col-12">
            {!! $row->message !!} 
    </div>
  </div>
  @if(Session::get('id_user') != null)
  <!--Form Input Your Answers-->
  <br />
  <div class="row">
    <h4>Answers</h4> 
  </div>
  <div class="row">
    <form class="form-inline border shadow-sm p-3 mb-5 bg-white rounded col-12" method="post" action="{{url('insert_ans')}}">
        {{csrf_field()}}
        <input type="hidden" name="id_post" value="{{$row->id_post}}" />
        <textarea id="summernote" name="summernote" class="from-control"></textarea>
        &nbsp; &nbsp; &nbsp; &nbsp;
        <input type="image" name="submit" src="{{asset('images/icon_message.png')}}" alt="Submit" style="width: 45px;" />
    </form>
  </div>
  <!--/Form Input Your Answers-->
@endif
@endforeach
<!--Answers-->
<?php $i = 1 ?>
@foreach($getAns as $row2)
  <div class="row">
    &nbsp; &nbsp;
    <div class="row col-12 bg-light text-dark"> 
        <div class="col-8">
            <h5>Answers <?php echo $i++; ?>: 
            @if(Session::get('user_type')=='techer')
                @foreach($check_is_con as $con)
                    @if($con->id_ans == $row2->id_ans)
                        <img src="{{asset('images/checked-checkbox1.png')}}" width="25" />{{$row2->firm}}</h5>
                        @break
                    @elseif($loop->last)
                        <a href="{{ url('confirm_ans',$row2->id_ans) }}" ><img src="{{asset('images/icons8-checked-checkbox-80.png')}}" width="25" /></a>{{$row2->firm}}</h5>
                    @endif
                @endforeach
            @else
               <img src="{{asset('images/success.png')}}" width="20" /> {{$row2->firm}}</h5>
            @endif
        </div>
        <div class="col text-right">
            <h6><small>{{$row2->date_time_ans}} by <a href="{{ url('profiles',$row->id_user) }}" style="text-decoration: none; color:black;" title="ไปยังโปรไฟล์"> {{$row2->firstname}} {{$row2->lastname}}</a></small></h6>
        </div>
        <div class="col-12 alert alert-info">
            {!!$row2->message!!}
        </div>
        <div class="row col-12 bg-light text-dark"> 
            @if($row2->id_user == Session::get('id_user'))
                <a href="{{ url('form_edit_ans',$row2->id_ans) }}" style="text-decoration: none;">แก้ไข</a> &nbsp; 
                <a href="{{ url('delete_ans',$row2->id_ans) }}" style="text-decoration: none;" onclick="return confirm_ans_del()">ลบ</a>
            @endif
            <div class="col text-right">
            @if(Session::get('id_user') != null)
              @if(!empty($check_like))
                  @foreach($check_like as $like)
                      @if($like->id_ans == $row2->id_ans && $like->score == 1)
                          <img src="{{asset('images/like.png')}}" width="25"/>{{$row2->v_like}} &nbsp;
                          <a href="{{ url('update_dislike_ans',$row2->id_ans) }}"><img src="{{asset('images/thumbs-down.png')}}" width="25"/></a>{{$row2->v_dislike}}
                          @break
                      @elseif($like->id_ans == $row2->id_ans && $like->score == -1)
                          <a href="{{ url('update_like_ans',$row2->id_ans) }}"><img src="{{asset('images/thumbs-up.png')}}" width="25"/></a>{{$row2->v_like}} &nbsp;
                          <img src="{{asset('images/dislike.png')}}" width="25"/>{{$row2->v_dislike}}
                          @break
                      @elseif($loop->last)
                          <a href="{{ url('like_ans',$row2->id_ans) }}"><img src="{{asset('images/thumbs-up.png')}}" width="25"/></a>{{$row2->v_like}} &nbsp;
                          <a href="{{ url('dislike_ans',$row2->id_ans) }}"><img src="{{asset('images/thumbs-down.png')}}" width="25"/></a>{{$row2->v_dislike}}
                      @endif
                  @endforeach
                @else
                  <a href="{{ url('like_ans',$row2->id_ans) }}"><img src="{{asset('images/thumbs-up.png')}}" width="25"/></a>{{$row2->v_like}} &nbsp;
                  <a href="{{ url('dislike_ans',$row2->id_ans) }}"><img src="{{asset('images/thumbs-down.png')}}" width="25"/></a>{{$row2->v_dislike}}
                @endif
                &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                <a data-toggle="collapse" href="#collapse{{$row2->id_ans}}" aria-expanded="false" aria-controls="{{$row2->id_ans}}" style="text-decoration: none;">show more comment</a>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#comment{{$row2->id_ans}}"> Reply </button>   
            @else
                <img src="{{asset('images/thumbs-up-gray.png')}}" width="25"/>{{$row2->v_like}} &nbsp;
                <img src="{{asset('images/thumbs-down-gray.png')}}" width="25"/>{{$row2->v_dislike}}
                &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                <a data-toggle="collapse" href="#collapse{{$row2->id_ans}}" aria-expanded="false" aria-controls="{{$row2->id_ans}}" style="text-decoration: none;">show more comment</a>   
            @endif
            </div>
        </div>

        <div class="row col-12 bg-light text-dark">
            <div class="collapse multi-collapse" id="collapse{{$row2->id_ans}}">
                <ul class="media-list">
                  <!--Comment-->
            @foreach($getCom as $row3)
                @if($row3->id_ans == $row2->id_ans)
                    <li class="media media-replied">
                        <div class="media-body">
                            <div class="well well-lg">
                                <h6><b><a href="{{ url('profiles',$row3->id_user) }}" style="text-decoration: none; color:black;" title="ไปยังโปรไฟล์"> {{$row3->firstname}} {{$row3->lastname}}</a></b></h6>
                                <p class="media-comment">{{$row3->message}}</p>
                            </div>              
                        </div>
                    </li>
                    <!--/Comment-->
                @endif
            @endforeach
                </ul>  
            </div>
        </div>
    </div>
  </div>
  <br />
  <!--/Answers-->
  <!--pop-up comment-->
<div class="modal fade" id="comment{{$row2->id_ans}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Form input Comment -->
      <form method="post" action="{{url('comments')}}">
        {{csrf_field()}}
        <input type="hidden" name="id_ans" value="{{$row2->id_ans}}" />
        <div class="modal-body">
            <textarea name="com" placeholder="Comment..." rows="5" cols="62" style="border: none; resize: none;"></textarea>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Send <img src="{{asset('images/icon_message.png')}}" style="width: 20px;" /></button>
        </div>
      </form>
      <!-- /Form input Comment -->
    </div>
  </div>
</div>
@endforeach
</div>
<script>
    var s = document.getElementById("list_result").value;              
    window.srmethod(s);

    function srmethod($strSearch){
        $(document).ready(function(){
        if($strSearch == "name" && $strSearch != null){

            $( "#search" ).autocomplete({

                source: function(request, response) {
                    $.ajax({
                    url: "{{url('autocompleteName')}}",
                    data: {
                            term : request.term
                    },
                    dataType: "json",
                    success: function(data){
                    var resp = $.map(data,function(obj){
                            //console.log(obj.city_name);
                            name = obj.firstname + " " + obj.lastname;
                            return name;
                    });

                    response(resp);
                    }
                });
            },
            minLength: 1
        });

        }else{

            $( "#search" ).autocomplete({

                source: function(request, response) {
                    $.ajax({
                    url: "{{url('autocompleteTitle')}}",
                    data: {
                            term : request.term
                    },
                    dataType: "json",
                    success: function(data){
                    var resp = $.map(data,function(obj){
                            //console.log(obj.city_name);
                            name = obj.title;
                            return name;
                    });

                    response(resp);
                    }
                });
            },
                minLength: 1
            });


        }
    });}
  </script>
<script> 
    function myFunction() {
        var txt;
        var r = confirm("ํYou sure to logout");
        if (r == true) {
            return true;
        }else 
        {
            return false;
        }
    }
    function confirm_del()  {   
        return confirm("คุณต้องการลบกระทู้นี้หรือไม่");
    }
    function confirm_ans_del(){
        return confirm("คุณต้องการลบคำตอบนี้หรือไม่");
    } 
    function reports(){
        return confirm("คุณต้องการรายงานกระทู้ที่นี้หรือไม่");
    }

    $(document).ready(function(){
          $('#summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            placeholder: 'เขียนเนื้อหาของคุณ...',
            tabsize: 2,
            height: 300,
            width: 1020
          })
    });
</script>

</body>
</html>