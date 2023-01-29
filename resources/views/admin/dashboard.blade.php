@extends('admin.layouts.master')

@section('page-breadcrum')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Trang chủ</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('container-fluid')
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Email campaign chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Biểu đồ thành viên tham gia</h4>
                                <div id="chart"></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-5">Tình trạng tài khoản đã đăng ký</h5>
                                <h3 class="font-light"></h3>
                                <div class="m-t-20 text-center">
                                    <div class="m-t-30">
                                    <div class="row text-center">
                                        <div class="col-4 border-right">
                                            <h4 class="m-b-0"></h4>
                                            <span class="font-14 text-muted">Số tài khoản chưa xác minh</span>
                                            <h2>{{$userNotActive}}</h2>
                                        </div>
                                        <div class="col-4 border-right">
                                            <h4 class="m-b-0"></h4>
                                            <span class="font-14 text-muted">Số tài khoản đã được xác minh</span>
                                            <h2>{{$userActive}}</h2>
                                        </div>
                                        <div class="col-4">
                                            <h4 class="m-b-0"></h4>
                                            <span class="font-14 text-muted">Số tài khoản đã taọ hồ sơ</span>
                                            <h2>{{$userActiveContract}}</h2>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0">Thành viên đăng ký</h4>
                                <h2 class="font-light"> <span class="font-16 text-success font-medium">Thành viên</span></h2>
                                <div class="m-t-30">
                                    <div class="row text-center">
                                        <div class="col-6 border-right">
                                            <h4 class="m-b-0"></h4>
                                            <span class="font-14 text-muted">Thành viên mới</span>
                                            <h2>{{$newMember}}</h2>
                                        </div>
                                        <div class="col-6">
                                            <h4 class="m-b-0"></h4>
                                            <span class="font-14 text-muted">Tổng số thành viên</span>
                                            <h2>{{$allMember}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Email campaign chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Ravenue - page-view-bounce rate -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
                <!-- Ravenue - page-view-bounce rate -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    
                    <!-- column -->
                    
                </div>
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            </div>
@endsection
@section('footer')
<footer class="footer text-center">
    Việt thành
    
</footer>
@endsection
@section('scriptt')
<script>
 window.onload = function () {
  Morris.Bar({
    element: 'chart',
    data:  
      <?php echo $stats; ?>
    ,
    xkey: 'date',
    ykeys: ['value'],
    labels: ['Orders']
  });
}
</script>
@endsection
