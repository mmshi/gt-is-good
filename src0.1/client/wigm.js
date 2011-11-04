// JavaScript Document

var selectionStatus1 = 1;	// 1 = SINGLE; 2 = STICKY
var selectionStatus2 = 1;	// 1 = SINGLE; 2 = STICKY
var selectionStatus3 = 1;	// 1 = SINGLE; 2 = STICKY
var timeStatus1 =  2;		// 0 = BAD, 1 = Bad, 2 = Good, 3 = GOOD
var timeStatus2 =  2;		// 0 = BAD, 1 = Bad, 2 = Good, 3 = GOOD
var timeStatus3 =  2;		// 0 = BAD, 1 = Bad, 2 = Good, 3 = GOOD
var firstClick = true;		// tracks first click, second click for sticky function

var r1 = -1;				// tracks first click (row) for sticky function
var c1 = -1;				// tracks first click (column) for sticky function
var t1 = -1;				// tracks frist click (table) for sticky function

var numOfRows = 0;

function setNumOfRows(num){
	
	numOfRows = num;
}

function applyTimeStatus(td){
	var sId;
	var r2;
	var c2;
	var t2;
	
	sId = (td.id).split("-");
	r2 = Number(sId[0]);
	c2 = Number(sId[1]);
	t2 = Number(sId[2]);

	if(  ((t2 ==1) && (selectionStatus1 == 2))  ||  ((t2 ==2) && (selectionStatus2 == 2))  ||   ((t2 ==3) && (selectionStatus3 == 2))  )  {
		if(firstClick){
			//----do sticky section here	
			sId = (td.id).split("-");
			r1 = Number(sId[0]);
			c1 = Number(sId[1]);
			t1 = Number(sId[2]);
			td.style.border = "solid 1px #000";
			td.style.fontWeight =  "bolder";	
		}
		if(!firstClick){
			var temp;
			var cell;
			
			cell = document.getElementById(""+r1+"-"+c1+"-"+t1);								//----get the first click cell
			cell.style.border = "solid 0px #000";
			cell.style.fontWeight =  "normal";
			
			if( t1 == t2){																							//Same table check
					//----this will allow revese slection (bottom right to top left)---JUST SWAPPING THE VARIABLES
					//FORCE THIS SHIT TO WORK USING NUMBERS
					//r1 = Number(r1);
					//r2 = Number(r2);
					if(r1 > r2){
						temp = r2;
						r2 = r1;
						r1 = temp;	
					} else {
					}
					if(c1 > c2){
						temp = c2;
						c2 = c1;
						c1 = temp;		
					}
					for( var r = r1; r <= r2; r++){														//---------------------NEED TO FIX  TO WORK FOR A BACKWARD SELECTION!!!!
						for( var c = c1; c <= c2; c++){
							//var str = ''+r+'-'+c;
							//cell = getElementById(''+r+'-'+c);	
							cell = document.getElementById(""+r+"-"+c+"-"+t2);								//need 'document.' becuse the getElementId need to know where to get the elemebyById from.
							//alert("cell.id = " + cell.id);
							setTimeStatus(cell, t2);
						}
					}
			}
		}
	}
	else{
		//----do single selection here............DO NOT HAVE TO USE r1 and c1 vars
		setTimeStatus(td,t2);
	}
	firstClick = !firstClick; 
}



function applyTimeStatusDay(td){
	var r2;
	var c2;
	var cell;
	var temp;
	var sId;

	sId = (td.id).split("-");
	//r2 = sId[0];
	var r = Number(numOfRows);
	var c = Number(sId[1]);
	var t = Number(sId[2]);
	for( var rIdx = 0; rIdx <= r; rIdx++){					
		cell = document.getElementById(""+rIdx+"-"+c+"-"+t);								//need 'document.' becuse the getElementId need to know where to get the elemebyById from.
		setTimeStatus(cell, t);
	}
}


function setSelectionStatus(ssn, intVal){
	if((r1 > -1) && (c1>-1)){
		var cell =document.getElementById(""+r1+"-"+c1+"-"+t1);
		cell.style.border = "solid 0px #000";
		cell.style.fontWeight =  "normal";	
		r1 = -1;
		c1 = -1;
		t1 = -1;
	}
	firstClick = true;
	if(ssn==1){
		selectionStatus1 = intVal;	
	}
	else if(ssn==2){
		selectionStatus2 = intVal;	;
	}
	else if(ssn==3){
		selectionStatus3 = intVal;	
	}
}



function setTimeStatus(td, table){
	/*
	alert("setTimeStatus running: table = " + table);
	alert("timeStatus1 = " + timeStatus1);
	alert("timeStatus2 = " + timeStatus2);
	alert("timeStatus3 = " + timeStatus3);
	*/
	if(table == 1){
			if( timeStatus1 == 0){
				setTimeStatusHorrible(td);	
			}
			else if(timeStatus1 == 1){
				setTimeStatusBad(td);	
			}
			else if(timeStatus1 == 2){
				setTimeStatusGood(td);
			}
			else if(timeStatus1 == 3){
				setTimeStatusAwesome(td);	
			}
	}
	else if(table == 2){
			//alert("setTimeStatus running: table = " + table);
			if( timeStatus2 == 0){
				setTimeStatusHorrible(td);	
			}
			else if(timeStatus2 == 1){
				setTimeStatusBad(td);	
			}
			else if(timeStatus2 == 2){
				setTimeStatusGood(td);
			}
			else if(timeStatus2 == 3){
				setTimeStatusAwesome(td);	
			}
	}
	else if(table == 3){
			//alert("setTimeStatus running: table = " + table);
			if( timeStatus3 == 0){
				setTimeStatusHorrible(td);	
			}
			else if(timeStatus3 == 1){
				setTimeStatusBad(td);	
			}
			else if(timeStatus3 == 2){
				setTimeStatusGood(td);
			}
			else if(timeStatus3 == 3){
				setTimeStatusAwesome(td);	
			}
	}				
}


function setTimeStatusAwesome(td){
	td.className = "A";
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

function generateString(tableNo) {
	var toRet = "";
	var td;
	
	for (var i=0; i<7; i++) {
		for(var j=0; j<24; j++) {
			td = document.getElementById("" + j + "-" + i + "-" + tableNo);
			toRet += td.className;
		}
	}
	
	alert(toRet);
	return toRet;
}

function applyString(str, tableNo) {
	var day=0;
	var hour=0;
	var td;
	
	for(var i=0; i<str.length; i++) {
		td = document.getElementById("" + hour + "-" + day + "-" + tableNo);
		if (td) {
			td.className = str.charAt(i);
			hour++;
			if (hour>23) {
				hour=0;
				day++;
			}
		} else {
			return;
		}
	}
}


	

$(document).ready(function(){	
	//This will respond to the EDIT SCHEDULE switch
	$('#selectionStatusFlip1').change(function() {									//$(....) = do jquery magic			'#<element id>'  = like getElementById
		var myswitch = $(this);
		var stickyOption  = myswitch[0].selectedIndex == 1 ? true:false;
		if(stickyOption){
		   setSelectionStatus(1,1);
		}else{
			setSelectionStatus(1,2);
		}
	});
});

$(document).ready(function(){
	//This will respond to the JOIN SCHEDULE switch
	$('#selectionStatusFlip2').change(function() {									//$(....) = do jquery magic			'#<element id>'  = like getElementById	
		var myswitch = $(this);
		var stickyOption  = myswitch[0].selectedIndex == 1 ? true:false;
		if(stickyOption){
		   setSelectionStatus(2,1);
		}else{
			setSelectionStatus(2,2);
		}
	});
});

$(document).ready(function(){
	//This will respond to the JOIN SCHEDULE switch
	$('#selectionStatusFlip3').change(function() {									//$(....) = do jquery magic			'#<element id>'  = like getElementById	
		var myswitch = $(this);
		var stickyOption  = myswitch[0].selectedIndex == 1 ? true:false;
		if(stickyOption){
		   setSelectionStatus(3,1);
		}else{
			setSelectionStatus(3,2);
		}
	});
});
$(document).ready(function(){
		//++++++++++++++++++++++++++++++++++++++ NOTE!!!! IF RADIO BUTTONS STOP WORKING ON 1ST CLICK, UNCOMMENT ALERTS, SAVE, RUN, COMMENT OUT ALERTS!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		//++++++++++++++++++++++++++++++++++++++ NOTE!!!! IF RADIO BUTTONS STOP WORKING ON 1ST CLICK, UNCOMMENT ALERTS, SAVE, RUN, COMMENT OUT ALERTS!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		//++++++++++++++++++++++++++++++++++++++ NOTE!!!! IF RADIO BUTTONS STOP WORKING ON 1ST CLICK, UNCOMMENT ALERTS, SAVE, RUN, COMMENT OUT ALERTS!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	$('#timeStatusButtonsEdit input:radio').change(function (event, ui){
		//alert("radio change");	
		//alert($(this).val());  / <----this shows value before change
		//alert($('input[name=radio-group-1]:checked').val());			//<----this shows the value after change
		var selection = $('input[name=radio-group-1]:checked').val();
		//alert("1-timeStatus3 = " + timeStatus
		if(selection == 'choice-0'){
				timeStatus1 = 0;
		}
		else if(selection == 'choice-1'){
				timeStatus1 = 1;
		}
		else if(selection == 'choice-2'){
				timeStatus1 = 2;
		}
		else if(selection == 'choice-3'){
				timeStatus1 = 3;
		}
		
	});
});

$(document).ready(function(){
	$('#timeStatusButtonsCreate input:radio').change(function (event, ui){
		//alert("radio change");	
		//alert($(this).val());  / <----this shows value before change
		//alert($('input[name=radio-group-1]:checked').val());			//<----this shows the value after change
		var selection = $('input[name=radio-group-1]:checked').val();
		if(selection == 'choice-0'){
				timeStatus2 = 0;
		}
		else if(selection == 'choice-1'){
				timeStatus2 = 1;
		}
		else if(selection == 'choice-2'){
				timeStatus2 = 2;
		}
		else if(selection == 'choice-3'){
				timeStatus2 = 3;
		}
		
	});
});


$(document).ready(function(){
		//++++++++++++++++++++++++++++++++++++++ NOTE!!!! IF RADIO BUTTONS STOP WORKING ON 1ST CLICK, UNCOMMENT ALERTS, SAVE, RUN, COMMENT OUT ALERTS!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		//++++++++++++++++++++++++++++++++++++++ NOTE!!!! IF RADIO BUTTONS STOP WORKING ON 1ST CLICK, UNCOMMENT ALERTS, SAVE, RUN, COMMENT OUT ALERTS!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		//++++++++++++++++++++++++++++++++++++++ NOTE!!!! IF RADIO BUTTONS STOP WORKING ON 1ST CLICK, UNCOMMENT ALERTS, SAVE, RUN, COMMENT OUT ALERTS!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	$('#timeStatusButtonsJoin input:radio').change(function (event, ui){
			//alert("radio change");	
			//alert($(this).val());  / <----this shows value before change
			//alert($('input[name=radio-group-1]:checked').val());			//<----this shows the value after change
			//alert("1-timeStatus3 = " + timeStatus3);
			var selection = $('input[name=radio-group-1]:checked').val();
			if(selection == 'choice-0'){
					timeStatus3 = 0;
				//	alert("SET timeStatus3 = " + timeStatus3);
			}
			else if(selection == 'choice-1'){
					timeStatus3 = 1;
					//alert("SET timeStatus3 = " + timeStatus3);
			}
			else if(selection == 'choice-2'){
					timeStatus3 = 2;
					//alert("SET timeStatus3 = " + timeStatus3);
			}
			else if(selection == 'choice-3'){
					timeStatus3 = 3;
					//alert("SET timeStatus3 = " + timeStatus3);
			}		
			//alert("2-timeStatus3 = " + timeStatus3);
			//alert("timeStatus1 = " + timeStatus1);
			//alert("timeStatus2 = " + timeStatus2);
	});
});

$('#resultsEditSlider1').change(function(){
	var thisSwitch = $(this);
	var show1 = thisSwitch[0].selectedIndex == 1? true:false;
	var show2 = thisSwitch[0].selectedIndex == 1? false:true;
	$('#resultTable').toggle(show1);
	$('#editResultTable').toggle(show2);
	
	/*
	if(show == true){
		//set resutls to show and hide edit schedule
		$('#resultTable').toggle(show);
	}
	else{
		//set hide to show and results edit schedule
		$('#editResultTable').toggle(show);
	}
	*/

	
	
});
