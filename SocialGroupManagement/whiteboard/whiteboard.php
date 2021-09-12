<?php
// reference the file containing the Whiteboard class
require_once('whiteboard.class.php');
// create a new Whiteboard instance
$wb = new Whiteboard();
// clear the whiteboard if it's too loaded
$wb->checkLoad();
// retrieve the parameters from the request
$mode = $_POST['mode'];
$session_id = $_POST['session_id'];
// if the client connects for the first time, we generate its session id
if($session_id == '')
$session_id = md5(uniqid());
// initialize the last known ID to 0
$last_id = 0;
// if the operation is DeleteAndRetrieve
if($mode == 'DeleteAndRetrieve')
// clear the whiteboard
$wb->clearWhiteboard();
// if the operation is SendAndRetrieve
elseif($mode == 'SendAndRetrieve')
{
// retrieve the new lines
$lines = $_POST['lines'];
// retrieve the id of the last line
$last_id = $_POST['last_id'];
// insert the new lines
$wb->insertLines($lines, $session_id);
}
// if the operation is Retrieve
elseif($mode == 'Retrieve')
{
// retrieve the id of the last line
$last_id = $_POST['last_id'];
}
// clear the output
if(ob_get_length()) ob_clean();
// headers are sent to prevent browsers from caching
header('Expires: Fri, 25 Dec 1980 00:00:00 GMT'); // time in the past
header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s') . 'GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type: text/xml');
// send the latest lines to client
echo $wb->getNewLines($last_id, $session_id);
?>