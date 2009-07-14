// CHAT.js
chatQueue = ""; // STRING of chat lines received from PHP, not yet added to chat
ajaxOpts["chatrefreshids"] = new Array();
modules.push("Chat");
readyFunctions.push("registerAllChats();");
chatRegisterQueue = new Array();
chatPrefixes = new Array();
ajaxOpts["chatrefreshids"] = "";

function registerAllChats() {

	for (index in chatRegisterQueue) {
	
		chatRegister(index, chatRegisterQueue[index]);
	
	}

}

function chatRegister(chatid, prefix) {

	//alert("chatregister id " + chatid+ " : " + prefix);
	chatPrefixes[chatid] = prefix;
	ajaxOpts["chatrefreshids"] += chatid.toString() + "|";
	refreshVars["chat"+chatid+"last"] = -1;
	$("#"+prefix+"chatform").bind("submit", {"chatid": chatid}, chatSubmit);
//	alert("after bind");

}

function chatSubmit(event) {
	
	chatid = event.data.chatid;
	prefix = chatPrefixes[chatid];
	chattext = $("#"+prefix+"chatbox").val();
	shit({"ChatLine" : chattext, "chatid" : chatid});
	flush();
	$("#"+prefix+"chatbox").val("");
	return false;

}

function emptyCallback() {

	// do absolutely nothing

}

function takeChatRefresh(chatid, text) {

	prefix = chatPrefixes[chatid];
	//alert(prefix);
	oldtext = $("#"+prefix+"chatarea").html();
	newtext = oldtext + text;
	$("#"+prefix+"chatarea").html(newtext);
	chatarea = document.getElementById(prefix+"chatarea");
	chatarea.scrollTop = chatarea.scrollHeight;

}

function setChatLastId(chatid, lastid) {

	refreshVars["chat"+chatid+"last"] = lastid;

}

$(function() {
	// ready function
	//$("#chatform").bind("submit", chatSubmit);
	// CLEAR!
	//heartBeat(); --> this goes to common
	
});