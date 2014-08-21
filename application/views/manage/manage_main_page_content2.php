<style type="text/css">
    .form_area div{
        margin-bottom: 2em;
    }
    .form_area div label{
        margin-left: 40px;
        width: 80px;
        display: inline-block;
    }

    .browser{
        display: inline-block;
        width: 100px;
        border: 1px solid #8a8a8a;
        background: #ccc;
        text-align: center;
        cursor: pointer;
        color: #838383;
    }
    .title{
        width: 150px;
    }
    .link{
        width: 400px;
    }
</style>
<td id="right_area">
    <div style="padding:20px;">
        <form class="form_area" method="post" action="/Services/SaveLink">
            <?php for($i=0;$i<count($result);$i++): ?>
                <div>
                    <input type="hidden" name="link[<?=$i+1?>][]" value="<?=$result[$i]->id?>"/>
                    <label>标题<?=$i+1?></label>
                    <input class="title<?=$i+1?>" type="text" name="link[<?=$i+1?>][]" value="<?=$result[$i]->title?>"/>
                    <label>链接<?=$i+1?></label>
                    <input class="link<?=$i+1?>" type="text" name="link[<?=$i+1?>][]" value="<?=$result[$i]->link?>"/>
                    <span class="browser">浏览</span>
                </div>
            <?php endfor; ?>
            <input type="submit" value="保存" style="width: 100px;height: 30px;margin-left: 40px"/>
            <input type="button" value="取消"  style="width: 100px;height: 30px;margin-left: 40px"/>
        </form>
    </div>
</td>

