@extends('admin.layouts.master')

@section('page-breadcrum')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">users Management</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            Home
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">users Management</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('container-fluid')
<div class="container-fluid">
    <div class="table-responsive">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Notification!</h4>
            {{session('success')}}
        </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">phoneNumber</th>
                    <th scope="col">idFront</th>
                    <th scope="col">idBack</th>
                    <th scope="col">face</th>
                    <th scope="col">userName</th>
                    <th scope="col">cccd</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $k=>$value)
                <tr>
                    <th scope="row">{{ Helper::stt($k, $users->currentPage()) }}</th>
                    <td>{{$value['phoneNumber']}}</td>
                    <td><img src="{{$value['idFront']}}" width="100" /></td>
                    <td><img src="{{$value['idBack']}}" width="100" /></td>
                    <td><img src="{{$value['face']}}" width="100" /></td>
                    <td>{{$value['userName']}}</td>
                    <td>{{$value['cccd']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        You are on page {{$users->currentPage()}}
        <a style="font-size: 20px;margin-right: 20px;" href="{{$users->previousPageUrl()}}" id="previousPagebtn">
            </a> <a style="font-size: 20px;" href="{{$users->nextPageUrl()}}" id="nextPagebtn">>
                </a>
    </div>

</div>
@endsection
@section('footer')
<footer class="footer text-center">
    All Rights Reserved by Nice admin. Designed and Developed by
    <a href="">STK</a>.
</footer>
@endsection