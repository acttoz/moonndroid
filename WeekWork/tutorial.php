<!DOCTYPE html>
<html lang="ko" >

    <?php
    include_once ('./config.php');
    ?>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WeekWork</title>
        <link href="framework/css/sign.css" rel="stylesheet" type="text/css">
        <link href="framework/css/jssor.slider.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="framework/js/jssor.slider.mini.js"></script>
        <?php
        include_once ('./framework.php');
        if (empty($_SESSION['is_logged']) || $_SESSION['is_logged'] == FALSE) {
            header("location:index.php");
            exit ;
        }
        ?>
    </head>

    <body style="background:#000000" >

        <div id="wrapper" >
            <button class="btn btn-info" style="width: 100px;float:right;position: relative;" onclick="goBack()">
                뒤로
            </button>
            <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1024px; height: 832px; overflow: hidden; visibility: hidden;">
                <!-- Loading Screen -->
                <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                    <div style="position:absolute;display:block;background:url('./img/tutorial/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                </div>
                <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1024px; height: 832px; overflow: hidden;">
                    <div data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/1.png" />
                    </div>
                    <div data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/2.png" />
                    </div>
                    <div data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/3.png" />
                    </div>
                    <div data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/4.png" />
                    </div>
                    <div data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/5.png" />
                    </div>
                    <div data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/6.png" />
                    </div>
                    <div data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/7.png" />
                    </div>
                    <div data-b="0" data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/8.png" />
                    </div>
                    <div data-b="0" data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/9.png" />
                    </div>
                    <div data-b="0" data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/10.png" />
                    </div>
                    <div data-b="0" data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/11.png" />
                    </div>
                    <div data-b="0" data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/12.png" />
                    </div>
                    <div data-b="0" data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/13.png" />
                    </div>
                    <div data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/14.png" />
                    </div>
                    <div data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/15.png" />
                    </div>
                    <div data-p="112.50" style="display: none;">
                        <img data-u="image" src="./img/tutorial/16.png" />
                    </div>

                </div>
                <!-- Bullet Navigator -->
                <div data-u="navigator" class="jssorb01" style="bottom:16px;right:16px;">
                    <div data-u="prototype" style="width:12px;height:12px;"></div>
                </div>
                <!-- Arrow Navigator -->
                <span data-u="arrowleft" class="jssora02l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
                <span data-u="arrowright" class="jssora02r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
            </div>

        </div>
        <!-- /#wrapper -->
        <!-- Menu Toggle Script -->
        <script>
            jQuery(document).ready(function($) {

                var jssor_1_SlideoTransitions = [[{
                    b : 0,
                    d : 600,
                    y : -290,
                    e : {
                        y : 27
                    }
                }], [{
                    b : 0,
                    d : 1000,
                    y : 185
                }, {
                    b : 1000,
                    d : 500,
                    o : -1
                }, {
                    b : 1500,
                    d : 500,
                    o : 1
                }, {
                    b : 2000,
                    d : 1500,
                    r : 360
                }, {
                    b : 3500,
                    d : 1000,
                    rX : 30
                }, {
                    b : 4500,
                    d : 500,
                    rX : -30
                }, {
                    b : 5000,
                    d : 1000,
                    rY : 30
                }, {
                    b : 6000,
                    d : 500,
                    rY : -30
                }, {
                    b : 6500,
                    d : 500,
                    sX : 1
                }, {
                    b : 7000,
                    d : 500,
                    sX : -1
                }, {
                    b : 7500,
                    d : 500,
                    sY : 1
                }, {
                    b : 8000,
                    d : 500,
                    sY : -1
                }, {
                    b : 8500,
                    d : 500,
                    kX : 30
                }, {
                    b : 9000,
                    d : 500,
                    kX : -30
                }, {
                    b : 9500,
                    d : 500,
                    kY : 30
                }, {
                    b : 10000,
                    d : 500,
                    kY : -30
                }, {
                    b : 10500,
                    d : 500,
                    c : {
                        x : 87.50,
                        t : -87.50
                    }
                }, {
                    b : 11000,
                    d : 500,
                    c : {
                        x : -87.50,
                        t : 87.50
                    }
                }], [{
                    b : 0,
                    d : 600,
                    x : 410,
                    e : {
                        x : 27
                    }
                }], [{
                    b : -1,
                    d : 1,
                    o : -1
                }, {
                    b : 0,
                    d : 600,
                    o : 1,
                    e : {
                        o : 5
                    }
                }], [{
                    b : -1,
                    d : 1,
                    c : {
                        x : 175.0,
                        t : -175.0
                    }
                }, {
                    b : 0,
                    d : 800,
                    c : {
                        x : -175.0,
                        t : 175.0
                    },
                    e : {
                        c : {
                            x : 7,
                            t : 7
                        }
                    }
                }], [{
                    b : -1,
                    d : 1,
                    o : -1
                }, {
                    b : 0,
                    d : 600,
                    x : -570,
                    o : 1,
                    e : {
                        x : 6
                    }
                }], [{
                    b : -1,
                    d : 1,
                    o : -1,
                    r : -180
                }, {
                    b : 0,
                    d : 800,
                    o : 1,
                    r : 180,
                    e : {
                        r : 7
                    }
                }], [{
                    b : 0,
                    d : 1000,
                    y : 80,
                    e : {
                        y : 24
                    }
                }, {
                    b : 1000,
                    d : 1100,
                    x : 570,
                    y : 170,
                    o : -1,
                    r : 30,
                    sX : 9,
                    sY : 9,
                    e : {
                        x : 2,
                        y : 6,
                        r : 1,
                        sX : 5,
                        sY : 5
                    }
                }], [{
                    b : 2000,
                    d : 600,
                    rY : 30
                }], [{
                    b : 0,
                    d : 500,
                    x : -105
                }, {
                    b : 500,
                    d : 500,
                    x : 230
                }, {
                    b : 1000,
                    d : 500,
                    y : -120
                }, {
                    b : 1500,
                    d : 500,
                    x : -70,
                    y : 120
                }, {
                    b : 2600,
                    d : 500,
                    y : -80
                }, {
                    b : 3100,
                    d : 900,
                    y : 160,
                    e : {
                        y : 24
                    }
                }], [{
                    b : 0,
                    d : 1000,
                    o : -0.4,
                    rX : 2,
                    rY : 1
                }, {
                    b : 1000,
                    d : 1000,
                    rY : 1
                }, {
                    b : 2000,
                    d : 1000,
                    rX : -1
                }, {
                    b : 3000,
                    d : 1000,
                    rY : -1
                }, {
                    b : 4000,
                    d : 1000,
                    o : 0.4,
                    rX : -1,
                    rY : -1
                }]];

                var jssor_1_options = {
                    $AutoPlay : true,
                    $Idle : 10000,
                    $CaptionSliderOptions : {
                        $Class : $JssorCaptionSlideo$,
                        $Transitions : jssor_1_SlideoTransitions,
                        $Breaks : [[{
                            d : 2000,
                            b : 1000
                        }]]
                    },
                    $ArrowNavigatorOptions : {
                        $Class : $JssorArrowNavigator$
                    },
                    $BulletNavigatorOptions : {
                        $Class : $JssorBulletNavigator$
                    }
                };

                var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

                //responsive code begin
                //you can remove responsive code if you don't want the slider scales while window resizing
                function ScaleSlider() {
                    var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                    if (refSize) {
                        refSize = Math.min(refSize, 1024);
                        jssor_1_slider.$ScaleWidth(refSize);
                    } else {
                        window.setTimeout(ScaleSlider, 5000);
                    }
                }

                ScaleSlider();
                $(window).bind("load", ScaleSlider);
                $(window).bind("resize", ScaleSlider);
                $(window).bind("orientationchange", ScaleSlider);
                //responsive code end
            });

            function goBack() {
                window.history.back();
            }
        </script>
    </body>

</html>
