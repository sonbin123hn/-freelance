@php 
    $urlActiveIdentity = route('admin.update.user', ['id' => $user->id]);
    $urlupdateContract = route('admin.contract.update');
@endphp
@extends('admin.layouts.master')
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<style>
    .font-size-14{font-size: 14px;}
    .max-height-25{max-height: 25px;}
    .c-bg-success{background-color:#a7283f1a!important}
    .custom-switch.custom-switch-sm .custom-control-label {padding-left: 1rem;padding-bottom: 1rem;}
    .custom-switch.custom-switch-sm .custom-control-label::before {height: 1rem;width: calc(1rem + 0.75rem);border-radius: 2rem;}
    .custom-switch.custom-switch-sm .custom-control-label::after {width: calc(1rem - 4px);height: calc(1rem - 4px);border-radius: calc(1rem - (1rem / 2));}
    .custom-switch.custom-switch-sm .custom-control-input:checked ~ .custom-control-label::after {transform: translateX(calc(1rem - 0.25rem));}
    .custom-switch.custom-switch-md .custom-control-label {padding-left: 2rem;padding-bottom: 1.5rem;}
    .custom-switch.custom-switch-md .custom-control-label::before {height: 1.5rem;width: calc(2rem + 0.75rem);border-radius: 3rem;}
    .custom-switch.custom-switch-md .custom-control-label::after {width: calc(1.5rem - 4px);height: calc(1.5rem - 4px);border-radius: calc(2rem - (1.5rem / 2));}
    .custom-switch.custom-switch-md .custom-control-input:checked ~ .custom-control-label::after {transform: translateX(calc(1.5rem - 0.25rem));}
    .custom-switch.custom-switch-lg .custom-control-label {padding-left: 3rem;padding-bottom: 2rem;}
    .custom-switch.custom-switch-lg .custom-control-label::before {height: 2rem;width: calc(3rem + 0.75rem);border-radius: 4rem;}
    .custom-switch.custom-switch-lg .custom-control-label::after {width: calc(2rem - 4px);height: calc(2rem - 4px);border-radius: calc(3rem - (2rem / 2));}
    .custom-switch.custom-switch-lg .custom-control-input:checked ~ .custom-control-label::after {transform: translateX(calc(2rem - 0.25rem));}
    .custom-switch.custom-switch-xl .custom-control-label {padding-left: 4rem;padding-bottom: 2.5rem;}
    .custom-switch.custom-switch-xl .custom-control-label::before {height: 2.5rem;width: calc(4rem + 0.75rem);border-radius: 5rem;}
    .custom-switch.custom-switch-xl .custom-control-label::after {width: calc(2.5rem - 4px); height: calc(2.5rem - 4px);border-radius: calc(4rem - (2.5rem / 2));}
    .custom-switch.custom-switch-xl .custom-control-input:checked ~ .custom-control-label::after {transform: translateX(calc(2.5rem - 0.25rem));}
</style>
@section('page-breadcrum')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-8 align-self-center ml-4 mr-4">
            <h4 class="page-title text-center" style="font-size:33px;font-weight:bold;">Thông tin khách hàng</h4>
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
            <form action="{{ route('admin.update.user', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-5">
                        <div class="avata">
                            <!-- <p class=" m-auto text-center  {{ ( $user->active != 0 ) ? 'c-bg-success text-success': 'text-danger c-bg-success' }}" style="max-width: 130px;">Đã xác minh</p> -->
                            <img class="mt-2" style="display: block;margin-left: auto;margin-right: auto;border-radius: 50%;width: 120px;object-fit: cover;height: 120px;" src="http://admin-vayvonvietthanh.com{{$user->face ?? ''}}">
                        </div>
                    </div>
                    <div class="col-6">
                        <h3 class="text-center mb-3 font-weight-bold">Thông tin cá nhân</h3>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Số CMND</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="cccd" value="{{$user->cccd ?? ''}}" placeholder="Số CMND " class="form-control form-control-line max-height-25">
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
                                <input type="date" name="birth" value="{{ $birth }}" placeholder="Ngày sinh " class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Địa chỉ</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="address" value="{{$user->address ?? ''}}" placeholder="Địa chỉ" class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Nghề nghiệp</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="job" value="{{$user->job ?? ''}}" placeholder="Nghề nghiệp" class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Giới tính</p>
                            </div>
                            <div class="col-8">
                                <select class="custom-select mr-sm-2" name="sex" id="sex">
                                    <option >Giới tính</option>
                                    <option value="0" {{ ($user->sex == 0) ? 'selected' : ''}}>Nam</option>
                                    <option value="1" {{ ($user->sex == 1) ? 'selected' : ''}}>Nữ</option>
                                    <option value="2" {{ ($user->sex == 2) ? 'selected' : ''}}>Khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Thu nhập</p>
                            </div>
                            <div class="col-8">
                                <select class="custom-select mr-sm-2" name="salary" id="salary">
                                    <option>Thu nhập</option>
                                    <option value="1" {{($user->salary == 1) ? 'selected' : '' }}>Dưới 5 triệu</option>
                                    <option value="2" {{($user->salary == 2) ? 'selected' : '' }}>Từ 5 - 10 triệu</option>
                                    <option value="3" {{($user->salary == 3) ? 'selected' : ''}}>Từ 10 - 20 triệu</option>
                                    <option value="4" {{($user->salary == 4) ? 'selected' : ''}}>Trên 20 triệu</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Mục đích vay</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="reason" value="{{$user->salary}}" placeholder="Mục đích vay " class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">SĐT người thân</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="phoneNumberRelationship" value="{{$user->phoneNumberRelationship}}" placeholder="SĐT người thân " class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">người thân</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="relationship" value="{{$user->relationship}}" placeholder="Mối quan hệ với người thân" class="form-control form-control-line max-height-25">
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
                                <input type="text" name="bank" value="{{$user->bank}}" placeholder="Ngân hàng" class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Tên người thụ hưởng</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="bankUserName" value="{{$user->bankUserName}}" placeholder="Tên người thụ hưởng" class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <p class="m-0 pt-1 font-size-14">Số tài khoản</p>
                            </div>
                            <div class="col-8">
                                <input type="text" name="bankAccount" value="{{$user->bankAccount}}" placeholder="Số tài khoản" class="form-control form-control-line max-height-25">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col text-center mt-2">
                    <button class="btn btn-primary">Cập Nhập</button>
                </div>
            </form>
        </div>
        <div class="col-md-3 shadow p-3 mb-5 bg-white rounded" style="max-height: 350px;">
            <div class="main-gallery">
                <div class="gallery-cell w-100">
                    <img class="gallery-cell-image w-100" src="http://admin-vayvonvietthanh.com{{$user->idFront ?? ''}}" data-flickity-lazyload="http://admin-vayvonvietthanh.com{{$user->face ?? ''}}" />
                </div>
                <div class="gallery-cell w-100">
                    <img class="gallery-cell-image w-100" src="http://admin-vayvonvietthanh.com{{$user->idBack ?? ''}}" data-flickity-lazyload="http://admin-vayvonvietthanh.com{{$user->face ?? ''}}" />
                </div>
                <div class="gallery-cell w-100">
                    <img class="gallery-cell-image w-100" src="http://admin-vayvonvietthanh.com{{$user->face ?? ''}}" data-flickity-lazyload="http://admin-vayvonvietthanh.com{{$user->face ?? ''}}" />
                </div>
            </div>
        </div>

        <div class="col-md-3 shadow p-3 mb-5 bg-white rounded ml-4 mr-4">
            <h3 class="text-center mb-3 font-weight-bold">Trạng thái tài khoản</h3>
            <div class="custom-control custom-switch custom-switch-md">
                <input type="checkbox" class="custom-control-input" value="{{$user->active}}" id="activeIdentity" {{ ( $user->active == 2 ) ? 'checked': '' }}>
                <label class="custom-control-label" style="padding-top: 4px;" id="activeIdentityLabel" for="activeIdentity">{{ ( $user->active == 2 ) ? 'Đã xác minh danh tính': 'Tài khoản chưa xác minh danh tính' }}</label>
            </div>

            <div class="checkActive {{ ( $user->active != 2 ) ? 'd-none': '' }}">
                <div class="custom-control custom-switch custom-switch-md">
                    <input type="checkbox" class="custom-control-input" value="{{$user->withDrawalType}}" id="withDrawalType" {{ ( $user->withDrawalType == 1 ) ? 'checked': '' }}>
                    <label class="custom-control-label" style="padding-top: 4px;" id="withDrawalTypeLabel" for="withDrawalType">{{ ( $user->withDrawalType == 1 ) ? 'Có thể rút tiền': 'Không thể rút tiền' }}</label>
                </div>
            </div>
        </div>
        <div class="col-md-4 shadow p-3 mr-4 mb-5 bg-white rounded">
            <h3 class="text-center mb-3 font-weight-bold">Hợp đồng vay</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Mã HĐ</th>
                        <th scope="col">Số tiền vay</th>
                        <th scope="col">TG</th>
                        <th scope="col">Xác nhận khoản vay</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listContracts as $k=>$value)
                    <tr>
                        <td>{{$value['prive']}}</td>
                        <td>{{number_format($value['loanValue'])}} VND</td>
                        <td>{{$value['loanTime']}}T</td>
                        <td class="pt-1">
                            <div class="custom-control custom-switch custom-switch-md ml-2 text-center">
                                @php
                                $id = 'status_'.$value['prive'];
                                $idContract = $value['id'];
                                $loanValue = number_format($value['loanValue']);
                                @endphp
                                <input type="checkbox" class="custom-control-input" value="{{$value['status']}}" onclick="activeContract('{{$id}}','{{$idContract}}','{{$loanValue}}')" {{ ( $value['status'] == 2 ) ? 'checked': '' }} id="status_{{$value['prive']}}" >
                                <label class="custom-control-label" style="padding-top: 4px;" for="status_{{$value['prive']}}"></label>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-4 shadow p-3 mr-5 mb-5 bg-white rounded">
            <h3 class="text-center mb-3 font-weight-bold">Lịch sử rút tiền</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">SỐ tiền</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                    </tr>
                </thead>
                <tbody class="files">
                    @foreach($listHistory as $k=>$value)
                    <tr>
                        <td>{{number_format($value['value'])}} VND</td>
                        <td>{{($value['type'] == 1 ) ? 'Cộng' : 'Trừ'}}</td>
                        <td>{{$value['created_at']->format('d/m/Y H:i:s')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection
@section('footer')
<footer class="footer text-center">
    Việt thành
    
</footer>
@endsection
@section('script')
<script type="text/javascript" src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    function toastMessage(type, message) {
        let background = "";
        if(type == 'success') {
            background = 'linear-gradient(to right, #00b09b, #96c93d)';
        }else if (type == 'error') {
            background = 'linear-gradient(to right, #ff5f6d, #ffc371)';
        }

        let options = {
            text: message,
            duration: 5000,
            close: true,
            style: {
                background: background,
            },
            offset: {x:0, y: 70},
        };
        Toastify(options).showToast();
    }

    function activeContract(id,idContract,loanValue) {
        let checked = $('#'+id).is(":checked");
        if(!$('#activeIdentity').is(":checked")){
            $('#'+id).prop("checked", false);
            toastMessage('error', 'Vui lòng xác thực danh tính trước khi xác thực khoản vay'); return false;
        }
        if(checked){
            var returnVal = confirm("Bạn có muốn xác nhận khoản vay này, sau khi xác nhận không thể hủy ");
            $('#'+id).prop("checked", returnVal);
            if(!returnVal){
                return false;
            }
            var urlupdateContract = '{{$urlupdateContract}}';
            let formData = new FormData();
            formData.append('status', 2);
            formData.append('id', idContract);
            formData.append('_token', "{{ csrf_token() }}");
            $.ajax({
                type: 'POST',
                url: urlupdateContract,
                cache: false,
                contentType: false,
                processData: false,
                data : formData,
                success: function(res){
                    var date = new Date();
                    var dateStr =
                    ("00" + (date.getMonth() + 1)).slice(-2) + "/" +
                    ("00" + date.getDate()).slice(-2) + "/" +
                    date.getFullYear() + " " +
                    ("00" + date.getHours()).slice(-2) + ":" +
                    ("00" + date.getMinutes()).slice(-2) + ":" +
                    ("00" + date.getSeconds()).slice(-2);
                    console.log(dateStr);

                    toastMessage('success', 'Xác nhận khoản vay thành công');
                    let html = `<tr>
                                    <td>${loanValue} VND</td>
                                    <td>Cộng</td>
                                    <td>${dateStr}</td>
                                </tr>`;
                    $('.files').prepend(html);
                },
                error: function(err){
                    toastMessage('error', 'Đã xảy ra lỗi vui lòng thử lại sau'); return false;
                    $('#'+id).prop("checked", false);
                },
            });
        }else{
            $('#'+id).prop("checked", true);
            toastMessage('error', 'Không thể hủy khoản vay này'); return false;
        }
        
    }

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
        
        $('#activeIdentity').change(function() {
            let active = 1;
            if(this.checked) {
                active = 2;
                var returnVal = confirm("Bạn có muốn xác minh tài khoản này ");
                var message = 'Xác minh danh tính thành công';
                var messageLabel = 'Đã xác minh danh tính';
                $(this).prop("checked", returnVal);
                if(!returnVal){
                    return false;
                }
            }else{
                var returnVal = confirm("Bạn có muốn hủy xác minh tài khoản này");
                var message = 'Hủy xác minh danh tính thành công';
                var messageLabel = 'Tài khoản chưa xác minh danh tính';
                $(this).prop("checked", !returnVal);
                if(!returnVal){
                    return false;
                }
            }
            var urlActiveIdentity = '{{$urlActiveIdentity}}';
            let formData = new FormData();
            formData.append('active', active);
            formData.append('_token', "{{ csrf_token() }}");
            var checked = this.checked;
            $.ajax({
                type: 'POST',
                url: urlActiveIdentity,
                cache: false,
                contentType: false,
                processData: false,
                data : formData,
                success: function(res){
                    toastMessage('success', message);
                    $('#activeIdentityLabel').text(messageLabel);
                    console.log(checked);
                    if(checked){
                        $('.checkActive').removeClass('d-none');
                    }else{
                        $('.checkActive').addClass('d-none');
                    }
                },
                error: function(err){
                    toastMessage('error', 'Đã xảy ra lỗi vui lòng thử lại sau'); return false;
                    $(this).prop("checked", this.checked);
                },
            });
        });


        $('#withDrawalType').change(function() {
            let withDrawalType = 0;
            if(this.checked) {
                withDrawalType = 1;
                var returnVal = confirm("Bạn có muốn xác minh rút tiền cho tài khoản này ");
                var message = 'Xác minh rút tiền thành công';
                var messageLabel = 'Có thể rút tiền';
                $(this).prop("checked", returnVal);
                if(!returnVal){
                    return false;
                }
            }else{
                var returnVal = confirm("Bạn có muốn hủy xác minh rút tiền cho tài khoản này");
                var message = 'Hủy xác minh rút tiền thành công';
                var messageLabel = 'Không thể  rút tiền';
                $(this).prop("checked", !returnVal);
                if(!returnVal){
                    return false;
                }
            }
            var urlActiveIdentity = '{{$urlActiveIdentity}}';
            let formData = new FormData();
            formData.append('withDrawalType', withDrawalType);
            formData.append('_token', "{{ csrf_token() }}");
            $.ajax({
                type: 'POST',
                url: urlActiveIdentity,
                cache: false,
                contentType: false,
                processData: false,
                data : formData,
                success: function(res){
                    toastMessage('success', message);
                    $('#withDrawalTypeLabel').text(messageLabel);
                },
                error: function(err){
                    toastMessage('error', 'Đã xảy ra lỗi vui lòng thử lại sau'); return false;
                    $(this).prop("checked", this.checked);
                },
            });
        });
    })
</script>
@endsection
