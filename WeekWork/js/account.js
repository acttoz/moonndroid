/**
 * @author 문병무
 */

var isLoading = false;
var idChecked = false;
var currentSchoolNo = 0;
var currentChId = 0;
var currentChName = 0;
var flag_isSchool = false;

 

function signUp() {
    var mUserid = $("form #user_id").val();
    var teacher = $("form #teacher_name").val();
    var mUserPass = $("form #user_pass").val();
    var mUserPass2 = $("form #user_pass2").val();

    if (!teacher) {
        alert("이름을 입력하세요..!!");
        return;
    }   else if (!mUserPass) {
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
        return;
    } else {

        if (isLoading)
            return false;
        isLoading = true;
        $.ajax({
            url : "../db.php",
            type : 'GET',
            data : {
                select : "account",
                user_name : teacher,
                user_pw : mUserPass,
                user_mail : $("#email").val()
            },
            success : function(args) {
                isLoading = false;
                if (!alert('회원 정보 수정 완료.')) {
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
function logout(){
    location.href="logout.php";
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