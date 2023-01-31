@extends('admin.layouts.master')
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<style>
    .font-size-14{font-size: 14px;}
    .max-height-25{max-height: 25px;}
    .c-bg-success{background-color:#28a7451a!important}
</style>
@section('page-breadcrum')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Khách hàng</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            Home
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Khách hàng</li>
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
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
            {{session('error')}}
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
    <div class="row" style="width: 106%;">
        <div class="col-md-8 shadow p-3 mb-5 bg-white rounded ml-4 mr-4">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12 mb-5">
                        <div class="avata">
                            <p class="c-bg-success m-auto text-center text-success" style="max-width: 130px;">Đã xác minh</p>
                            <img class="mt-2" style="display: block;margin-left: auto;margin-right: auto;border-radius: 50%;width: 120px;object-fit: cover;height: 120px;" src="https://api.vietthanhcredit.online/file-1673149298131.jpg">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Số CMND</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="name" value="{{$user->cccd ?? ''}}" placeholder="Số CMND " class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Ngày sinh</p>
                            </div>
                            <div class="col-8">
                                @php
                                    $birth = (string) $user->birth;
                                    $birth = date('Y-m-d', '1673160001');
                                @endphp
                                <input type="date" name="name" value="{{ $birth }}" placeholder="Ngày sinh " class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Địa chỉ</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="name" value="{{$user->address ?? ''}}" placeholder="Địa chỉ" class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Nghề nghiệp</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="name" value="{{$user->job ?? ''}}" placeholder="Nghề nghiệp" class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Giới tính</p>
                            </div>
                            <div class="col-8">
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option selected>Giới tính</option>
                                    <option value="1" {{($user->sex == 1) ?? 'selected'}}>Nam</option>
                                    <option value="2" {{($user->sex == 2) ?? 'selected'}}>Nữ</option>
                                    <option value="3" {{($user->sex == 3) ?? 'selected'}}>Khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Thu nhập</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="name" value="" placeholder="Đường dẫn facebook/zalo " class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Mục đích vay</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="name" value="" placeholder="Mục đích vay " class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">SĐT người thân</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="name" value="" placeholder="SĐT người thân " class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Mối quan hệ với người thân</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="name" value="" placeholder="Mối quan hệ với người thân" class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <h3 class="text-center mb-3 font-weight-bold">Thông tin tài khoản thụ hưởng</h3>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Ngân hàng</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="name" value="" placeholder="Ngân hàng" class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Tên người thụ hưởng</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="name" value="" placeholder="Tên người thụ hưởng" class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Số tài khoản</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="name" value="" placeholder="Số tài khoản" class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3 shadow p-3 mb-5 bg-white rounded">
            <div class="main-gallery">
                <div class="gallery-cell w-100">
                    <img class="gallery-cell-image w-100" src="https://i.imgur.com/9xYjgCk.jpg" data-flickity-lazyload="https://i.imgur.com/9xYjgCk.jpg" />
                </div>
                <div class="gallery-cell w-100">
                    <img class="gallery-cell-image w-100" src="https://i.imgur.com/9xYjgCk.jpg" data-flickity-lazyload="https://i.imgur.com/9xYjgCk.jpg" />
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('footer')
<footer class="footer text-center">
    Việt thành
    
</footer>
@endsection
@section('script')
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            var elem =  document.querySelector('.main-gallery');
            var flkty = new Flickity( elem, {
                cellAlign: 'left',
                contain: true,
                wrapAround: true,
            });
            var flkty = new Flickity( '.main-gallery', {});
        }, 500);
        
    })
</script>
@endsection
