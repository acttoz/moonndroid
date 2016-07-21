$("#search_input").keydown(function(event) {
    if (event.keyCode == 13) {
        search();

    }
});

search = function() {
    if ($("#search_input").val().replace(/\s/g, '') == "") {
        alert("검색어를 입력하세요.");
        $("#search_input").val("");
        return false;
    }
    var request = $.ajax("db.php", {
        type : "GET",
        dataType : "json",
        contentType : "application/json; charset=utf-8",
        data : {
            select : "search_work",
            word : $("#search_input").val()
        }

    });
    request.done(function(json) {
        var obj = $("#search_result");

        obj.empty();
        if (json.week != null && typeof json === "object" && json.week.length > 0) {
            $(json.week).each(function() {
                
                htmls += '<table  style="width:100%;table-layout: fixed;" class="work_name" onclick="move_week(\''+this.date+'\','+this.work_id+')"><tr>';
                htmls += '<td style="width:10%;padding:0px;border:none;background-color:rgba(0, 0, 0, 0);height:auto;">';
                htmls += '<p data-toggle="tooltip" title="' + this.work_name + '" class="btn btn-default work"  style="border-color:#cfebf2;display:block;margin-top:0px;margin-bottom:10px; ">'+this.day+'</p>';
                htmls += '</td>';
                htmls += '<td style="width:20%;padding:0px;border:none;background-color:rgba(0, 0, 0, 0);height:auto;">';
                htmls += '<p data-toggle="tooltip" title="' + this.work_name + '" class="btn btn-default work"   style="border-color:#cfebf2;';
                htmls += 'display:block;margin-top:0px;margin-bottom:10px; ">';
                htmls += this.work_name;
                htmls += '</p>';
                htmls += '</td>';
                htmls += '<td style="width:10%;padding:0px;border:none;background-color:rgba(0, 0, 0, 0);height:auto;">';
                htmls += '<p data-toggle="tooltip" title="' + this.work_name + '" class="btn btn-default work"  style="border-color:#cfebf2;display:block;margin-top:0px;margin-bottom:10px; ">'+this.ch_id+'</p>';
                htmls += '</td>';
                htmls += '</tr></table>';
                obj.prepend(htmls);
                htmls = "";
                obj.scrollTop(obj[0].scrollHeight);

            });

        }else{
            htmls += '<table  style="width:100%;table-layout: fixed;" class="work_name"  ><tr>';
                htmls += '<td style="width:10%;padding:0px;border:none;background-color:rgba(0, 0, 0, 0);height:auto;">';
                htmls += '<p  class="btn btn-default work"  style="border-color:#cfebf2;display:block;margin-top:0px;margin-bottom:10px; ">'+'\''+$("#search_input").val()+'\'의 검색 결과가 없습니다.'+'</p>';
                htmls += '</td>';
                htmls += '</tr></table>';
                obj.prepend(htmls);
                htmls = "";
                obj.scrollTop(obj[0].scrollHeight);
        }
    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        alert("오류 : 네트워크 연결을 확인해주세요.");
    });
    // parsing end

    return true;

};

function move_week(date,work_id){
    location.href="./week.php?search_date="+date+"&search_work="+work_id;
}

