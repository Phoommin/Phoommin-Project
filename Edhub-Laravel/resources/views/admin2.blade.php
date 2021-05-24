<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
        <link rel="shortcut icon" href="images/Logo.png" />
      <style>
        .bg-bluecolorheader {
            background: #7EC9C5 no-repeat padding-box;
        }
    </style>
        <title>verify_teacher_admin</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F1C214;">
            <!-- <nav class="navbar navbar-expand-lg navbar-light bg-warning"> -->
                    <a class="navbar-brand" href="#">
                            <img src="{{asset('images/Logo.png')}}" width="100" height="50" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                  
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                          <a class="nav-link" href="{{ url('admin1') }}"><b>ผู้ใช้ที่ถูกรายงาน</b><span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                          <a class="nav-link" href="{{ url('admin2') }}" ><font color="white"><b>อนุมัติอาจารย์</b></font></a>
                        </li>
                      </ul>
                      
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
                      $name = Session::get('email_admin');
                      $name = Str::limit($name, 25);
                      $id = Session::get('id_admin');
                        if($name != null){
                          echo "&nbsp;&nbsp;&nbsp;";
                          echo "<div class='btn-group dropleft'>";
                          echo "<a class='btn btn-dark dropdown-toggle' data-toggle='dropdown' id='dropdownMenuLink' data-display='static' aria-haspopup='true' aria-expanded='false' >
                               <font color='white'>$name</font></a>";
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

<div class="container" ><img src="{{ asset('/images/admin.jpg' )}}" height="300" width="100%" >
<br/><br/>
<div>
<table border="0" width="1200" align="center">
    <tr>
        <td align="left" ><h1>อนุมัติอาจารย์</h1></td>
    </tr>
</table>
</div>

<div>
<table border="1" width="100%" align="center" class="table-dark">
 
    <tr>
        <td align="center" >รหัส</td>
        <td align="center" >ชื่อ</td>
        <td align="center" >นามสกุล</td>
        <td align="center" >อีเมล</td>
        <td align="center" >เบอร์มือถือ</td>
        <td align="center" >รูปภาพ</td>
        <td align="center" ></td>
    </tr>

    @foreach($admin as $row)
    <tr>       
        <td align="center" >{{ $row->id_user }}</td>
        <td align="center" >{{ $row->firstname }}</td>
        <td align="center" >{{ $row->lastname }}</td>
        <td align="center" >{{ $row->email }}</td>
        <td align="center" >{{ $row->tel }}</td>
        <td align="center" ><img src="{{ asset('/images/' .$row->img )}}" height="100" width="150"></td>
            <td align="center"><a onclick="return JSalert()" class="btn btn-success"  href="{{ url('approve', $row->id_user) }}">อนุมัติ</a>
            <a onclick="return JSalert2()" class="btn btn-danger"  href="{{ url('noapprove', $row->id_user) }}">ไม่อนุมัติ</a></td> 
    </tr>
    @endforeach
    <tr>
    <td><br></td>
    </tr>
</table>
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

<script type="text/javascript">
    function JSalert(){
        var chk=0;
			   chk = confirm("คุณต้องการจะระงับการใช้งานผู้ใช้นี้หรือไม่");
               if (!chk)
				   return(false);
               else
				   return(true);
    }

    function JSalert2(){
        var chk=0;
			   chk = confirm("คุณต้องการจะปลดการระงับการใช้งานผู้ใช้นี้หรือไม่");
               if (!chk)
				   return(false);
               else
				   return(true);
    }

</script>
</body>
</html>
