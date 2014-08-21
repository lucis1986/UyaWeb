function getClientBounds() {
    var clientWidth;
    var clientHeight;

    clientWidth = document.compatMode == "CSS1Compat" ? document.documentElement.clientWidth : document.body.clientWidth;
    clientHeight = document.compatMode == "CSS1Compat" ? document.documentElement.clientHeight : document.body.clientHeight;

    return {width: clientWidth, height: clientHeight};
}

/*设置客户端的高和宽*/
function div_center(id) {
    var divId = document.getElementById(id);
    var rr = new getClientBounds();

    if (divId != null) {
        divId.style.left = (rr.width - parseInt(divId.style.width)) / 2 + document.body.scrollLeft + "px";
        divId.style.top = (rr.height - parseInt(divId.style.height)) / 2 + document.body.scrollTop + "px";
    }
}