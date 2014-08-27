<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>后台管理平台</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/js/window_resize.js"></script>
    <script type="text/javascript" src="/js/div_center.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
    <link rel="stylesheet" href="/css/manage.css" type="text/css"/>
    <link rel="stylesheet" href="/css/dialog.css" type="text/css"/>
    <style type="text/css">











        #left_area {
            text-align: center;
        }

        #right_area {
            text-align: left;
            width: 100%;
        }
        #edit_panel{
            margin-top: 10px;
        }

    </style>
    <?php if (isset($current_top_nav) && isset($current_left_nav)): ?>
        <script type="text/javascript">
            $(function () {
                $("#<?=$current_top_nav?>").addClass("current_top");
                $("#left_nav_<?=$current_left_nav?>").addClass("current_left");
            })
        </script>
    <?php endif; ?>
</head>
<body>
<div id="mask"
     style="background: black;position: fixed; opacity: 0.3; top:0;left:0;display: none; width:9999px;height: 9999px;z-index: 999">
</div>
<div id="head_area">
    <div id="top_ribbon1">
        <span id="user_info">欢迎，Admin |  注销</span>
        <div style="clear: both"></div>
    </div>
    <div id="top_ribbon2">
        <a id="logo_link" href="/Management/Index"></a>
        <ul id="top_nav">
            <li><a id="MainPage" href="/Management/MainPage">首页管理</a></li>
            <li><a id="Module" href="/Management/Module">模块管理</a></li>
            <li><a id="Authority" href="/Management/Authority">权限管理</a></li>
        </ul>
        <div style="clear: both"></div>
    </div>
</div>
<table id="core_area">
    <tr>


