/**
 * Created by charlie on 2017/1/7.
 */
//  app

$(document).ready(function () {
    $(".delete").on("submit", function () {
        return confirm("确定要删除？");
    });

    // questions manager
    // question  url
    var qurl = "/admin/questions";
    var getAns = function getAns(type, ans) {
        var Ans = ['A', 'B', 'C', 'D', '正确', '错误'];
        return Ans[Number(type) * 4 + Number(ans)];
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });

    //add question module
    $('body').on('click', '#add-question1', function () {
        alert("hello");
        $('#question').trigger('reset');
        $('#question-title').text('添加题目');
        $('#qsave').text('添加');
        $('#qsave').val('add');
        $('#qtype').removeAttr('disabled');
        $('#qtype').val(0);
        $('#qselection').show();
        $('#qans').html('<option value="">请选择答案</option>' + '<option value="0">A</option>' + '<option value="1">B</option>' + '<option value="2">C</option>' + '<option value="3">D</option>');

        $('#qtype').change(function () {
            if ($('#qtype').val() == 1) {
                // 判断题
                $('#qselection').hide();
                $('#qans').html('<option value="">请选择答案</option>' + '<option value="0">正确</option>' + '<option value="1">错误</option>');
            } else {
                // 单选题
                $('#qselection').show();
                $('#qans').html('<option value="">请选择答案</option>' + '<option value="0">A</option>' + '<option value="1">B</option>' + '<option value="2">C</option>' + '<option value="3">D</option>');
            }
        });
        $('#questionModal').modal('show');
    });

    //delete question module
    $('body').on('click', '.delete-question', function () {
        alert("hello");
        var qid = $(this).val();
        toastr.warning('你确定要删除？<br><button class="btn btn-info btn-raised btn-raised" id="delete-question-sure">确定</button>');
        $('#delete-question-sure').click(function () {
            $.ajax({
                url: qurl + '/' + qid,
                type: 'DELETE',
                success: function success(data) {
                    toastr.info('删除成功');
                    $('#question' + qid).remove();
                },
                error: function error(data) {
                    toastr.error('删除失败');                
                }
            });
        });
    });

    //edit question module
    $('body').on('click','.edit-question', function () {
        alert("hello");
        $('#question').trigger('reset');
        $('#question-title').text('修改题目');
        $('#qsave').text('更新');
        $('#qsave').val('update');
        var qid = $(this).val();
        $.get(qurl + '/' + qid, function (data) {
            console.log(data);
            $('#qtype').val(data.type);
            $('#qtype').attr('disabled','disabled');
            $('#qid').var(qid);
            $('#qcontent').val(data.content);
            if (data.type == 0) {
                $('#qselection').show();
                $('#qA').val(data.A);
                $('#qB').val(data.B);
                $('#qC').val(data.C);
                $('#qD').val(data.D);
                $('#qans').html('<option value="0">A</option>' + '<option value="1">B</option>' + '<option value="2">C</option>' + '<option value="3">D</option>');
                $('#qans').val(data.ans);
            }
        });
        $('#questionModal').modal('show');
    });

    //questionModal keyup function    
    $('#questionModal').keyup(function (event) {
        if (event.keyCode == 13) $('#qsave').click();
    });

    //question save function
    $('#qsave').click(function(event) {
        var qid = $('#qid').val();
        event.preventDefalut();     //prevent the default event

        var data = {
            type: $('#qtype').val(),
            content: $('#qcontent').val(),
            A: $('#qA').val(),
            B: $('#qB').val(),
            C: $('#qC').val(),
            D: $('#qD').val(),
            ans: $('#qans').val()
        };

        if($('#qsave').val() == 'update'){
            var type = 'PUT';
            var url = qual + '/'+ qid;
        }else{
            var type = 'POST';
            var url = qurl;
        }

        console.log(data);
        console.log(url);

        $.ajax({
            type: type,
            url:url,
            data: data,
            dataType: 'json',
            success: function success(data){
                console.log(data);

                var question = '<tr id="question' + data.id + '">' + '<td>' + (data.type == 0 ? "单选" : "判断") + '</td>' + '<td>' + data.content + '</td>' + '<td>' + data.A + '</td>' + '<td>' + data.B + '</td>' + '<td>' + data.C + '</td>' + '<td>' + data.D + '</td>' + '<td>' + getAns(data.type, data.ans) + '</td>' + '<td><button class="btn btn-info edit-question btn-raised" value="' + data.id + '">修改</button> ' + '<button class="btn btn-warning delete-question btn-raised" value="' + data.id + '">删除</button>' + '</td>' + '</tr>';
                console.log(question);

                if ($('#qsave').val() == 'update') {
                    $('#question' + data.id).replaceWith(question);
                    toastr.success('修改成功！');
                } else {
                    $('tbody').append(question);
                    toastr.success('添加成功！');
                }

                $('#questionModal').modal('hide');
            },
            error: function error(data, json, errorThrown) {
                console.log(data);
                // $('.panel-body').append(data.responseText);
                var errors = data.responseJSON;
                var errorsHtml = '';
                $.each(errors, function (key, value) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                toastr.error(errorsHtml, "Error " + data.status + ': ' + errorThrown);
            }
        });
    });

    //paper manage: teacher relate the papers and question
    var purl = 'edit/';
    $('body').on('click', '.paper-question-action', function () {
        var button = $(this);
        var action = button.text();
        var qid = button.val();
        console.log(action);
        if (action == '添加') {
            $.ajax({
                async:false,
                type: 'put',
                url: purl + qid,
                success: function success(data) {
                    button.attr('class', 'btn btn-warning paper-question-action btn-raised');
                    button.text('移除');
                    console.log(data);
                    toastr.success('添加成功');
                },
                error: function error(data, json, errorThrown) {
                    console.log(data);
                    // $('.panel-body').append(data.responseText);
                    var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors, function (key, value) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                    toastr.error(errorsHtml, "Error " + data.status + ': ' + errorThrown);
                    $('.panel-body').append(data.responseText);
                }
            });
        } else {
            $.ajax({
                type: 'delete',
                url: purl + qid,
                success: function success(data) {
                    button.attr('class', 'btn btn-info paper-question-action btn-raised');
                    button.text('添加');
                    console.log(data);
                    toastr.warning('移除成功');
                },
                error: function error(data, json, errorThrown) {
                    console.log(data);
                    // $('.panel-body').append(data.responseText);
                    var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors, function (key, value) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                    toastr.error(errorsHtml, "Error " + data.status + ': ' + errorThrown);
                    $('.panel-body').append(data.responseText);
                }
            });
        }
    });
});
