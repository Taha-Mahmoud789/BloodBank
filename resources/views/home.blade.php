@extends('adminlte::page')
@inject('client','App\Models\Client')
@inject('donation','App\Models\DonationRequest')
@inject('governorates','App\Models\Governorate')
@inject('cities','App\Models\City')
@inject('categories','App\Models\Categorie')
@inject('posts','App\Models\Post')
@inject('contact','App\Models\Contact')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon "><i class="fa fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Clients</span>
                        <span class="info-box-number">{{$client->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon "><i class="fa fa-hand-holding-heart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Donations</span>
                        <span class="info-box-number">{{$donation->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon "><i class="fa fa-city"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Governorate</span>
                        <span class="info-box-number">{{$governorates->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon "><i class="fa fa-city"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">City</span>
                        <span class="info-box-number">{{$cities->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon "><i class="fa fa-list-alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">categories</span>
                        <span class="info-box-number">{{$categories->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon "><i class="fa fa-newspaper"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Posts</span>
                        <span class="info-box-number">{{$posts->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon "><i class="fa fa-phone"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Contact US</span>
                        <span class="info-box-number">{{$contact->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

        </div>

        <div class="box-body">

        </div>
        <!-- /.box-body -->

        <!-- /.box-footer-->

        <!-- /.box -->

    </section>
    <!-- /.content -->
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
