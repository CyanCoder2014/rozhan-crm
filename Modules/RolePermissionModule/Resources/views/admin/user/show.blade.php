@extends('layouts.admin')
@section('head')
    <style>
        .profile span{
            color: #0b0b0b;
        }
        .profile span {
            color: #0b0b0b;
        }
        .profile span.badge{
            color: #fff;
        }
    </style>
@endsection
@section('content')
    <link href="/select2/select2.min.css" rel="stylesheet" />





    <section id="content">

        <div class="page page-dashboard">

            <div class="pageheader">

                <h2><span> </span></h2>

                <div class="page-bar">

                    <ul class="page-breadcrumb">
                        <li>
                            <a href="<?= Url('/admin' ); ?>"><i class="fa fa-home"></i> پنل مدیریت </a>
                        </li>
                        <li>
                            <a href="#"> نمایش کاربر</a>
                        </li>
                    </ul>


                </div>

            </div>


        <div class="inner" style="min-height: 565px;">
            <div class="row">
                <section id="lts_sec " class="right" style="margin: -20px auto;">
                    <div class="container ">
                        <div class="row " >
                            <ul class="p-3 d-flex flex-row flex-wrap boxshadowBottom rounded profile">
                                <li class="mx-2">
                                    <img src="@if(isset($user->AProfile) && isset($user->AProfile->image)) {{ asset($user->AProfile->image) }} @else /olympus/img/avatar1.jpg @endif" height="70" width="70" class="rounded-circle" alt="">
                                </li>
                                <li class="mx-2">
                                    <div class="bg-myBlue text-white p-1 rounded mt-3">
                                        <span>نام :</span>
                                        <span>{{ $user->name }}</span>
                                    </div>
                                </li>
                                <li class="mx-2">
                                    <div class="bg-myBlue text-white p-1 rounded mt-3">
                                        <span>نام خانوادگی:</span>
                                        <span>{{ $user->family }}</span>
                                    </div>
                                </li>
                                <li class="mx-2">
                                    <div class="bg-myBlue text-white p-1 rounded mt-3">
                                        <span>موبایل:</span>
                                        <span>{{ $user->mobile }}</span>
                                    </div>
                                </li>
                                <li class="mx-2">
                                    <div class="bg-myBlue text-white p-1 rounded mt-3">
                                        <span>ایمیل:</span>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </li>
                                <li class="mx-2">
                                    <div class="bg-myBlue text-white p-1 rounded mt-3">
                                        <span>نام کاربر:</span>
                                        <span>{{ $user->username }}</span>
                                    </div>
                                </li>
                                <li class="mx-2">
                                    <div class="bg-myBlue text-white p-1 rounded mt-3">
                                        <span>کد ملی:</span>
                                        <span>{{ $user->national_code }}</span>
                                    </div>
                                </li>
                                @if(isset($user->AProfile))

                                    @if(isset($user->AProfile->birth_date))
                                        <li class="mx-2">
                                            <div class="bg-myBlue text-white p-1 rounded mt-3">
                                                <span>تاریخ تولد:</span>
                                                <span>{{ $user->AProfile->birth_date }}</span>
                                            </div>
                                        </li>
                                    @endif
                                    @if(isset($user->AProfile->height))
                                        <li class="mx-2">
                                            <div class="bg-myBlue text-white p-1 rounded mt-3">
                                                <span>قد:</span>
                                                <span>{{ $user->AProfile->height }}</span>
                                            </div>
                                        </li>
                                    @endif
                                    @if(isset($user->AProfile->weight))
                                        <li class="mx-2">
                                            <div class="bg-myBlue text-white p-1 rounded mt-3">
                                                <span>وزن:</span>
                                                <span>{{ $user->AProfile->weight }}</span>
                                            </div>
                                        </li>
                                    @endif
                                    @if(isset($user->AProfile->account_number))
                                        <li class="mx-2">
                                            <div class="bg-myBlue text-white p-1 rounded mt-3">
                                                <span> شماره حساب:</span>
                                                <span>{{ $user->AProfile->account_number }}</span>
                                            </div>
                                        </li>
                                    @endif
                                    <li class="mx-2">
                                        <div class="bg-myBlue text-white p-1 rounded mt-3">
                                            <span>شبکه های اجتماعی:</span>
                                            <ul>
                                                @foreach($user->AProfile->socials as $name => $link)
                                                    <li>
                                                    <span>
                                                    {{ $name.' : '.$link }}
                                                    </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="mx-2">
                                        <div class="bg-myBlue text-white p-1 rounded mt-3">
                                            <span>ورزش حال حاضر کاربر:</span>
                                            @foreach($user->AProfile->sports() as $sport)
                                                <span class="badge badge-primary">{{ $sport->name }}</span>
                                            @endforeach
                                        </div>
                                    </li>
                                    @if(isset($user->AProfile->city))
                                        <li class="mx-2">
                                            <div class="bg-myBlue text-white p-1 rounded mt-3">
                                                <span>شهر و استان:</span>
                                                <span>{{ $user->AProfile->city->name }},{{ $user->AProfile->city->province->name }}</span>
                                            </div>
                                        </li>
                                    @endif
                                    @if(isset($user->AProfile->district))
                                        <li class="mx-2">
                                            <div class="bg-myBlue text-white p-1 rounded mt-3">
                                                <span>محله:</span>
                                                <span>{{ $user->AProfile->district }}</span>
                                            </div>
                                        </li>
                                    @endif
                                    <li class="mx-2">
                                        <div class="bg-myBlue text-white p-1 rounded mt-3">
                                            <span>شغل:</span>
                                            <span>{{ $user->AProfile->job }}</span>
                                        </div>
                                    </li>
                                    <li class="mx-2">
                                        <div class="bg-myBlue text-white p-1 rounded mt-3">
                                            <span>علاقه مندی های ورزشی:</span>
                                            <span>{{ $user->AProfile->interest_sports }}</span>
                                        </div>
                                    </li>
                                    <li class="mx-2">
                                        <div class="bg-myBlue text-white p-1 rounded mt-3">
                                            <span>مدرک:</span>
                                            <span>{{ $user->AProfile->education }}</span>
                                        </div>
                                    </li>
                                    <li class="mx-2">
                                        <div class="bg-myBlue text-white p-1 rounded mt-3">
                                            <span>سابقه پزشکی:</span>
                                            <span>{{ $user->AProfile->medical_background }}</span>
                                        </div>
                                    </li>
                                    <li class="mx-2">
                                        <div class="bg-myBlue text-white p-1 rounded mt-3">
                                            <span>درباره کاربر:</span>
                                            <span>{{ $user->AProfile->aboutme }}</span>
                                        </div>
                                    </li>

                                    @if(isset($user->AProfile->background))
                                        <li class="mx-2">
                                            <div class="bg-myBlue text-white p-1 rounded mt-3">
                                                <span>سابقه کار:</span>
                                                <span>{{ $user->AProfile->background }}</span>
                                            </div>
                                        </li>
                                    @endif
                                    @if(isset($user->AProfile->major))
                                        <li class="mx-2">
                                            <div class="bg-myBlue text-white p-1 rounded mt-3">
                                                <span>تخصص:</span>
                                                <span>{{ $user->AProfile->major }}</span>
                                            </div>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>

                        <br><br>
                    </div>

                </section>
            </div>
        </div>
    </div>
        
    </section>

@endsection
@section('end_script')
  
@endsection