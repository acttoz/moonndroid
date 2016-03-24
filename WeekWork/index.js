$("#menu-toggle").click(function(e) {
	e.preventDefault();
	$("#wrapper").toggleClass("toggled");
});

// var console = console || {
// log : function() {
// },
// warn : function() {
// },
// error : function() {
// }
// };
var isLoading = false;
var tClass = localStorage.getItem("tClass");
var quiz = localStorage.getItem("quiz");
var htmls = '';
// $('#title').html("문항번호: &nbsp; " + quiz);
getItem = function() {
	if (isLoading)
		return false;

	isLoading = true;

	var request = $.ajax("index_db.php", {
		type : "GET",
		dataType : "json",
		contentType : "application/json; charset=utf-8",
		data : {
			select : "week"
		}

	});

	request.done(function(json) {
		var obj;
		if ( typeof json === "object" && json.week.length > 0) {
			$(json.week).each(function() {
				var text = $('#' + this.ch_id + ' #' + this.day).text();
				if (text == '+') {
					$('#' + this.ch_id + ' #' + this.day).css('font-size',16);
					$('#' + this.ch_id + ' #' + this.day).css('text-align','left');
					$('#' + this.ch_id + ' #' + this.day).text('⦁ '+ this.work_name);
					$('#' + this.ch_id + ' #' + this.day).attr('onclick','workList("'+this.work_id+'")');
				} else {
					obj = $('#' + this.ch_id + ' #' + this.day).text(text + "\n" + '⦁ '+ this.work_name);

				}
			});
			obj.html(obj.html().replace(/\n/g, "<br>"));
			// $('#ctlGrid').html(htmls);
		}
		htmls = "";
		isLoading = false;

	});

	request.fail(function(jqXHR, textStatus, errorThrown) {
		alert("jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);

		isLoading = false;
	});
	// parsing end

	return true;

};

getItem();

function answer_input() {
	var encodedClass = encodeURI(tClass);
	var encodedQuiz = encodeURI(quiz);
	location.href = "answer_input.html?" + encodedClass + "&" + encodedQuiz;
}

function toHome() {
	location.href = "quiz_list.html";
}

function quiz_input() {
	var encodedClass = encodeURI(tClass);
	var encodedQuiz = encodeURI(quiz);
	location.href = "quiz_input.html?" + encodedClass + "&" + encodedQuiz;
}

function deleteAll() {
	console.log("delete" + tClass + this.quiz);
	var submitFlag = window.confirm("이 문항의 모든 자료가 삭제 됩니다.");
	if (submitFlag) {
		var request2 = $.ajax("db.php", {
			type : "POST",
			data : {
				select : "deleteall",
				mClass : tClass,
				quiz : this.quiz
			}

		});

		request2.done(function(data) {
			// Create our data table out of JSON data loaded from server.
			console.log("delete " + data);
			location.href = "quiz_list.html";

		});

		request2.fail(function(jqXHR, textStatus) {
			console.log("Request failed: " + textStatus);
			// location.href = "quiz_list.html";
		});
		// location.href = "quiz_list.html";
	}
}

function workList(ch_id,day) {
    $('#workList').css("display","block");
	var request2 = $.ajax("db.php", {
		dataType : "json",
		data : {
			select : "graph2",
			mClass : tClass,
			quiz : this.quiz

		}

	});

	request2.done(function(json) {
		// Create our data table out of JSON data loaded from server.
		var data = new google.visualization.DataTable(json);

		// Instantiate and draw our chart, passing in some options.
		var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		chart.draw(data, {
			width : 800,
			height : 400,
			title : "문항별 응답 비율(%)",

			vAxis : {

				viewWindowMode : 'explicit',
				viewWindow : {
					max : 100,
					min : 0
				}

			}
		});

	});

	request2.fail(function(jqXHR, textStatus) {
		console.log("Request failed: " + textStatus);
	});

}

function excel() {
	console.log("excel.php?mClass=" + tClass + "&quiz=" + quiz);
	location.href = "excel.php?mClass=" + tClass + "&quiz=" + quiz;

}

function view() {
	var obj = document.getElementById('ctlGrid');

	if (obj.style.display == "")
		obj.style.display = "none";
	else
		obj.style.display = "";
}

function newline(text) {
	var htmls = [];
	var lines = text.split(/\n/);
	var tmpDiv = jQuery(document.createElement('div'));
	for (var i = 0; i < lines.length; i++) {
		htmls.push(tmpDiv.text(lines[i]).html());
	}
	return htmls.join("<br>");
}

// setInterval(function() {
// getItem();
// drawChart();
// }, 5000);
