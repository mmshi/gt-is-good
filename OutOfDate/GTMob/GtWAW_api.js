/**
 * SCHEDULE
 */
function scheduleIndex() {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWschedule",
			context: document.body,
			success: function (data) {
				$('#WAWschedule_index').html(data);
			}
		}
	);
}

function scheduleGet() {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWschedule/1",
			context: document.body,
			success: function (data) {
				$('#WAWschedule_get').html(data);
			}
		}
	);
}

function schedulePost() {
	$.ajax( 
		{
			type: "POST",
			url: "../../GtWAW/api/WAWschedule",
			data: { 'loggedInUserID': '1', 
					'startDate': '2011-11-1 9:27:30', 
					'endDate': '2011-11-1 9:27:30',
					'alias': 'ScheduleAlias',
					'type': '30min'
				},
			context: document.body,
			success: function (data) {
				$('#WAWschedule_post').html(data);
			}
		}
	);
}

function schedulePut() {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWschedule",
			data: { 'scheduleID': '1',
					'loggedInUserID': '1', 
					'startDate': '2011-11-1 9:27:30', 
					'endDate': '2011-11-1 9:27:30',
					'alias': 'ScheduleAlias',
					'type': '30min'
			},
			context: document.body,
			header: { 'X-HTTP-Method-Override': 'POST' },
			type: "POST",
			success: function (data) {
				$('#WAWschedule_put').html(data);
			}
		}
	);
}

/**
 * GRID
 */
function gridGet() {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWgrid/WAWgrid_get",
			context: document.body,
			success: function (data) {
				$('#WAWgrid_get').html(data);
			}
		}
	);
}

function gridPost() {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWgrid",
			data: { 'loggedInUserID': '1', 
					'scheduleID': '1', 
					'data': 'aaaaaaaaaaaaaaaaaaaa',
					'comments': 'Call me if anything changes.'
			},
			context: document.body,
			type: 'POST',
			success: function (data) {
				$('#WAWgrid_post').html(data);
			}
		}
	);
}

function gridPut() {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWgrid",
			data: { 'gridID': '1', 
					'loggedInUserID': '1', 
					'scheduleID': '1', 
					'data': 'aaaaaaaaaaaaaaaaaaaa',
					'comments': 'Call me if anything changes.'
			},
			context: document.body,
			header: { 'X-HTTP-Method-Override': 'POST' },
			type: 'POST',
			success: function (data) {
				$('#WAWgrid_put').html(data);
			}
		}
	);
}

/**
 * USER
 */
function userGet() {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWuser/WAWuser_get",
			context: document.body,
			success: function (data) {
				$('#WAWuser_get').html(data);
			}
		}
	);
}

function userPost() {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWuser",
			data: { 'name': 'David', 
					'email': 'desposito7@gatech.edu', 
					'password': 'password',
					'pullDataFromTSquare': '0'
			},
			context: document.body,
			type: 'POST',
			success: function (data) {
				$('#WAWuser_post').html(data);
			}
		}
	);
}

function userPut() {
	$.ajax( 
		{
			url: "../../GtWAW/api/WAWuser",
			data: { 'loggedInUserID': '1', 
					'toEditUserID': '1', 
					'name': 'David', 
					'email': 'desposito7@gatech.edu', 
					'password': 'password',
					'pullDataFromTSquare': '0'
			},
			context: document.body,
			header: { 'X-HTTP-Method-Override': 'POST' },
			type: 'POST',
			success: function (data) {
				$('#WAWuser_put').html(data);
			}
		}
	);
}


function fillContents() {
	scheduleIndex();
	scheduleGet();
	schedulePost();
	schedulePut();
	
	gridGet();
	gridPost();
	gridPut();
	
	userGet();
	userPost();
	userPut();
	
}
