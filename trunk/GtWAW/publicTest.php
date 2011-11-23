<?php
include_once "GtWAWpublic.php";

echo "p_getSchedulesForUser<div style='border:1px solid #000'>";

//p_getSchedulesForUser($userID)
p_getSchedulesForUser(1);

echo "</div><br />p_getEditStringById<div style='border:1px solid #000'>";

// p_getEditStringById($gridID, $schID)
// TODO
p_getEditStringById(1, 1);

echo "</div><br />p_addEditString<div style='border:1px solid #000'>";

//p_addEditString($userID, $schID, $editStr, $alias)
p_addEditString(1, 1, "AAAAAAAAAAAAAAAAAABBBBBBBBBBBBBBBBBAAAAAAAAA", "My New Schedule");

echo "</div><br />p_updateEditString<div style='border:1px solid #000'>";

//p_updateEditString($gridID, $userID, $editStr)
p_updateEditString(1, 1, "AAAAAAAAAAAAAAAAAAOOOOOOOOOOOOOOOOOAAAAAAAAA");

echo "</div><br />p_getResultsTable<div style='border:1px solid #000'>";

//p_getResultsTable($schID)
p_getResultsTable(1);

echo "</div><br />p_getIncompleteResultsTable<div style='border:1px solid #000'>";

//p_getIncompleteResultsTable($schID, $includedUsers)
p_getIncompleteResultsTable(1, '1,2');

echo "</div><br />p_getScheduleById<div style='border:1px solid #000'>";

//p_getScheduleById($schID)
p_getScheduleById(1);

echo "</div><br />p_addSchedule<div style='border:1px solid #000'>";

//p_addSchedule($userID, $editStr, $alias)
p_addSchedule(1, "AAAAAAAAAAAAAAAAAAOOOOOOOOOOOOOOOOOHHHHHHHHH", "My New Schedule");

echo "</div><br />p_getScheduleByAlias<div style='border:1px solid #000'>";

//p_getScheduleByAlias($alias)
p_getScheduleByAlias("My New Schedule");

echo "</div><br />";



?>