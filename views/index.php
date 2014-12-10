<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <title>锻炼时光</title>
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
<body>
<style>
.item-txt{padding:7px 0;display:inline-block}
.item-txt span.glyphicon{margin-left:10px;cursor:pointer;color:#d9534f}
.run-list-content{margin-left:8px;color:#666}
.run-list-time{color:#333}
.nav .nav-hello{display:inline-block;padding:14px 10px;color:#aaa;font-size:16px;}
</style>
<header class="navbar navbar-inverse navbar-static-top">
    <div class="navbar-inner">
        <div class="container">
            <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo BASE_URL;?>">坚持锻炼</a>
            </div>
            <nav class="collapse navbar-collapse">
                <ul class="nav navbar-nav"></ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><span class="nav-hello"><?php if ($userInfo['isLogin']) echo "Hi " . $userInfo['username'];?></span></li>
                    <li>
                        <a href="javascript:;" data-toggle="modal" data-target="#addItem">添加项目</a>
                    </li>
                    <li>
                    <?php 
                    if ($userInfo['isLogin']) {
                    ?>
                        <a href="<?php echo BASE_URL;?>?f=logout">退出</a>
                    <?php
                    } else {
                    ?>
                        <a href="<?php echo BASE_URL;?>?f=login">登录</a>
                    <?php
                    }
                    ?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div id="itemList"></div>
    <div class="run-btn">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 text-right">
                <button class="btn btn-warning" id="run-none">今天打酱油</button>
                <button class="btn btn-success" id="run-sub">存储</button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-top:20px;">
	<div class="row">
        <div class="col-sm-offset-2 col-sm-2">
        	<input type="date" class="form-control start-date">
        </div>
        <div class="col-sm-2">
            <input type="date" class="form-control end-date">
        </div>
        <div class="query-run">
        	<button class="btn btn-info time-area">查询记录</button>
        	<button class="btn btn-info" data-query="-7 day">一周内</button>
        	<button class="btn btn-info" data-query="-1 month">一个月</button>
        	<button class="btn btn-info" data-query="-3 month">三个月</button>
        	<button class="btn btn-info" data-query="-6 month">六个月</button>
        	<button class="btn btn-info" data-query="-12 month">一年内</button>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-top:20px;">
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <div id="run-list"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Item</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="" role="form">
                        <div class="form-group">
                            <label for="itemName">Item Name:</label>
                            <input type="text" class="form-control" id="itemName" name="itemName">
                        </div>
                        <div class="form-group">
                            <label for="itemUnit">Item Unit:</label>
                            <select id="itemUnit" name="itemUnit" class="form-control">
                                <option value="">请选择</option>
                                <option value="个">个</option>
                                <option value="次">次</option>
                                <option value="米">米</option>
                                <option value="公里">公里</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="itemFrequency">Frequency:</label>
                            <select id="itemFrequency" name="itemFrequency" class="form-control">
                                <option value="每天">每天</option>
                                <option value="每周">每周</option>
                                <option value="每月">每月</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addItem-sub">Save</button>
            </div>
        </div>
    </div>
</div>
    
<!--登录区域-->
    <div class="modal fade" id="login" tabindex="1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">登录</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" role="form">
                            <div class="form-group">
                                <label for="username">用户名:</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="form-group">
                                <label for="password">密  码:</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取  消</button>
                    <button type="button" class="btn btn-primary" id="login-sub">登  录</button>
                </div>
            </div>
        </div>
    </div>
<script src="http://cdn.staticfile.org/jquery/1.10.0/jquery.min.js"></script>
<script src="static/js/bootstrap.min.js"></script>
<script>
$(function() {
    var login = false;
    <?php
    if ($userInfo['isLogin']) {
    ?>
        login = true;
    <?php
    }
    ?>
    if (!login) {
        $('#login').modal('show');
    }

    $(document).on('click', function() {
        $login = $('#login');
        if (login) return;

        if ($login.css('display') === 'none') {
            $login.modal('show');
        }
        return false;
    });
    
    $("#login-sub").on('click', function() {
    	var $form = $('#login').find('form').eq(0);
        var obj = {};
        $form.find('input, select').each(function() {
            var $this = $(this);
            var $p = $this.closest('.form-group');
            if (!this.value && !$p.hasClass('has-error')) {
                $p.addClass('has-error');
            }
            if (this.value) $p.removeClass('has-error');
            obj[this.name] = this.value;
        });

        if ($form.find('.has-error').length) {
            return false;
        }
        
        NI.query('?f=login', NI.format_query('?f=login', obj), function(data) {
            if (data === "success") {
            	window.location.reload();
            } else if (data === "fail") {
            	alert('用户名或者密码有误！');
                $form.get(0).reset();
            }
        })
    });
    
    $('#addItem-sub').on('click', function() {
        var $form = $('#addItem').find('form').eq(0);
        var obj = {};
        $form.find('input, select').each(function() {
            var $this = $(this);
            var $p = $this.closest('.form-group');
            if (!this.value && !$p.hasClass('has-error')) {
                $p.addClass('has-error');
            }
            if (this.value) $p.removeClass('has-error');
            obj[this.name] = this.value;
        });

        if ($form.find('.has-error').length) {
            return false;
        }

        NI.query('?f=addItem', NI.format_query('addItem', obj), function(data) {
            $('#addItem').modal('hide');
            $form[0].reset();
            NI.append_item([JSON.parse(data)]);
        });
    });

    $(document).on('click', '.item-remove', function() {
        var $group = $(this).closest('.form-group');
        var id = parseInt($group.attr('data-id'));
        NI.query('?f=remove_line', NI.format_query('remove_item', id), function(data) {
            $group.remove();
        });
    });

    $('#run-none').on('click', function() {
        var data = ["今天啥也没做…"];
        NI.save_run(data);
    });

    $('#run-sub').on('click', function() {
        var data = [];
        $('#itemList').find('.form-group').each(function() {
            var msg = "";
            $(this).children().each(function() {
                var $this = $(this);
                if ($this.find('input,select').length) {
                    var num = $this.find('input,select').eq(0).val() || '0';
                    msg += '【' + num + '】';
                }
                if ($this.find('span').length) {
                    msg += $this.find('span').eq(0).text();
                }
            });
            data.push(msg);
        });

        NI.save_run(data);
    });
    
    $('.query-run').on('click', 'button', function() {
        var obj = {};
        var $row = $(this).closest('.row');
        var start = $row.find('.start-date').eq(0).val();
        var end = $row.find('.end-date').eq(0).val();
        
        if ($(this).hasClass('time-area')) {
            obj = {start: start, end: end};
        } else {
            obj = {query: $(this).attr("data-query")};
        }
        NI.query('?f=query_run', NI.format_query('query_run', obj), function(data) {
            var obj = JSON.parse(data);
        	var html = "";
            var tpl = '<p><span class="run-list-time">#{0}</span><span class="run-list-content">#{1}</span></p>';
            
            // 解决PHP中的经典坑---数据中只有一个元素的时候是一个Object
            if (obj.constructor !== Array) obj = [obj];
            for (var i = 0, len = obj.length; i < len; i++) {
            	html += $.format(tpl, obj[i].time, obj[i].content);
            }
            if (!len) html = "<p>暂无记录。</p>";
            $('#run-list').empty().append(html);
        });
    });

    // 初始化，预取数据
    NI.query('?f=get_items_by_name', NI.format_query('get_items'), function(data) {
        var obj;
        try{
            obj = JSON.parse(data);
            // PHP 经典坑
            if (Object.prototype.toString.call(obj) === '[object Object]') {
                obj = [obj];
            }
        } catch(ev) {
            obj = null;
        }
        
        NI.append_item(obj);
    });
});
var NI = {
    base_url: '<?php echo BASE_URL;?>',
    format_query: function(action, obj) {
        return {
            action: action,
            data: obj
        };
    },
    query: function(url, data, succ, fail) {
        $.ajax({
            url: this.base_url + url,
            data: data,
            method: 'post',
            success: function(data) {
                succ && succ(data);
            },
            error: function(info) {
                fail && fail();
            }
        });
    },
    save_run: function(data) {
        this.query('?f=save_run', this.format_query('save_run', data), function() {
            $('#itemList').find('input,select').val('');
            alert('保存成功！');
        });
    },
    append_item: function(arr) {
        var tpl_item = ['<div class="row form-group" data-id="#{2}">',
                '<div class="col-sm-2 col-sm-offset-2 text-right item-txt">',
                    '<span>#{0}</span>',
                '</div>',
                '<div class="col-sm-4">',
                    '<input type="number" class="form-control">',
                '</div>',
                '<div class="item-txt">',
                    '<span>#{1}</span><span class="glyphicon glyphicon-remove item-remove"></span>',
                '</div>',
            '</div>'].join('');
        var html = "";
        for (var i = 0, len = arr.length; i < len; i++) {
            html += $.format(tpl_item, arr[i]['name'], arr[i]['unit'], arr[i]['id']);
        }

        $('#itemList').append(html);
    }
};

$.format = function (d,a){d=String(d);var b=Array.prototype.slice.call(arguments,1),f=Object.prototype.toString;if(b.length){b=b.length==1?(a!==null&&(/\[object Array\]|\[object Object\]/.test(f.call(a)))?a:b):b;return d.replace(/#\{(.+?)\}/g,function(g,j){var i=b[j];if("[object Function]"==f.call(i)){i=i(j)}return("undefined"==typeof i?"":i)})}return d};
</script>
</body>
</html>
