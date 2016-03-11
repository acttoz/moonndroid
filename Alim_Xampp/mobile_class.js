/**
 * @author 문병무
 */

var isLoading = false;
var idChecked = false;
var android_school;
var android_class;
var android_id;
var android_day;
var fnSchool = function() {

	var word = select_school.school_word.value;
	if (!word) {
		alert("검색어를 입력하세요..!!");
		select_school.school_word.focus();
		return false;
	}
	var htmls = '';
	$('#school_list').html(htmls);
	var grade = '';
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
			grade : grade,
			word : word
		}

	});

	request.done(function(json) {
		$(".school_list").css("display", "block");
		if ( typeof json === "object" && json.list.length > 0) {
			$(json.list).each(function() {

				htmls += '<a onclick="schoolClick(\'' + this.no + '\',\'' + this.school + '\')" class="list-group-item" >' + this.school + '</a>';

			});
			$('#school_list').html(htmls);
		} else {
			htmls = '<a href="#"  class="list-group-item" value="' + '0' + '">' + '검색결과가 없습니다. <br/>대한초등학교의 경우 "대한"만 입력해보세요.<br/> 문의(acttoz@naver.com).' + '</a>';
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

var schoolClick = function(id, school) {

	
	var htmls = '';
	$('#class_list').html(htmls);
	if (isLoading)
		return false;

	isLoading = true;
	android_school=school;
	var request = $.ajax("mobile_class_db.php", {
		type : "GET",
		dataType : "json",
		contentType : "application/json; charset=utf-8",
		data : {
			id : id
		}

	});

	request.done(function(json) {
		$(".class_list").css("display", "block");
		if ( typeof json === "object" && json.list.length > 0) {
			$(json.list).each(function() {

				htmls += '<a onclick="classClick(\'' + this.class_key+'\',\'' +this.grade + '학년' + this.ban + '반 ' + this.name + '선생님\',\''+this.id+'\',\''+this.day+'\')" class="list-group-item">' + this.grade + '학년' + this.ban + '반<br>' + this.name + '선생님' + '</a>';

			});
			$('#class_list').html(htmls);
		} else {
			htmls = '<a href="#"  class="list-group-item" value="' + '0' + '">' + '검색결과가 없습니다. <br/>' + school + '에는 스피드알림장을 쓰는 학급이 없습니다.<br/>담임선생님께 문의해주세요.' + '</a>';
			$('#class_list').html(htmls);
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

var classClick = function(class_key,class_name,class_id,day) {
	$('#password').css("display", "block");
	$('#password').attr("class_key", class_key);
	$('#password').attr("class_id", class_id);
	android_class=class_name;
	android_day=day;
	return true;

};

function toNext() {

	var class_key = $("#password").attr("class_key");
	var class_id = $("#password").attr("class_id");
	var input_key = $("#class_pass").val();
	var nick=$("#nick").val();

	if (class_key == input_key) {
		Android.showToast(android_school,android_class,class_id,class_key,nick,android_day);
		return;
	} else {
		Android.showToast2();
		return;
	}
}
 

