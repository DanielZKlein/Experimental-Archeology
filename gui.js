//testonetwo

// What I was doing: working on reDraw players. Currently thinking abthe PlayersPresent (icons present? artifacts etc) mechanic to establish the how manieth player icon we're rendering in redrawPlayers. Make sure .data works the way you think it does (this being jquery, it will), then finish redraw players. Figure out whether to bind the menu to player or city (going for player right now; might bind different menus to other players? Dunno. Attack would make sense, but adding Attack A and Attack B to the city-bound menu would work too I guess)

// Let's make fake mapdata and gamestate data maps to see what they might look like
// Cities: Id is in the array id obviously, then it's name, x, y, city type so far. We'll probably treat artifacts like players in that they're simply attached to a city by cityid
gamestate = new Object();

ajaxurl = "index.php";
redrawFrequency = 20; //ms between city/player redraws on mapscroll. Higher values mean better
					   //performance at the cost of less smooth visuals.	

CurrentlyMoving = "no";
ListOfMenuElements = [];
MapX = -195;
MapY = -420;
ViewportSizeX = 1024;
ViewportSizeY = 486;
// DISPLACEMENT of map. MapX = -400 means we've moved the map LEFT by 400 pixels, meaning that 0,0 on the viewport corresponds to 400,0 on the map.
// to get the viewport coordinate of any object on the map we only have to add MapX/MapY to RealX/RealY.



gamestate.characters = [];
// Name, city id, remaining action points

function buildMenus() {
	
	if (gamestate.therearenocommands) {
		//dbug("there are no commands");
		$("#endroundbutton").css("display", "none");
		return;
	}
	$("#endroundbutton").css("display", "block");
	//dbug("there are commands!");

	// step 1: build command lists per city
	// step 2: build div with ul for each city command box (bonus points if you find a way to display "no commands for this city!" on right click on a city without commands)
	
	n = gamestate.commands.length;

	canHasMenu = [];
	// index is city it's going to be bound to

	for (i = 0; i < n; i++) {

		thisCommand = gamestate.commands[i];
		thisCity = thisCommand['city'];
		if (typeof(canHasMenu[thisCity]) == "undefined") {
			canHasMenu[thisCity] = "invisible";
			$("<DIV>")
				.attr("id", "city"+thisCity.toString()+"menu")
				.appendTo("body");
			//menuDiv = $("#city"+thisCity.toString()+"menu");
			$("<ul>")
				.attr("id", "city"+thisCity.toString()+"ul")
				.appendTo("#city"+thisCity.toString()+"menu");
		}
		ListOfMenuElements.push("city"+thisCity.toString()+"menu");
		$("<li>")
			.attr("id", "li"+i.toString())
			.appendTo("#city"+thisCity.toString()+"ul");
		$("<a>")
			.attr("href", "#" + i.toString())
			.text(thisCommand['text'])
			.appendTo("#li"+i.toString());
	
	}
	
	n = canHasMenu.length;
	for (i = 0; i < n; i++) {
		
		if (!(typeof(canHasMenu[i]) == "undefined")) {
		
			//dbug("about to attach city"+i.toString()+"menu to its city.");
			$("#city"+i.toString()).toggleClass("cityactive").contextMenu({menu: "city"+i.toString()+"menu"}, takeCommand);
			addText("#comavailable", "<a href='javascript:scrollIntoView("+i.toString()+")'>"+gamestate.cities[i].name+"</a><br>");
			
			
		
		}
	
	}
	
}
function addText(element, text) {

	oldtext = $(element).html();
	newtext = oldtext + text;
	$(element).html(newtext);
	
}
function callback(data) {

	data = $.trim(data);
	if (data.substr(0, 5) == "ERROR") {
	
		alert(data);
		return;
	}
	eval(data);
	updateStatus(); 
	redrawCities(); 
	redrawPlayers(); //never call redrawPlayers without first calling redrawcities
	destroyAllMenus();
	buildMenus();
	showMe();
	

}
function endRound() {

	dbug("endround calling ajax");
	$.post(ajaxurl, {"login": myLogin, "pw":myPW, "command":"endround"}, callback);

}
function resetEverything() {

	return;
	$.post(ajaxurl, {"login": myLogin, "pw":myPW, "command":"reseteverything"}, callback);

}
function destroyAllMenus() {

	$("#comavailable").html("");
	$(".city").destroyContextMenu();
	$(".cityactive").toggleClass("cityactive");
	$.each(ListOfMenuElements, function () {
	
		$("#"+this).remove();
	
	});
	ListOfMenuElements = [];

}
function takeCommand(action, el, pos) {

	dbug("takeCommand calling AJAX");
	$.post(ajaxurl, {"login": myLogin, "pw":myPW, "command": 'docommand', "number": action}, callback);
	
}
function setupMapScroll() {

	$("#mapcontainer").mousedown(function() {
		CurrentlyMoving = "notquite";
		
	
		$("#mapcontainer").mousemove(function (e) {
			if (CurrentlyMoving == "no") {
				return;
			} else if (CurrentlyMoving == "notquite") {
				MouseX = e.clientX;
				MouseY = e.clientY;
				CurrentlyMoving = "almost";
			} else if (CurrentlyMoving == "almost") {
				tempdiff = Math.abs(MouseX - e.clientX) + Math.abs(MouseY - e.clientY);
				if (tempdiff > 5) {
					CurrentlyMoving = "yes";
					scrollRedraw();
				}
			} else {
				diffX = MouseX - e.clientX;
				diffY = MouseY - e.clientY;
				newMapX = MapX - diffX;
				if (newMapX > 0) {
					newMapX = -1;
				}
				newMapY = MapY - diffY;
				if (newMapY > 0) {
					newMapY = -1;
				}
				$("#mapcontainer").css("background-position", newMapX.toString() + "px " + newMapY.toString() + "px");
				MapX = newMapX;
				MapY = newMapY;
				MouseX = e.clientX;
				MouseY = e.clientY;
				

			}
		});
		$("body").mouseup(function () {
			$("#mapcontainer").mousemove(showCoord);
			CurrentlyMoving = "no";
			redrawCities();
			redrawPlayers();
		});
		$("body").mouseout(function () {
			CurrentlyMoving = "no";
			redrawCities();
			redrawPlayers();
		});

	});

}

function showCoord(e) {

	curX = e.clientX - MapX;
	curY = e.clientY - MapY;
	$("#coords").html("X: "+curX+"  -- Y: "+curY);

}

function scrollRedraw() {
	if (CurrentlyMoving == "yes") {
		redrawCities();
		redrawPlayers();
		setTimeout("scrollRedraw()", redrawFrequency);
		
	}
}

function redrawPlayers() {

// Draw each player icon next to the city he's in.

	n = gamestate.characters.length;
	for (i = 0; i < n; i++) {

		thisPlayer = gamestate.characters[i];
		cityId = thisPlayer['city'];
		thisCity = gamestate.cities[cityId];
		thisCityDiv = $("#city"+cityId.toString());
		thisPlayerDiv = $("#player"+i.toString());
		if (thisCityDiv.css("display") == "block") {
			RealX = thisCity['x'];
			RealY = thisCity['y'];
			ViewportX = RealX + MapX;
			ViewportY = RealY + MapY;
			RightEdge = ViewportX + thisCityDiv.width();
			BottomEdge = ViewportY + thisCityDiv.height();
			PlayerX = RightEdge + 10;
			PlayerY = ViewportY + (thisCity['iconsRendered'] * thisPlayerDiv.height());
			thisCity['iconsRendered'] = thisCity['iconsRendered'] + 1;
			//dbug("PlayerY is " + PlayerY.toString());
			thisPlayerDiv.css({"display":"block", "top":PlayerY.toString()+"px", "left":PlayerX.toString()+"px"});

		} else {
			thisPlayerDiv.css("display", "none");

			
		}
	}

}

function redrawCities() {

	// this function is a stand-in right now. The way I envision the map working in the long term is with the cities hardcoded into the map graphics. This function would then redraw player and artifact tokens based on what city they're in. We need to figure out a good way of arranging multiple player icons and artifacts icons next to a city. The cities should be spaced on the map in such a way that proximity alone will be sufficient to decide who is where.
	// MUCH LATER: I'm not so sure about this anymore. There's a lot of stuff that speaks FOR dynamic city placement. Like, this way it'll be much easier to change stuff on the fly (without having to recreate map graphics), the game might call for it anyway (event cards that flip a city's emotion type?), and if we do want to go with hot-swappable rule and or map sets lateron, this is what we need. So for now we'll keep everything dynamic.
	// NEVER call this function without following up with a redrawPlayers

	n = gamestate.cities.length;
	for (i = 0; i < n; i++) {

		thisCity = gamestate.cities[i];
		thisCityDiv = $("#city"+i.toString());
		RealX = thisCity['x'];
		RealY = thisCity['y'];
		ViewportX = RealX + MapX;
		ViewportY = RealY + MapY;
		RightEdge = ViewportX + thisCityDiv.width();
		BottomEdge = ViewportY + thisCityDiv.height();
		
		if (ViewportX > 0 && RightEdge < ViewportSizeX && ViewportY > 0 && BottomEdge < ViewportSizeY) {
			thisCityDiv.css({
				"display":"block",
				"left":ViewportX.toString()+"px",
				"top":ViewportY.toString()+"px"
			});
			thisCity['iconsRendered'] = 0;
		} else {
			thisCityDiv.css("display", "none");
			//dbug("RightEdge is " + RightEdge.toString());
		}
		
	
	}


}

function updateStatus() {

	$("#user").html(gamestate.username);
	$("#char").html(gamestate.charname);
	$("#dollar").html(gamestate.dollar);
	$("#ap").html(gamestate.ap);
	$("#curcity").html(gamestate.curcityname);
	$("#round").html(gamestate.round);
	$("#curchar").html(gamestate.curcharname);
	$("#curplayer").html(gamestate.curplayername);
	updateCards();


}

function updateCards() {

	cardHTML = "";

	for (index in gamestate.cards) {
		card = gamestate.cards[index];
		cardHTML = cardHTML + "<b>" + card.name + "</b>: " + card.description + "<br>";
	
	}
	$("#carddiv").html(cardHTML);
	

}

function initStuff() {

	updateStatus();
	n = gamestate.characters.length;
	for (i = 0; i < n; i++) {
		// I'm thinking we can do distinction between player1 player2 etc lateron through #player1 etc rules in the css.
		thisPlayer = gamestate.characters[i];
		$("<div>")
				.attr({"id":"player"+i.toString(), "title":thisPlayer['name']})
				.addClass("player")
				.css({
						"position":"absolute"
					})
				.appendTo("#mapcontainer");
	}
	
	n = gamestate.cities.length;
	for (i = 0; i < n; i++) {

		thisCity = gamestate.cities[i];
		
		$("<div>")
				.attr({"id":"city"+i.toString(), "title":thisCity['name']})
				.addClass("city")
				.css({
						"position":"absolute"
					})
				.appendTo("#mapcontainer");
	}
	$("#mapcontainer").mousemove(showCoord);


}

function pokeMap() {
	// poke!
	$("#mapcontainer").css("background-position", MapX.toString() + "px " + MapY.toString() + "px");
	redrawEverything();

}

function redrawEverything() {
	// if you also want to update the map, use pokeMap() instead
	redrawCities();
	redrawPlayers();


}
	
$(function() {
	// this is the ready function. It was born ready. getInitialGamestate will put out an ajax call, which in turn will call continueReady.
	//dbug("about to get init");
	getInitialGamestate();
	$("#endroundbutton").click(endRound);
	
});

function getInitialGamestate() {

	dbug("getinitialstate calling ajax");
	$.post(ajaxurl, {"login": myLogin, "pw":myPW, "command":"getInitialGamestate"}, continueReady);
	
	
}

function showMe() {

	scrollIntoView(gamestate.characters[gamestate.me].city);
	
}

function scrollIntoView(cityid) {

	dbug("scrolling to " +cityid.toString());
	adjustX = Math.round(ViewportSizeX / 2);
	adjustY = Math.round(ViewportSizeY / 2);
	cityX = gamestate.cities[cityid].x;
	cityY = gamestate.cities[cityid].y;
	MapX = (cityX - adjustX) * -1;
	MapY = (cityY - adjustY) * -1;
	//dbug("adjustY is " + adjustY.toString() + " and cityY is " + cityY.toString());
	if (MapX > 0) 
		MapX = 0;
	if (MapY > 0)
		MapY = 0;
	//dbug("new map coords are " + MapX.toString() + " and " + MapY.toString());
	pokeMap();
}

function continueReady(cbData) {

	//dbug(cbData);
	//dbug("in continue ready");
	eval(cbData); //god help us all
	//dbug("after eval");
	initStuff();
	//dbug("after init");
	setupMapScroll();
	//dbug("after mapscroll");
	buildMenus();
	//dbug("after menus");
	redrawCities();
	//dbug("after cities");
	redrawPlayers();
	showMe();
	//dbug("all done");
	
}
