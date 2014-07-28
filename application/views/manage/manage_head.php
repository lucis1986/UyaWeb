<html>
<head>
    <title>后台管理平台</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/js/windowresize.js"></script>
    <link rel="stylesheet" href="/css/core.css" type="text/css">
    <style type="text/css">
        #manage_top_nav{
            margin-left: 90px;
            float: left;
            list-style: none;
        }
        #manage_top_nav li{
            float: left;
        }
        #manage_top_nav li a{
            display: block;
            line-height: 50px;
            padding: 0 20px;
        }
        #manage_left_nav{
            margin-top:20px;
        }
        #manage_left_nav li a{
            display: block;
            height: 30px;
            line-height: 30px;
            color: #000000;
        }
        .current_top{
            background: #595959;
        }
        .current_left{
            background: #595959;
        }

    </style>
    <?php if(isset($current_top_nav)&&isset($current_left_nav)):?>
    <script type="text/javascript">
        $(function(){
            $("#<?=$current_top_nav?>").addClass("current_top");
            $("#left_nav_<?=$current_left_nav?>").addClass("current_left");
        })
    </script>
    <?php endif;?>
</head>
<body>
    <div style="height: 50px;background: #CCCCCC;text-align: left;min-width: 1000px;overflow: hidden">
        <div style="float: left;line-height: 50px;text-indent: 50px;"><a href="/Management/Index">管理平台</a></div>
        <div style="float: left;line-height: 50px;text-indent: 50px;">欢迎，***</div>
        <ul id="manage_top_nav">
            <li><a id="MainPage" href="/Management/MainPage">首页管理</a></li>
            <li><a id="Module" href="/Management/Module">模块管理</a></li>
            <li><a id="SinglePage" href="/Management/SinglePage">单页管理</a></li>
            <li><a id="Authority" href="/Management/Authority">权限管理</a></li>
        </ul>
        <div style="clear: both"></div>
    </div>