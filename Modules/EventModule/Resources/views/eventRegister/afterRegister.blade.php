@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $event->title }}</div>

                <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>کد ملی</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($eventRegister->infos as $info)
                                <tr>
                                    <td>
                                        <h4>{{ $info->name }}</h4>
                                    </td>
                                    <td>
                                        <h4>{{ $info->national_code }}</h4>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
