@extends('admin.layouts.master')

@section('page-breadcrum')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Quản lý nhân viên</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            Trang chủ
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Quản lý nhân viên</li>
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
            <h4><i class="icon fa fa-check"></i> Thành công</h4>
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
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success"><a style="color: white;" href="{{ url('/admin/employee/add')}}">Thêm Nhân Viên</a></button>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Đường dẫn</th>
                    <th scope="col">Loại</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $k=>$value)
                <tr>
                    <th scope="row">{{ Helper::stt($k, $employees->currentPage()) }}</th>
                    <td>{{$value['name']}}</td>
                    <td> <a href="">{{$value['link']}}</a></td>
                    <td>
                        @if($value['type'] == 1)
                        <img style="width: 30px;" src="/uploads/icons8-zalo-50.png" alt="">
                        @else
                        <i style="font-size: 30px;" class="fa fa-facebook-official" aria-hidden="true"></i>
                        @endif
                    </td>
                    
                    <td>
                        <a href="{{ route('admin.employee.edit', ['id' => $value['id']]) }}"><i style="font-size:22px" class="fa">&#xf044;</i></a>
                        @if($value['active'] == 1)
                        <a href="{{ route('admin.employee.lock', ['id' => $value['id']]) }}" onclick="return confirm('Bạn muốn khóa nhân viên này ?')"><i style="font-size:22px" class="fa fa-unlock-alt fa-2x"></i></a>
                        @else
                        <a href="{{ route('admin.employee.lock', ['id' => $value['id']]) }}" onclick="return confirm('Bạn muốn mở khóa cho nhân viên này ?')"><i style="font-size:22px" class="fa fa-lock fa-2x"></i></a>
                        @endif
                        <a href="{{ route('admin.employee.delete', ['id' => $value['id']]) }}" onclick="return confirm('Bạn muốn xóa nhân viên này ?')"><i style="font-size:22px" class="fa fa-solid fa-trash fa-2x"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper" style="margin: 0 auto;display: table;"> {!! $employees->fragment('foo')->links('pagination::bootstrap-4') !!} </div>
    </div>

</div>
@endsection
@section('footer')
<footer class="footer text-center">
    Việt thành

</footer>
@endsection