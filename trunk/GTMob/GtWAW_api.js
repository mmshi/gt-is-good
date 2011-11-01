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
			url: "../../GtWAW/api/WAWschedule/WAWschedule_get",
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
			data: { 'loggedInUserID': 'loggedInUserID', 
					'startDate': 'startDate', 
					'endDate': 'endDate',
					'alias': 'alias',
					'type': 'type'
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
			data: { 'scheduleID': 'scheduleID',
					'loggedInUserID': '1', 
					'startDate': 'startDate', 
					'endDate': 'endDate',
					'alias': 'alias',
					'type': 'type'
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
			data: { 'loggedInUserID': 'loggedInUserID', 
					'scheduleID': 'scheduleID', 
					'data': 'data',
					'comments': 'comments'
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
			data: { 'gridID': 'gridID', 
					'loggedInUserID': 'loggedInUserID', 
					'scheduleID': 'scheduleID', 
					'data': 'data',
					'comments': 'comments'
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
			data: { 'name': 'name', 
					'email': 'email', 
					'password': 'password',
					'pullDataFromTSquare': 'pullDataFromTSquare'
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
			data: { 'loggedInUserID': 'loggedInUserID', 
					'toEditUserID': 'toEditUserID', 
					'name': 'name', 
					'email': 'email', 
					'password': 'password',
					'pullDataFromTSquare': 'pullDataFromTSquare'
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
