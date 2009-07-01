modules = new Array();
refreshVars = new Array(); // stuff that isn't a refresh by itself but that should be sent with refreshes. Ugh. This is ugly. REDO!
ajaxOpts = new Object();
ajaxOpts["login"] = myLogin;
ajaxOpts["pw"] = myPW;
ajaxOpts["ajax"] = "x";
ajaxUrl = "index.php";
userRefresh = new Array(); // uR["Daniel"] = {"timestamp":"Sun Jun 14 15:15", "status":"online"} etc
ajaxNonPersistents = new Object(); // object fits better since we won't need to push. These are the NONPERSISTENTS. AjaxOpts that should be sent with every single call, always, without exceptions, should be defined directly as ajaxOpts; everything else goes in here.

waitingForRefresh = false; // so that submit flushes don't bother with refreshing at callback
				// Daniel, innocent question here: why would submit flushes even get a callback?

// So here's how I think Ajax calls should work. We assume a state of ajaxOpts where only the PERSISTENTS are in there. We need to add something to that with our call, of course, so here's what we do: we call a function that adds a key:value pair (or a bunch of them, through an object) (actually, let's always make it an object) to ajaxOpts and also to ajaxNonPers. We flush all the shit down the ajax sewers. And then we wipe: deleteNonPersistents. This means that all nonpersistents should live only for a short while. There is no need to keep a catalog of them.

stopItAlready = false; // set to true to stop ajax refreshes -- THIS IS FOR DEBUGGING ONLY. AJAX
						// calls should never be stopped in production

firstRun = true; // is this the very first time you send a refresh request out per Ajax? If so,
				 // mark all ajax modules involved as <modulename>firstcall (passed on to ajaxmodule.php)
						
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
		console.log("submit call");
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

function overwriteDiv(divid, html) {

	// not sure if I'm a huge fan of this function. Simply overwrites the html in a div with html
	// done as function just in case I want to add general things to this
	$("#"+divid).html(html);
}


function ajaxCallback(cb) {

	// back from PHP
	// eval the whole thing for greater satanism
	// php generates javascript function calls, like so:
	// takeChatRefresh('[03:22:10] <Daniel> Isn&#39;t this great?');
	// since all strings should be single quoted and all single quotes inside the strings
	// should be replaced by UTF8 entities, this SHOULD be safe. SHOULD.

	if (waitingForRefresh) {
		eval(cb);
		waitingForRefresh = false;
	} 
	
	setTimeout("heartBeat();", 200);
}



function heartBeat() {
	if (stopItAlready) { 
		return;
	}
	// Set all refreshes and send off the request
	poop = new Object();
	waitingForRefresh = true;
	for (index in modules) {
		module = modules[index];
		refresh = module + "Refresh";
		//alert(refresh);
		poop[refresh] = "x";
		if (firstRun) {
			ajaxname = module + "Ajax";
			ajaxOpts[ajaxname] = "x"; // this stays for good
			firstcall = module + "firstcall";
			poop[firstcall] = "x";
		}
	}
	for (index in refreshVars) {
		// these are session persistent vars that go into refresh calls only
		// currently only used to remember the last chat line received. 
		poop[index] = refreshVars[index];
	}
	
	shit(poop);
	flush("callback");
	firstRun = false; // it ran
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
	console.log("hier bin ich");
	$("#stopajaxbutton").bind("click", function (e) { console.log("Stopping ajax calls"); stopItAlready = true; });
	
});
