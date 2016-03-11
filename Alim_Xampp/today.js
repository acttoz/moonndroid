


function fontResize(num) {

	var font_size;
	var text_input = $('textarea');
	font_size = parseInt(text_input.css("font-size"));
	font_size += num;
	text_input.css("font-size", font_size + "px");
	localStorage.setItem("FONT", font_size);
}

function fontSize() {
	var font_size = localStorage.getItem("FONT");
	if (font_size != null)
		$('textarea').css("font-size", font_size + "px");
}

var day = 5;

function daySelect(num) {
	for (var i = 1; i < 6; i++) {

		document.getElementById("content" + i).style.display = "none";

	}
	day += num;
	if (day < 1)
		day = 1;
	if (day > 5)
		day = 5;
	document.getElementById("content" + day).style.display = "block";

}

var isLoading = false;

function save() {

	if (isLoading)
		return false;
	isLoading = true;

	$.ajax({
		url : "today_db.php",
		type : 'POST',
		data : {
			select : "save",
			d5 : $('#content5').val(),
		},
		success : function(args) {
			alert("저장완료.\n작성 내용은 저장되어 어플에서 볼 수는 있지만\n어플에 알림을 띄우지는 않습니다.\n알림을 띄우려면 '보내기'를 누르세요.");
			isLoading = false;
		},
		fail : function(jqXHR, textStatus, errorThrown) {
			alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
			isLoading = false;
		}
	});

}

function upload() {

	var r = confirm("학생과 학부모의 어플에 알림을 띄워\n알림장을 확인하도록 합니다.\n알림은 10분~20분정도 소요됩니다.");
	if (r == true) {
		if (isLoading)
			return false;
		isLoading = true;

		$.ajax({
			url : "today_db.php",
			type : 'POST',
			data : {
				select : "send",
				d5 : $('#content5').val(),
				day : $('#content5').attr("day")
			},
			success : function(args) {
				if (confirm("보내기 완료")) {
					 location.reload();
				}
				isLoading = false;
			},
			fail : function(jqXHR, textStatus, errorThrown) {
				alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
				isLoading = false;
			}
		});
	} else {

	}

}

$(function() {
	var mobileKeyWords = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'Windows CE;', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Mobile', 'Symbian', 'Opera Mobi', 'Opera Mini', 'IEmobile');
	var isMobile = false;
	for (var word in mobileKeyWords) {
		if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
			isMobile = true;
			break;
		}
	}
	if (!isMobile)
		fontSize();
});

