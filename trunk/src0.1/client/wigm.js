// JavaScript Document

var selectionStatus = 1;	// 1 = SINGLE; 2 = STICKY
var timeStatus =  2;		// 0 = BAD, 1 = Bad, 2 = Good, 3 = GOOD
var firstClick = true;		// tracks first click, second click for sticky function

var r1 = -1;				// tracks first click (row) for sticky functoin
var c1 = -1;				// tracks first click (column) for sticky functoin

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

$('#my-slider').change(function() {
    var myswitch = $(this);
    var show     = myswitch[0].selectedIndex == 1 ? true:false;
    
    if(show) {
        $('#show-me').fadeIn('slow');
    } else {
        $('#show-me').fadeOut('slow');
    }
});

$('#selectionStatusFlip').change(function() {
	alert('test');
    var myswitch = $(this);
    var stickyOption  = myswitch[0].selectedIndex == 1 ? true:false;
	if(stickyOption){
       setSelectionStatus(2);
	   alert('here2');
	}else{
		setSelectionStatus(1);
	}
});

