@extends('promotions.layout')

@php
    $bg = asset('admin/uploads/'.$global_d['store_banner']);
  
    $azArray = array();
    for ($i = 97; $i <= 122; $i++) {
        array_push($azArray ,chr($i));
    }

    // dd(array_chunk($azArray,3));
@endphp

@section('metatags')
    <title>{{$global_d['store_meta_title'] ?? ''}}</title>
    <meta name="description" content="{{$global_d['store_meta_description'] ?? ''}}">
    <meta name="keywords" content="{{$global_d['store_keywords'] ?? ''}}">
@endsection


@section('css')

<style>

    #banner-nin {
        padding: 20% 0 15%;
    
        background-color: #000;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        background: url("{{$bg}}")!important;
    }

    .latest_page_box img{
        width: 100%;
    }

    .title{
        padding: 48px 0px;
    }
     .latest_page_box {
        border: 1px solid #e3e3e3;
        border-radius: 5px;
        margin-bottom: 50px;
    }

  

    .profile-list .active  a:hover{
        background: #ed2a28!important;
        color:white!important;
    }

    .profile-list .normal a:hover{
        background: white!important;
        color:#ed2a28!important;
    }

    .no_record_found a{
            padding: 15px 0;
            display: block;
            border-bottom: none!important;
            border-radius: 0px;
        
    }

</style>
@endsection


@section('content')

<section id="banner-nin" class="parallaxie">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="banner_detail">
            <h2>{!!$global_d['store_banner_title']!!}</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /#Banner --> 


 
<section id="profile" class="padding bg_light">
    <div class="container">

      <div id="section_title_1" style="background: white" class="row ">
            <div class="col-md-12 bottom40" style="margin-top: 40px;">
              <h2 class="text-uppercase">CHOOSE STORES
            </h2>
            <div class="line">
              <div class="line_1"></div>
              <div class="line_2"></div>
              <div class="line_3"></div>
            </div>      
          </div>
      </div>

       @foreach (array_chunk($azArray,3) as $chunk)
                   
        <div class="row">
            @foreach ($chunk as $char)
                
          
          
                <?php 
                //    $char = chr($i); 
                         $result = \App\Models\Store::where('title', 'like', $char.'%')->get();
                ?>
           
                <div class="col-md-4 col-sm-12 ">
                    <div class="profile-list">
                        <ul>
                            <li class="active">
                            <a>STORE WITH ALPHABATICAL ({{$char}})</a>
                            </li>
                            @if(count($result) > 0)
                            <?php 
                            //   dd($result);
                            ?>
                            @foreach ($result  as $item)
                                <li class="normal" >
                                    <a href="{{URL::to('/promotions/stores/')}}/{{$item->slug}}">{{$item->title}}</a>
                                </li>
                            @endforeach
                            @else
                            {{-- <li class="no_record_found" >
                                <a href="#">No Record Found</a>
                            </li> --}}
                            <p style="padding-top: 20px" class="text-center" >Not Record Found</p>
                            @endif
                        </ul>
                    </div>
                </div>

                @endforeach

            </div>
            @endforeach
        
        
    </div>
</section>
@endsection
