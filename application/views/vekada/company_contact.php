<div class="container contact">

    <script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
    <div class="sixteen columns">

        <div class="sixteen columns alpha content">

            <!--百度地图容器-->
            <div style="width:938px;height:300px;border:#ccc solid 1px;" id="dituContent"></div>

            <script type="text/javascript">
                //创建和初始化地图函数：
                function initMap(){
                    createMap();//创建地图
                    setMapEvent();//设置地图事件
                    addMapControl();//向地图添加控件
                    addMarker();//向地图中添加marker
                }

                //创建地图函数：
                function createMap(){
                    var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
                    var point = new BMap.Point(117.701016,39.036529);//定义一个中心点坐标
                    map.centerAndZoom(point,18);//设定地图的中心点和坐标并将地图显示在地图容器中
                    window.map = map;//将map变量存储在全局
                }

                //地图事件设置函数：
                function setMapEvent(){
                    map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
                    map.enableScrollWheelZoom();//启用地图滚轮放大缩小
                    map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
                    map.enableKeyboard();//启用键盘上下左右键移动地图
                }

                //地图控件添加函数：
                function addMapControl(){
                    //向地图中添加缩放控件
                    var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
                    map.addControl(ctrl_nav);
                    //向地图中添加缩略图控件
                    var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
                    map.addControl(ctrl_ove);
                    //向地图中添加比例尺控件
                    var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
                    map.addControl(ctrl_sca);
                }

                //标注点数组
                var markerArr = [{title:"威克达科技",content:"天津开发区第二大街国信大厦A座1门403",point:"117.700059|39.036592",isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
                ];
                //创建marker
                function addMarker(){
                    for(var i=0;i<markerArr.length;i++){
                        var json = markerArr[i];
                        var p0 = json.point.split("|")[0];
                        var p1 = json.point.split("|")[1];
                        var point = new BMap.Point(p0,p1);
                        var iconImg = createIcon(json.icon);
                        var marker = new BMap.Marker(point,{icon:iconImg});
                        var iw = createInfoWindow(i);
                        var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
                        marker.setLabel(label);
                        map.addOverlay(marker);
                        label.setStyle({
                            borderColor:"#808080",
                            color:"#333",
                            cursor:"pointer"
                        });

                        (function(){
                            var index = i;
                            var _iw = createInfoWindow(i);
                            var _marker = marker;
                            _marker.addEventListener("click",function(){
                                this.openInfoWindow(_iw);
                            });
                            _iw.addEventListener("open",function(){
                                _marker.getLabel().hide();
                            })
                            _iw.addEventListener("close",function(){
                                _marker.getLabel().show();
                            })
                            label.addEventListener("click",function(){
                                _marker.openInfoWindow(_iw);
                            })
                            if(!!json.isOpen){
                                label.hide();
                                _marker.openInfoWindow(_iw);
                            }
                        })()
                    }
                }
                //创建InfoWindow
                function createInfoWindow(i){
                    var json = markerArr[i];
                    var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
                    return iw;
                }
                //创建一个Icon
                function createIcon(json){
                    var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
                    return icon;
                }

                initMap();//创建和初始化地图
            </script>








            <div class="five columns alpha address">
                <h3>联系方式：</h3>

                <p><br />


                    Email: <a href="#">info@vekada.com</a><br /><br />
                    Phone: <a href="#">022-6554-1228</a><br /><br />
                    Fax： <a href="#">022-6554-1227</a><br /><br />
                    Web:  <a href="#">www.vekada.com</a>
                </p>

                <h3>&nbsp;</h3>
                <p><br />
                </p>

            </div>

            <div class="eleven columns alpha">
                <h1>&nbsp;</h1>
                <p>地址：天津开发区第四大街天大科技园软件大厦北楼403</p>
                <p>Add：Rm North-403 Software Building,No.80,4th Avenue TEDA Tianjin P.R.China</p>
                <form>
                <label for="name">Name:</label>
                <input type="text" id="name" />

                <label for="email">Email:</label>
                <input type="email" id="email" />

                <label for="message">Message:</label>
                <textarea id="message" rows="8"></textarea>


                <p><br /><input type="submit" class="button branded" value="Send message" /></p>
                </form>
            </div>


        </div><!-- /content -->

    </div>

</div>