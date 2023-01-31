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
        <div>
        <form name="formRadio">
            <label for="exampleInputPassword1">Tình trạng :</label>
            <div class="col-10 float-right">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radioButton" id="inlineRadio" value="0">
                    <label class="form-check-label" for="inlineRadio3">Chưa xác minh</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radioButton" id="inlineRadio" value="1">
                    <label class="form-check-label" for="inlineRadio4">Đã xác minh</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radioButton" id="inlineRadio" value="2">
                    <label class="form-check-label" for="inlineRadio4">Đã tạo hồ sơ</label>
                </div>
            </div>
        </form>
        <h2 id="ketqua" style="display: none;"></h2>

    </div>
</div>
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
        Bạn đang ở trên trang {{$users->currentPage()}}
        <a style="font-size: 20px;margin-right: 20px;" href="{{$users->previousPageUrl()}}" id="previousPagebtn"> < </a>
        <a style="font-size: 20px;" href="{{$users->nextPageUrl()}}" id="nextPagebtn"> > </a>
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
    $('.form-check-input').click(function(){
        var typeActive = $(this).val();
        if (typeActive == "") {
            $(".table").hide();
        } else {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "GET",
                url: '/admin/ajax-active/'+typeActive+'',
                data: {
                    active: typeActive
                },
                success: function(data) {
                    if(data != ""){
                        $(".table").show();
                        location.reload();
                    }else{
                        $(".table").hide();
                    }
                }
            })
        }
    })
    
})
</script>
@endsection
