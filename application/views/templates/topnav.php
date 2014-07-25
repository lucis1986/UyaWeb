<div style="border-bottom: 1px #ccc solid;height: 50px;line-height: 50px;">
    <div style="width:1000px; margin: 0 auto">
        <input
            style="border-bottom: 1px #ccc solid; height: 30px;width: 200px;vertical-align:middle;float: left; margin-top: 10px; "
            type="text">
        <span
            style="width: 30px; height: 30px; background: red; cursor: pointer; display: inline-block; line-height: 38px; float: left; margin: 10px 0 0 10px;background: url('/images/searchbutton.png')"></span>
        <ul id="topright_nav" style="float: right;">

            <?php for ($i = 0; $i < count($top_links); $i++): ?>
                <?php if ($i != 0): ?>
                    <li class="topright_nav_space"></li>
                <?php endif; ?>
                <li><a href="<?=$top_links[$i]->link?>"><?=$top_links[$i]->title?></a></li>
            <?php endfor; ?>
        </ul>
        <div style="clear: both"></div>
    </div>
</div>
<div style="margin: 0 auto;width: 1000px">
    <div>
        <div id="logo"></div>
        <ul id="main_menu">
            <?php for ($i = 0; $i < count($links); $i++): ?>
                <?php if ($i != 0): ?>
                    <li class="main_menu_space"></li>
                <?php endif; ?>
                <li><a href="<?=$links[$i]->link?>"><span><?=$links[$i]->title?></span></a></li>
            <?php endfor; ?>
        </ul>
        <div style="clear: both"></div>
    </div>
</div>