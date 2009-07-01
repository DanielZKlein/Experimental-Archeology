refreshes = new Array();
refreshVars = new Array(); // stuff that isn't a refresh by itself but that should be sent with refreshes. Ugh. This is ugly. REDO!
ajaxOpts = new Object();
ajaxOpts["login"] = myLogin;
ajaxOpts["pw"] = myPW;
ajaxOpts["ajax"] = "Malkovichmalkovich";
ajaxUrl = "index.php";
userRefresh = new Array(); // uR["Daniel"] = {"timestamp":"Sun Jun 14 15:15", "status":"online"} etc
ajaxNonPersistents = new Object(); // object fits better since we won't need to push. These are the NONPERSISTENTS. AjaxOpts that should be sent with every single call, always, without exceptions, should be defined directly as ajaxOpts; everything else goes in here.

waitingForRefresh = false; // so that submit flushes don't bother with refreshing at callback
				// Daniel, innocent question here: why would submit flushes even get a callback?

// So here's how I think Ajax calls should work. We assume a state of ajaxOpts where only the PERSISTENTS are in there. We need to add something to that with our call, of course, so here's what we do: we call a function that adds a key:value pair (or a bunch of them, through an object) (actually, let's always make it an object) to ajaxOpts and also to ajaxNonPers. We flush all the shit down the ajax sewers. And then we wipe: deleteNonPersistents. This means that all nonpersistents should live only for a short while. There is no need to keep a catalog of them.

function dbug(mytext) {

	oldtext = $("#tempdiv").html();
	newtext = mytext + "<br>" + oldtext;
	$("#tempdiv").html(newtext);

}

function shit(NPs) {

	// Adds non persistent variables both to ajaxOpts and to ajaxNonPersistents.
	// I couldn't resist the expressive function naming. Look for shit's friends "flush" and "wipe"

	for (np in NPs) {
		if (typeof ajaxOpts[np] != 'undefined') {
			continue; // do not overwrite persistents
		} else {
			ajaxNonPersistents[np] = NPs[np];
			ajaxOpts[np] = NPs[np];
		}
	}
}


function flush(cb) {

	if (cb === undefined) {
		$.post(ajaxUrl, ajaxOpts);
	} else {
		$.post(ajaxUrl, ajaxOpts, ajaxCallback);
	}
	wipe(); // always wipe

}

function wipe() {

	for (np in ajaxNonPersistents) {
		delete ajaxOpts[np];
	}
	ajaxNonPersistents = new Object();
	// nice and clean
}


function ajaxCallback(cb) {

	// back from PHP
	// eval the whole thing for greater satanism

	if (waitingForRefresh) {
		eval(cb);
		waitingForRefresh = false;
	} 
	
	setTimeout("heartBeat();", 200);
}



function heartBeat() {
	// Set all refreshes and send off the request
	poop = new Object();
	waitingForRefresh = true;
	for (index in refreshes) {
		refresh = refreshes[index];
		//alert(refresh);
		poop[refresh] = "x";
	}
	for (index in refreshVars) {
		poop[index] = refreshVars[index];
	}
	
	shit(poop);
	flush("callback");
}

function ocat(a) {

	// takes an array of integer indexed objects (can be arrays, I guess)
	// returns a single top level object with all properties of the subobjects
	// earlier instances take priority
	ro = new Object();
	first = true;
	for (index in a) {
		if (first) {
			ro = a[index];
			first = false;
		} else {
			for (bindex in a[index]) {
				if (typeof ro[bindex] == 'undefined') {
					ro[bindex] = a[index][bindex];
				}
			}
		}
	}

	return ro;
}

function objectDump(o) {

	// turns an object (or array) into a flat string representation
	rv = "{ ";
	first = true;
	for (i in o) {
		if (!first) {
			rv = rv + ", ";
		} else { 
			first = false;
		}
		
		rv = rv + i.toString() + " : ";
		
		if (typeof o[i] == 'Object') {
			rv = rv + objectDump(o[i]);
		} else {
			rv = rv + o[i];
		}
		
	}
	rv = rv + " }";
	return rv;

}

$(function() {
	heartBeat(); 
});
