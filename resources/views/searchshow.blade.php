@extends('layouts.client.master')

@section('content')


    <menu-compo></menu-compo>


    <div class="container py-3 px-0">
        <div class="row mx-0">
            @php
                if (auth()->check()){
                    $myauth = '1';
                }else{
                    $myauth = '0';
                }
            @endphp
            <div class="col-lg-2 d-none d-lg-block pr-0">
                <leftside-compo :title="'download'" :auth="{{$myauth}}"></leftside-compo>
            </div>
            <div class="col-12 col-lg-8">
                <div class="row mx-0 mt-4">
                    <div class="col-12">
                        <h3 class="persontitle mb-0 pr-2 py-2 text-right">
                            <strong>
                                نتایج جستجو برای :
                                {{$searchtext}}
                            </strong>
                        </h3>
                    </div>
                    <div class="col-12 mt-4">
                        <show-search :book="{{$book}}" :nasher="{{$nasher}}" :writer="{{$writer}}" :translator="{{$translator}}" :auth="{{$myauth}}"></show-search>
                    </div>
                </div>

            </div>
            <div class="col-lg-2 d-none d-lg-block pl-0">
                <leftside-compo :title="'likes'" :auth="{{$myauth}}"></leftside-compo>
            </div>
        </div>
    </div>


@endsection
