// This script adds a userlist refresh to the ajaxopts and deals with the callback when it comes
// Note that calls from this script by themselves should not PING the user table. Only actual
// actions should cause a ping because otherwise a user just sitting on a page with a heartbeat
// would constantly show as offline. Or is this the behaviour we want? I guess not.

modules.push("Userlist");

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

