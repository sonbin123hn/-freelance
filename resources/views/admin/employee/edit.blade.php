@extends('admin.layouts.master')

@section('page-breadcrum')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Nhân Viên</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            Home
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Nhân Viên</li>
                        <li class="breadcrumb-item" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('container-fluid')
<div class="container-fluid">
    <!-- hien thi thong bao -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
        {{session('success')}}
    </div>
    @endif
    <!-- hien thi loi request -->
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="col-md-12">Link Facebook</label>
                    <div class="col-md-12">
                        <input type="text" name="link" value="{{ $employee->link }}" placeholder="Please enter service " class="form-control form-control-line">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('footer')
<footer class="footer text-center">
    All Rights Reserved by Nice admin. Designed and Developed by
    <a href="">STK</a>.
</footer>
@endsection