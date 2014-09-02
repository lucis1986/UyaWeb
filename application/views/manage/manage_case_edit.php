<td id="right_area">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script charset="utf-8" src="/plugins/kindeditor/kindeditor-min.js"></script>
    <script charset="utf-8" src="/plugins/kindeditor/lang/zh_CN.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>

<!--            <input type="text" name="author" value="--><?//= $author ?><!--"/><br>-->
<!--            <input type="text" name="created" value="--><?//= $created ?><!--"/><br>-->

            <table>
                <tr>
                    <td>
                        <div class="op_panel">
                            <a href="<?= $pre_url ?>" title="返回" class="back_btn op_btn"></a>
                            <a href="javascript:void(0)" onclick="save()" title="保存" class="save_btn op_btn"></a>
                        </div>
                    </td>
                    <td style="width: 100%">
                        <div class="op_content">
                            <div class="location">位置：案例库 -> 编辑</div>
                            <form  id="submit_form1" name="submit_form1" method="post" action="/ProductCase/save/<?= $id ?>">
                                <div style="text-align: left; margin-bottom: 20px;">
                                    <span class="yai_hei size1 color1">标题</span>
                                    <input name="title" id="title" style="text-align: left;width:800px" type="text"
                                           value="<?= $title ?>"  />
                                </div>
                                <input type="hidden" name="id" value="<?= $id ?>"/>
<!--                                <input type="hidden" name="pre_url" value="--><?//= $pre_url ?><!--">-->
                                <input type="hidden" name="author" value="<?= $author ?>"/>
                                <textarea name="body" id="body" rows="10" cols="80">
                                    <?= $body ?>
                                </textarea>
                                <br>
                                <div style="text-align: left; margin-bottom: 20px;">
                                    <span class="yai_hei size1 color1">产品</span>
                                    <select id="product_id" name="product_id">

                                        <option value="">-请选择-</option>
                                        <?php if (count($query3) > 0): ?>

                                                <?php foreach ($query3 as $row): ?>

                                                  <option value="<?= $row->id ?>" <?php if ("<?= $product_id?>"=="<?= $row->id ?>"): ?>selected="selected"<?php endif; ?>><?= $row->title ?></option>

                                                <?php endforeach; ?>

                                        <?php endif; ?>

                                    </select>

                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>


    <script type="text/javascript">
        var editor;
        KindEditor.ready(function (K) {
            editor = K.create('textarea[name="body"]', {
                allowFileManager: true,
                width: '95%',
                height: '500px'
            });
        });
        function save() {

            var title = $("#title").val();
            if(title==""||title==null){
                alert('标题不能为空');
            }
            else{
                var id=$("#id").val();
                //如果id==0，是新增，判断是否存在相同Title，存在不提交，不存在提交
                //如果id<>0,是更新，提交
                if(id==0||id==null)
                {
                    $.ajax({
                        url: "/ProductCase/IsExist/"+title,
                        type: 'GET',
                        async: false,
                        dataType:'text',
                        success: function (data) {
                            alert('111');
                             if(data>0)
                             {
                                alert('已存在此标题');
                             }
                            else
                             {
                                 $("#body").val(editor.html());
                                 $('#submit_form1').submit();
                             }
                        },
                        error: function (e) {
                            alert("发生错误！");
                            return;
                        }
                    });
                }
                else
                {
                    $("#body").val(editor.html());
                    $('#submit_form1').submit();
                }
            }
        }

    </script>

        </form>
</td>

