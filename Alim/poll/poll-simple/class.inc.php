<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajax Poll Script v3.02 [ GPL ]
// Copyright (c) phpkobo.com ( http://www.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : APSMX-302
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CTClass extends CTClassBase
{
	function setupPoll( $poll ) {

		//-- Poll Title
		$poll->attr( "title", "" );

		//-- Poll Options
		$poll->addItem( "있으면 좋겠다." );
		$poll->addItem( "불필요한 기능이다." );

		//-- Text used in polls
		$poll->attr( "msg-vote", "투표" );
		$poll->attr( "msg-select-one", "하나만 골라주세요." );
		$poll->attr( "msg-already-voted", "이미 투표하셨네요~" );
		$poll->attr( "msg-view-result", "결과 보기" );
		$poll->attr( "msg-thank-you", "투표해주셔서 감사합니다." );
		$poll->attr( "msg-return", "뒤로" );
		$poll->attr( "msg-total", "전체" );
		$poll->attr( "msg-reset-block", "Reset IP & Cookie Block" );
		$poll->attr( "msg-not-started", "투표가 열리지 않았습니다." );
		$poll->attr( "msg-ended", "투표가 종료되었습니다." );

		//-- Display "Reset IP & Cookie Block" button
		//--	Show: true
		//--	Hide: false
		$poll->attr( "b-reset-block", false );

		//-- Single selection or multiple selection
		//--	single selection: "radio"
		//--	multiple selection: "checkbox"
		$poll->attr( "vote-input", "radio" );

		//-- Specify the time delay on tool tips in milliseconds
		$poll->attr( "tip-box-duration", 2000 );

		//-- Prevent users from voting more than once by IP address
		//--	"true" or "false"
		$poll->attr( "enable-ip-block", false );

		//-- Prevent users from voting more than once by Cookie
		//--	"true" or "false"
		$poll->attr( "enable-cookie-block", true );

		//-- Specifiy the cookie's life span in seconds
		//--	(e.g.)　60*60*24 => One Day
		//--	(e.g.)　60*60*24*365 => One Year
		$poll->attr( "cookie-block-period", 60*60*24*365 );

		//-- Specifiy Start and End Date&Time:
		//-- Enter an empty string ("") if you don't need to specify it.
		//--	(e.g.)　"2010-01-02"
		//--	(e.g.)　"2015-03-01 15:20"
		$poll->attr( "dt-start", "" );
		$poll->attr( "dt-end", "" );

		//-- end
		return true;
	}
}

?>
