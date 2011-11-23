var searchedScheduleID = 0; //The Schedule ID searched for when joining a schedule

/**
 * SCHEDULE
 */
function getSchedulesForUser(id) {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWfrontDoor/" + id,
			context: document.body,
			success: function (data) {
				var arr = eval('('+data+')');
				if (arr.html) {
					$('#p_getSchedulesForUser').html(arr.html);
					$('#p_getSchedulesForUser').listview('refresh');
				} else 
					$('#p_getSchedulesForUser').html(printError(arr.error));
			}
		}
	);
}

function getEditStringById() {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWeditString/1_1",
			context: document.body,
			success: function (data) {
				var arr = eval('('+data+')');
				$('#p_getEditStringById').html(arr.html ? arr.html : printError(arr.error));
			}
		}
	);
}

function addEditString() {
	$.ajax( 
		{
			type: "POST",
			url: "../../GtWAW/api/WAWeditString",
			data: { 'userID': 'unused',
					'schID': ''+searchedScheduleID,
					'editStr': generateString(3), 
					'alias': 'unused'
				},
			context: document.body,
			success: function (data) {
				var arr = eval('('+data+')');
				if(arr.html) {
					$('#p_getSchedulesForUser').append(arr.html);
					$('#p_getSchedulesForUser').listview('refresh');
					$('#DIVinviteEdit').trigger("collapse");
					$('#DIVinviteEdit').hide();
					$('#DIVjoinASchedule').trigger("collapse");
					getResultsTable(searchedScheduleID);
				}
			}
		}
	);
}

function updateEditString() {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWeditString/1",
			data: { 'userID': '1', 
					'gridID': '1',
					'editStr': 'AAAAAAAAAAAAAAAAAAOOOOOOOOOOOOOOOOOAAAAAAAAA'
			},
			context: document.body,
			header: { 'X-HTTP-Method-Override': 'PUT' },
			type: "POST",
			success: function (data) {
				var arr = eval('('+data+')');
				$('#p_updateEditString').html(arr.html ? arr.html : printError(arr.error));
			}
		}
	);
}

function getResultsTable(id) {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWresultsTable/"+id,
			context: document.body,
			success: function (data) {
				var arr = eval('('+data+')');
				if (arr.html) {
					$('#p_getResultsTable').html(arr.html);
					$('#p_getSchedulesForUser').trigger('collapse');
					$('#DIVviewCurrent').trigger('expand');
				} // else	TODO
			}
		}
	);
}

function getIncompleteResultsTable() {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWresultsTable/1",
			data: { 'includedUsers': '1,2' // TODO
			},
			context: document.body,
			type: 'POST',
			success: function (data) {
				var arr = eval('('+data+')');
				$('#p_getIncompleteResultsTable').html(arr.html ? arr.html : printError(arr.error));
			}
		}
	);
}

function getScheduleById() {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWschedule/1",
			context: document.body,
			success: function (data) {
				var arr = eval('('+data+')');
				$('#p_getScheduleById').html(arr.html ? arr.html : printError(arr.error));
			}
		}
	);
}


/**
 * USER
 */
function addSchedule(userID, editStr, alias) {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWschedule",
			data: { 'userID': '' + userID, // TODO
					'editStr': editStr,
					'alias': alias
			},
			context: document.body,
			type: 'POST',
			success: function (data) {
				var arr = eval('('+data+')');
				if (arr.html) {
					clearCreateNewForm();
					$('#DIVcreateNewSchedule').trigger('collapse');
					$('#p_getSchedulesForUser').append(arr.html);
					$('#p_getSchedulesForUser').listview('refresh');
					$('#p_getSchedulesForUser').trigger('expand');
				} else {
					$('#p_addScheduleError').hmtl(printError(arr.error));
				}
			}
		}
	);
}

function getScheduleByAlias(aliasID) {
	$.ajax( 
		{
			beforeSend: function(xhr) {
				xhr.setRequestHeader('X-HTTP-Method-Override', 'PUT');
			},
			url: "../../GtWAW/api/WAWschedule",
			data: { 'alias': aliasID},
			context: document.body,
			header: { 'X-HTTP-Method-Override': 'PUT' },
			type: 'POST',
			success: function (data) {
				var arr = eval('('+data+')');
				if(arr.html) {
					$('#idSearchBox').val("");
					$('#nameSearchBox').val("");
					$("#DIVsearchSchedule").trigger("collapse");
					$('#p_getScheduleByAlias').html(arr.html ? arr.html : printError(arr.error));
					$("#DIVinviteEdit").show();
					$("#DIVinviteEdit").trigger("expand");
					searchedScheduleID = arr.id;
				} else {
					alert("Error: Schedule with ID and Name Not Found!");
				}
			}
		}
	);
}

function printError(str) {
	return "<div style='color:red;font-weight:bold;'>"+str+"</div>";
}

function fillContents() {	
	getSchedulesForUser();
	getEditStringById();
	addEditString();
	updateEditString();
	getResultsTable(1);
	getIncompleteResultsTable();
	getScheduleById();
	addSchedule(1, 'AAAAAAAAAAAAAAAA', 'New Alias');
	getScheduleByAlias();
}
