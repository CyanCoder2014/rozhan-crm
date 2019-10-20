@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $event->title }}</div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>وضعیت</td>
                            <td>{{ $event->statusAlias() }}</td>
                        </tr>
                        <tr>
                            <td>توضیحات</td>
                            <td>{{ $event->description }}</td>
                        </tr>
                        <tr>
                            <td>دسته بندی</td>
                            <td>{{ $event->category->name }}</td>
                        </tr>
                        <tr>
                            <td>ظرفیت</td>
                            <td>{{ $event->capacity }}</td>
                        </tr>
                        <tr>
                            <td>قیمت</td>
                            <td>{{ $event->price }}</td>
                        </tr>
                        <tr>
                            <td>استان, شهر</td>
                            <td>{{ $event->city->name.' , '.$event->province->name }}</td>
                        </tr>
                        <tr>
                            <td>آدرس</td>
                            <td>{{ $event->address }}</td>
                        </tr>
                        <tr>
                            <td>زمان شروع رویداد</td>
                            <td>{!! to_jalali($event->event_start_at) !!}</td>
                        </tr>
                        <tr>
                            <td>زمان پایان رویداد</td>
                            <td>{!! to_jalali($event->event_event_at) !!}</td>
                        </tr>
                        <tr>
                            <td>زمان شروع ثبت نام</td>
                            <td>{!! to_jalali($event->end_registration) !!}</td>
                        </tr>
                        <tr>
                            <td>زمان پایان ثبت نام</td>
                            <td>{!! to_jalali($event->start_registration) !!}</td>
                        </tr>
                        </tbody>
                    </table>
                    <form action="{{ route('eventmodule.event.register',['event'=> $event->id]) }}">
                        <div>
                            <label for="">تعداد</label>
                            <input type="text" name="quantity">

                        </div>
                        <button class="btn btn-success">ثبت نام</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
