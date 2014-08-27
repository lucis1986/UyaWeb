function getClientBounds() {
    var clientWidth;
    var clientHeight;

    clientWidth = document.compatMode == "CSS1Compat" ? document.documentElement.clientWidth : document.body.clientWidth;
    clientHeight = document.compatMode == "CSS1Compat" ? document.documentElement.clientHeight : document.body.clientHeight;

    return {width: clientWidth, height: clientHeight};
}

/*设置客户端的高和宽*/
function div_center(item) {
    var divId = item;
    var rr = new getClientBounds();

    if (divId != null) {
        divId.style.left = (rr.width - divId.clientWidth) / 2 + document.body.scrollLeft + "px";
        var top=(rr.height - divId.clientHeight) / 2 + document.body.scrollTop;
        top=top<divId.clientHeight/2?top:top-60
        divId.style.top =top  + "px";
    }
}