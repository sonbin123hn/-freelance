@extends('admin.layouts.master')

@section('page-breadcrum')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Teacher Management</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            Home
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Teacher Management</li>
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
        <label class="col-sm-12">Select Status</label>
        <div class="col-sm-12 form-group">
            <select name="status" class="form-control form-control-line">
                @if($contracts->status == 0)
                <option value="0">Pending</option>
                <option value="1">cancel</option>
                <option value="2">Success</option>

                @elseif($contracts->status == 1)
                <option value="1">cancel</option>
                <option value="2">Success</option>
                <option value="0">Pending</option>
                @else
                <option value="2">Success</option>
                <option value="0">Pending</option>
                <option value="1">cancel</option>

                @endif
            </select>
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
    Việt thành
    
</footer>
@endsection