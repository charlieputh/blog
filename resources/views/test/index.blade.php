
@extends('layout.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <!--online test button-->
        <div class="col-md-3">
            <div class="container-fluid">
                <div class="row">
                    <div>
                        <a class="btn btn-lg btn-success" href="{{ url('category') }}">
                        <i class="fa fa-flag fa-2x pull-left"></i>在线学习<span class="badge">{{ $data['articles_count'] }}</span></a>
                    </div>
                    <a class="btn btn-lg btn-primary" href="{{ url('papers') }}">
                    <i class="fa fa-cloud fa-2x pull-left" aria-hidden="true"></i>在线考试</a>
                </div>
            </div>
        </div>
        <!--Imformation-->
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="fa fa-bell" aria-hidden="true"></i>系统提示</div>
                <div class="panel-body system_info">
                    @if($data['systeminfo'])
                        {!! $data['systeminfo']->content !!}
                    @endif
                </div>
            </div>
        </div>

        <!--Notice-->
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
</i>考试须知</div>
                <div class="panel-body system_info">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection