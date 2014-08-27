<div class="container">
    <div class="sixteen columns">
        <aside class="five columns alpha sidebar">
            <!-- /text -->
            <div class="widget search">
                <h3>Search</h3>

                <form/>
                <input type="input" placeholder="Enter keyword and press enter…" name="s" id="search" results="5"/>
                </form>
            </div>
            <!-- /search -->

            <div class="widget text">
                <h3>企业理念</h3>

                <p> 真诚 卓越 有序 协同</p>

                <p>Sincerity Saliency Sequence Synergia </p>
            </div>
            <!-- /text -->
            <?php if(isset($product)):?>
                <div class="widget menu top_fix">
                <h3><a href="/Product/Index/<?=$product->id?>"><?=$product->title?></a></h3>
                <?php if(isset($query2)&&count($query2)>0):?>


                        <ul>
                            <?php foreach($query2 as $row):?>
                                <li><a href="/ProductCase/Index/<?=$row->id?>"><?=$row->title?></a> </li>
                            <?php endforeach;?>
                        </ul>

                <?php endif;?>
                </div>
            <?php endif;?>

        </aside>
       