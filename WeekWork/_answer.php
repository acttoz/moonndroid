<!DOCTYPE html>
<html lang="ko" >

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
<link href="framework/css/simple-sidebar.css" rel="stylesheet" >
    </head>

    <body >
<h1 id="user_id"><?php
echo $_REQUEST['user_id'];
 ?></h1>
                   <table class="help_chat_table" style="width:100%; background:#F8F8F8;color:#000; border-radius: 10px 10px 10px 10px; table-layout: fixed" align="center"  >
                               <tr class="" style="border-radius: 10px 0 0 0; ">
                                   <td class="content" style="vertical-align:top;  width:70%;border-top-style:none; border-right-style:none; ">
                                      <div id="help_chat_content" style="text-align:left; overflow-y:scroll;margin:10px;">
                                          안녕하세요. 문샘입니다.
                                      </div>
                                   </td>
                                </tr>
                                <tr>
                                   <td class="content"  style="width:10%;border-bottom-style:none;border-right-style:none; border-left-color:white; border-radius: 0 0 10px  0;">
                                      <div class="form-group" style="height:50px;margin-bottom:0px;line-height: 0px">
                                         <div class="col-sm-8" style="padding:5px;">
                                            <input id="help_chat_input" type="text" name="reply_content" style="height:30px; width:100%" class="form-control"   checked="0" placeholder=""/>
                                         </div>
                                         <div class="col-sm-4" style="padding:5px;">
                                            <button id="help_chat_submit" class = "btn btn-info form-control " type="button"  style=" width: 100%px;height:30px;" onclick="sendAnswer()">보내기</button>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                     </table>
                   
        <!-- Menu Toggle Script -->
        <script>
            function pollingAnswer() {

                $.ajax("db.php", {
                    type : "GET",
                    dataType : "json",
                    complete : setTimeout(function() {
                        pollingAnswer();
                    }, 50000),
                    contentType : "application/json; charset=utf-8",
                    data : {
                        select : "answer",
                        user_id : $("#user_id").text()
                    },
                    success : function(json) {
                        $("#help_chat_content").empty();
                        var obj = $("#help_chat_content");
                        var replyCount = 0;
                        htmls = "";
                        if ( typeof json === "object" && json.week.length > 0) {
                            $(json.week).each(function() {
                                if (replyCount != 0)
                                    htmls += '<hr>';
                                htmls += '<p style="line-height=0px;padding-right:10px;';
                                if (this.me != 0) {
                                    htmls += 'text-align:right;';
                                }

                                htmls += '">' + this.content + '&nbsp;';
                                // <span style="font-weight:bold"><br> ';
                                // htmls += '<a class="btn btn-info reply_clip" type="button" href="';
                                // htmls += './file.php?select=download&name=' + this.file_name + '&hash=' + this.file_hash;
                                // htmls += '">' + this.file_name + '</a>';
                                // }
                                // if (wUser_id == this.user_id)
                                // htmls += ' <button class="btn btn-danger reply_x glyphicon glyphicon-trash" type="button"  onclick=delReply(' + this.chat_id + ',"' + this.file_hash + '")></button>';
                                htmls += '</p>';
                                replyCount++;
                            });
                            obj.append(htmls);
                            htmls = "";
                            // obj.html(obj.html().replace(/\n/g, "<br>"));
                            obj.scrollTop(obj[0].scrollHeight);
                        }
                    },
                    fail : function(jqXHR, textStatus, errorThrown) {
                        // alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

                    }
                });

            }

            function getAnswer() {

                $.ajax("db.php", {
                    type : "GET",
                    dataType : "json",
                    contentType : "application/json; charset=utf-8",
                    data : {
                        select : "answer",
                        user_id : $("#user_id").text()
                    },
                    success : function(json) {
                        $("#help_chat_content").empty();
                        var obj = $("#help_chat_content");
                        var replyCount = 0;
                        htmls = "";
                        if ( typeof json === "object" && json.week.length > 0) {
                            $(json.week).each(function() {
                                if (replyCount != 0)
                                    htmls += '<hr>';
                                htmls += '<p style="line-height=0px;padding-right:10px;';
                                if (this.me != 0) {
                                    htmls += 'text-align:right;';
                                }

                                htmls += '">' + this.content + '&nbsp;';
                                // <span style="font-weight:bold"><br> ';
                                // htmls += '<a class="btn btn-info reply_clip" type="button" href="';
                                // htmls += './file.php?select=download&name=' + this.file_name + '&hash=' + this.file_hash;
                                // htmls += '">' + this.file_name + '</a>';
                                // }
                                // if (wUser_id == this.user_id)
                                // htmls += ' <button class="btn btn-danger reply_x glyphicon glyphicon-trash" type="button"  onclick=delReply(' + this.chat_id + ',"' + this.file_hash + '")></button>';
                                htmls += '</p>';
                                replyCount++;
                            });
                            obj.append(htmls);
                            htmls = "";
                            // obj.html(obj.html().replace(/\n/g, "<br>"));
                            obj.scrollTop(obj[0].scrollHeight);
                        }
                    },
                    fail : function(jqXHR, textStatus, errorThrown) {
                        // alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

                    }
                });

            }

            var sendingHelp;
            function sendAnswer() {

                if ($("#help_chat_input").val().replace(/\s/g, '') == "") {
                    alert("내용을 입력하세요.");
                    $("#help_chat_input").val("");
                    return false;
                }

                if (sendingHelp)
                    return false;

                sendingHelp = true;
                var request = $.ajax("db.php", {
                    type : "GET",
                    data : {
                        select : "sendAnswer",
                        content : $("#help_chat_input").val(),
                        user_id : $("#user_id").text()
                    }
                });
                request.done(function() {
                    sendingHelp = false;
                    $("#help_chat_input").val("");
                    getAnswer();
                });
                request.fail(function(jqXHR, textStatus, errorThrown) {
                    // alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

                    sendingHelp = false;
                });
                // parsing end

                return true;
            }

            pollingAnswer();

            $("#help_chat_input").keydown(function(event) {
                if (event.keyCode == 13) {
                    $('#help_chat_submit').trigger('click');

                }
            });
    </script>
        <?php
        include_once ("./tail.php");
        ?>
    </body>

</html>
