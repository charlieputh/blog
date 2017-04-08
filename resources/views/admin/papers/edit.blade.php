@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('admin/papers') }}">试卷管理</a> > 编辑试卷
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>操作失败</strong><br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif


                        <form action="{{ url('/admin/papers/'.$paper->id) }}" method="POST" class="form-inline">
                            <div class="form-group">
                                <label for="name">试卷名</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="试卷名" value="{{ old('title', $paper->title) }}">
                            </div>
                            <div class="form-group">
                                <label for="multi_score">单选题分值</label>
                                <input type="number" step="0.1" name="multi_score" class="form-control" id="multi_score" placeholder="单选题分值" value="{{ old('multi_score', $paper->multi_score) }}">
                            </div>
                            <div class="form-group">
                                <label for="judge_score">判断题分值</label>
                                <input type="number" step="0.1" name="judge_score" class="form-control" id="judge_score" placeholder="判断题分值" value="{{ old('judge_score', $paper->judge_score) }}">
                            </div>
                            <div class="form-group">
                                <label for="time">考试时间(分钟)</label>
                                <input type="number" class="form-control" name="time" id="time" placeholder="考试时间" value="{{ old('time', $paper->time) }}">
                            </div>
                            <div class="form-group">
                                <label for="start_time">开始时间</label>
                                <input type="datetime-local" class="form-control" name="start_time" id="start_time" placeholder="开始时间" value="{{ old('start_time', \Carbon\Carbon::parse($paper->start_time)->format('Y-m-d\TG:i')) }}">
                            </div>
                            <div class="form-group">
                                <label for="end_time">结束时间</label>
                                <input type="datetime-local" class="form-control" name="end_time" id="end_time" placeholder="结束时间" value="{{ old('end_time', \Carbon\Carbon::parse($paper->end_time)->format('Y-m-d\TG:i')) }}">
                            </div>
                            {{ method_field('PUT') }}
                            <button type="submit" class="btn btn-success btn-raised">提交</button>
                            {!! csrf_field() !!}
                        </form>

                        <br>
                        <a href="?filter=multi" class="btn btn-info btn-raised">单选题 <span class="badge">{{ $questions_count['multi'] }}</span></a>
                        <a href="?filter=judge" class="btn btn-info btn-raised">判断题 <span class="badge">{{ $questions_count['judge'] }}</span></a>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>题型</th>
                                <th>题目</th>
                                <th>添加/移除</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $question)
                                <tr>
                                    <td>{{ \App\Http\Controllers\Admin\QuestionController::getType($question->type) }}</td>
                                    <td>{{ $question->content }}</td>
                                    <td>
                                        @if(in_array($question->id, $questions_added))
                                            <button class="paper-question-action btn btn-warning btn-raised" value="{{ $question->id }}">移除</button>
                                        @else
                                            <button class="paper-question-action btn btn-info btn-raised" value="{{ $question->id }}">添加</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $questions->appends([
                                    'filter' => Request::get('filter'),
                                ])
                            ->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
