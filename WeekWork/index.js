$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

// var console = console || {
// log : function() {
// },
// warn : function() {
// },
// error : function() {
// }
// };
var isLoading = false;
var tClass = localStorage.getItem("tClass");
var quiz = localStorage.getItem("quiz");
var htmls = '';
var workArray = [];
var flag_work_id;
var flag_isEditing = false;
var wUser_id = $("#workDate").attr("user");
getItem = function() {
    if (isLoading)
        return false;

    isLoading = true;

    var request = $.ajax("index_db.php", {
        type : "GET",
        dataType : "json",
        contentType : "application/json; charset=utf-8",
        data : {
            select : "week"
        }

    });

    request.done(function(json) {
        $(".work > p").remove();
        var obj;
        if ( typeof json === "object" && json.week.length > 0) {
            $(json.week).each(function() {
                workArray[this.work_id] = {
                    "work_name" : this.work_name,
                    "work_content" : this.work_content,
                    "file_id" : this.file_id,
                    "day" : this.day,
                    "complete" : this.complete,
                    "ch_id" : this.ch_id,
                    "user_id" : this.user_id,
                    "user_name" : this.user_name
                };
                obj = $('#' + this.ch_id + ' #' + this.day);
                htmls += '<p class="btn btn-default work" id="work_' + this.work_id + '"  style="';
                htmls += 'display:block;margin-top:10px;margin-bottom:10px; " onclick=viewWork(' + this.work_id + ')>';
                htmls += '⦁ ' + this.work_name;
                htmls += '</p>';
                obj.prepend(htmls);
                htmls = "";
                if (this.complete == 1)
                    setComplete(true, this.work_id);
            });
            obj.html(obj.html().replace(/\n/g, "<br>"));

        }
        isLoading = false;
        $("#workList").css("display", "none");
        viewWork(1);

    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        isLoading = false;
    });
    // parsing end

    return true;

};

//edit
function viewWork(work_id) {
    $("#workList").css("display", "block");
    resetWork();
    if (workArray[work_id]["complete"] == 1)
        setComplete(true, work_id);

    flag_work_id = work_id;
    $("#work_id").val(flag_work_id);
    getReply(work_id);
    var date = new Date(workArray[work_id]["day"]);
    $("#workDate").text((date.getMonth() + 1) + "월 " + date.getDate() + "일 / " + $("#" + workArray[work_id]["ch_id"]).attr("ch_name") + " / " + workArray[work_id]["user_name"] + '님이 생성함.');
    $("#work_title").val(workArray[work_id]["work_name"]);
    $("#work_content").val(workArray[work_id]["work_content"]);

    if (wUser_id != workArray[work_id]["user_id"]) {
        $("#work_complete_btn").attr("disabled", "disabled");
        $("#work_edit_btn").attr("disabled", "disabled");
        $("#work_delete_btn").attr("disabled", "disabled");
    }

}

//new
function newWork(ch_id, ch_name, mDate) {
    $("#workList").css("display", "block");
    flag_work_id = 0;
    $("#work_id").val(flag_work_id);
    resetWork();
    editMode();
    var date = new Date(mDate);
    $("#workDate").text((date.getMonth() + 1) + "월 " + date.getDate() + "일 / " + ch_name);
    $("#work_title").val("");
    $("#work_content").text("");
    $("#work_content").val("");
    $("#reply").html("");
    $("#reply_submit").attr("disabled", "disabled");
    $("#reply_file").attr("disabled", "disabled");
    workArray[0] = {
        "day" : mDate,
        "ch_id" : ch_id
    };
    $("#work_day").val(mDate);
    $("#work_ch_id").val(ch_id);
}

function editMode() {
    var title = $("#work_title");
    var content = $("#work_content");

    if (!flag_isEditing) {

        flag_isEditing = true;
        title.attr("readonly", false);
        content.attr("readonly", false);
        title.css("border", "1px solid #04a4b5");
        content.css("border", "1px solid #04A4B5");
        $("#work_complete_btn").attr("disabled", "disabled");
        $("#work_edit_btn").text("저장");
        $("#work_edit_btn").attr("class", "btn btn-warning");
    } else {
        if (title.val().replace(/\s/g, '') == "") {
            alert("제목 입력은 필수입니다.");
        } else {
            sendWork(title.val(), content.val());
        }
    }
}

function setComplete(bool, work_id) {
    resetWork();
    if (bool) {
        $("#work_" + work_id).css("text-decoration", "line-through");
        $("#work_title").css("text-decoration", "line-through");
        $("#work_complete_btn").text("완료 표시 취소");
        $("#reply_submit").attr("disabled", "disabled");
        $("#reply_file").attr("disabled", "disabled");
        $("#work_complete_btn").attr("class", "btn btn-success has-spinner");
        $("#work_edit_btn").attr("disabled", "disabled");
    } else {

        $("#work_" + work_id).css("text-decoration", "none");

    }
}

function resetWork() {

    var title = $("#work_title");
    var content = $("#work_content");
    title.css("border", "0px solid #04a4b5");
    content.css("border", "0px solid #04A4B5");
    title.attr("readonly", true);
    content.attr("readonly", true);
    title.css("text-decoration", "none");
    $("#work_edit_btn").text("수정");
    $("#work_edit_btn").attr("class", "btn btn-info");
    $("#work_edit_btn").removeAttr("disabled");
    $("#work_delete_btn").removeAttr("disabled");
    $("#work_complete_btn").attr("class", "btn btn-info has-spinner");
    $("#work_complete_btn").text("완료 표시 하기");
    $("#work_complete_btn").removeAttr("disabled");
    $("#reply_submit").removeAttr("disabled");
    $("#reply_file").removeAttr("disabled");
    flag_isEditing = false;
}

//sendWork
function sendWork(title, content) {

    if (isLoading)
        return false;

    isLoading = true;
    var request = $.ajax("index_db.php", {
        type : "GET",
        data : {
            select : "sendWork",
            work_id : flag_work_id,
            work_name : title,
            work_content : content,
            day : workArray[flag_work_id]["day"],
            ch_id : workArray[flag_work_id]["ch_id"]
        }

    });

    request.done(function() {
        if (!alert("성공")) {
            isLoading = false;
            getItem();
        }
    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        isLoading = false;
    });
    // parsing end

    return true;
}


$("#work_delete_btn").click(function() {

    if (confirm("삭제 후에는 복구가 불가능합니다.\n삭제하시겠습니까?"+flag_work_id)) {

    } else {
        return false;
    }

    if (isLoading)
        return false;

    isLoading = true;

    var request = $.ajax("index_db.php", {
        type : "GET",
        data : {
            select : "delWork",
            work_id : flag_work_id
        }

    });

    request.done(function() {
        isLoading = false;
        getItem();
    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        isLoading = false;
    });
    // parsing end

    return true;
});

//reply
function getReply(work_id) {
    $("#reply").empty();
    if (isLoading)
        return false;

    isLoading = true;

    var request = $.ajax("index_db.php", {
        type : "GET",
        dataType : "json",
        contentType : "application/json; charset=utf-8",
        data : {
            select : "reply",
            work_id : work_id
        }

    });

    request.done(function(json) {
        var obj = $("#reply");
        htmls = "";
        var countTemp = 0;
        if ( typeof json === "object" && json.week.length > 0) {
            $(json.week).each(function() {
                if (countTemp != 0)
                    htmls += '<hr>';
                htmls += '<p style=" padding-right:5px;">' + this.content + '&nbsp;<span style="font-weight:bold">- ' + this.user_name + '</span>' + '<span style="font-size:12px">(' + this.time + ')</span>';
                htmls += '<br><button class="btn btn-info reply_clip"  >첨부파일</button>';
                if (wUser_id == this.user_id)
                    htmls += ' <button class="btn btn-info reply_clip" onclick=delReply(' + this.reply_id + ')>삭제</button>';
                htmls += '</p>';
                countTemp++;
            });
            obj.append(htmls);
            htmls = "";
            // obj.html(obj.html().replace(/\n/g, "<br>"));
            obj.scrollTop(obj[0].scrollHeight);
        }
        isLoading = false;

    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        // alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        isLoading = false;
    });
    // parsing end

    return true;
}

function delReply(reply_id) {

    if (isLoading)
        return false;

    isLoading = true;
    var request = $.ajax("index_db.php", {
        type : "GET",
        data : {
            select : "delReply",
            reply_id : reply_id
        }

    });

    request.done(function() {
        isLoading = false;
        getReply(flag_work_id);

    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
        $("#work_complete_btn").buttonLoader('stop');

        isLoading = false;
    });
    // parsing end

    return true;
}


$('#reply_submit').click(function() {

    if ($("#reply_input").val().replace(/\s/g, '') == "")
        return false;

    if (isLoading)
        return false;

    isLoading = true;
    var request = $.ajax("index_db.php", {
        type : "GET",
        data : {
            select : "sendReply",
            work_id : flag_work_id,
            content : $("#reply_input").val()
        }

    });

    request.done(function() {
        isLoading = false;
        $("#reply_input").val("");
        getReply(flag_work_id);

    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
        $("#work_complete_btn").buttonLoader('stop');

        isLoading = false;
    });
    // parsing end

    return true;
});

$('.has-spinner').click(function() {
    var isComplete = workArray[flag_work_id]["complete"];
    if (isLoading)
        return false;

    var btn = $(this);

    $(btn).buttonLoader('start');

    isLoading = true;

    var request = $.ajax("index_db.php", {
        type : "GET",
        data : {
            select : "complete",
            work_id : flag_work_id,
            complete : ((isComplete - 1) * -1)
        }

    });

    request.done(function() {
        setTimeout(function() {
            $(btn).buttonLoader('stop');

            if (isComplete == 1) {
                setComplete(false, flag_work_id);
                workArray[flag_work_id]["complete"] = 0;
            } else {
                setComplete(true, flag_work_id);
                workArray[flag_work_id]["complete"] = 1;
            }
        }, 1500);
        //do something special

        isLoading = false;

    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
        $("#work_complete_btn").buttonLoader('stop');

        isLoading = false;
    });
    // parsing end

    return true;

});

$(document).ready(function() {
    getItem();
});

function newline(text) {
    var htmls = [];
    var lines = text.split(/\n/);
    var tmpDiv = jQuery(document.createElement('div'));
    for (var i = 0; i < lines.length; i++) {
        htmls.push(tmpDiv.text(lines[i]).html());
    }
    return htmls.join("<br>");
}

// setInterval(function() {
// getItem();
// drawChart();
// }, 5000);
