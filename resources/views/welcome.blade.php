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
                <slider-compo></slider-compo>
                <lastbook-compo :flag="'all'" :auth="{{$myauth}}"></lastbook-compo>
            </div>
            <div class="col-lg-2 d-none d-lg-block pl-0">
                <leftside-compo :title="'likes'" :auth="{{$myauth}}"></leftside-compo>
            </div>
        </div>
    </div>


@endsection
