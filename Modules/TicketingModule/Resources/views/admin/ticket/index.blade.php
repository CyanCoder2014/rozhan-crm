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
                                    <div class="col-lg-12 col-md-12  col-sm-12 col-xs12 ">
                                        <div class="title_sec">
                                            مدیریت تیکت ها
                                        </div>

                                        @can('افزودن تیکت')
                                        <a data-toggle="modal"
                                           data-target="#{{1}}" style="float: left"
                                           class="btn btn-primary  btn-sm"><i class="icon-plus"></i>&nbsp;&nbsp; افزودن تیکت </a>
                                        @endcan






                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>شماره</th>
                                                        <th>عنوان</th>
                                                        <th>وضعیت</th>
                                                        <th>فرستنده</th>
                                                        <th>پاسخ دهنده</th>
                                                        <th>تاریخ ایجاد</th>
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
                                                                <select name="status[]" id="" class="form-control select2" multiple>
                                                                    <option value="0" @if(in_array(0,request()->get('status',[]))) selected @endif>فرستاده شده</option>
                                                                    <option value="1" @if(in_array(1,request()->get('status',[]))) selected @endif>پاسخ داده شده</option>
                                                                    <option value="2" @if(in_array(2,request()->get('status',[]))) selected @endif>به اتمام رسیده</option>
                                                                </select>
                                                            </th>
                                                            <th width="12%">
                                                                <select name="owner" id="" class="form-control user-find">

                                                                </select>
                                                            </th>
                                                            <th width="12%">
                                                                <select name="answerable" id="" class="form-control user-find">

                                                                </select>
                                                            </th>
                                                            <th width="20%">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <label class="control-label">از تاریخ</label>
                                                                        <input name="date_from" type="text" class="form-control" id="dateRangePicker" value="{{ request()->get('date_from') }}" />
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label class="control-label">تا تاریخ</label>
                                                                        <input name="date_to" type="text" class="form-control" id="dateRangePickerEnd" value="{{ request()->get('date_to') }}" />
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th>
                                                                <button class="btn btn-primary" type="submit">فیلتر</button>
                                                            </th>
                                                        </tr>
                                                    </form>

                                                </thead>
                                                <tbody>
                                                    @foreach($tickets as $ticket)
                                                        <tr>
                                                            <td>{{ $ticket->id }}</td>
                                                            <td>{{ $ticket->messages()->first()->title }}</td>
                                                            <td>
                                                                @switch($ticket->status)
                                                                    @case(0)
                                                                        <span class="badge badge-primary">فرستاده شده</span>
                                                                    @break
                                                                    @case(1)
                                                                        <span class="badge badge-primary">پاسخ داده شده</span>
                                                                    @break
                                                                    @case(2)
                                                                        <span class="badge badge-primary">به اتمام رسیده</span>
                                                                    @break
                                                                @endswitch
                                                            </td>
                                                            <td>{{ $ticket->owner->name }}</td>
                                                            <td>{{ $ticket->answerable->name??'نامشخص' }}</td>
                                                            <td>{{ to_jalali_date($ticket->created_at) }}</td>
                                                            <td>
                                                                @can('نمایش پاسخ تیکت|پاسخ به تیکت')
                                                                <a href="{{ route('ticketingmodule.admin.ticket.show',['ticket' => $ticket->id]) }}">
                                                                    <button class="btn btn-success">نمایش پیام ها</button>
                                                                </a>
                                                                @can('حذف تیکت')
                                                                <a href="{{ route('ticketingmodule.admin.ticket.delete',['ticket' => $ticket->id]) }}" onclick="confirm('ایا از حذف اطمینان دارید؟')">
                                                                    <button class="btn btn-danger" >حذف</button>
                                                                </a>
                                                                @endcan

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        {{$tickets->links()}}
                                    </div>
                                </div>


                            </div>


                        </section>
                    </div>
                </div>
            </div>

        @can('افزودن تیکت')
            <!-- modal -->
            <div class="modal fade" id="{{1}}" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">  افزودن تیکت</h4>
                        </div>
                        <div class="modal-body">

                            <form method="POST"
                                  enctype="multipart/form-data"
                                  action="{{ route('ticketingmodule.admin.ticket.store') }}">
                                {{ csrf_field() }}


                                <div class="">

                                    <div class="col-lg-8 col-md-8  col-sm-12 col-xs-12">
                                        <div class="row">
                                            <label> عنوان</label>
                                            <input class="form-control" name="title">
                                        </div>
                                       <div class="row">
                                           <label> توضیحات  </label>
                                           <textarea class="form-control" name="description"></textarea>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-6">
                                               <label> دسته بندی </label>
                                               <select name="category_id" id="">
                                                   @foreach($categories as $category)
                                                       <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                           <div class="col-md-6">
                                               <label>کاربر</label>
                                               <select name="answerable_id" id="" class="form-control user-find">

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
        @endcan













        </div>
    </section>

@endsection
@section('script')
    <script src="/datepicker/jquery.md.bootstrap.datetimepicker.js"></script>
    <script src="/select2/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $('.user-find').select2({
                placeholder: "کاربر ...",
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route('ticketingmodule.admin.user.find') }}',
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
            $("#dateRangePicker").MdPersianDateTimePicker({
                targetTextSelector: '#dateRangePicker',
            });
            $("#dateRangePickerEnd").MdPersianDateTimePicker({
                targetTextSelector: '#dateRangePickerEnd',
            });
        });
    </script>
@endsection