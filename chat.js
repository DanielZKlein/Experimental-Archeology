// CHAT.js
chatQueue = ""; // STRING of chat lines received from PHP, not yet added to chat
refreshVars["chatlast"] = -1;
refreshes.push("ChatRefresh");
ajaxOpts["chatajax"] = "enabled";

function chatSubmit() {
	
	chattext = $("#chatbox").val();
	shit({"chatline" : chattext});
	flush();
	$("#chatbox").val("");
	return false;

}

function emptyCallback() {

	// do absolutely nothing

}

function takeChatRefresh(text) {

	oldtext = $("#chatarea").html();
	newtext = oldtext + text;
	$("#chatarea").html(newtext);
	chatarea = document.getElementById("chatarea");
	chatarea.scrollTop = chatarea.scrollHeight;

}

function setChatLastId(id) {

	refreshVars["chatlast"] = id;

}

$(function() {
	// ready function
	$("#chatform").bind("submit", chatSubmit);
	// CLEAR!
	//heartBeat(); --> this goes to common
	
});