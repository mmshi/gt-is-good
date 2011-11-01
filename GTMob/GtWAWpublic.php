<?php

	function scheduleIndex() {
		// TODO
		echo 'scheduleIndex()\n';
	}

	function scheduleList($id) {
		// TODO
		echo 'scheduleList($id)\n';
	}

	function scheduleAddNew($loggedInUserID, $startDate, $endDate, $alias, $type) {
		// TODO
		echo 'scheduleAddNew($loggedInUserID, $startDate, $endDate, $alias, $type)\n';
	}

	function scheduleUpdate($scheduleID, $loggedInUserID, $startDate, $endDate, $alias, $type) {
		// TODO
		echo 'scheduleUpdate($scheduleID, $loggedInUserID, $startDate, $endDate, $alias, $type)\n';
	}

	function gridRetrieve($gridID) {
		// TODO
		echo 'gridRetrieve($gridID)\n';
	}

	function gridAddNew($loggedInUserID, $scheduleID, $data, $comments) {
		// TODO
		echo 'gridAddNew($loggedInUserID, $scheduleID, $data, $comments)\n';
	}

	function gridUpdate($gridID, $loggedInUserID, $scheduleID, $data, $comments) {
		// TODO
		echo 'gridUpdate($gridID, $loggedInUserID, $scheduleID, $data, $comments)\n';
	}

	function gridDelete($gridID, $loggedInUserID, $scheduleID) {
		// TODO
		echo 'gridDelete($gridID, $loggedInUserID, $scheduleID)\n';
	}

	function userGetByCredentials($credentials) {
		// TODO
		echo 'userGetByCredentials($credentials)\n';
	}

	function userAddNew($name, $email, $password, $pullDataFromTSquare) {
		// TODO
		echo 'userAddNew($name, $email, $password, $pullDataFromTSquare)\n';
	}

	function userUpdate($loggedInUserID, $toEditUserID, $name, $email, $password) {
		// TODO
		echo 'userUpdate($loggedInUserID, $toEditUserID, $name, $email, $password)\n';
	}
?>