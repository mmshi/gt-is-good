// JavaScript Document

//var tdSettingTo = false;

var selectionStatus = 2;				// for SINGLE or STICKY selection
var timeStatus =  3;					//-1 = not initialized; 0 = bad time; 1 = ok time; 2 = good time 0 = Horrible, 1 = Bad, 2 = Ok, 3 = Awesome
var firstClick = true;

var r1 = -1;
var c1 = -1;


var mousePressed = false;


function applyTimeStatus(td){
	var sId;

	if(selectionStatus == 2){	
			alert("sticky running");
			alert("firstClick = " + firstClick);
			if(firstClick){
					alert("running firstClick");
				//----do sticky section here	
				sId = (td.id).split("_");
				r1 = sId[0];
				c1 = sId[1];
				
				//alert("r1 = " + r1);
			}
			if(!firstClick){
									alert("running NOT_firstClick");
				var r2;
				var c2;
				var cell;
				
				sId = (td.id).split("-");
				r2 = sId[0];
				c2 = sId[1];
	
				alert("r1, c1  = " + r1 + ", " + c1);
				alert("r2, c2  = " + r2 + ", " + c2);
				for( var r = r1; r <= r2; r++){														//---------------------NEED TO FIX  TO WORK FOR A BACKWARD SELECTION!!!!
					for( var c = c1; c <= c2; c++){
						var str = ''+r+'-'+c;
						alert("str " + str);
						//cell = getElementById(''+r+'-'+c);	
						cell = getElementById('0_0');	
						alert("please get here");
							alert("->-> (r,c) = " + r + ", " + c);
						if( timeStatus == 0){
										alert("-----trying to set H");
							setTimeStatusHorrible(cell);	
						}
						else if(timeStatus == 1){
										alert("-----trying to set B");
							setTimeStatusBad(cell);	
						}
						else if(timeStatus == 2){
										alert("-----trying to set G");
							setTimeStatusGood(cell);
						}
						else if(timeStatus == 3){
										alert("-----trying to set A");
							setTimeStatusAwesome(cell);	
						}
					}
				}
			}
	}
	else{
		//----do single selection here............DO NOT HAVE TO USE r1 and c1 vars
			//alert("single running - timeStatus = " + timeStatus);
			if( timeStatus == 0){
				setTimeStatusHorrible(td);	
			}
			else if(timeStatus == 1){
				setTimeStatusBad(td);	
			}
			else if(timeStatus == 2){
				setTimeStatusGood(td);
			}
			else if(timeStatus == 3){
				setTimeStatusAwesome(td);	
			}
	}
	firstClick = !firstClick; 
}



function isSet(td){
	return (td.className.indexOf("timeGood") > -1);
}


function mouseClick(td){
	// alert("td.id = " + td.id);		<-------- WHY DOESN"T THE INTERNET HAVE THIS...IT IS SOOOOO SIMPLE!!!!!
	//setTimeStatusAwesome(td)
} 

function mouseDown(td){
	//-----sets the boolean mousePressed flag to true. mousePressed is used in toggleTimeStatus(td)
	mousePressed = true;
	tdSettingTo = !isSet(td)
	mouseOver(td);
}

function mouseOver(td) {
	if (!mousePressed) return;												//rudamentry mouseDrag dection...code will only advance when mouse is dragged because of a mousePressed set with mounseDown() and mouseUp();
	if (td.className == "empty") return;
	if (tdSettingTo) {														//uses predefined boolean value to determine wheter this current click and drag is setting to...........ALSO IT B/C MOUSEOVER EVENT IS TRIGGERED WHEN MOUSE IS MOVED WITHIN AN ELEMENT, THIS WILL PREVENT IT FROM CONSTANTLY SWITCHING THE STATUS OF THE ELEMENT(timeGood, timeOK,...ect)
		setTimeStatusAwesome(td);
	}
	else {
		setTimeStatusHorrible(td);
	}
} 

function mouseUp(){
	mousePressed = false;	
}

				/*
					function onclick(event) {
						mouseDown(this);	
					}
					
					function onmousedown(td){
						mouseDown(td);
					}
				*/



/*
	function setTimeStatusGood(td){
		//if(!isSet(td)){
			  td.className = td.className.replace("weekdayColor", "timeGood");
		//}
	}
*/

function setSelectionStatus(intVal){
	firstClick = true;
	selectionStatus = intVal;	
}

function setTimeStatus(intVal){
	timeStatus = intVal;
}

function setTimeStatusUndef(td){
	if(isSet(td)){
		td.className = td.className.replace("timeGood", "weekdayColor");	
	}
}


function setTimeStatusAwesome(td){
	//if(!isSet(td)){
   		  td.className = "A";
 		  //document.td.className = "A";
	//}
}

function setTimeStatusGood(td){
	  td.className = "G";
}

function setTimeStatusBad(td){
	  td.className = "B";
}

function setTimeStatusHorrible(td){
	  td.className = "H";
}








function toggleTimeStatus(td){
	//-----ALL of this will just modify the part of the class name...
	//...by changing the class name and having preset values for background colors in a .css file it will change the background color.			
	//if(mousePressed){
		alert("toggleTimeStatusRunning");
		/*
			if(td.className.indexOf("weekdayColor") > -1){
				td.className = td.className.replace("weekdayColor", "timeGood");
			}
			else if(td.className.indexOf("timeGood") > -1){
				td.className = td.className.replace("timeGood", "weekdayColor");
			}
			else if(td.className.indexOf("timeGood") > -1){
					td.className = td.className.replace("timeGood", "timeOK");
			}
			else if(td.className.indexOf("timeOK") > -1){
					td.className = td.className.replace("timeOK", "weekdayColor");
			}
		*/
		
	//}
}

