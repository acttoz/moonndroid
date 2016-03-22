<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <![endif]-->
      <title>스피드알림장</title>
      <!-- BOOTSTRAP CORE STYLE CSS -->
      <link href="assets/css/bootstrap.css" rel="stylesheet" />
      <!-- FONTAWESOME STYLE CSS -->
      <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
      <!-- CUSTOM STYLE CSS -->
      <link href="assets/css/style.css" rel="stylesheet" />
   </head>
   <body>
      <div class="container">
         <div class="row text-center pad-top">
            <div class="col-md-10">
               <div class="alert alert-info text-center">
                  <IMG class="displayed" src="./img/logo.png" style="width:200px;padding:5%; display: block; margin-left: auto; margin-right: auto">
                  <hr /> 
                  <? include_once './notice_content2.php';?>
                  
               </div>
            </div>
         </div>
      </div>
      <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
      <!-- CORE JQUERY  -->
      <script src="assets/plugins/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS  -->
      <script src="assets/plugins/bootstrap.js"></script>
   </body>
</html>