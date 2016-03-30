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

