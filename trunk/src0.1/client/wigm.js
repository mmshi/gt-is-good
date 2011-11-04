// JavaScript Document

var selectionStatus1 = 1;	// 1 = SINGLE; 2 = STICKY
var selectionStatus2 = 1;	// 1 = SINGLE; 2 = STICKY
var timeStatus1 =  2;		// 0 = BAD, 1 = Bad, 2 = Good, 3 = GOOD
var timeStatus2 =  2;		// 0 = BAD, 1 = Bad, 2 = Good, 3 = GOOD
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
	r2 = sId[0];
	c2 = sId[1];
	t2 = sId[2];

	if( (((t2 ==1) && (selectionStatus1 == 2))  ||  (((t2 ==2) && (selectionStatus2 == 2)))) )  {
		if(firstClick){
			//----do sticky section here	
			sId = (td.id).split("-");
			r1 = sId[0];
			c1 = sId[1];
			t1 = sId[2];
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
					if(r1>r2){
						temp = r2;
						r2 = r1;
						r1 = temp;	
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



function setTimeStatus(td, table){
	if(table == 1){
			//alert("setTimeStatus running: table = " + table);
			if( timeStatus1 == 0){
				setTimeStatusHorrible();	
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
}



function applyTimeStatusDay(td){
	var r2;
	var c2;
	var cell;
	var temp;
	var sId;

	sId = (td.id).split("-");
	//r2 = sId[0];
	var r = numOfRows;
	var c = sId[1];
	var t = sId[2];
	for( var rIdx = 0; rIdx <= r; rIdx++){					
		var str = ''+rIdx+'-'+c;
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
		// alert("ssn1 = " + intVal);
	}
	else if(ssn==2){
		selectionStatus2 = intVal;	
		// alert("ssn2 = " + intVal);
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
	$('#timeStatusButtonsEdit input:radio').change(function (event, ui){
		//alert("radio change");	
		//alert($(this).val());  / <----this shows value before change
		//alert($('input[name=radio-group-1]:checked').val());			//<----this shows the value after change
		var selection = $('input[name=radio-group-1]:checked').val();
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
	$('#timeStatusButtonsJoin input:radio').change(function (event, ui){
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

