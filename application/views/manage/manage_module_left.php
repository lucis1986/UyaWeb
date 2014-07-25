<div
    style="float: left; width: 200px; background: rgb(157, 157, 157);min-height: 700px;height: auto !important; height: 700px;overflow: visible;">
    <ul id="manage_left_nav">
        <?php foreach($types as $row):?>
            <li><a id="left_nav_<?=$row->id?>" href="/Management/Module/<?=$row->id==0?"":$row->id?>"><?=$row->title?></a></li>
        <?php endforeach;?>
    </ul>
</div>