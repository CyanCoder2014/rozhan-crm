@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="/datepicker/jquery.md.bootstrap.datetimepicker.style.css"/>
    <link href="/select2/select2.min.css" rel="stylesheet" />


@endsection
@section('content')
    <section id="content">

        <div class="page page-dashboard">

            <div class="pageheader">

                <h2><span> </span></h2>

                <div class="page-bar">

                    <ul class="page-breadcrumb">
                        <li>
                            <a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> پنل مدیریت </a>
                        </li>
                        <li>
                            <a href="#"> تیکت</a>
                        </li>
                        <li>
                            <a href="#"> تیکت</a>
                        </li>
                    </ul>


                </div>

            </div>

            <!-- cards row -->
            <div class="row" >

                @if(session()->has('message'))
                    <br>
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <br>
                <div class="inner" style="min-height: 300px;">
                    <div class="row">

                        <section id="lts_sec " class="right" style="margin: 0px auto">

                            <div class="container">
                                <div class="row ">
                                    <div class="container">
                                        @foreach($ticket->messages as $message)
                                            <div class="user-mesaage" style="margin-bottom: 10px">
                                                <div class="row flex bg-primary" style="border-radius: 5px 5px 0 0">
                                                    <div class="user-info col-sm-1">
{{--                                                        <img src="{{ $message->user->image() }}" alt="{{ $message->user->name }}" class="img-circle" style="max-width: 55px;">--}}
                                                        <h4>{{ $message->owner->name }}</h4>

                                                    </div>
                                                    <div class="user-text col-sm-8">
                                                        <h3 class="col">{{ $message->title }}</h3>
                                                        <div>{!! $message->description !!}</div>
                                                    </div>
                                                    <div class="pull-left col-sm-2 text-left ">
                                                        <h6>تاریخ و ساعت:</h6>
                                                        <p>{!! to_jalali($message->created_at) !!}</p>
                                                    </div>

                                                </div>
                                                <div class="row user-description">

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <h3>پاسخ دادن</h3>
                                    <form id="productForm" class="form-horizontal ng-pristine ng-valid" role="form" method="post" action="{{ route('ticketingmodule.admin.ticket.reply',['ticket' => $ticket->id]) }}">
                                        <input type="hidden" name="reply_to" value="{{ $message->id }}">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="عنوان">
                                            </div>
                                            <div class="form-group col-12">
                                                <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="متن">{{old('description')}}</textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">ثبت</button>

                                    </form>
                                </div>


                            </div>


                        </section>
                    </div>
                </div>
            </div>


        </div>
    </section>

@endsection
@section('script')

@endsection