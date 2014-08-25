<td id="left_area">
    <ul id="left_nav">
        <?php foreach($types as $row):?>
            <li><a id="left_nav_<?=$row->id?>" href="/Management/Module/<?=$row->id==0?"":$row->id?>"><?=$row->title?></a></li>
        <?php endforeach;?>
    </ul>
    <div class="space_bar_top"></div>
    <div class="space_bar_bottom"></div>
</td>
