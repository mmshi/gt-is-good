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
			if(firstClick){
				//----do sticky section here	
				sId = (td.id).split("-");
				r1 = sId[0];
				c1 = sId[1];
				td.style.border = "solid 1px #000";
				td.style.fontWeight =  "bolder";
				
			}
			if(!firstClick){
				var r2;
				var c2;
				var cell;
				var temp;
				
				sId = (td.id).split("-");
				r2 = sId[0];
				c2 = sId[1];
				
				cell = document.getElementById(""+r1+"-"+c1);
				cell.style.border = "solid 0px #000";
				cell.style.fontWeight =  "normal";
				
				//----this will allow revese slection (bottom right to top left)---JUST SWAPPING THE VARIABLES
				if(r1>r2){
					t = r2;
					r2 = r1;
					r1 = t;	
				}
				if(c1 > c2){
					t = c2;
					c2 = c1;
					c1 = t;		
				}
	
				for( var r = r1; r <= r2; r++){														//---------------------NEED TO FIX  TO WORK FOR A BACKWARD SELECTION!!!!
					for( var c = c1; c <= c2; c++){
						var str = ''+r+'-'+c;
						//cell = getElementById(''+r+'-'+c);	
						cell = document.getElementById(""+r+"-"+c);								//need 'document.' becuse the getElementId need to know where to get the elemebyById from.
						if( timeStatus == 0){
							setTimeStatusHorrible(cell);	
						}
						else if(timeStatus == 1){
							setTimeStatusBad(cell);	
						}
						else if(timeStatus == 2){
							setTimeStatusGood(cell);
						}
						else if(timeStatus == 3){
							setTimeStatusAwesome(cell);	
						}
					}
				}
			}
	}
	else{
		//----do single selection here............DO NOT HAVE TO USE r1 and c1 vars
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
	if((r1 > -1) && (c1>-1)){
		var cell =document.getElementById(""+r1+"-"+c1);
		cell.style.border = "solid 0px #000";
		cell.style.fontWeight =  "normal";	
	}
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

