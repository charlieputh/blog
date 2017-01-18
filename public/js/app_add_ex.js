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
            content: $('#qcontent').val();
            A: $('#qA').val(),
            B: $('#qB').val(),
            C: $('#qC').val(),
            D: $('#qD').val(),
            ans: $('#qans').val()
        };

        
    });
});