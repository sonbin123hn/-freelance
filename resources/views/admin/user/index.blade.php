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
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                {{session('error')}}
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
        <div class="card-body bg-white card-body rounded shadow mb-4">
            <form action="{{ route('admin.list.user')}}" method="get" enctype="multipart/form-data">
                <div class="form-group mx-sm-3 mb-2 d-inline">
                    <label class="my-1 mr-2" for="userName">Họ Tên</label>
                    <input type="text" name="userName" value="{{$userName}}">
                </div>
                <div class="form-group mx-sm-3 mb-2 d-inline">
                    <label class="my-1 mr-2" for="userName">Số điện thoại</label>
                    <input type="text" name="phoneNumber" value="{{$phoneNumber}}">
                </div>
                <div class="form-group mx-sm-3 mb-2 d-inline">
                    <label class="my-1 mr-2" for="email">Tình trạng</label>
                    <select class="custom-select mr-sm-2 form-control d-inline"  style="max-width: 200px;" name="active" id="active">
                        <option>Tình trạng khách hàng</option>
                        <option value="0" {{ ($active==0) ? 'selected="selected"' : ''}}>Chưa có thông tin</option>
                        <option value="1" {{ ($active==1) ? 'selected="selected"' : ''}}>Đã có thông tin</option>
                        <option value="2" {{ ($active==2) ? 'selected="selected"' : ''}}>Đã xác minh danh tính</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <div class="card-body bg-white card-body rounded shadow">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Tình Trạng</th>
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
                    <td>
                        @if($value['active'] == 0)
                            chưa có thông tin cá nhân
                        @elseif($value['active'] ==1)
                            đã có thông tin cá nhân
                        @elseif($value['active'] ==2)
                            đã xác minh danh tính
                        @endif
                    </td>
                    <td>{{$value['created_at']->format('H:i:s, d/m/Y')}}</td>
                    <td>
                        @if($value['active'] != 0)
                            <a href="{{ route('admin.edit.user', ['id' => $value['id']]) }}"><i style="font-size:22px;margin-right:10px" class="fa">&#xf044;</i></a>
                        @endif
                        <a href="{{ route('admin.delete.user', ['id' => $value['id']]) }}" onclick="return confirm('Bạn có muốn xóa khách hàng này ?')"><i style="font-size:22px;color:red" class="mdi mdi-delete"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
       
        <div class="pagination-wrapper" style="margin: 0 auto;display: table;"> {!! $users->fragment('foo')->links('pagination::bootstrap-4') !!} </div>
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
@endsection
