@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        题库管理
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>操作失败</strong><br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif

                        <button class="btn btn-block btn-success btn-lg btn-raised" id="add-question">添加题目</button>
                            <br>
                            <form action="questions" class="form-inline">
                            	<a href="?filter=all" class="btn btn-primary btn-raised">显示全部<span class="badge">{{ $questions_count['all'] }}</span></a>
                                <a href="?filter=multi" class="btn btn-info btn-raised">单选题 <span class="badge">{{ $questions_count['multi'] }}</span></a>
                                <a href="?filter=judge" class="btn btn-info btn-raised">判断题 <span class="badge">{{ $questions_count['judge'] }}</span></a>
                            	<input type="text" class="form-control" placeholder="searching" name="query">
                            	<button type="submit" class="btn btn-primary btn-raised">搜索</button>
                            </form>
                            <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>题型</th>
                                <th>题目</th>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>
                                <th>答案</th>
                                <th>动作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $question)
                               <tr id="question{{ $question['id'] }}">  <td>{{ $question['type'] == 0?'单选':'判断' }}</td>
                                   <td>{!! $question['content'] !!}</td>
                                   <td>{!! $question['type'] == 0?$question['A']:'' !!}</td>
                                   <td>{!! $question['type'] == 0?$question['B']:'' !!}</td>
                                   <td>{!! $question['type'] == 0?$question['C']:'' !!}</td>
                                   <td>{!! $question['type'] == 0?$question['D']:'' !!}</td>
                                   <td>{!! \App\Http\Controllers\Admin\QuestionController::getAns($question['type'],$question['ans']) !!}</td>
                                   <td><button class="btn btn-info edit-question btn-raised" value="{{ $question['id'] }}">修改</button>
                                       <button class="btn btn-info edit-question btn-raised" value="{{ $question['id'] }}">删除</button>
                                   </td>
                               </tr>
                            @endforeach
                            </tbody>
                        </table>
                            {{--模态框 For Bootstrap--}}
                            <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div calss="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="true">&times;</button>
                                                <h4 class="modal-title" id="question-title">修改题目</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label for="qtype" class="control-label col-sm-2">题型</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="qtype">
                                                                <option value="0">单选</option>
                                                                <option value="1">判断</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form id="question">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="qcontent" class="control-label col-sm-2">题目</label>
                                                            <div class="col-sm-10">
                                                                <textarea id="qcontent" name="qcontent" class="form-control" required="required" placeholder="输入题目描述..." rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--for the answers editing: ABCD--}}
                                                    <div id="qselection">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label for="qA" class="control-label col-sm-2">A.</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" id="qA" name="qA" class="form-control" required="required" placeholder="选项A">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label for="qB" class="control-label col-sm-2">B.</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" id="qB" name="qB" class="form-control" required="required" placeholder="选项B">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label for="qC" class="control-label col-sm-2">C.</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" id="qC" name="qC" class="form-control" required="required" placeholder="选项C">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label for="qD" class="control-label col-sm-2">D.</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" id="qD" name="qD" class="form-control" required="required" placeholder="选项D">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="qans" class="control-label col-sm-2">答案</label>
                                                            <div class="col-sm-10">
                                                                <select class="form-control" id="qans"></select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary btn-raised" id="qsave" value="update">更新</button>
                                                <input type="hidden" id="qid" name="qid" value="-1">
                                            </div>
>                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--分页--}}
                            <div class="text-center">
                                {{ $questions->appends([
                                    'filter' => Request::get('filter'),
                                    'query' => Request::get('query'),
                                ])
                                ->links() }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection