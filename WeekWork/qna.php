<!DOCTYPE html>
<html lang="ko" style="overflow: hidden">

    <?php
    include_once ('./config.php');
    ?>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <?php
        include_once ('./framework.php');
        ?>
    </head>

    <body style="overflow: hidden">
        <?php
        include_once ('./header.php');
        ?>
        <div id="wrapper">
           <iframe style="overflow-y: hidden;" border-radi width="100%" height="800px"  src="http://actoze.dothome.co.kr/gnu/bbs/board.php?bo_table=weekwork&device=mobile" scrolling="yes"></iframe>
        </div>
        <!-- /#wrapper -->
        <div class="overlay overlay_ctrl" ></div>
        <!-- Menu Toggle Script -->

        <?php
        include_once ("./tail.php");
        ?>
    </body>

</html>
