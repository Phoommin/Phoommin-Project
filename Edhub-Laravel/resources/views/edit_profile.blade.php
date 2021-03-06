<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
        <title>Edit Profile</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href={{asset("css/component.css")}} />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
        
		<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
    <link rel="icon" href="{!! asset('images/Logo.png') !!}"/>
    </head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F1C214;">
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
                            <a class="dropdown-item" href="{{ url('showpost') }}">?????????????????????????????????</a>
                            <a class="dropdown-item" href="{{ url('showarticle') }}">?????????????????????????????????</a>
                          </div>
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

    <br>
    <div class="container">
{{-- I'm right here !!
    Edit Method
    And upload file live preview
--}}

@foreach($info as $row)
<form class="form-horizontal" method="POST" action="{{url('edit_profiles')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="id_user" value="{{$row->id_user}}" />

    <div class="form-group row">
        <div class="col-md-10">
          <h2>Edit Profile</h2>
          <br>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-2">
          <img src="{{asset('images/'.$row->img)}}" alt="Avatar" class="img" style="width:150px; height:150px;" id="imgPreview" >
        </div>
        <div class="col-md-auto">
          <p>
            <h3>{{$row->firstname}} {{$row->lastname}}</h3>
            <br>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <input type="hidden" name="phodo" value="{{$row->img}}">
          <input type="file" name="fileImg" id="file-4" class="inputfile inputfile-3" onchange="showImagePreview(this)" />
          <label for="file-4"><span>Choose a file&hellip;</span></label>
          </p>
        </div>
      </div>
<br>
      <div class="form-group row">
        <div class="col-md-2 text-right">
          <label for="firstname"><h5>Firstname</h5></label>
        </div>
        <div class="col-md-4">
        <input type="text" name="firstname" class="form-control" id="firstname" value="{{$row->firstname}}" placeholder="Enter Firstname">
        </div>

        <div class="col-md-2 text-right">
            <label for="email"><h5>Email</h5></label>
        </div>
        <div class="col-md-4">
          <input type="text" name="email" class="form-control" id="email" value="{{$row->email}}" placeholder="example@laraval.com">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-2  text-right">
            <label for="lastname"><h5>Lastname</h5></label>
        </div>
        <div class="col-md-4">
          <input type="text" name="lastname" class="form-control" id="lastname" value="{{$row->lastname}}" placeholder="Enter Lastname">
        </div>

        <div class="col-md-2 text-right">
            <label for="password"><h5>Password</h5></label>
        </div>
        <div class="col-md-4">
          <input type="text" name="password" class="form-control" id="password" value="{{$row->password}}" placeholder="Enter Password">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-2 text-right">
            <label for="job"><h5>Job</h5></label>
        </div>
        <div class="col-md-4">
          <input type="text" name="job" class="form-control" id="job" value="{{$row->jobs}}" placeholder="Enter your job">
        </div>

        <div class="col-md-2 text-right">
            <label for="tel"><h5>Tel</h5></label>
        </div>
        <div class="col-md-4">
          <input type="text" name="tel" class="form-control" id="tel" value="{{$row->tel}}" placeholder="Ex. 0909009090">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-2 text-right">
            <label for="bio"><h5>Bio</h5></label>
        </div>
        <div class="col-md-4">
            <textarea class="form-control" name="bio" id="bio" rows="4" placeholder="Write something about you <optional>">{{$row->bio}}</textarea>
        </div>

        <div class="col-md-2 text-right">
          <label for="website"><h5>Website</h5></label>
        </div>
        <div class="col-md-4">
          <textarea class="form-control" name="web" id="website" rows="4" placeholder="Ex. www.helloworld.com">{{$row->website}}</textarea>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-12 d-flex"><button type="submit" class="btn btn-warning ml-auto">Submit</button></div>
      </div>
      <!-- End of Container -->
    </div>
    @endforeach
</form>
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
<script src={{asset("js/custom-file-input.js")}}></script>
<script type="text/javascript">
    function showImagePreview(input) {
        if (input.files && input.files[0]) {
            var filerdr = new FileReader();
            filerdr.onload = function (e) {
                $('#imgPreview').attr('src', e.target.result);
            }
            filerdr.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>
