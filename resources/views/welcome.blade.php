{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head> --}}
    @extends('layouts.app')

    @section('content')
    <div class="flex-center position-ref full-height Auth" style="padding-top:80px;">
        <div class="container">
        <!-- <div>
            <h1>ESHOP VUE LARAVEL</h1>
        </div> -->
            @if(Auth::check())

        <!-- se utente LOGGATO User, ADMIN e' TRUE -->
            @if(Auth::user()->admin)
                <welcome-component-admin></welcome-component-admin>
            @else
                <welcome-component-cart></welcome-component-cart>
            @endif
            @else
                <welcome-component></welcome-component>
            @endif
            <div class="links">
                
                <small>Created By: <a href="https://github.com/Mirko2552150">LM</a> & <a href="https://github.com/michael-molin">MM</a> </small>
                
            </div>
        </div>
    </div>
    @endsection
    

<style>
    .flex-container {
        display: flex;
    }

    .links {
        text-align: center;
        margin: 0 auto;
    }
</style>
