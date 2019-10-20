@extends('layouts.admin')

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
                            <a href="#">رویداد</a>
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
                                    <div class="col-lg-12 col-md-12  col-sm-12 col-xs12 ">
                                        <div class="title_sec">
                                            مدیریت تیکت ها
                                        </div>

                                        <a data-toggle="modal"
                                           data-target="#{{1}}" style="float: left"
                                           class="btn btn-primary  btn-sm"><i class="icon-plus"></i>&nbsp;&nbsp; افزودن تیکت </a>


                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>شماره</th>
                                                        <th>عنوان</th>
                                                        <th>وضعیت</th>
                                                        <th>دسته بندی</th>
                                                        <th>شهر</th>
                                                        <th>شروع ثبت نام</th>
                                                        <th>مهلت ثبت نام</th>
                                                        <th>ظرفیت</th>
                                                        <th>تعداد ثبت نامی ها</th>
                                                        <th>عملیات</th>
                                                    </tr>
                                                    <form>
                                                        <tr>
                                                            <th width="7%">
                                                                <input type="text" name="id" class="form-control" value="{{ request()->get('id') }}">
                                                            </th>
                                                            <th width="15%">
                                                                <input type="text" name="title" class="form-control" value="{{ request()->get('title') }}">
                                                            </th>
                                                            <th width="15%">
                                                                <select name="status" id="" class="form-control select2">
                                                                    <option value="">همه</option>
                                                                    <option value="0" @if(  0 ==  request()->get('status')) selected @endif>غیر فعال</option>
                                                                    <option value="1" @if(  1 ==  request()->get('status')) selected @endif>فعال</option>
                                                                </select>
                                                            </th>
                                                            <th width="12%">
                                                                <select name="category_id" id="" class="form-control user-find">
                                                                    <option value="">همه</option>
                                                                    @foreach($categories as $category)
                                                                        <option value="{{ $category->id }}" @if(  $category->id ==  request()->get('category_id')) selected @endif>{{ $category->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </th>
                                                            <th width="12%">
                                                                <select name="city_id" id="" class="form-control city-find">

                                                                </select>
                                                            </th>
                                                            <th width="10%">
                                                                <label class="control-label">از تاریخ</label>
                                                                <input name="start_from" type="text" class="form-control" id="datePicker-from" value="{{ request()->get('start_from') }}" />
                                                            </th>
                                                            <th width="10%">
                                                                <label class="control-label">تا تاریخ</label>
                                                                <input name="end_to" type="text" class="form-control" id="datePicker-to" value="{{ request()->get('end_to') }}" />
                                                            </th>
                                                            <th colspan="3">
                                                                <button class="btn btn-primary" type="submit">فیلتر</button>
                                                            </th>
                                                        </tr>
                                                    </form>

                                                </thead>
                                                <tbody>
                                                    @foreach($events as $event)
                                                        <tr>
                                                            <td>{{ $event->id }}</td>
                                                            <td>{{ $event->title }}</td>
                                                            <td>
                                                                @switch($event->status)
                                                                    @case(0)
                                                                        <span class="badge badge-danger">غیرفعال</span>
                                                                    @break
                                                                    @case(1)
                                                                        <span class="badge badge-primary">فعال</span>
                                                                    @break
                                                                @endswitch
                                                            </td>
                                                            <td>{{ $event->category->name }}</td>
                                                            <td>{{ $event->city->name }}</td>
                                                            <td>{!! to_jalali($event->start_registration) !!}</td>
                                                            <td>{!! to_jalali($event->end_registration) !!}</td>
                                                            <td>{{ $event->capacity }}</td>
                                                            <td>{{ $event->SuccessRegistered->sum('quantity') }}</td>
                                                            <td>
                                                                <a href="{{ route('eventmodule.admin.event.edit',['event' => $event->id]) }}">
                                                                    <button class="btn btn-success">ویرایش</button>
                                                                </a>
                                                                <a href="{{ route('eventmodule.admin.event.delete',['event' => $event->id]) }}" onclick="confirm('ایا از حذف اطمینان دارید؟')">
                                                                    <button class="btn btn-danger" >حذف</button>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        {{$events->links()}}
                                    </div>
                                </div>


                            </div>


                        </section>
                    </div>
                </div>
            </div>

            <!-- modal -->
            <div class="modal fade" id="{{1}}" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">  افزودن رویداد</h4>
                        </div>
                        <div class="modal-body">

                            <form method="POST"
                                  enctype="multipart/form-data"
                                  action="{{ route('eventmodule.admin.event.store') }}">
                                {{ csrf_field() }}


                                <div class="">

                                    <div class="col-lg-12  col-sm-12 col-xs-12">
                                        <div class="row">
                                            <label> عنوان</label>
                                            <input class="form-control" name="title" value="{{ old('title') }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>زمان شروع رویداد</label>
                                                <input type="text" name="event_start_at" class="form-control" id="datepicker-1" value="{{ old('event_start_at') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>زمان پایان رویداد</label>
                                                <input type="text" name="event_end_at" class="form-control" id="datepicker-2" value="{{ old('event_end_at') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>زمان شروع ثبت نام</label>
                                                <input type="text" name="start_registration" class="form-control" id="datepicker-3" value="{{ old('start_registration') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>زمان پایان ثبت نام</label>
                                                <input type="text" name="end_registration" class="form-control" id="datepicker-4" value="{{ old('end_registration') }}">
                                            </div>
                                        </div>
                                       <div class="row">
                                           <label> توضیحات  </label>
                                           <textarea class="form-control ck-editor" name="description">{{ old('description') }}</textarea>
                                       </div>
                                       <div class="row">

                                           <div class="col-md-4">
                                               <label> دسته بندی </label>
                                               <select name="category_id" id="" class="form-control">
                                                   @foreach($categories as $category)
                                                       <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                           <div class="col-md-4">
                                               <label>ظرفیت</label>
                                               <input name="capacity" id="" type="number" class="form-control" value="{{ old('capacity') }}">

                                           </div>
                                           <div class="col-md-4">
                                               <label>حد تعداد ثبت نامی</label>
                                               <input name="quantity_limit" id="" type="number" class="form-control" value="{{ old('quantity_limit') }}">

                                           </div>
                                           <div class="col-md-4">
                                               <label>قیمت</label>
                                               <input name="price" id="" type="number" class="form-control" value="{{ old('price') }}">

                                           </div>
                                           <div class="col-md-4">
                                               <label>شهر</label>
                                               <select name="city_id" id="" class="form-control city-find">

                                               </select>
                                           </div>
                                           <div class="col-md-4">
                                               <label>آدرس</label>
                                               <textarea name="address" id="" class="form-control">{{ old('address') }}</textarea>

                                           </div>

                                           <div class="col-md-4">
                                               <label>وضعیت</label>
                                               <select name="status" id="" class="form-control" >
                                                   <option value="0" @if(old('status') == 0) selected @endif>غیرفعال</option>
                                                   <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                                               </select>
                                           </div>

                                       </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="_token"
                                            value="{{ csrf_token() }}"
                                            class="btn btn-primary">افزودن
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













        </div>
    </section>

@endsection
@section('script')
    <script src="/datepicker/jquery.md.bootstrap.datetimepicker.js"></script>
    <script src="/select2/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $('.city-find').select2({
                placeholder: "شهر ...",
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route('city.find') }}',
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
            $("#datepicker-1").MdPersianDateTimePicker({
                targetTextSelector: '#datepicker-1',
                enableTimePicker: true,
            });
            $("#datepicker-2").MdPersianDateTimePicker({
                targetTextSelector: '#datepicker-2',
                enableTimePicker: true,
            });
            $("#datepicker-3").MdPersianDateTimePicker({
                targetTextSelector: '#datepicker-3',
                enableTimePicker: true,
            });
            $("#datepicker-4").MdPersianDateTimePicker({
                targetTextSelector: '#datepicker-4',
                enableTimePicker: true,
            });
            $("#datePicker-from").MdPersianDateTimePicker({
                targetTextSelector: '#datePicker-from',
            });
            $("#datePicker-to").MdPersianDateTimePicker({
                targetTextSelector: '#datePicker-to',
            });
        });
    </script>
@endsection