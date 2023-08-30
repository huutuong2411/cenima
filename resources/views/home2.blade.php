@extends('layouts.main')

@section('content')

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Xem</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $value)
        <tr>
            <th scope="row">{{$value->id}}</th>
            <td>{{$value->name}}</td>
            <td>{{$value->email}}</td>
            <td>{{$value->phone}}</td>
            <td><a href="{{url("/users/{$value->id}")}}" type="button" class="btn btn-success">Xem</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$result->links('pagination::bootstrap-4')}}
<a class="btn btn-warning" href="{{url("/users/create")}}">Thêm</a>
<a class="btn btn-success" href="{{route('get_send_email')}}">Spam email</a>
@endsection