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
var isComplete = 0;
var flag_work_id;
// $('#title').html("문항번호: &nbsp; " + quiz);
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
        var obj;
        if ( typeof json === "object" && json.week.length > 0) {
            $(json.week).each(function() {
                workArray[this.work_id] = {
                    "work_name" : this.work_name,
                    "work_content" : this.work_content,
                    "file_path" : this.file_path,
                    "day" : this.day,
                    "complete" : this.complete,
                    "ch_id" : this.ch_id,
                    "user_id" : this.user_id,
                    "user_name" : this.user_name
                };
                obj = $('#' + this.ch_id + ' #' + this.day);
                if (obj.text() == '+')
                    obj.text("");
                htmls += '<p class="btn btn-default" style="display:block;margin-top:10px;margin-bottom:10px; " onclick=viewWork(' + this.work_id + ')>';
                htmls += '⦁ ' + this.work_name;
                htmls += '</p>';
                obj.append(htmls);
                htmls = "";
            });
            obj.html(obj.html().replace(/\n/g, "<br>"));

        }
        isLoading = false;

    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        isLoading = false;
    });
    // parsing end

    return true;

};

getItem();

//edit
function viewWork(work_id) {
    flag_work_id = work_id;
    editMode(false);
    getReply(work_id);
    var date = new Date(workArray[work_id]["day"]);
    $("#workDate").text((date.getMonth() + 1) + "월 " + date.getDate() + "일 / " + $("#" + workArray[work_id]["ch_id"]).attr("ch_name"));
    $("#work_title").val(workArray[work_id]["work_name"]);
    $("#work_content").val(workArray[work_id]["work_content"] + '\n' + workArray[work_id]["user_name"] + '님이 생성함.');
    var user_id = $("#workDate").attr("user");
    if (user_id != workArray[work_id]["user_id"]) {
        $("#work_edit_btn").attr("disabled", "disabled");
        $("#work_complete_btn").attr("disabled", "disabled");
    } else {
        $("#work_edit_btn").removeAttr("disabled");
        $("#work_complete_btn").removeAttr("disabled");
    }
}

//reply
function getReply(work_id) {
    $("#reply").text("");
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
        ;

        htmls = "";
        var countTemp = 0;
        if ( typeof json === "object" && json.week.length > 0) {
            $(json.week).each(function() {
                if (countTemp != 0)
                    htmls += '<hr>';
                htmls += '<p style="display:block;padding-right:5px;">' + this.content + '&nbsp;<span style="font-weight:bold">- ' + this.user_name + '</span>' + '<span style="font-size:12px">(' + this.time + ')</span></p>';
                countTemp++;
            });
            obj.append(htmls);
            htmls = "";
            obj.html(obj.html().replace(/\n/g, "<br>"));

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

//new
function newWork(ch_id, ch_name, date) {
    editMode(true);
    var date = new Date(date);
    $("#workDate").text((date.getMonth() + 1) + "월 " + date.getDate() + "일 / " + ch_name);
    $("#work_title").val("");
    $("#work_content").text("");
    $("#work_content").val("");
    $("#reply").html("");
    $("#work_complete_btn").attr("disabled", "disabled");
}

function editMode(isEditMode) {
    isComplete = 0;
    var title = $("#work_title");
    var content = $("#work_content");
    title.attr("readonly", !isEditMode);
    content.attr("readonly", !isEditMode);

    if (isEditMode) {
        title.css("border", "1px solid #04a4b5");
        content.css("border", "1px solid #04A4B5");
        $("#work_edit_btn").text("저장");
        $("#work_edit_btn").attr("class", "btn btn-warning");
        $("#work_edit_btn").removeAttr("disabled");
        $("#work_complete_btn").removeAttr("disabled");
    } else {
        $("#work_edit_btn").text("수정");
        $("#work_edit_btn").attr("class", "btn btn-info");

        title.css("border", "0px solid #04a4b5");
        content.css("border", "0px solid #04A4B5");

    }
}

function editWork() {
    editMode(true);

}


$('.has-spinner').click(function() {

    if (isLoading)
        return false;

    var btn = $(this);
    
    $(btn).buttonLoader('start');


    if (isComplete == 0) {
        isComplete = 1;
    } else {
        isComplete = 0;
    }

    isLoading = true;

    var request = $.ajax("index_db.php", {
        type : "GET",
        data : {
            select : "complete",
            work_id : flag_work_id,
            complete : isComplete
        }

    });

    request.done(function(json) {
        setTimeout(function() {
            $(btn).buttonLoader('stop');
            if (isComplete == 1) {
                $("#work_title").css("text-decoration", "line-through");
                $("#work_complete_btn").text("완료 표시 취소");
                $("#work_complete_btn").attr("class", "btn btn-success has-spinner");
            } else {
                $("#work_title").css("text-decoration","none");
                $("#work_complete_btn").text("완료 표시 하기");
                $("#work_complete_btn").attr("class", "btn btn-info has-spinner");
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

    $('.has-spinner').click(function() {

    });
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
