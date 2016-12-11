@extends('layout.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <!--online test button 还有数据没放进去-->
        <div class="col-md-3">
            <div class="container-fluid">
                <div class="row">
                    <a class="btn btn-lg btn-success" href="#">
                    <i class="fa fa-flag fa-2x pull-left"></i>在线学习</a>
                    <a class="btn btn-primary" href="#">
                    <i class="fa fa-cloud" aria-hidden="true"></i>在线考试></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection