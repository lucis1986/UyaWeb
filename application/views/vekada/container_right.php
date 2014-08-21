<div class="eleven columns omega content">
    <style type="text/css">
        .item_list{
            list-style: none;
            margin: 10px 0 30px 0;

        }
        .item_list li{
            text-align: left;

        }
        .item_list li a,.item_list li a:link{
            display: block;
            text-indent: 10px;
            height: 25px;
            line-height: 25px;
            color: #000000;
            text-decoration: none;

        }
        .item_list li a:hover{
            background: #ccc;
        }
        .item_list li a:visited{
            color: inherit;
        }
        .item_list li a span{
            color:
        }
    </style>
    <span style="text-align: left;margin-left: 10px; padding-top: 10px;display: inline-block"><?php echo $block_title ?></span>

    <div style="margin: 10px 0;border-top:1px solid #ccc;border-bottom:1px solid #ccc;text-align: center;min-height: 500px; position: relative">
        <ul class="item_list">
            <?php foreach ($query as $row): ?>
                <li style="position: relative"><a href="/<?=$class?>/index/<?=$row->id?>" title="<?=$row->title?>"><?=mb_strimwidth($row->title,0,80,"...","utf8")?><span style=" position: absolute; right: 10px; font-size:14px;color:#778899;display: inline-block; top:0;"><?=date("Y-m-d",strtotime($row->modified))?></span></a></li>
            <?php endforeach; ?>
        </ul>
        <div style="position: absolute;bottom: 10px;width:100%; left:0;text-align: center;">
            <span><?php echo $this->pagination->create_links(); ?></span>
        </div>
    </div>
</div>
<!-- /content -->

</div>

</div>