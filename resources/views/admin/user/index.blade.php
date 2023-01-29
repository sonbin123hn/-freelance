@extends('admin.layouts.master')

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
    <div class="table-responsive">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thành công</h4>
            {{session('success')}}
        </div>
        @endif
        <!-- hien thi loi request -->
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="fa fa-bug"></i> Thông báo!</h4>
            <ul>
                <li>{{session('error')}}</li>
            </ul>
        </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Khởi tạo lúc</th>
                    <th scope="col">Tuỳ chọn</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $k=>$value)
                <tr>
                    <th scope="row">{{ Helper::stt($k, $users->currentPage()) }}</th>
                    <td>{{$value['phoneNumber']}}</td>
                    <td>{{$value['userName']}}</td>
                    <td>{{$value['created_at']->format('H:i:s, d/m/Y')}}</td>
                    <td>
                        <a href="{{ route('admin.edit.user', ['id' => $value['id']]) }}"><i style="font-size:22px;margin-right:10px" class="fa">&#xf044;</i></a>
                        <a href="{{ route('admin.delete.user', ['id' => $value['id']]) }}" onclick="return confirm('Bạn có muốn xóa khách hàng này ?')"><i style="font-size:22px;color:red" class="mdi mdi-delete"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        You are on page {{$users->currentPage()}}
        <a style="font-size: 20px;margin-right: 20px;" href="{{$users->previousPageUrl()}}" id="previousPagebtn">
        </a> <a style="font-size: 20px;" href="{{$users->nextPageUrl()}}" id="nextPagebtn"></a>
    </div>

</div>
@endsection
@section('footer')
<footer class="footer text-center">
    Việt thành
    
</footer>
@endsection
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
