$(function(){
    $('.btn1').each(function(){
        $(this).mouseenter(function(){
            $(this).addClass("btn1_h")
        });
        $(this).mouseleave(function(){
            $(this).removeClass("btn1_h");
            $(this).removeClass("btn1_click")
        });

        $(this).mousedown(function(){
            $(this).addClass("btn1_click")
        })
        $(this).mouseup(function(){
            $(this).removeClass("btn1_click")
        })
    });
    $("button").mousedown(function(){
        alert("ttt");
    })
    onWindowResize.add(function () {
        dialog_center(".dialog");
    });

    $(".content_table tr").each(function () {
        $(this).mouseenter(function () {
            $(this).addClass("MouseOver")
        });
        $(this).mouseleave(function () {
            $(this).removeClass("MouseOver");
        });
        /*$(this).click(function () {
            $(".content_table tr").each(function () {
                if ($(this).hasClass("Selected")) {
                    $(this).removeClass("Selected");
                }
            });
            $(this).addClass("Selected");
        })*/
    });

    $('.dialog_title_panel').each(function(){
        $(this).mousedown(function(event){
            var isMove = true;
            var obj=$(this).parent();
            var abs_x = event.pageX - obj.offset().left;
            var abs_y = event.pageY - obj.offset().top;

            $(document).mousemove(function(event){
                if (isMove) {
                    obj.css({'left':event.pageX - abs_x, 'top':event.pageY - abs_y});
                }
            }).mouseup(function(){
                isMove = false;
            })
        })
    })



})
function dialog_center(class_name){
    $(class_name).each(function(){
        div_center(this);
    })
}
function dialog_close() {
    $('.dialog').hide()
    $("#mask").hide();
}
function dialog_show(id,callback){
    $("#"+id).show();
    $("#mask").show();
    if (callback){
        callback();
    }
    div_center(document.getElementById(id));
}

//$.fn.dialog_show = function(id,callback){
//    $("#"+id).show();
//    $("#mask").show();
//    if (callback){
//        callback();
//    }
//    div_center(document.getElementById(id));
//}

function checked_change(item) {
    var checked_item = $(item).prev();
    if (!checked_item.prop("checked")) {
        checked_item.prop("checked", true);
        $(item).addClass("checked")
    } else {
        checked_item.prop("checked", false);
        $(item).removeClass("checked")
    }
}
function cancel(item) {
    $(item).next().remove();
    $(item).after('<a href="#" title="编辑" class="edit_btn op_btn" onclick="edit(this)"></a>');
    $(item).remove();
    $("#entry_list li").each(function () {
        $(this).find(".extra").remove();
    })
}
