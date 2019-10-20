@extends('layouts.admin')
@section('end_script')
    <script src="{{asset('/vendor/laravel-filemanager/js/lfm.js')}}"></script>
    <script>
        $('.lfm').filemanager('image');
    </script>
@endsection
@section('content')
    <div id="content"><br>
        <div class="inner" style="min-height: 565px;">
            <div class="row">
                <section id="lts_sec " class="right" style="margin: 10px auto;">
                    <div class="container ">
                        <div class="row ">
                            <div class="col-lg-12 col-md-12  col-sm-12 col-xs12 ">
                                <div class="title_sec">
                                    @can('افزودن نقش های مدیران سایت')
                                    <a data-toggle="modal" data-target=".add-page" style="float: left" class="btn btn-primary"><i class="fa fa-plus"></i> افزودن نقش </a>
                                    @endcan
                                    <h1>مدیریت  نقش های کاربران </h1>
                                </div>
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                           id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">&nbspنام</th>
                                            <th style="text-align: center">&nbsp;تاریخ ایجاد</th>
                                            <th style="text-align: center"> اعمال</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($roles as $role)
                                            <tr class="odd gradeX">
                                                <th style="text-align: center"> &nbsp; <strong >{{$role->name}} </strong></th>
                                                <th style="text-align: center; font-weight: 100">{!!  to_jalali_date($role->created_at) !!}</th>
                                               <th style="text-align: center; font-weight: 100">
                                                   @can('ویرایش نقش های مدیران سایت')
                                                   <a data-toggle="modal" data-target=".edit-page-{{$role->id}}" class="btn btn-warning "><i class="fa fa-edit"></i>ویرایش</a>
                                                   @endcan
                                                   @can('حذف نقش های مدیران سایت')
                                                    <form method="POST" action="{{ route('rolePermission.role.delete',['id' =>$role->id]) }}" id="'delete-{{$role->id}}'">
                                                        <button onclick="return confirm('آیا از حذف این صفحه مطمئن هستید؟');"   class="btn btn-danger"><i class="fa fa-remove"></i>حذف</button>
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                    </form>
                                                   @endcan
                                                </th>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{$roles->links()}}
                        <br><br>
                    </div>

                </section>
            </div>
        </div>
    </div>







    @can('افزودن نقش های مدیران سایت')
    <div class="modal fade add-page" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>

                <form name="_token" method="POST" enctype="multipart/form-data"
                      action="{{route('rolePermission.role.add')}}">
                    {{ csrf_field() }}
                    <div class="modal-body">


                        <input type="hidden" name="_token" value="{{ csrf_token() }} ">

                        <div class="col-md-12" style="margin-bottom: 30px">
                            <div class="input-group"><p style="float: right">نام</p>
                                <input required name="name" type="text" value="{{old('name')}}"  class="form-control">
                            </div>
                            <div class="input-group row">
                                <div class="col-md-12"><p>دسترسی ها</p></div>
                                @foreach($permissions as $permission)
                                    <div class="col-md-3 col-sm-6">
                                        <label for="{{ $permission->name }}">{{ $permission->name }}</label>
                                        <input id="{{ $permission->name }}" type="checkbox" name="permissions[]" value="{{$permission->id}}" @if(is_array(old('permissions')) && in_array($permission->id,old('permissions'))) checked @endif>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" >
                        <a type="button" class="btn red-bg" data-dismiss="modal">بستن</a>
                        <button  type="submit"  name="_token" value="{{ csrf_token() }}" class="btn  blue-bg">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endcan
    @can('ویرایش نقش های مدیران سایت')
    @foreach($roles as $role)


        <div class="modal fade edit-page-{{$role->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>

                    <form name="_token" method="POST" enctype="multipart/form-data"
                          action="{{route('rolePermission.role.update',['id'=>$role->id])}}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="modal-body">


                            <input type="hidden" name="_token" value="{{ csrf_token() }} ">

                            <div class="col-md-12" style="margin-bottom: 30px">
                                <div class="input-group"><p style="float: right">نام</p>
                                    <input required name="name" type="text" value="{{$role->name}}"  class="form-control">
                                </div>
                                <div class="input-group row">
                                    <div><p>دسترسی ها</p></div>
                                    @foreach($permissions as $permission)
                                        <div class="col-md-3 col-sm-6">
                                            <label for="{{ $permission->name.$role->id}}">{{ $permission->name }}</label>
                                            <input id="{{ $permission->name.$role->id}}" type="checkbox" name="permissions[]" value="{{$permission->id}}" @if($role->hasPermissionTo($permission->name)) checked @endif>
                                        </div>
                                        @endforeach
                                </div>
                            </div>


                            <div class="col-md-3">
                            </div>

                        </div>
                        <div class="modal-footer" >
                            <a type="button" class="btn red-bg" data-dismiss="modal">بستن</a>
                            <button  type="submit"  name="_token" value="{{ csrf_token() }}" class="btn  blue-bg">ثبت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    @endforeach
    @endcan


@endsection