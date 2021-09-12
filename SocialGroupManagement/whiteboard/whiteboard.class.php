<?php
// load configuration file
require_once('config.php');
// load error handling file
require_once('error_handler.php');
// class handles server-side whiteboard support functionality
class Whiteboard
{
// database handler
private $mMysqli;
// define the maximum total length of all lines in the table
private $mMaxLoad = 3000;
/* constructor opens database connection */
function __construct()
{
$this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,
DB_DATABASE);
}
/* destructor, closes database connection */
function __destruct()
{
$this->mMysqli->close();
}
/*
The checkLoad method clears the whiteboard table if the total length
of all lines in it is bigger than the predefined value
*/
public function checkLoad()
{
// build the SQL query to get the total length of all lines
$check_load = 'SELECT SUM(length) total_length FROM whiteboard';
// execute the SQL query
$result = $this->mMysqli->query($check_load);
$row = $result->fetch_array(MYSQLI_ASSOC);
// if the total length of all lines exceeds the maximum total length
// we delete all the entries in the table
if($row['total_length'] > $this->mMaxLoad)
{
// clear the whiteboard
$this->clearWhiteboard();
// flag that we cleared the whiteboard
return true;
}
else
return false; // we didn't clear the whiteboard
}
/*
The insertLines method inserts new lines into the database
- $lines contains the lines as received by the server as a
string with separators
- $session_id contains the id of the client's session
*/
public function insertLines($lines, $session_id)
{
// check to see if there are new lines sent
if($lines)
{
// the lines are comma separated
$array_lines = explode(',', $lines);
// process each line
for($i=0; $i<count($array_lines); $i++)
{
// each line is received in the form:
// color:offsetx1:offsety1:offsetyx2:offsety2
list($color, $offsetx1, $offsety1, $offsetx2, $offsety2) =
explode(':', $array_lines[$i]);
// escape the input data
$color = $this->mMysqli->real_escape_string($color);
$offsetx1 = $this->mMysqli->real_escape_string($offsetx1);
$offsetx2 = $this->mMysqli->real_escape_string($offsetx2);
$offsety1 = $this->mMysqli->real_escape_string($offsety1);
$offsety2 = $this->mMysqli->real_escape_string($offsety2);
// build the SQL query to insert a new line
$insert_line = 'INSERT INTO whiteboard ' . '
(offsetx1, offsety1, offsetx2, offsety2, length, color, session_id) '
.'VALUES (' . $offsetx1 . ',' . $offsety1 . ',' . $offsetx2 . ','
. $offsety2 . ',' .
sqrt(pow(($offsetx1-$offsetx2), 2) + pow(($offsety1-$offsety2), 2))
. ',"'.$color. '","' . $session_id . '")';
// execute the SQL query
$this->mMysqli->query($insert_line);
}
}
}
/*
The getNewLines method returns the lines that appeared since the last
update
- $id contains the id of the last updated line
- $session_id contains the id of the client's session
*/
public function getNewLines($id, $session_id)
{
// escape the variable data
$id = $this->mMysqli->real_escape_string($id);
$session_id = $this->mMysqli->real_escape_string($session_id);
// retrieve the latest ID in the database
$last_id = $this->getLastId();
// build the SQL query to get the latest lines
$get_lines =
'SELECT whiteboard_id, color, offsetx1, offsety1, offsetx2, offsety2 '
. 'FROM whiteboard ' .
'WHERE whiteboard_id IN ' .
' (SELECT MAX(whiteboard_id) ' .
' FROM whiteboard ' .
' WHERE whiteboard_id> ' . $id .
' GROUP BY offsetx1, offsety1, offsetx2, offsety2) ' .
'AND session_id<>"' . $session_id . '" ' .
'ORDER BY whiteboard_id ASC';
// execute the SQL query
$result = $this->mMysqli->query($get_lines);
// build the XML response
$response = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
$response .= '<response>';
// get the last id in the database
$response .= '<last_id>' . $last_id . '</last_id>';
// send back the session id
$response .= '<session_id>' . $session_id . '</session_id>';
// retrieve all lines and send them back to the client
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
// get the details
$id = $row['whiteboard_id'];
$offsetx1 = $row['offsetx1'];
$offsety1 = $row['offsety1'];
$offsetx2 = $row['offsetx2'];
$offsety2 = $row['offsety2'];
$color = $row['color'];
// generate the XML element
$response .= '<id>' . $id . '</id>' .
'<color>' . $color . '</color>' .
'<offsetx1>' . $offsetx1 . '</offsetx1>' .
'<offsety1>' . $offsety1 . '</offsety1>' .
'<offsetx2>' . $offsetx2 . '</offsetx2>' .
'<offsety2>' . $offsety2 . '</offsety2>';
}
// close the database connection as soon as possible
$result->close();
// finish the XML response
$response .= '</response>';
// return the response
return $response;
}
/*
The clearWhiteboard method truncates the data table
*/
public function clearWhiteboard()
{
// build the SQL query to truncate the whiteboard table
$clear_wb = 'TRUNCATE TABLE whiteboard';
// execute the SQL query
$this->mMysqli->query($clear_wb);
}
/*
The getLastId method returns the most recent whiteboard_id
*/
private function getLastId()
{
// build the SQL query to retrieve the last id in the whiteboard table
$get_last_id = 'SELECT whiteboard_id ' .
'FROM whiteboard ' .
'ORDER BY whiteboard_id DESC ' .
'LIMIT 1';
// execute the SQL query
$result = $this->mMysqli->query($get_last_id);
// check to see if there are any results
if($result->num_rows > 0)
{
// fetch the row containing the result
$row = $result->fetch_array(MYSQLI_ASSOC);
// return the xml element
return $row['whiteboard_id'];
}
else
// there are no records in the database so we return 0 as the id
return '0';
}
//end class Whiteboard
}
?>