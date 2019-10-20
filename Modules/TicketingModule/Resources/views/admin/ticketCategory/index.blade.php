@extends('layouts.admin')

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
                            <a href="#"> دسته بندی تیکت</a>
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
                                            مدیریت دسته بندی تیکت ها
                                        </div>

                                        <a data-toggle="modal"
                                           data-target="#{{1}}" style="float: left"
                                           class="btn btn-primary  btn-sm"><i class="icon-plus"></i>&nbsp;&nbsp; افزودن دسته بندی </a>






                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>نام</th>
                                                                <th>توضیحات</th>
                                                                <th>عملیات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($categories as $category)

                                                                <tr>
                                                                    <td>{{ $category->name }}</td>
                                                                    <td>{{ $category->description }}</td>
                                                                    <td>
                                                                        <button class="btn btn-success" data-toggle="modal" data-target="#editModal{{ $category->id }}">ویرایش</button>
                                                                        <a href="{{ route('ticketingmodule.admin.category.delete',['id' => $category->id]) }}" onclick="confirm('ایا از حذف اطمینان دارید؟')">
                                                                            <button class="btn btn-danger" >حذف</button>
                                                                        </a>

                                                                    </td>
                                                                </tr>

                                                            @endforeach
                                                        </tbody>
                                                    </table>















                                        {{$categories->links()}}
                                    </div>
                                </div>


                            </div>


                        </section>
                    </div>
                </div>
            </div>

            <!-- modal -->
            <div class="modal fade" id="{{1}}" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">  افزودن دسته بندی</h4>
                        </div>
                        <div class="modal-body">

                            <form method="POST"
                                  enctype="multipart/form-data"
                                  action="{{ route('ticketingmodule.admin.category.store') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="_token"
                                       value="{{ csrf_token() }} ">
                                <input type="hidden" name="state"
                                       value="1">

                                <div class="">

                                    <div class="col-lg-8 col-md-8  col-sm-12 col-xs12">
                                        <div class="row">
                                            <label> عنوان دسته بندی</label>
                                            <input class="form-control" name="name">
                                        </div>
                                       <div class="row">
                                           <label> توضیحات  </label>
                                           <textarea class="form-control" name="description"></textarea>
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









            @foreach($categories as $category)
                <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">  ویرایش دسته بندی</h4>
                            </div>
                            <div class="modal-body">

                                <form method="POST"
                                      enctype="multipart/form-data"
                                      action="{{ route('ticketingmodule.admin.category.update',['id' => $category->id]) }}">
                                    {{ csrf_field() }}

                                    <div class="">

                                        <div class="col-lg-8 col-md-8  col-sm-12 col-xs12">
                                            <div class="row">
                                                <label> عنوان دسته بندی</label>
                                                <input class="form-control" name="name" value="{{ $category->name }}">
                                            </div>
                                            <div class="row">
                                                <label> توضیحات  </label>
                                                <textarea class="form-control" name="description">{{ $category->description }}</textarea>
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
                </div>


            @endforeach



        </div>
    </section>

@endsection