@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $event->title }}</div>

                <div class="card-body">
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>کد ملی</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0; $i < $quantity ; $i++)
                                <tr>
                                    <td>
                                        <input type="text" name="infos[{{ $i }}][name]">
                                    </td>
                                    <td>
                                        <input type="text" name="infos[{{ $i }}][national_code]">
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                        <button class="btn btn-success">ثبت نام</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
