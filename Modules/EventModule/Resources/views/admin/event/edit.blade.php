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
                        <li>
                            <a href="#">ویرایش</a>
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
                                            ویرایش تیکت
                                        </div>
                                        <form method="POST"
                                              enctype="multipart/form-data"
                                              action="{{ route('eventmodule.admin.event.update',['event' => $event->id]) }}">
                                            {{ csrf_field() }}


                                            <div class="">

                                                <div class="col-lg-12  col-sm-12 col-xs-12">
                                                    <div class="row">
                                                        <label> عنوان</label>
                                                        <input class="form-control" name="title" value="{{ $event->title }}">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>زمان شروع رویداد</label>
                                                            <input type="text" name="event_start_at" class="form-control" id="datepicker-1" value="{{ to_jalali_datetime($event->event_start_at) }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>زمان پایان رویداد</label>
                                                            <input type="text" name="event_end_at" class="form-control" id="datepicker-2" value="{{ to_jalali_datetime($event->event_end_at) }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>زمان شروع ثبت نام</label>
                                                            <input type="text" name="start_registration" class="form-control" id="datepicker-3" value="{{ to_jalali_datetime($event->start_registration) }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>زمان پایان ثبت نام</label>
                                                            <input type="text" name="end_registration" class="form-control" id="datepicker-4" value="{{ to_jalali_datetime($event->end_registration) }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label> توضیحات  </label>
                                                        <textarea class="form-control ck-editor" name="description">{{ $event->description }}</textarea>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-4">
                                                            <label> دسته بندی </label>
                                                            <select name="category_id" id="" class="form-control">
                                                                @foreach($categories as $category)
                                                                    <option value="{{ $category->id }}" @if($category->id == $event->category_id) selected @endif>{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>ظرفیت</label>
                                                            <input name="capacity" id="" type="number" class="form-control" value="{{ $event->capacity }}">

                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>حد تعداد ثبت نامی</label>
                                                            <input name="quantity_limit" id="" type="number" class="form-control" value="{{ $event->quantity_limit }}">

                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>قیمت</label>
                                                            <input name="price" id="" type="number" class="form-control" value="{{ $event->price }}">

                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>شهر</label>
                                                            <select name="city_id" id="" class="form-control city-find" >
                                                                <option value="{{ $event->city_id }}" selected>{{ $event->city->name }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>آدرس</label>
                                                            <textarea name="address" id="" class="form-control">{{ $event->address }}</textarea>

                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>وضعیت</label>
                                                            <select name="status" id="" class="form-control" >
                                                                <option value="0" @if($event->status == 0) selected @endif>غیرفعال</option>
                                                                <option value="1" @if($event->status == 1) selected @endif>فعال</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" name="_token"
                                                        value="{{ csrf_token() }}"
                                                        class="btn btn-primary">ویرایش
                                                </button>
                                                <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">بستن
                                                </button>
                                            </div>
                                        </form>
                                        
                                    </div>
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
        });
    </script>
@endsection