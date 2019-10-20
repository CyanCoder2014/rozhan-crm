@extends('layouts.admin')
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
                            <a href="#"> مدیریت کاربران</a>
                        </li>
                    </ul>


                </div>

            </div>


        <div class="inner" style="min-height: 565px;">
            <div class="row">
                <section id="lts_sec " class="right" style="margin: -20px auto;">
                    <div class="container ">
                        <div class="row ">
                            <div class="col-lg-12 col-md-12  col-sm-12 col-xs12 ">
                                <div class="title_sec">
                                    @can('add manager')
                                    <a  data-toggle="modal" data-target="#newsletter" style="float: left" class="btn btn-primary skyblue-bg"> <i class="fa fa-send-o"></i> ایجاد کاربر  </a>
                                    @endcan
                                    <h3>اطلاعات مدیران</h3>
                                </div>
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                           id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">&nbsp; نام و نام خانوادگی</th>
                                            <th style="text-align: center">&nbspنقش ها</th>
                                            <th style="text-align: center">&nbsp; نام کاربری</th>
                                            <th style="text-align: center">&nbsp;ایمیل</th>
                                            <th style="text-align: right">تاریخ ثبت</th>
                                            <th style="text-align: center">اعمال</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr class="odd gradeX">
                                                <th style="font-weight: 100;text-align: center">
                                                    &nbsp; {{\Illuminate\Support\Str::words($user->name.' '.$user->family, $words = 6, $end = '...') }}</th>
                                                <th style="text-align: center">&nbsp;
                                                        @foreach($user->roles as $role)
                                                        <a class="badge badge-success"> {{ $role->name }}</a>
                                                        @endforeach

                                                </th>
                                                <th style="font-weight: 100; text-align: center">&nbsp; {{\Illuminate\Support\Str::words($user->username, $words = 6, $end = '...') }} </th>
                                                <th style="text-align: center"> &nbsp; {{$user->email}} </th>
                                                <th style="text-align: right; font-weight: 100">{!!  to_jalali_date($user->created_at) !!}</th>
                                                <th style="text-align: center">
                                                    @can('edit manager')
                                                        <a data-toggle="modal" data-target="#{{$user->id}}"
                                                                                  class="btn btn-warning btn-line btn-sm"
                                                                                  href="#"><i
                                                                class="fa fa-user"></i>ویرایش</a>
                                                    @endcan
                                                    @can('delete manager')
                                                        <a onclick="return confirm('آیا از حذف این کاربر مطمئن هستید؟');"
                                                            href="<?= Url('home/admin/user/delete/'.$user->id); ?>"><i
                                                                class="fa fa-remove"></i>حذف</a>
                                                    @endcan

                                                </th>
                                            </tr>
                                            @can('edit manager')
                                            <div class="modal fade" id="{{$user->id}}" tabindex="-1" role="dialog"
                                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel"> ویرایش کاربر</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form name="_token" method="POST"
                                                                  enctype="multipart/form-data"
                                                                  action="<?= Url('home/admin/user/update/'.$user->id); ?>">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="_token"
                                                                       value="{{ csrf_token() }} ">
                                                                <div class="row">
                                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label> نام کاربری</label>
                                                                            <input disabled class="form-control" name="name"
                                                                                   value="{{$user->username}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label> ایمیل </label>
                                                                            <input disabled type="email" class="form-control"
                                                                                   name="email" value="{{$user->email}}">
                                                                        </div>
                                                                        @if($user->profile !== null)
                                                                            <div class="form-group">
                                                                                <label> تلفن </label>
                                                                                <input disabled type="text" class="form-control"
                                                                                       name="tell" value="{{$user->profile->tell}}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label> تلفن همراه </label>
                                                                                <input disabled type="text" class="form-control"
                                                                                       name="mobile" value="{{$user->profile->mobile}}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label> سایت </label>
                                                                                <input disabled type="text" class="form-control"
                                                                                       name="site" value="{{$user->profile->site}}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label> طریقه آشنایی </label>
                                                                                <input disabled type="text" class="form-control"
                                                                                       name="introduce" value="{{$user->profile->introduce}}">
                                                                            </div>
                                                                        @endif
                                                                        <br>
                                                                        <label>نقش ها:</label>
                                                                            <select  name="roles[]" class="form-control role-list" multiple style="width: 100%">
                                                                                @foreach($user->roles as $role)
                                                                                    <option value="{{$role->id}}" selected="selected"> {{ $role->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        <br><br>
                                                                    </div>
                                                                </div><br><br>
                                                                <div class="modal-footer">
                                                                    <button type="submit" name="_token"
                                                                            value="{{ csrf_token() }}"
                                                                            class="btn btn-primary">ذخیره تغییرات
                                                                    </button>
                                                                    <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">بستن
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endcan

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{$users->render()}}

                        <br><br>
                    </div>

                </section>
            </div>
        </div>
    </div>




        @can('add manager')
    <div class="modal fade" id="newsletter" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">  ایجاد مدیر جدید</h4>
                </div>
                <div class="modal-body">
                    <form name="_token" method="POST"
                          enctype="multipart/form-data"
                          action="<?= Url('home/admin/users'); ?>">
                        {{ csrf_field() }}
                        <input type="hidden" name="_token"
                               value="{{ csrf_token() }} ">
                        <div class="row">
                            <div>
                                <div class="form-group required {{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label for="input-firstname" class="col-sm-2 control-label">نام کاربری</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="input-username" placeholder="نام کاربری" value="{{ old('username') }}" name="username" type="text">
                                        @if ($errors->has('username'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group required {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                    <label for="input-firstname" class="col-sm-2 control-label">نام</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="input-firstname" placeholder="نام" value="{{ old('firstname') }}" name="firstname" type="text">
                                        @if ($errors->has('firstname'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group required {{ $errors->has('lastname') ? ' has-error' : '' }}">
                                    <label for="input-firstname" class="col-sm-2 control-label"> نام خانوادگی</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="input-lastname" placeholder="نام خانوادگی" value="{{ old('lastname') }}" name="lastname" type="text">
                                        @if ($errors->has('lastname'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group required {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                    <label for="input-lastname" class="col-sm-2 control-label">تلفن همراه</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="input-lastname" placeholder="تلفن همراه"  name="mobile" value="{{ old('mobile') }}" type="text">
                                        @if ($errors->has('mobile'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group required {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="input-email" class="col-sm-2 control-label">آدرس ایمیل</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="input-email" placeholder="آدرس ایمیل" value="{{ old('email') }}" name="email" type="email">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group required {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="input-password" class="col-sm-2 control-label">رمز عبور</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="input-password" placeholder="رمز عبور" value="" name="password" type="password">
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group required {{ $errors->has('roles') ? ' has-error' : '' }}">
                                    <label for="input-email" class="col-sm-2 control-label">نقش ها:</label>
                                    <div class="col-sm-10">
                                        <select  name="roles[]" class="form-control role-list" multiple style="width: 100%">

                                        </select>
                                        @if ($errors->has('roles'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('roles') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div><br><br>
                        <div class="modal-footer">
                            <button type="submit" name="_token"
                                    value="{{ csrf_token() }}"
                                    class="btn btn-primary">ایجاد
                            </button>
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">بستن
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        @endcan





    </section>

@endsection
@section('end_script')
    <script src="/select2/select2.min.js"></script>
    <script>
        $('.role-list').select2({
            placeholder: "نقش های کاربر ...",
            minimumInputLength: 2,
            ajax: {
                url: '{{ route('rolePermission.role.find') }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    </script>
@endsection