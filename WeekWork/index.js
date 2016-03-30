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
var isLoadingFile = false;
var tClass = localStorage.getItem("tClass");
var quiz = localStorage.getItem("quiz");
var htmls = '';
var workArray = [];
var fileInfo = [];
var flag_work_id;
var flag_isEditing = false;
var wUser_id = $("#workDate").attr("user");

var work_complete_btn = $("#work_complete_btn");
var work_edit_btn = $("#work_edit_btn");
var work_delete_btn = $("#work_delete_btn");
var work_save_btn = $("#work_save_btn");
var work_file_btns = $("#work_file_btns");
var work_file_add = $("#work_file_add");
var work_file_down = $("#work_file_down");
var work_file_del = $("#work_file_del");

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
        work_complete_btn.attr("disabled", "disabled");
        work_edit_btn.attr("disabled", "disabled");
        work_delete_btn.attr("disabled", "disabled");
    }
    if (workArray[flag_work_id]["file_id"] != 0) {
        getFileInfo(workArray[flag_work_id]["file_id"]);
    }

}

function getFileInfo(file_id) {
    if (isLoadingFile)
        return false;
    isLoadingFile = true;
    var request = $.ajax("index_db.php", {

        type : "GET",
        dataType : "json",
        contentType : "application/json; charset=utf-8",
        data : {
            select : "file",
            file_id : file_id
        }

    });

    request.done(function(json) {
        if ( typeof json === "object" && json.week.length > 0) {

            $(json.week).each(function() {
                fileInfo = {
                    "file_id" : file_id,
                    "name" : this.name,
                    "hash" : this.hash
                };

            });
        }
        work_file_down.text("파일 : " + fileInfo["name"]);
        work_file_btns.css("display", "block");
        isLoadingFile = false;

    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        isLoadingFile = false;
    });
    // parsing end

    return true;
}

work_file_down.click(function() {
    document.location = "./file.php?select=download&name=" + fileInfo["name"] + "&hash=" + fileInfo["hash"];
});

//new
function newWork(ch_id, ch_name, mDate) {
    $("#workList").css("display", "block");
    flag_work_id = 0;
    $("#work_id").val(flag_work_id);
    resetWork();
    var date = new Date(mDate);
    $("#workDate").text((date.getMonth() + 1) + "월 " + date.getDate() + "일 / " + ch_name);
    $("#work_title").val("");
    $("#work_content").text("");
    $("#work_content").val("");
    $("#reply").html("");

    workArray[0] = {
        "day" : mDate,
        "ch_id" : ch_id,
        "file_id" : 0
    };
    $("#work_day").val(mDate);
    $("#work_ch_id").val(ch_id);
    work_file_add.css("display", "none");
    editMode();
}

function editMode() {
    var title = $("#work_title");
    var content = $("#work_content");

    flag_isEditing = true;
    title.attr("readonly", false);
    content.attr("readonly", false);
    title.css("border", "1px solid #04a4b5");
    content.css("border", "1px solid #04A4B5");
    work_complete_btn.attr("disabled", "disabled");
    work_edit_btn.css("display", "none");
    work_save_btn.css("display", "block");
    $("#reply_submit").attr("disabled", "disabled");
    $("#reply_file").attr("disabled", "disabled");
    if (workArray[flag_work_id]["file_id"] == 0) {
        work_file_add.css("display", "block");
    }
    $("#flag_select").val("upload");
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
        work_edit_btn.attr("disabled", "disabled");
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
    work_edit_btn.text("수정");
    work_edit_btn.attr("class", "btn btn-info");
    work_edit_btn.removeAttr("disabled");
    $("#work_delete_btn").removeAttr("disabled");
    $("#work_complete_btn").attr("class", "btn btn-info has-spinner");
    $("#work_complete_btn").text("완료 표시 하기");
    $("#work_complete_btn").removeAttr("disabled");
    $("#reply_submit").removeAttr("disabled");
    $("#reply_file").removeAttr("disabled");
    work_edit_btn.css("display", "block");
    work_save_btn.css("display", "none");
    flag_isEditing = false;
    work_file_btns.css("display", "none");
    work_file_add.css("display", "none");
    work_file_add.replaceWith( work_file_add = work_file_add.clone(true));
    $("#flag_select").val("reply");
}


$("#work_file_del").click(function() {

    if (confirm("삭제 후에는 복구가 불가능합니다.\n파일을 삭제하시겠습니까?")) {

    } else {
        return false;
    }

    if (isLoading)
        return false;

    isLoading = true;

    var request = $.ajax("file.php", {
        type : "GET",
        data : {
            select : "del",
            file_id : fileInfo["file_id"],
            name : fileInfo["name"],
            hash : fileInfo["hash"]
        }

    });

    request.done(function() {
        work_file_btns.css("display", "none");
        work_file_add.css("display", "block");
        isLoading = false;
    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        isLoading = false;
    });
    // parsing end

    return true;
});
$("#work_delete_btn").click(function() {

    if (confirm("삭제 후에는 복구가 불가능합니다.\n삭제하시겠습니까?")) {

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
            work_id : flag_work_id,
            file_id : workArray[flag_work_id]["file_id"]
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

function formValidate() {
    if (flag_isEditing) {
        var title = $("#work_title");
        if (title.val().replace(/\s/g, '') == "") {
            alert("제목 입력은 필수입니다.");
            return false;
        } else {
            return true;
        }
    } else {
        var title = $("#reply_input");
        if (title.val().replace(/\s/g, '') == "") {
            alert("내용을 입력하세요.");
            return false;
        } else {
            return true;
        }
    }
}


$('#work_file_add').bind('change', function() {
    if (1050000 < this.files[0].size) {
        alert('1MB이하의 용량만 업로드 가능합니다.');
        work_file_add.replaceWith( work_file_add = work_file_add.clone(true));
    }
});
$('#reply_file_add').bind('change', function() {
    if (1050000 < this.files[0].size) {
        var temp = $('#reply_file_add');
        alert('1MB이하의 용량만 업로드 가능합니다.');
        temp.replaceWith( temp = temp.clone(true));
    }
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
