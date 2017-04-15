
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>社区服务网</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <script type="text/javascript" src="../js/jquery.easydrag.handler.beta2.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../js/login.js" ></script>
    <script type="text/javascript" src="../js/slide.js" ></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $('.one').click(function(){

                $('.box2').show();


            });

            $('.login5 a').click(function(){


                $('.box2').hide();


            });

            $('.box').easydrag();
            $(".btn2").click(function(){
                window.location.href="index.html";

            })

        });
    </script>
    <style type="text/css">

        body {
            background-image: url(../images/bg.jpg);
            background-repeat: repeat-x;
            margin-top: 0px;
        }

        .biaoti {
            height: 35px;
            width: 960px;
            background-image: url(../images/banner2.jpg);
            background-repeat: no-repeat;
            margin-top: 4px;
            margin-right: auto;
            margin-bottom: 0px;
            margin-left: auto;
        }
        .biaoti_lanmu {
            font-family: "宋体";
            font-size: 14px;
            color: #FFF;
            height: 35px;
            width: 70px;
            line-height: 35px;
            text-align: center;
            margin: 0px;
            float: left;
        }
        .biaoti_lanmu a{ color:#ffffff; text-decoration:none;}
        .biaoti_lanmu a:link{ color:#ffffff; text-decoration:none;}
        .biaoti_lanmu a:visited{ color:#ffffff; text-decoration:none;}
        .biaoti_lanmu a:hover{ color:#3FF; text-decoration:none;}
        .biaoti_lanmu a:active{ color:#ffffff; text-decoration:none;}

        #apDiv1 {
            position:absolute;
            width:116px;
            height:43px;
            z-index:1;
            left: 771px;
            top: 235px;
            visibility: hidden;
        }
        .cttt {
            height: 60px;
            width: 960px;
            margin-top: 4px;
            margin-right: auto;
            margin-bottom: 0px;
            margin-left: auto;
            border: 1px solid #C4F0FF;
            line-height: 60px;
            text-align: center;
            color: #000;
        }
        .one{  cursor: pointer;  }
        .box{ float:left; position:relative; padding:1px; top:10%;  opacity:0.5;z-index:4;  opacity:1; }
        .box_bg{}
        .box2{ width:100%; height:100%; margin:0 auto; display:none; z-index:5; position:fixed; background:rgba(0, 0, 0, 0.52) none repeat scroll 0% 0%; opacity:1;}

        .login5{ width:680px; height:65px; background:#b52200; text-align:center; position:relative; margin:150px auto 0px auto;}
        .login5 h2{ font-size:30px; line-height:65px; color:#ffffff;}
        .login5 a{ background:url(../img/login_reg.png) 0px 0px no-repeat; position:absolute; width:16px; height:16px; right:10px; top:25px;}
        .login51{ width:600px; padding:40px 40px 50px; margin:0 auto; background:#EFEFEF; height:300px; }
        .login5left{ float:left; width:300px; height:200px; font-size:13px;}
        .login5left span{ line-height:24px; color:#f00; margin-left:10px;}
        .login5left1{ width:100%; margin-bottom:22px; float:left; position:relative; display:block;}
        .login5left1 input{ text-indent:10px; width:296px; color:#999; font-size:13px; height:40px; line-height:40px; border:1px solid #999; border-radius:5px;}
        .login5left2{ height:45px; line-height:45px; width:100%; margin-bottom:22px; float:left; position:relative; display:block;}
        .login5left2 .dl{ float:left; width:97px; height:45px; line-height:45px; text-align:center; background:none repeat scroll 0% 0% #55ACEF; color:#fff; border-radius:5px; display:inline-block; font-size:14px; outline:medium none;}
        .login5left2 .wjmm{ color:#55ACEF; margin-left:20px;}
        .login5right{ float:left; margin-left:35px; width:220px; height:280px; border-left:1px solid #CBCBCB; padding-left:35px;}
        .login5right span{ line-height:24px; color:#f00; margin-left:10px;}
        .login5right1{ height:40px; line-height:40px; border-radius:5px; border:1px solid #55ACEF; width:100%; margin-bottom:22px; float:left; position:relative;}
        .login5right1 .sjdl{ background:url(../images/smallico.png) no-repeat 30px -28px; height:22px; line-height:20px; padding-left:60px; display:inline-block; color:#55ACEF; position:relative; margin-top:10px;}
        .login5right2{ width:100%; float:left; margin-bottom:22px; position:relative; font-size:13px; text-align:center;}
        .login5right2 .zcdl{ color:#55ACEF; font-size:14px;}
        .login5right3{ text-align:center; height:40px; line-height:40px; width:100%; float:left; margin-bottom:22px; position:relative; display:inline-block; font-size:13px;}
        .login5right3 b{ height:4px; border-top:1px solid rgb(203, 203, 203); display:inline-block; width:60px;}
        .login5right3 .found{ margin-left:8px;}
        .login5right3 .back{ margin-right:8px;}
        .login5right4{ text-align:center; width:100%; float:left; margin-bottom:22px; position:relative; display:block;}
        .login5right4 a{ background:url(../images/share.png) no-repeat; width:46px; height:46px; position:absolute;}
        .login5right4 .wb{ background-position:0px -47px; margin-left:-60px }
        .login5right4 .qq{ background-position:0px 0px;}

    /*评论样式*/
        #comments{padding:0;height:6%;overflow:hidden;border-bottom:1px solid #BCD5E5;margin-bottom: 40px}
        #comments h1{background:#F6FBFF;border-bottom:2px solid #3BB0DB;font-size:14px;color:#000; padding:12px;height:1%;overflow:hidden;font-weight:bold;}
        /*ul {*/
            /*list-style: none;*/
            /*margin-top: 30px;*/
        /*}*/

        .box1 {
            width: 600px;
            margin: 0px 200px;
            border: 1px solid #ccc;
            border-radius: 3px;
            padding: 0;
        }
        .input{
            position: relative;
        }
        .touxiang {
            display: inline;
            position: absolute;
            top:0px;
            left:10px;
        }
        .box1 textarea {

            width: 80%;
            height: 110px;
            outline: none;
            display: inline;
            resize: none;
            margin-left: 60px;
        }

        .box1 ul {
            width: 450px;
            padding-left: 80px;
        }

        .box1 ul li {
            line-height: 25px;
            border-bottom: 1px dashed #ccc;
        }

        .title {
            float: left;
        }

        .box1 .input {
            margin-top: 4px;
            padding: 5px;
        }

        .func {
            float: right;
        }

        #btn {
            display: inline-block;
            height: 28px;
            line-height: 29px;
            width: 60px;
            min-width: 40px;
            font-size: 14px;
            background-color: #ff8140;
            color: #fff;
            box-shadow: none;
            cursor: default;
            border: 1px solid #f77c3d;
            outline: none;
            padding: 0 10px;
            border-radius: 2px;
            text-align: center;
        }

        .box1 input {
            float: right;
        }
    </style>
</head>
<body>
<!--登录弹出框-->
<div class="box">
    <div class="box2">
        <div class="login5">
            <h2 >登录</h2>
            <a class="close"></a>
        </div>
        <div class="login51">
            <form name="login5form" action="">
                <div class="login5left">
                    <span></span>
                    <div class="login5left1">
                        <input id="loginName" type="text" name="username" placeholder="用户名/手机号/邮箱" /></input>
                    </div>
                    <div class="login5left1">
                        <input id="loginpwd" type="password" name="user_possword" placeholder="密码" /></input>
                    </div>
                    <div class="login5left2">
                        <input name="" type="button" onclick="login()" class="dl btn2"  value="登录"/>
                        <!--<a class="dl">登录</a>-->
                        <a class="wjmm" style="cursor: pointer">忘记密码</a>
                    </div>
                </div>
                <div class="login5right">

                    <div class="login5right2">
                        没有账号？<a class="zcdl">快速注册</a>
                    </div>
                    <div class="login5right3">
                        <b class="found"></b>合作账号登录<b class="back"></b>
                    </div>
                    <div class="login5right4">
                        <a class="wb"></a><a class="qq"></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--头部、登录-->
<div class="sz_header">
    <!-- 注册登陆-->
    <div class="sz_topNav" contorl="LEAP/HOME/Web/SJYWControl/home_sjyw_ysj.vm" sc="WebGeneral" >
        <div class="clearfix sz_topNav_content">
            <a class="jyw_login one" >登录</a>
            <a class="jyw_register" href="/home/sjwy_webmap/sjwy_yhzc">注册</a>

            <div class="sz_topNav_right">
                <a class="jyw_homePage" href="#" onclick="SetHome(this,window.location)" >设为首页</a>
                <a class="jyw_addFavorites" href="#" onclick="javascript:addFavorite2()">加入收藏</a>
                <a href="javascript:return false" class="jyw_skin">换肤</a>


            </div>
            <input type="hidden" id="webcontext" name="webcontext" value="/home/">
            <input type="hidden" id="webcontext1" name="webcontext1" value="">
            <input type="hidden" id="jumppath" name="jumppath" value="">
            <input type="hidden" id="pageurl" name="pageurl" value="">
        </div>
      </div>
    </div>
<div class="sz_banner_content" style="height: 200px; width: 960px; margin-top: 0px;margin-right: auto;margin-bottom: 0px;margin-left: auto;">
    <img src="../img/fazhi.jpg " width="960px" height="200px">
</div>


<!--导航栏、-->
<div class="biaoti">
    <!-- <div class="biaoti_lanmu"><a href="default.aspx">首页</a></div>
    <div class="biaoti_lanmu"><a href="shequ-map.html">社区导航</a></div>


    <div class="biaoti_lanmu"><a href="street-trends.html">街道动态</a></div>

    <div class="biaoti_lanmu"><a href="fazhi.html">法制宣传</a></div>
    <div class="biaoti_lanmu"><a href="tongzhi.html">通知公告</a></div>

    <div class="biaoti_lanmu"><a href="banshi.html">办事指南</a></div> -->

    @foreach($weng as $w)
        <div class="biaoti_lanmu"><a href="tongzhi.html" style="color:#000">
            {{ $w->category_name }}
        </a></div>
    @endforeach




</div>








<!--主内容-->
<div class="content"style="height:820px;">
    <!-- 左栏 start-->
    <div class="content_left">
        <div class="news">
            <div class="news_title"> </div>
            <!--[if !IE]>幻灯片+文字列表㈡<![endif]-->
            <div class="swflist swf-list-02">
                <div class="main">
                        <div class="swf_wjj">
                            <img src="../images/area.jpg!qtwebp226"/>
                        </div>
                    <ul>
                        <!-- <li>·<a href="Article.aspx?id=995" target="_blank">  “弘扬文明祭祀，倡导绿色生活”清明宣传活</a><span >2017-03-31</span></li>
                        <li>·<a href="Article.aspx?id=992" target="_blank">  文竹苑社区开展“惠民政策进万家”宣传活动</a><span >2017-03-25</span></li>
                        <li>·<a href="Article.aspx?id=990" target="_blank">  安彩嘉园社区开展义诊活动</a><span >2017-03-21</span></li>
                        <li>·<a href="Article.aspx?id=989" target="_blank">  “学雷锋”志愿服务活动进社区</a><span >2017-03-17</span></li>
                        <li>·<a href="Article.aspx?id=988" target="_blank">  全面治理环境污染，“蓝天工程”初见成效</a><span >2017-03-14</span></li>
                        <li>·<a href="Article.aspx?id=987" target="_blank">  高新区消防大队联合安彩嘉园社区开展消防宣</a><span >2017-03-14</span></li> -->
                        @foreach($articles as $article)
                        <li>·<a href="Article.aspx?id=988" target="_blank">
                            {{ $article->article_title }}
                        </a><span >{{ $article->article_created_at }}</span></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--[if !IE]>END 幻灯片+文字列表㈡<![endif]-->
        </div>
        <div class="jt_mbox_01" id="slippage_01">
            <div class="jt_mbox_01_title">
                <ol>
                    <li class="over"><span class="cat_title"><a href="">在线服务</a></span></li>

                </ol>
            </div>
            <div class="jt_mbox_01_content">
                <ul class="sz_otherService ">
                    <!--<li class="one"><img src="../images/dh_r1_c1.jpg" border="0" /></a>-->

                    <!--</li>-->
                    <!--<li class="one"><img src="../images/dh_r1_c3.jpg" border="0" /></a>-->

                    <!--</li>-->
                    <!--<li class="one"><img src="../images/dh_r1_c5.jpg" border="0" /></a>-->

                    <!--</li>-->
                    <!--<li class="one"><img src="../images/dh_r1_c7.jpg" border="0" /></a>-->

                    <!--</li>-->
                    <!--<li class="one"><img src="../images/dh_r1_c9.jpg" border="0" /></a>-->
                    <!--<li class="one"><img alt="" src="../images/dh_r1_c11.jpg" /></a></li>-->
                    <!--<li class="one"><img alt="" src="../images/dh_r1_c16.jpg" /></a></li>-->

                    <!--<li class="one"><img alt="" src="../images/dh_r1_c13.jpg" /></a></li>-->
                    <!--</li>-->
                    <!--<li class="one"><img src="../images/dh_r1_c14.jpg" border="0" /></a>-->

                    <!--</li>-->
                    <li><a href="http://localhost:63342/weng/html/anyang.html" target="_blank"><img sc="resource" resource.att="src" src="../images/service1.gif">养老服务</a></li>
                    <li><a href="http://www.gbsq.org/home/sjwy_webmap/sjwy_yilfw" target="_blank"><img sc="resource" resource.att="src" src="../images/service2.gif">医疗服务</a></li>
                    <li><a href="http://www.gbsq.org/home/sjwy_webmap/sjwy_bxfw"><img sc="resource" resource.att="src" src="../images/service3.gif">保险服务</a></li>
                    <li><a href="http://www.gbsq.org/home/sjwy_webmap/sjwy_qcfw" target="_blank"><img sc="resource" resource.att="src" src="../images/service4.gif">汽车服务</a></li>
                    <li><a href="http://www.gbsq.org/home/sjwy_webmap/sjwy_wyfw"><img sc="resource" resource.att="src" src="../images/service5.gif">物业服务</a></li>
                    <li><a href="http://a1865789.sn12279.gzonet.com/" target="_blank"><img sc="resource" resource.att="src" src="../images/service6.gif">青年驿站</a></li>
                    <li><a href="http://www.gbsq.org/home/sjwy_webmap/sjwy_flfw_cf#height=1123" target="_blank"><img sc="resource" resource.att="src" src="../images/service7.gif">法律服务</a></li>
                    <li><a href="http://www.gbsq.org/home/sjwy_webmap/sjwy_wxfw" target="_blank"><img sc="resource" resource.att="src" src="../images/service8.gif">维修服务</a></li>


                </ul>
                    <div class="clearfix"></div>
            </div>

        </div>


        <div class="SameBox_03 sspp">
            <div class="SameBox_03_title">
                <h2><span class="cat_title">社区动态</span></h2>
                <span class="more"><a href="classd.aspx">&lt; MORE &gt;</a></span> </div>
            <div class="SameBox_03_con">
                <ul>

                    <li>·<a href="article2.aspx?name=文竹苑社区&id=995" target="_blank">  “弘扬文明祭祀，倡导绿色生活”清明</a><span >　2017-03-31</span></li>

                    <li>·<a href="article2.aspx?name=文竹苑社区&id=992" target="_blank">  文竹苑社区开展“惠民政策进万家”宣</a><span >　2017-03-25</span></li>

                    <li>·<a href="article2.aspx?name=安彩嘉园社区&id=990" target="_blank">  安彩嘉园社区开展义诊活动</a><span >　2017-03-21</span></li>

                    <li>·<a href="article2.aspx?name=华强城社区&id=989" target="_blank">  “学雷锋”志愿服务活动进社区</a><span >　2017-03-17</span></li>

                    <li>·<a href="article2.aspx?name=安彩嘉园社区&id=988" target="_blank">  全面治理环境污染，“蓝天工程”初见</a><span >　2017-03-14</span></li>

                    <li>·<a href="article2.aspx?name=安彩嘉园社区&id=987" target="_blank">  高新区消防大队联合安彩嘉园社区开展</a><span >　2017-03-14</span></li>

                </ul>
            </div>
        </div>
        <div class="SameBox_03">
            <div class="SameBox_03_title">
                <h2><span class="cat_title">办事处动态</span></h2>

                <span class="more"><a href="classa.aspx?class=办事处动态">&lt; MORE &gt;</a></span> </div>
            <div class="SameBox_03_con">
                <ul>

                    <li>·<a href="article2.aspx?name=峨嵋大街街道办事处&id=911" target="_blank">   峨嵋街道顺利召开机关支部换届选举</a><span >　2016-12-19</span></li>

                    <li>·<a href="article2.aspx?name=商颂办事处&id=909" target="_blank">  商颂街道党工委组织开展“美丽乡村 </a><span >　2016-12-16</span></li>

                    <li>·<a href="article2.aspx?name=峨嵋大街街道办事处&id=906" target="_blank">  峨嵋办事处组织社区志愿者慰问空巢老</a><span >　2016-12-14</span></li>

                    <li>·<a href="article2.aspx?name=银杏大街街道办事处&id=734" target="_blank">  强化安全发展观念  提升全民安全素</a><span >　2016-07-15</span></li>

                    <li>·<a href="article2.aspx?name=银杏大街街道办事处&id=694" target="_blank">  为民吃水日夜奋战 学习红旗渠精神争</a><span >　2016-07-01</span></li>




                </ul>
            </div>
        </div>
        <!--[if !IE]>END 栏目<![endif]-->
        <!-- 通栏广告-优惠政策 -->
        <div class="sz_banner_yhzc" >

            <div ><a  href="/home/sjwy_webmap/sjwy_hmzt" target="_blank">
                <img sc="resource" resource.att="src" src="../images/banner_yhzc.jpg">
            </a>
            </div>
        </div>
        <!-- 结束-通栏广告-优惠政策 -->


    </div>
<!--右栏-->
    <div class="content_right"  style="height:800px;">

        <div class="jt_mbox_02" id="slippage_05" style="margin-top:0px;">
            <div class="jt_mbox_02_title">
                <ol>
                    <li class="over"><span class="cat_title"><a href="">通知公告</a></span></li>
                </ol>
            </div>
            <div class="jt_mbox_02_content" style="height:234px;">
                <ul class="jjss02">

                    <li><a href="http://www.gxqsqfw.cn/Article.aspx?id=828" target="_blank">  安阳市民政局关于转发河南省民</a>　<span >11-24</span></li>
                    <li><a href="Article.aspx?id=786" target="_blank">  安阳市人民政府关于做好201</a>　<span >09-05</span></li>
                    <li><a href="Article.aspx?id=776" target="_blank">  全国民政系统学习宣传许帅同志</a>　<span >08-23</span></li>
                    <li><a href="Article.aspx?id=764" target="_blank">  河南省确定每年8月为“农村留</a>　<span >08-09</span></li>
                    <li><a href="Article.aspx?id=746" target="_blank">   公告</a>　<span >07-20</span></li>
                    <li><a href="Article.aspx?id=704" target="_blank">  关于2015年度按比例安排残</a>　<span >07-04</span></li>
                    <li><a href="Article.aspx?id=516" target="_blank">  高新区召开城市管理工作会议 </a>　<span >05-16</span></li>
                    <li><a href="Article.aspx?id=420" target="_blank">  高新区召开村级组织换届选举工</a>　<span >12-11</span></li>



                </ul>

            </div>
            <div class="jt_mbox_02_bot"></div>
        </div>

        <div class="pic_link_01">
            <ul>
                <li style="margin-top:0px;"></li>
            </ul>
        </div>

        <div class="jt_mbox_02" id="slippage_02">
            <div class="jt_mbox_02_title">
                <ol>
                    <li class="over"><span class="cat_title"><a href="">互动交流</a></span></li>
                </ol>
            </div>
            <div class="jt_mbox_02_content">
                <ul class="jjss">
                    <li><span style="font-size:10.5px;font-family:宋体;
" class="one">
                        网上投诉</span></li>
                    <li><span style="font-size:10.5px;font-family:宋体;
mso-ascii-font-family:&quot;Times New Roman&quot;;mso-hansi-font-family:&quot;Times New Roman&quot;;
mso-bidi-font-family:&quot;Times New Roman&quot;;mso-font-kerning:1.0pt;mso-ansi-language:
EN-US;mso-fareast-language:ZH-CN;mso-bidi-language:AR-SA" class="one">
                        网上咨询 </span></li>
                    <li><span style="font-size:10.5px;font-family:宋体;" class="one">
                        回复反馈</span></li>
                    <li><span style="font-size:10.5px;font-family:宋体;" class="one">
                        民意征集</span></li>
                </ul>
            </div>
            <div class="jt_mbox_02_bot"></div>

        </div>

        <div class="jt_mbox_02" id="slippage_05" >
            <div class="jt_mbox_02_title">
                <ol>
                    <li class="over"><span class="cat_title"><a href="#">社区信息排行榜</a></span></li>


                </ol>
            </div>
            <div class="jt_mbox_02_content" style="height:149px;">
                <ul class="jjss02">

                    <li><img src="../images/top1.gif" width="15" height="12" /><a href="sq.aspx?name=万科社区" target="_blank">  万科社区</a><span >　发文(54)篇</span></li>

                    <li><img src="../images/top2.gif" width="15" height="12" /><a href="sq.aspx?name=华强城社区" target="_blank">  华强城社区</a><span >　发文(34)篇</span></li>

                    <li><img src="../images/top3.gif" width="15" height="12" /><a href="sq.aspx?name=银杏社区" target="_blank">  银杏社区</a><span >　发文(29)篇</span></li>

                    <li><a href="sq.aspx?name=安彩嘉园社区" target="_blank">  安彩嘉园社区</a><span >　发文(23)篇</span></li>

                    <li><a href="sq.aspx?name=御景园社区" target="_blank">  御景园社区</a><span >　发文(17)篇</span></li>

                    <li><a href="sq.aspx?name=后营社区" target="_blank">  后营社区</a><span >　发文(16)篇</span></li>

                    <li><a href="sq.aspx?name=前张村社区" target="_blank">  前张村社区</a><span >　发文(14)篇</span></li>

                    <li>><a href="sq.aspx?name=文竹苑社区" target="_blank">  文竹苑社区</a><span >　发文(12)篇</span></li>

                    <li><a href="sq.aspx?name=桂花社区" target="_blank">  桂花社区</a><span >　发文(11)篇</span></li>

                    <li><a href="sq.aspx?name=丽豪社区" target="_blank">  丽豪社区</a><span >　发文(11)篇</span></li>

                </ul>

            </div>

        </div>

        <div style="border-style: none; border-color: inherit; border-width: medium; font-size:0; clear:both; zoom:1;">
            <div class="jt_mbox_02_bot">
            </div>
        </div>




        <!--心声细语-->
        <div class="jyw_xsxy" contorl="LEAP/HOME/Web/SJYWControl/home_sjyw_bbsmore.vm" sc="WebGeneral" >


            <div class="sz_rightBox_hd">
                <h2>心声细语</h2>

            </div>

            <div class="sz_rightBox_bd" id="marqueeContainer">

                <dl class="sz_xsxy">

                    <dt>
                        <span class="sz_xsxy_question">问</span>
                        个人信息泄露怎么办？天天有广告电话！！垃圾短信！！没完没了！！怎么办！！
                    </dt>
                    <dd >
                        <p style="text-indent:0;text-align:left" >
                            <span class="sz_xsxy_answer">答</span>
                            1个人的电子邮箱、网络支付及银行卡等密码要有差异；
                            2掌握公民个人信息的网站或单位要对用户信息加密并采取分级查看的权限设置；
                            3增强个人信息安全意识，不要轻易将...
                        </p>
                    </dd>

                    <dt>
                        <span class="sz_xsxy_question">问</span>
                        我是住在年丰社区这边的居民，为什么在年丰村公交站之间的马路一直没有建设红绿灯呢？？？我们年丰社区这边离高速路口近，很多大货车经过，平时都不敢然小孩子自己一个人独...
                    </dt>
                    <dd >
                        <p style="text-indent:0;text-align:left" >
                            <span class="sz_xsxy_answer">答</span>
                            你好，我们会和相关部门反映，及时给您答复
                        </p>
                    </dd>

                    <dt>
                        <span class="sz_xsxy_question">问</span>
                        13日，我們水山緣会所已封閉且搞裝修。我们是一群在水山缘露台跳舞打球的水山缘业住，由于装修一时也没有了地方。我想了解，你们装修完后，不会做成封闭式的吧？这可是我...
                    </dt>
                    <dd >
                        <p style="text-indent:0;text-align:left" >
                            <span class="sz_xsxy_answer">答</span>
                            谢谢居民对我社区工作站工作的支持与关注。
                            一、南龙社区志愿服务站提升工程（水山缘会所提升工程）属民生大盆菜工程，工程主要内容是：对水山缘会所进行翻新及修复。翻新...
                        </p>
                    </dd>



                    <dt>
                        <span class="sz_xsxy_question">问</span>
                        荣村小公园垃圾比较多，请帮忙联系物业清理。
                    </dt>
                    <dd >
                        <p style="text-indent:0;text-align:left" >
                            <span class="sz_xsxy_answer">答</span>
                            已联系物业处理了，谢谢您的反馈！
                        </p>
                    </dd>

                    <dt>
                        <span class="sz_xsxy_question">问</span>
                        请问工作现在新搬哪儿去了？
                    </dt>
                    <dd >
                        <p style="text-indent:0;text-align:left" >
                            <span class="sz_xsxy_answer">答</span>
                            还是之前那个地点，在之前办公室的旁边世纪假日物业管理处办公，二分钟就走到了
                        </p>
                    </dd>

                    <dt>
                        <span class="sz_xsxy_question">问</span>
                        荣村的的天然气什么时候开通？
                    </dt>
                    <dd >
                        <p style="text-indent:0;text-align:left" >
                            <span class="sz_xsxy_answer">答</span>
                            荣村小区属于老旧小区，不具备通气的条件，目前工作站已经和深圳燃气公司协商此项工作，有进一步消息，我们会发通知在宣传栏，请大家留意。或者前往工作站咨询。
                        </p>
                    </dd>

                    <dt>
                        <span class="sz_xsxy_question">问</span>
                        请问兰园附近有没有可以租借的稍微大一点，最好有投影仪的会议室，开会需要展示但是没有场地。
                    </dt>
                    <dd >
                        <p style="text-indent:0;text-align:left" >
                            <span class="sz_xsxy_answer">答</span>
                            您好，感谢提问，社区工作站有，但是需要您去工作站咨询一下，看看时间是否冲突，如果工作站已经安排了会议的话是无法外接的。
                            我们也会后续跟进，整理社区公共可用资源，...
                        </p>
                    </dd>


                    <dt>
                        <span class="sz_xsxy_question">问</span>
                        连先生咨询相关劳动法律知识
                    </dt>
                    <dd >
                        <p style="text-indent:0;text-align:left" >
                            <span class="sz_xsxy_answer">答</span>
                            反馈相关法律法规。
                        </p>
                    </dd>


                    <dt>
                        <span class="sz_xsxy_question">问</span>
                        蓝女士咨询是否有保姆或清洁的工作
                    </dt>
                    <dd >
                        <p style="text-indent:0;text-align:left" >
                            <span class="sz_xsxy_answer">答</span>
                            请其联系前次来寻找保姆的社区居民。
                        </p>
                    </dd>



                    <dt>
                        <span class="sz_xsxy_question">问</span>
                        闵先生希望在兰园小区租房
                    </dt>
                    <dd >
                        <p style="text-indent:0;text-align:left" >
                            <span class="sz_xsxy_answer">答</span>
                            帮助其一起咨询管理处。
                        </p>
                    </dd>

                    <dt>
                        <span class="sz_xsxy_question">问</span>
                        求助生活小妙招，越多越好！
                    </dt>
                    <dd >
                        <p style="text-indent:0;text-align:left" >
                            <span class="sz_xsxy_answer">答</span>
                            求助生活小妙招，越多越好！
                        </p>
                    </dd>


                    <dt>
                        <span class="sz_xsxy_question">问</span>
                        请问社区有闲置交换或转让的活动吗？
                    </dt>
                    <dd >
                        <p style="text-indent:0;text-align:left" >
                            <span class="sz_xsxy_answer">答</span>
                            您好，社区服务中心之前有物物交换这项活动进行，现在居民一般是通过Q群发布物品相片出来，如果有居民有兴趣的话会关注，您可加上光华社区居民群在里面发布您在交换的物品...
                        </p>
                    </dd>


                </dl>
            </div>



        </div>

    </div>

    <div style="font-size:0; height:0; border:none; clear:both; zoom:1;"></div>



</div>

<!--评论-->
<div class="box1" id="weibo">
    <div id="comments">
        <H1>最新评论</H1>
    </div>

    <div style="clear: both"></div>

    <div class="input">
        <!--头像-->
        <div class="touxiang">
            <img src="http://assets.changyan.sohu.com/upload/asset/scs/images/pic/pic42_null.gif" onerror="SOHUCS.isImgErr(this)" width="42" height="42" alt="">
        </div>
        <textarea name="" id="txt" cols="20" rows="10">来说两句吧。。。</textarea>
    </div>
    <div class="func">
        <a id="btn">发布</a>
    </div>
    <div style="clear: both"></div>
    <ul id="ul"></ul>
    <div></div>
</div>
<script type="text/javascript">
    window.onload=function(){
        var txt = document.getElementById("txt");
        var btn = document.getElementById("btn");
        var ul = document.getElementById("ul");
        btn.onclick = function() {
            var val = txt.value;
            if (val === "") {
                alert("请输入内容");
                return;
            }
            var li = document.createElement("li");
            var span = document.createElement("span");
            setInnerText(span, val);
            li.appendChild(span);
            var lis = ul.children;
            if (lis.length === 0) {
                ul.appendChild(li);
            } else {
                ul.insertBefore(li, lis[0]);
            }

            txt.value = "";
            var btn = document.createElement("input");
            btn.type = "button";
            btn.value = "删除";
            li.appendChild(btn);
            btn.onclick = function() {
                var li = this.parentNode;
                ul.removeChild(li);
            }
        }
    }


</script>



<div class="wrapper footer blue">
    <p class="copy">
        <br />
        高新区社区服务网<br />
        <a href="http://www.gbsq.org/LEAP/Login/4403/JYWHT/Login.html" target="_blank" class="back_stage_link">后台管理入口</a>
    </p>

    <p >1024*768分辨率，16位以上颜色，IE6.0以上版本浏览器</p>

</div>



</body>
</html>
