<script type="text/javascript">
    $(function(){
        $("#content_list tr").each(function(){
            $(this).mouseenter(function(){
                $(this).addClass("MouseOver")
            });
            $(this).mouseleave(function(){
                $(this).removeClass("MouseOver");
            });
            $(this).click(function(){
                $("#content_list tr").each(function(){
                    if($(this).hasClass("Selected")){
                        $(this).removeClass("Selected");
                    }
                });
                $(this).addClass("Selected");
            })
        })
    })
</script>
<style type="text/css">
    .MouseOver{
        background: #c6ddff;
    }
    .Selected{
        background: rgba(0, 0, 0, 0.20);
    }
    #content_list td{
        line-height: 25px;
    }
</style>
<div  style="margin-left:200px;    min-height: 800px; background:#ccc; overflow: auto ">
    <span><?=$module->title?></span>
    <a target="_blank" href="/<?=$module->flag?>/Pages">http://<?=$_SERVER['SERVER_NAME']?>:<?=$_SERVER['SERVER_PORT']?>/<?=$module->flag?>/Pages</a>
    <a href="/management/add/<?=$module->id?>">Add New</a>
    <table id="content_list" border="0" width="90%" cellspacing="0" cellpadding="0" style="margin: 20px;">
        <?php foreach ($query as $row): ?>
            <tr >
                <td width="70" title="<?=$row->title?>"><?=mb_strimwidth($row->title,0,30,"...","utf8")?></td>
                <td width="20"><?php echo date("Y-m-d",strtotime($row->modified))?></td>
                <td width="10"><a  href="/management/edit/<?=$row->module_id?>/<?=$row->id?>">编辑</a></td>
                <td width="10"><a target="_blank" href="/<?=$module->flag?>/index/<?=$row->id?>">查看</a></td>
                <td width="10"><a href="/management/delete/<?=$row->module_id?>/<?=$row->id?>">删除</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $this->pagination->create_links(); ?>
</div>
<div style="clear: both;"></div>