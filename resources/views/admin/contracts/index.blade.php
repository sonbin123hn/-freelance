@extends('admin.layouts.master')

@section('page-breadcrum')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Contracts Management</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            Home
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Contracts Management</li>
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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">loan Value</th>
                    <th scope="col">loan Time</th>
                    <th scope="col">signature</th>
                    <th scope="col">prive</th>
                    <th scope="col">user</th>
                    <th scope="col">status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contracts as $k=>$value)
                <tr>
                    <th scope="row">{{ Helper::stt($k, $contracts->currentPage()) }}</th>
                    <td>{{$value['loanValue']}}</td>
                    <td>{{$value['loanTime']}}</td>
                    <td><img src="{{$value['signature']}}" width="100" /></td>
                    <td>{{$value['prive']}}</td>
                    <td>{{$value['user']->userName ?? ($value['user']->phoneNumber ?? '')}}</td>
                    @if($value['status'] == 0)
                    <td>Pending</td>
                    @elseif($value['status'] == 1)
                    <td>cancel</td>
                    @else
                    <td>Success</td>
                    @endif
                    <td>
                        <a href="{{ route('admin.contract.edit', ['id' => $value['id']]) }}"><i style="font-size:22px" class="fa">&#xf044;</i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        You are on page {{$contracts->currentPage()}}
        <a style="font-size: 20px;margin-right: 20px;" href="{{$contracts->previousPageUrl()}}" id="previousPagebtn">
        </a> <a style="font-size: 20px;" href="{{$contracts->nextPageUrl()}}" id="nextPagebtn">>
        </a>
    </div>

</div>
@endsection
@section('footer')
<footer class="footer text-center">
    Việt thành
    
</footer>
@endsection