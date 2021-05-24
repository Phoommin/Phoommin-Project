@extends('layouts/Edhub-layout')
@section('title','search result')
@section('content')
<br />
<div class="container">
    <?php
    $cntName=0;
    $cntPost=0;
    $cntArc=0;
    foreach($select_name as $cntn){
        $cntName++;
    }  
    foreach($select_title as $cntt){
        if($cntt->type == 'กระทู้'){
            $cntPost++;
        }else{
            $cntArc++;
        }
    }  
    ?>
    <br>
    <img src="images/result.jpg" width="100%" height="300">
    <br>
    <b><h2 style="float:left"><font color="#C0C0C0">ผลลัพธ์ทั้งหมด <?php echo $cntName+$cntPost+$cntArc;?></font></h2></b>
    <br>
    <div class="w3-bar w3-light">
    @if($cntName != 0)
        <button class="w3-bar-item w3-button tablink btn-outline-warning" onclick="openLink(event,'People');">คน <?php echo $cntName;?></button>
    @endif
    @if($cntPost != 0)
        <button class="w3-bar-item w3-button tablink btn-outline-warning" onclick="openLink(event,'Post');">กระทู้ <?php echo $cntPost;?></button>
    @endif
    @if($cntArc != 0)
        <button class="w3-bar-item w3-button tablink btn-outline-warning" onclick="openLink(event,'Article');">บทความ <?php echo $cntArc;?></button>
    @endif
    </div>
    @if($cntName != 0)
    <div id="People" class="row myLink">
        @foreach($select_name as $item)
            <table class="table table-bordered">
                <tbody>
                    <tr onclick="document.location = '{{url('profiles', $item->id_user)}}';" onmouseover="this.style.backgroundColor='#FFCC00'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='white';">
                        <td scope="row">

                            <h5>{{$item->firstname}} {{$item->lastname}}</h5>
                            <div class="float-left">
                                {{$item->jobs}}
                            </div>
                            <div class="float-right">
                               <img srt="../images/{{$item->img}}" >
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
        @endforeach
        </div>
    @endif
    @if($cntPost != 0)
    <div id="Post" class="row myLink">
        @foreach($select_title as $title)
            @if($title->type == 'กระทู้')
            {{-- Post --}}
            
                <table class="table table-bordered">
                    <tbody>
                        <tr onclick="document.location = '{{url('post', $title->id_post)}}';" onmouseover="this.style.backgroundColor='#FFCC00'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='white';">
                            <td scope="row">
                                <h5>{{$title->title}}</h5>
                                <div class="float-left">
                                    {{$title->category.' '.date('H:i d/m/Y', strtotime($title->date_time_post))}}
                                </div>
                                <div class="float-right">
                                    ตอบกลับ {{$title->ansCount}} ครั้ง
                                </div>
                            </td>
                        </tr>
                        </tbody>
                </table>
            @endif
            @endforeach        
        </div>
        @endif
            {{-- End Post --}}
    @if($cntArc != 0)
        <div id="Article" class="row myLink">
        @foreach($select_title as $title)
            @if ($title->type == 'บทความ')
            {{-- Article --}}
            
                <table class="table table-bordered">
                    <tbody>
                    <tr onclick="document.location = '{{url('article', $title->id_post)}}';" onmouseover="this.style.backgroundColor='#FFCC00'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='white';">
                            <td scope="row">
                                <h5>{{$title->title}}</h5>
                                <div class="float-left">
                                    {{$title->category.' '.date('H:i d/m/Y', strtotime($title->date_time_post))}}
                                </div>
                                <div class="float-right">
                                    ถูกใจ {{$title->score}}
                                </div>
                            </td>
                        </tr>
                        </td>
                    </tr>
                </tbody>
                </table>
                
            {{-- End Article --}}
            @endif
        @endforeach
        </div>
    @endif
    @if($cntArc == 0 && $cntName == 0 && $cntPost == 0)
       <h1><center>No result </center></h1>
    @endif
</div>
<!-- End of container -->
<script type="text/javascript">        // Tabs
    function openLink(evt, linkName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("myLink");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
        }
        document.getElementById(linkName).style.display = "block";
        evt.currentTarget.className += " w3-red";
    }
    // Click on the first tablink on load
    document.getElementsByClassName("tablink")[0].click();
</script>
@endsection
