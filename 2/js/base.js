;(function(){
    var $ul = $('.messages ul');
    // 取出留言
    index();

    // 提交留言
    $('button[type=submit]').on('click', function(event) {
        event.preventDefault();
        var $username = $('#username'),
        $message = $('#message'),
        requestData = {
            act: 'insert',
            username: $username.val(),
            message: $message.val(),
        };

        $.post('curd.php', requestData, function(data) {
            if (data.success) {
                $username.val(null);
                $message.val(null);
                var $li = renderTpl(requestData);
                $ul.append($li);
            }
        });
    });

    // 删除留言
    $('ul').on('click', 'button', function() {
        $parent = $(this).parent();
        var requestData = {
            act: 'delete',
            id: $parent.find('input').val()
        };

        $.get('curd.php', requestData, function(data) {
            if (data.success) {
                $ul.empty();
                index();
            }
        });
    });

    function index() {
        $.get('curd.php?act=index', function(data) {
            for (var i = 0; i < data.length; i++) {
                var $li = renderTpl(data[i]);
                $ul.append($li);
            }
        })
    }

    function renderTpl(data) {
    var tpl = '<li>';
    if ('id' in data) {
        tpl = tpl + '<input type="hidden" value="' + data.id + '">';
    }
    tpl = tpl +     
    '<span>留言人：' + data.username +　'</span>' +
    '<button type="button" class="btn btn-danger">删除</button>' + 
    '<p>' + data.message + '</p>' +
    '</li>';
    return $(tpl);
    }
})();