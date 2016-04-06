/**
 * @author 문병무
 */

var isLoading = false;
var idChecked = false;

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
    switch($(".school_grade option:selected").attr("value")) {
    case '1':
        grade = 'school_cho';
        break;
    case '2':
        grade = 'school_joong';
        break;
    case '3':
        grade = 'school_ko';
        break;
    case '4':
        grade = 'school_special';
        break;
    }
    if (isLoading)
        return false;

    isLoading = true;
    var request = $.ajax("../../db.php", {
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
        if ( typeof json === "object" && json.list.length > 0) {
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

function schoolClick(id, school) {

    $("#selected_school").val(school);
    $("#selected_school").attr("school_id", id);
    $("#selected_school").attr("school_name", school);

}

function signUp() {
    var mUserid = $("form #user_id").val();
    var teacher = $("form #teacher_name").val();
    var mUserPass = $("form #user_pass").val();
    var mUserPass2 = $("form #user_pass2").val();

    if (!teacher) {
        alert("이름을 입력하세요..!!");
        return;
    } else if (!idChecked) {
        alert("아이디 중복확인을 해주세요..!!");
        select_school.user_id.focus();
        return;
    } else if (!mUserPass) {
        alert("비밀번호를 입력하세요..!!");
        return;
    } else if (!mUserPass2) {
        alert("비밀번호 확인을 입력하세요..!!");
        return;
    } else if (!$("#email").val()) {
        alert("이메일을 입력해 주세요...!!");
        return;
    } else if (mUserPass != mUserPass2) {
        alert("비밀번호가 일치하지 않습니다.");
        select_school.user_pass2.focus();
        return;
    } else {

        if (isLoading)
            return false;
        isLoading = true;
        $.ajax({
            url : "../db.php",
            type : 'GET',
            data : {
                select : "submit",
                user_name : teacher,
                user_id : mUserid,
                user_pw : mUserPass,
                user_mail : $("#email").val()
            },
            success : function(args) {
                isLoading = false;
                if (!alert(args + '회원가입이 완료되었습니다.\n로그인 화면으로 이동합니다.')) {
                    localStorage.removeItem("ID");
                    document.location.href = "index.php";
                }

            },
            fail : function(jqXHR, textStatus, errorThrown) {
                aler("오류 발생:" + jqXHR + " " + textStatus);
                isLoading = false;
            }
        });
    }
}

function idCheck() {
    var mUserid = $("form #user_id").val();

    if (!mUserid) {
        alert("아이디를 입력하세요..!!");
        return;
    } else {

        if (isLoading)
            return false;
        isLoading = true;
        $.ajax({
            url : "../db.php",
            type : 'GET',
            cache : false,
            data : {
                select : "idcheck",
                user_id : mUserid
            },
            success : function(args) {
                if (args == "success") {
                    alert("사용할 수 있는 아이디입니다.");
                    idChecked = true;
                } else {
                    alert(mUserid + "는 이미 사용 중인 아이디입니다.");
                    idChecked = false;
                    select_school.user_id.focus();
                }
                isLoading = false;
            },
            fail : function(jqXHR, textStatus, errorThrown) {
                alert("오류발생 \n jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
                isLoading = false;
            }
        });

    }

}// end function fnLogin()

function sign_help() {
    $("#dialog-confirm").css("display", "block");
    $("#dialog-confirm").scrollTop("0");

    $("#dialog-confirm").dialog({
        resizable : false,
        width : 840,
        height : 688,
        modal : true,

        buttons : {
            "확인" : function() {
                $(this).dialog("close");
            }
        },
        open : function() {
            $(this).scrollTop(0);
        }
    });
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

function maxLengthCheck(object) {
    if (object.value.length > object.maxLength)
        object.value = object.value.slice(0, object.maxLength)
}
