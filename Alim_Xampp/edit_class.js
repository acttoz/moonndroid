/**
 * @author 문병무
 */
$(function() {
	var ver = $("#notice").attr("ver") * 1;
	var local_ver = localStorage.getItem("TODAY_NOTICE") * 1;
	if (local_ver == null || ver > local_ver) {
		$("#dialog-confirm").css("display", "block");
		$("#dialog-confirm").dialog({
			resizable : false,
			width : 800,
			height : 640,
			modal : true,
			buttons : {
				"다시 보지 않기" : function() {
					$(this).dialog("close");
					localStorage.setItem("TODAY_NOTICE", ver);
				},
				"닫기" : function() {
					$(this).dialog("close");
				}
			},
			open : function() {
				$(this).scrollTop(0);
			}
		});
	}
});


var isLoading = false;
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
	var request = $.ajax("sign_class_db.php", {
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
			htmls = '<a href="#"  class="list-group-item" value="' + '0' + '">' + '검색결과가 없습니다. <br/> <br/>대한초등학교의 경우 "대한"만 입력해보세요. 문의(acttoz@naver.com).' + '</a>';
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

function toNext() {

	var grade = $(".grade option:selected").attr("value");
	var ban = $(".ban option:selected").attr("value");
	var teacher = $("#teacher_name").val();
	var school = $("#selected_school").attr("school_name");
	var school_id = $("#selected_school").attr("school_id");
	var mUserPass = select_school.user_pass.value;
	var mUserPass2 = select_school.user_pass2.value;
	var mUserid = $("#user_id").val();
	if (!teacher) {
		alert("담임성명을 입력하세요..!!");
		return;
	}   else if (school == "null") {
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

	} else {

			if (isLoading)
				return false;
			isLoading = true;
			$.ajax({
				url : "sign_class_db.php",
				type : 'GET',
				data : {
					select : "edit",
					name : teacher,
					school : school,
					school_id : school_id,
					grade : grade,
					ban : ban,
					user_id : mUserid,
					user_pass : mUserPass
				},
				success : function(args) {
					alert("선생님의 정보가 수정되었습니다.");
					document.location.href = "today.php";
					isLoading = false;
				},
				fail : function(jqXHR, textStatus, errorThrown) {
					alert("오류발생 \n jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
					isLoading = false;
				}
			});
			 
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

function maxLengthCheck(object) {
	if (object.value.length > object.maxLength)
		object.value = object.value.slice(0, object.maxLength);
}

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