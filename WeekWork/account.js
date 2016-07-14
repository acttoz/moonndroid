/**
 * @author 문병무
 */

var isLoading = false;
var idChecked = false;
var currentSchoolNo = 0;
var currentChId = 0;
var currentChName = 0;
var flag_isSchool = false;
var school_logout = 0;

function schoolClick(id, school) {

    $("#selected_school").val(school);
    $("#selected_school").attr("school_id", id);
    $("#selected_school").attr("school_name", school);

}

function toNext() {

    var grade = $(".grade option:selected").attr("value");
    if (flag_ban)
        var ban = $(".ban option:selected").attr("value");
    else
        var ban = $(".position option:selected").attr("value");
    var teacher = $("#teacher_name").val();
    var class_key = $("#class_pass").val();
    var school = $("#selected_school").attr("school_name");
    var school_id = $("#selected_school").attr("school_id");
    var mUserPass = select_school.user_pass.value;
    var mUserPass2 = select_school.user_pass2.value;
    var mUserid = $("#user_id").val();
    if (!teacher) {
        alert("담임성명을 입력하세요..!!");
        return;
    } else if (school == "null") {
        alert("학교를 선택하세요..!!");
        return;

    } else if (!mUserPass) {
        alert("비밀번호를 입력하세요..!!");
        return;
    } else if (!mUserPass2) {
        alert("비밀번호 확인을 입력하세요..!!");
        return;
    } else if (mUserPass != mUserPass2) {
        alert("비밀번호가 일치하지 않습니다.");
        select_school.user_pass2.focus();
        return;

    } else if (origin_school != school_id || origin_grade != grade) {
        if (confirm("학교나 학년을 변경면 학교와 학년 로그인을 다시 해야 합니다.\n변경하시겠습니까?"))
            school_logout = 1;
        else
            return;

    } else if (origin_school == school_id && origin_grade == grade) {
        school_logout = 0;
    }

    if (confirm("입력하신 정보가 맞습니까?")) {
        if (isLoading)
            return false;
        isLoading = true;
        $.ajax({
            url : "db.php",
            type : 'GET',
            data : {
                select : "account",
                name : teacher,
                school : school,
                school_id : school_id,
                grade : grade,
                ban : ban,
                user_id : mUserid,
                user_pass : mUserPass,
                school_logout : school_logout
            },
            success : function(args) {
                alert("선생님의 정보가 수정되었습니다.");
                document.location.href = "week.php";
                isLoading = false;
            },
            fail : function(jqXHR, textStatus, errorThrown) {
                alert("오류발생 \n jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
                isLoading = false;
            }
        });
        // Save it!
    }
}

var fnSchool = function() {

    var htmls = '';
    $('#school_list').html(htmls);
    var word = select_school.school_word.value;
    var grade = '';
    if (!word) {
        alert("검색어를 입력하세요..!!");
        select_school.school_word.focus();
        return false;
    }
    if (isLoading)
        return false;

    isLoading = true;
    var request = $.ajax("db.php", {
        type : "GET",
        dataType : "json",
        contentType : "application/json; charset=utf-8",
        data : {
            select : 'search',
            grade : grade,
            word : word
        }

    });

    request.done(function(json) {
        if (json != null && json.list != null && typeof json === "object" && json.list.length > 0) {
            $(json.list).each(function() {

                htmls += '<a onclick="schoolClick(\'' + this.no + '\',\'' + this.school + '\')" class="list-group-item" >' + this.school + '</a>';

            });
            $('#school_list').html(htmls);
        } else {
            htmls = '<a href="#"  class="list-group-item" value="' + '0' + '">' + '검색결과가 없습니다.  <br/>대한초등학교의 경우 "대한"만 입력해보세요.<br/>2005년이후 개교한 학교는 서버에 없을 수 있으니 메일주시면 바로 추가해드리겠습니다.<br/> 문의(acttoz@naver.com).' + '</a>';
            $('#school_list').html(htmls);
        }
        htmls = "";
        isLoading = false;

    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        alert("오류발생 \n jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

        isLoading = false;
    });
    // parsing end

    return true;

};
function logOut() {
    localStorage.removeItem("ID");
    document.location.href = "logout.php";

}

function signOut() {
    var r = confirm("정말로 탈퇴하시겠습니까?");
    if (r == true) {
        document.location.href = "signout.php";
    } else {
    }
}

function trim(str) {
    return str.replace(/(^\s*)|(\s*$)/g, "");
}

function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
    return true;
}


$(".pass2").keyup(function(event) {
    if (event.keyCode == 13) {
        $("#submit_btn").click();
    }
});

$("#search_input").keyup(function(event) {
    if (event.keyCode == 13) {
        $("#search_button").click();
    }
});
/* 숫자만 입력받기 */
function fn_press(event, type) {
    if (type == "numbers") {
        if (event.keyCode < 48 || event.keyCode > 57)
            return false;
        //onKeyDown일 경우 좌, 우, tab, backspace, delete키 허용 정의 필요
    }
}

/* 한글입력 방지 */
function fn_press_han(obj) {
    //좌우 방향키, 백스페이스, 딜리트, 탭키에 대한 예외
    if (event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46)
        return;
    //obj.value = obj.value.replace(/[\a-zㄱ-ㅎㅏ-ㅣ가-힣]/g, '');
    obj.value = obj.value.replace(/[\ㄱ-ㅎㅏ-ㅣ가-힣]/g, '');
}


$(".grade").change(function() {
    var str = "";
    $(".grade option:selected").each(function() {
        if ($(this).val() == 10 || $(this).val() == 100) {
            flag_ban = false;
            $("#select_position").css("display", "block");
            $("#select_ban").css("display", "none");
        } else {
            flag_ban = true;
            $("#select_position").css("display", "none");
            $("#select_ban").css("display", "block");
        }
    });
}).change();
