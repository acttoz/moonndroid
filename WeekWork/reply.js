//reply
function pollingReply() {
    $.ajax("db.php", {
        type : "GET",
        complete : setTimeout(function() {
            pollingReply();
        }, 100000),

        contentType : "application/json; charset=utf-8",
        data : {
            select : "reply_poll",
            work_id : flag_work_id
        },
        success : function(args) {
            if (args * 1 != reply_count) {
                reply_count = args * 1;
                getReply(flag_work_id);
            }
        },
        fail : function(jqXHR, textStatus, errorThrown) {
            // alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        }
    });

}

function getReply(work_id) {
    $("#reply").empty();
    $.ajax("db.php", {
        type : "GET",
        dataType : "json",
        contentType : "application/json; charset=utf-8",
        data : {
            select : "reply",
            work_id : work_id
        },
        success : function(json) {

            var obj = $("#reply");
            var replyCount = 0;
            htmls = "";
            if ( typeof json === "object" && json.week.length > 0) {
                $(json.week).each(function() {
                    if (replyCount != 0)
                        htmls += '<hr>';
                    htmls += '<p style=" padding-right:5px;">' + this.content + '&nbsp;<span style="font-weight:bold">- ';
                    switch(workArray[flag_work_id]["ch_id"]) {
                    case this.ch_school :
                        htmls += grade_array[this.grade] + " ";
                        break;
                    case this.ch_grade :
                        htmls += ban_array[this.ban] + " ";
                        break;
                    default :
                        break;
                    }
                    htmls += this.name + '</span>' + '<span style="font-size:12px">(' + this.time + ')</span>&nbsp;&nbsp;&nbsp;';
                    if (this.file_name != '0') {
                        htmls += '<a class="btn btn-info reply_clip" type="button" href="';
                        htmls += './file.php?select=download&name=' + this.file_name + '&hash=' + this.file_hash;
                        htmls += '">' + this.file_name + '</a>';
                    }
                    if (wUser_id == this.user_id)
                        htmls += ' <button class="btn btn-danger reply_x glyphicon glyphicon-trash" type="button"  onclick=delReply(' + this.reply_id + ',"' + this.file_hash + '")></button>';
                    htmls += '</p>';
                    replyCount++;
                });
                obj.append(htmls);
                htmls = "";
                obj.scrollTop(obj[0].scrollHeight);
            } else {

            }

        },
        fail : function(jqXHR, textStatus, errorThrown) {
            // alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        }
    });

}

function delReply(reply_id, hash) {

    if (isLoading)
        return false;

    isLoading = true;
    var request = $.ajax("file.php", {
        type : "GET",
        data : {
            select : "delReply",
            reply_id : reply_id,
            hash : hash,
            work_id : flag_work_id
        }

    });

    request.done(function(args) {
        isLoading = false;
        getReply(flag_work_id);

    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        isLoading = false;
    });
    // parsing end

    return true;
}

var sendingChat = false;
function sendChat() {

    if ($("#chat_input").val().replace(/\s/g, '') == "") {
        alert("내용을 입력하세요.");
        $("#chat_input").val("");
        return false;
    }

    if (sendingChat)
        return false;

    isLoading = true;
    chat_no++;
    var request = $.ajax("db.php", {
        type : "GET",
        data : {
            select : "sendChat",
            content : $("#chat_input").val()
        }

    });

    request.done(function() {
        sendingChat = false;
        $("#chat_input").val("");
        getChat();
    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        sendingChat = false;
    });
    // parsing end

    return true;
}

var showChat = false;
var chat_no = 0;
var server_chat_no = 0;

function chatPolling() {
    if (sendingChat)
        return false;

    $.ajax("db.php", {
        type : "GET",
        complete : setTimeout(function() {
            chatPolling();
        }, 5000),
        data : {
            select : "chat_polling"
        },
        success : function(args) {
            if (chat_no < args * 1) {

                if (chat_no != 0) {
                    if (localStorage.getItem("SIDE") == 0) {
                        $("#menu-toggle").attr("class", "btn glyphicon glyphicon-bell");
                        $("#menu-toggle").text(args - chat_no);
                    }
                    // $.playSound("img/noti");
                    // $("#dialog").dialog({
                    // width : "400"// dialog 넓이 지정
                    // ,
                    // height : "200"// dialog 높이 지정
                    // ,
                    // resizeable : false// 사이즈 조절가능 여부
                    // ,
                    // buttons : {// dialog 하단 버튼들
                    // "바로 보기" : function() {
                    // $("#wrapper").attr("class", "");
                    // $(this).dialog("close");
                    // },    // dialog 하단 버튼 클릭시 실행할 함수. (함수는 $.ready안에 선언되어있어야 한다.)
                    // }
                    // });
                }
                server_chat_no = args * 1;

                if (chat_no == 0)
                    chat_no = args * 1;

                getChat();
            }
        },
        fail : function(jqXHR, textStatus, errorThrown) {
            // alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        }
    });
}

function getChat() {

    $.ajax("db.php", {
        type : "GET",
        dataType : "json",
        contentType : "application/json; charset=utf-8",
        data : {
            select : "chat"
        },
        success : function(json) {
            $("#chat").empty();
            var obj = $("#chat");
            var replyCount = 0;
            htmls = "";
            if ( typeof json === "object" && json.week.length > 0) {
                $(json.week).each(function() {
                    if (replyCount != 0)
                        htmls += '<hr>';
                    htmls += '<p style="line-height=0px;padding-right:10px  ">' + this.content + '&nbsp;<span style="font-weight:bold"><br> ';
                    htmls += ban_array[this.ban];
                    htmls += this.name + '</span>' + '<span style="font-size:12px">(' + this.time + ')</span>&nbsp;&nbsp;&nbsp;';
                    // if (this.file_name != '0') {
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


function pollingHelp() {
     $.ajax("db.php", {
        type : "GET",
        dataType : "json",
        complete : setTimeout(function() {
           pollingHelp();
        }, 10000),
        contentType : "application/json; charset=utf-8",
        data : {
            select : "help"
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


function getHelp() {

    $.ajax("db.php", {
        type : "GET",
        dataType : "json",
        contentType : "application/json; charset=utf-8",
        data : {
            select : "help"
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
function sendHelp() {

    if ($("#help_chat_input").val().replace(/\s/g, '') == "") {
        alert("내용을 입력하세요.");
        $("#help_chat_input").val("");
        return false;
    }

    if (sendingHelp)
        return false;

    sendingHelp = true;
    chat_no++;
    var request = $.ajax("db.php", {
        type : "GET",
        data : {
            select : "sendHelp",
            content : $("#help_chat_input").val()
        }
    });
    request.done(function() {
        sendingHelp = false;
        $("#help_chat_input").val("");
        getHelp();
    });
    request.fail(function(jqXHR, textStatus, errorThrown) {
        // alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        sendingHelp = false;
    });
    // parsing end

    return true;
}
