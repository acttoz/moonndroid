function fontResize(num) {

	var font_size;
	var text_input = $('.content');
	font_size = parseInt(text_input.css("font-size"));
	font_size += num;
	text_input.css("font-size", font_size + "px");
	localStorage.setItem("FONT", font_size);
	// var textarea_height;
	// textarea_height= parseInt(text_input.css("height"));
	// textarea_height += (num*5);
	// text_input.css("height", textarea_height + "px");
	fontSizeSet();
}
 
function fontSize() {
	var font_size = localStorage.getItem("FONT");
	if (font_size != null)
		$('.content').css("font-size", font_size + "px");
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
	document.getElementById("content" + day)
	resize();

}

function fontSizeSet() {
	for (var i = 1; i < 6; i++) {
		$("#content" + i).css("height", "1px");
		$("#content" + i).css("height", (20 + document.getElementById("content" + i).scrollHeight + "px"));
	}
}



function logOut() {
	localStorage.setItem("ID","noid");
	document.location.href = "mobile_index.php";

}

fontSize();
fontSizeSet();