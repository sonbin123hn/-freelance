@extends('admin.layouts.master')

@section('page-breadcrum')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Employees Management</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            Home
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Employees Management</li>
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
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success"><a style="color: white;" href="{{ url('/admin/employee/add')}}">Add Employees</a></button>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Link Facebook</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $k=>$value)
                <tr>
                    <th scope="row">{{ Helper::stt($k, $employees->currentPage()) }}</th>
                    <td>{{$value['link']}}</td>
                    <td>
                        <a href="{{ route('admin.employee.edit', ['id' => $value['id']]) }}"><i style="font-size:22px" class="fa">&#xf044;</i></a>
                        @if($value['active'] == 1)
                        <a href="{{ route('admin.employee.lock', ['id' => $value['id']]) }}" onclick="return confirm('Do you want to unlock this Member Account ?')"><i style="font-size:22px" class="fa fa-unlock-alt fa-2x"></i></a>
                        @else
                        <a href="{{ route('admin.employee.lock', ['id' => $value['id']]) }}" onclick="return confirm('Do you want to lock this Member Account ?')"><i style="font-size:22px" class="fa fa-lock fa-2x"></i></a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        You are on page {{$employees->currentPage()}}
        <a style="font-size: 20px;margin-right: 20px;" href="{{$employees->previousPageUrl()}}" id="previousPagebtn">
            </a> <a style="font-size: 20px;" href="{{$employees->nextPageUrl()}}" id="nextPagebtn">>
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