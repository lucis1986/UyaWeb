<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>后台管理平台</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/js/window_resize.js"></script>
    <script type="text/javascript" src="/js/div_center.js"></script>
    <link rel="stylesheet" href="/css/core.css" type="text/css"/>
    <style type="text/css">
        #manage_top_nav {
            margin-left: 90px;
            float: left;
            list-style: none;
            white-space: nowrap;
        }

        #manage_top_nav li {
            float: left;
        }

        #manage_top_nav li a {
            display: block;
            line-height: 50px;
            padding: 0 20px;
        }

        #manage_left_nav {
            margin-top: 20px;
            width: 200px;
        }

        #manage_left_nav li a {
            display: block;
            height: 30px;
            line-height: 30px;
            color: #000000;
        }

        .current_top {
            background: #595959;
        }

        .current_left {
            background: #595959;
        }

        .menu_button {

            padding: 0 10px;
            height: 30px;
            margin-right: 5px;

        }

        #head_area {
            height: 50px;
            background: #CCCCCC;
            text-align: left;
            min-width: 1000px;
            width: 1000px;
            width: auto !important;

        }

        #core_area {
            width: 100%;
            border-collapse: collapse;
            height: 700px;
        }

        #core_area td {
            vertical-align: top;
        }

        .left_area_content {
            width: 200px;

        }

        #left_area {
            background: rgb(157, 157, 157);
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

<div id="head_area">
    <div style="float: left;line-height: 50px;text-indent: 50px;"><a href="/Management/Index">管理平台</a></div>
    <div style="float: left;line-height: 50px;text-indent: 50px;">欢迎，***</div>
    <ul id="manage_top_nav">
        <li><a id="MainPage" href="/Management/MainPage">首页管理</a></li>
        <li><a id="Module" href="/Management/Module">模块管理</a></li>
        <li><a id="Authority" href="/Management/Authority">权限管理</a></li>
    </ul>
    <div style="clear: both"></div>
</div>
<table id="core_area">
    <tr>


