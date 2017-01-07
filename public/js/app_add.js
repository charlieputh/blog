/**
 * Created by charlie on 2017/1/7.
 */
//  app
$(document).ready(function () {
    $(".delete").on("submit", function () {
        return confirm("确定要删除？");
    });

    // questions manager
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

    $('body').on('click', '#add-question', function () {
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
});