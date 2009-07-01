// This script adds a userlist refresh to the ajaxopts and deals with the callback when it comes
// Note that calls from this script by themselves should not PING the user table. Only actual
// actions should cause a ping because otherwise a user just sitting on a page with a heartbeat
// would constantly show as offline. Or is this the behaviour we want? I guess not.

refreshes.push("UserRefresh");
ajaxOpts["userajax"] = "yes";


function setUser(id, name, status, timestamp) {

	createUserIfNotExist(id);
	$("#user"+id.toString()).attr("class", status).attr("title", timestamp).text(name);
	
}

function createUserIfNotExist(id) {

	user = $("#user"+id.toString());
	if (user.length == 0) {
		//alert(id.toString() + "does not exist");
		$("<div>").attr("id", "user"+id.toString()).appendTo("#users");
	}

}

function takeUserListRefresh() {

	if (userRefresh.length == 0) {
		return;
	}
	alert('userrefresh.');
	// at this point we must be confident that there is new userRefresh data in the array
	for (user in userRefresh) {
		alert(user);
		$("<div>").addClass(userRefresh[user]["status"]).attr("title", userRefresh[user]["timestamp"]).text(user).appendTo("#users");
	
	}
	userRefresh = new Array(); // emptied

}
