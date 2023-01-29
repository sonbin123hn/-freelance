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
                            Trang chủ
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Nhân viên</li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm nhân viên</li>
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
                    <label class="col-md-12">Đường dẫn</label>
                    <div class="col-md-12">
                        <input type="text" name="link" placeholder="Đường dẫn facebook/zalo" class="form-control form-control-line">
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label class="col-md-12">Tên nhân viên</label>
                    <div class="col-md-12">
                        <input type="text" name="name" placeholder="Tên nhân viên" class="form-control form-control-line">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label class="col-sm-12">Chọn loại</label>
                    <div class="col-sm-12">
                        <select class="form-control form-control-line" name="type">
                            <option value="">-- Loại --</option>
                            <option value="1">faceBook</option>
                            <option value="2">zalo</option>

                        </select>
                    </div>
                </div>
            </div>
        </div>



        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success">Thêm nhân viên</button>
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