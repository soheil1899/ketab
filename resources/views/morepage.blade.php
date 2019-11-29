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
            @if($flag == 'download')
                <div class="col-12 col-lg-10">
                    <lastbook-compo :flag="'download'" :auth="{{$myauth}}"></lastbook-compo>
                </div>
                <div class="col-lg-2 d-none d-lg-block pl-0">
                    <leftside-compo :title="'likes'" :auth="{{$myauth}}"></leftside-compo>
                </div>
            @else
                <div class="col-lg-2 d-none d-lg-block pr-0">
                    <leftside-compo :title="'download'" :auth="{{$myauth}}"></leftside-compo>
                </div>
                <div class="col-12 col-lg-10">
                    <lastbook-compo :flag="'likes'" :auth="{{$myauth}}"></lastbook-compo>
                </div>
            @endif
        </div>
    </div>


@endsection
