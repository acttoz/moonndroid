function fontResize(num) {

	var font_size;
	var text_input = $('#content');
	font_size = parseInt(text_input.css("font-size"));
	font_size += num;
	text_input.css("font-size", font_size + "px");
	localStorage.setItem("FONT",font_size);
}

function fontSize() {
	var font_size = localStorage.getItem("FONT");
	if (font_size != null)
		$('#content').css("font-size", font_size + "px");
}

fontSize();

