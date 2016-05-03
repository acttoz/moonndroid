//reply
function getReply(work_id) {

    $.ajax("db.php", {
        type : "GET",
        dataType : "json",
        complete : setTimeout(function() {getReply(flag_work_id);}, 10000),

        contentType : "application/json; charset=utf-8",
        data : {
            select : "reply",
            work_id : work_id
        },
        success : function(json) {
            $("#reply").empty();
            var obj = $("#reply");
            var replyCount = 0;
            htmls = "";
            if ( typeof json === "object" && json.week.length > 0) {
                $(json.week).each(function() {
                    if (replyCount != 0)
                        htmls += '<hr>';
                    htmls += '<p style=" padding-right:5px;">' + this.content + '&nbsp;<span style="font-weight:bold">- ' + this.name + '</span>' + '<span style="font-size:12px">(' + this.time + ')</span>&nbsp;&nbsp;&nbsp;';
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
                // obj.html(obj.html().replace(/\n/g, "<br>"));
                obj.scrollTop(obj[0].scrollHeight);
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
            hash : hash
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

function reply_complete() {

    if (isLoading)
        return false;

    isLoading = true;
    var request = $.ajax("db.php", {
        type : "GET",
        data : {
            select : "sendReply",
            work_id : flag_work_id
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
}

