@extends('layouts/Edhub-layout')
@section('title','Math')
@section('content')
    <br>
    <img src="images/math.jpg" width="100%" height="300">
    <br><br><br>

    <!-- กระทู้ยอดนิยม -->
    <b><h4 style="float:left">กระทู้ยอดนิยม</h4></b>
    <b><a class="btn btn-warning text-white" href="math/allpost" style="float:right;"><u>กระทู้ทั้งหมด</u></a></b>
    <br><br>
    <table class="table table-bordered">
        <tbody>
            @foreach ($showQA as $row)
            <tr onclick="document.location = '{{url('post', $row->id_post)}}';" onmouseover="this.style.backgroundColor='#FFCC00'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='white';">
                <td scope="row">
                    <h5>{{$row->title}}</h5>
                    <div class="float-left">
                        {{$row->category.' '.date('H:i d/m/Y', strtotime($row->date_time_post)).' by '.$row->firstname.' '.$row->lastname}}
                    </div>
                    <div class="float-right">
                        ตอบกลับ {{$row->ansCount}} ครั้ง
                    </div>                        
                </td>
                </tr>
            @endforeach                    
        </tbody>
    </table>
    <br><br><br>

    <!-- บทความยอดนิยม -->
    <b><h4 style="float:left">บทความยอดนิยม</h4></b>
    <b><a class="btn btn-warning text-white" href="math/allblog" style="float:right;"><u>บทความทั้งหมด</u></a></b>
    <br><br>
    <table class="table table-bordered">
        <tbody>
            @foreach ($showBlog as $row)
            <tr onclick="document.location = '{{url('article', $row->id_post)}}';" onmouseover="this.style.backgroundColor='#FFCC00'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='white';">
                <td scope="row">
                    <h5>{{$row->title}}</h5>
                    <div class="float-left">
                        {{$row->category.' '.date('H:i d/m/Y', strtotime($row->date_time_post)).' by '.$row->firstname.' '.$row->lastname}}
                    </div>
                    <div class="float-right">
                        ถูกใจ {{$row->score}}
                    </div>                        
                </td>
                </tr>
            @endforeach                    
        </tbody>
    </table>
    
@endsection
