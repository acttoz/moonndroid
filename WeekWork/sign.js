/**
 * @author 문병무
 */

var isLoading = false;
var idChecked = false;
var currentSchoolNo = 0;
var currentChId = 0;
var currentChName = 0;
var flag_isSchool = false;

// function school() {
// var htmls = '';
// $('#school_list').html(htmls);
// flag_isSchool = true;
// $("#search_group").css("display", "block");
// $("#list_group").css("display", "block");
// }
//
// function channel() {
// flag_isSchool = false;
// $("#list_group").css("display", "block");
// $("#search_group").css("display", "none");
//
// var htmls = '';
// $('#school_list').html(htmls);
// if (isLoading)
// return false;
//
// isLoading = true;
// var request = $.ajax("db.php", {
// type : "GET",
// dataType : "json",
// contentType : "application/json; charset=utf-8",
// data : {
// select : 'get_channel',
// school_id : school_id
// }
//
// });
//
// request.done(function(json) {
// if (json.list != null && typeof json === "object" && json.list.length > 0) {
// $(json.list).each(function() {
// if (this.ch_name != "학교") {
// htmls += '<li class="list-group-item" style="height:60px;" onclick="';
//
// if (this.pw == 0)
// htmls += 'signChMode(' + this.ch_id + ',\'' + this.ch_name + '\')">';
// else
// htmls += 'loginChMode(' + this.ch_id + ',\'' + this.pw + '\',\'' + this.ch_name + '\')">';
//
// htmls += '<label>' + this.ch_name + '</label>';
// htmls += '</li>';
// }
//
// });
// $('#school_list').html(htmls);
// } else {
// htmls = '<li><a href="#"  class="list-group-item" value="' + '0' + '">' + '검색결과가 없습니다.  <br/>대한초등학교의 경우 "대한"만 입력해보세요.<br/>신축 학교는 서버에 없을 수 있으니 메일주시면 바로 추가해드리겠습니다.<br/> 문의(acttoz@naver.com).' + '</a></li>';
// $('#school_list').html(htmls);
// }
// htmls = "";
// isLoading = false;
//
// });
//
// request.fail(function(jqXHR, textStatus, errorThrown) {
// alert("오류발생 \n jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
//
// isLoading = false;
// });
// // parsing end
//
// return true;
// }

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
// function getSchoolPw(schoolNo, schoolName) {
// var htmls = '';
// var word = $("#search_input").val();
// if (!word) {
// alert("검색어를 입력하세요..!!");
// $("#search_input").focus();
// return false;
// }
// if (isLoading)
// return false;
//
// isLoading = true;
// var request = $.ajax("db.php", {
// type : "GET",
// dataType : "json",
// contentType : "application/json; charset=utf-8",
// data : {
// select : 'get_school',
// no : schoolNo
// }
//
// });
//
// request.done(function(json) {
// if (json.list != null && typeof json === "object" && json.list.length > 0) {
// loginChMode($(json.list).get(0).ch_id, $(json.list).get(0).pw, schoolName);
// } else {
// signSchoolMode(schoolNo, schoolName);
// }
// isLoading = false;
//
// });
//
// request.fail(function(jqXHR, textStatus, errorThrown) {
// alert("오류발생 \n jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
//
// isLoading = false;
// });
// // parsing end
//
// return true;
//
// }
//
// function getChPw(ch_name) {
// alert('<?php= $school_id ?>');
// var htmls = '';
// var word = $("#search_input").val();
// if (!word) {
// alert("검색어를 입력하세요..!!");
// $("#search_input").focus();
// return false;
// }
// if (isLoading)
// return false;
//
// isLoading = true;
// var request = $.ajax("db.php", {
// type : "GET",
// dataType : "json",
// contentType : "application/json; charset=utf-8",
// data : {
// select : 'get_ch',
// school_id : school_id
// }
//
// });
//
// request.done(function(json) {
// if (json.list != null && typeof json === "object" && json.list.length > 0) {
// $(json.list).each(function() {
// loginChMode(this.ch_id, this.pw, schoolName);
// });
// } else {
// signSchoolMode(schoolNo, schoolName);
// }
// isLoading = false;
//
// });
//
// request.fail(function(jqXHR, textStatus, errorThrown) {
// alert("오류발생 \n jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
//
// isLoading = false;
// });
// // parsing end
//
// return true;
//
// }

// function signSchoolMode(schoolNo, schoolName) {
// $("#sign_school").css("display", "block");
// $("#sign_school #ch_name").text(schoolName + "의 비밀번호를 설정합니다.\n학교의 선생님들께만 알려주세요.");
// $("#login_ch").css("display", "none");
// $("#sign_ch").css("display", "none");
// currentSchoolNo = schoolNo;
// currentChName = schoolName;
// }
//
// function loginChMode(ch_id, ch_pw, schoolName) {
// $("#sign_school").css("display", "none");
// $("#login_ch").css("display", "block");
// $("#login_ch #ch_name").text(schoolName + "는 이미 생성된 학교입니다.\n비밀번호를 입력하고 가입해주세요.");
// $("#sign_ch").css("display", "none");
// currentChPw = ch_pw;
// currentChId = ch_id;
//
// console.log(currentChPw);
// }
//
// function signChMode(ch_id, ch_name) {
// $("#sign_school").css("display", "none");
// $("#login_ch").css("display", "none");
// $("#sign_ch").css("display", "block");
// $("#sign_ch #ch_name").text(ch_name + "의 비밀번호를 설정합니다.\n동학년 선생님들께만 알려주세요.");
// currentChId = ch_id;
//
// }
//
// function sign_school(ch_id, ch_pw) {
// location.href = "db.php?select=sign_school&school_no=" + currentSchoolNo + "&grade=" + currentChName + "&pw=" + $("#pw_create").val();
// }

function sign_ch(grade, school_no) {
    var pw = 0;
    if (grade == 0)
        pw = $("#school_pw").val();
    else
        pw = $("#grade_pw").val();

    if (confirm("암호를 '" + pw + "'로 설정합니다.")) {
        location.href = "db.php?select=sign_ch&school_no=" + school_no + "&grade=" + grade + "&pw=" + pw;
    }
}

function login_ch(grade, ch_id) {
   
    var pw = 0;
    if (grade == 0) {
        pw = $("#school_pw").val();
         console.log(school_pw+"="+pw);
        if (school_pw != pw) {
            alert("암호가 맞지 않습니다.");
            return false;
        }
    } else {
        pw = $("#grade_pw").val();
        if (grade_pw != pw) {
            alert("암호가 맞지 않습니다.");
            return false;
        }
    }
    location.href = "db.php?select=login_ch&ch_id=" + ch_id + "&grade=" + grade;
}

// var fnChannel = function() {
//
// var htmls = '';
// $('#school_list').html(htmls);
// if (!word) {
// alert("검색어를 입력하세요..!!");
// $("#search_input").focus();
// return false;
// }
// if (isLoading)
// return false;
//
// isLoading = true;
// var request = $.ajax("db.php", {
// type : "GET",
// dataType : "json",
// contentType : "application/json; charset=utf-8",
// data : {
// select : 'search',
// word : word
// }
//
// });
//
// request.done(function(json) {
// if (json.list != null && typeof json === "object" && json.list.length > 0) {
// $(json.list).each(function() {
// htmls += '<li class="list-group-item" style="height:60px;" onclick="getSchoolPw(' + this.no + ',\'' + this.school + '\')"><label>' + this.school + '</label>';
// htmls += '</li>';
//
// });
// }
// $('#school_list').html(htmls);
// htmls = "";
// isLoading = false;
//
// });
//
// request.fail(function(jqXHR, textStatus, errorThrown) {
// alert("오류발생 \n jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
//
// isLoading = false;
// });
// // parsing end
//
// return true;
//
// };
//
function schoolClick(id, school) {

$("#selected_school").val(school);
$("#selected_school").attr("school_id", id);
$("#selected_school").attr("school_name", school);

}

function toNext() {
    var mUserid = $("#user_id").val();
    var grade = $(".grade option:selected").attr("value");
    var ban = $(".ban option:selected").attr("value");
    var teacher = $("#teacher_name").val();
    var class_key = $("#class_pass").val();
    var class_key2 = $("#class_pass2").val();
    var school = $("#selected_school").attr("school_name");
    var school_id = $("#selected_school").attr("school_id");
    var mUserPass = select_school.user_pass.value;
    var mUserPass2 = select_school.user_pass2.value;

    if (!teacher) {
        alert("담임성명을 입력하세요..!!");
        return;
    } else if (school == "null") {
        alert("학교를 선택하세요..!!");
        return;
    } else if (!idChecked) {
        alert("이메일 중복확인을 해주세요..!!");
        select_school.user_id.focus();
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
    } else {

        if (confirm(school + "\n" + grade + "학년\n" + ban + "반\n" + teacher + "선생님\n" + "위의 정보가 맞습니까?")) {
            if (isLoading)
                return false;
            isLoading = true;
            $.ajax({
                url : "db.php",
                type : 'GET',
                data : {
                    select : "sign",
                    name : teacher,
                    school : school,
                    school_id : school_id,
                    grade : grade,
                    ban : ban,
                    user_id : mUserid,
                    user_pass : mUserPass
                },
                success : function(args) {
                    isLoading = false;

                    if (args == "success") {
                        if (window.confirm('회원가입이 완료되었습니다.\n로그인 화면으로 이동합니다.')) {
                            localStorage.removeItem("ID");
                            document.location.href = "index.php";
                        }
                    } else if (args == "fail") {
                        alert("오류발생:이미 가입된 학급입니다. 관리자에게 문의하세요. acttoz@naver.com");
                    } else {
                        alert(args);
                    }

                },
                fail : function(jqXHR, textStatus, errorThrown) {
                    aler("오류 발생:" + jqXHR + " " + textStatus);
                    isLoading = false;
                }
            });
            // Save it!
        } else {
            // Do nothing!
        }
    }
}

function id_check() {
    var mUserid = $("form #user_id").val();

    if (!mUserid) {
        alert("아이디를 입력하세요..!!");
        return false;
    } else {

        if (isLoading)
            return false;
        isLoading = true;
        $.ajax({
            url : "db.php",
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



