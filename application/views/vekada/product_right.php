<aside class="five columns omega sidebar">

    <div class="widget search">
        <form />
        <input type="input" placeholder="Enter keyword and press enter…" name="s" id="search" results="5" />
        </form>
    </div><!-- /search -->

    <div class="widget text">
        <h3>我们服务的行业</h3>
        <p>石油 化工 天然气, 医药 快速消费品 污水处理. 汽车 钢铁 水泥. 造纸 </p>
    </div>
    <?php if(isset($query2)&&count($query2)>0):?>
        <div class="widget menu">
            <h3>成功案例</h3>
            <ul>
                <?php foreach($query2 as $row):?>
                    <li><a href="/ProductCase/Index/<?=$row->id?>"><?=$row->title?></a> </li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif;?>

</aside>

</div>

</div>