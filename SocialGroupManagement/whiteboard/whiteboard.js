// JavaScript Document
/* URL to the page that updates the whiteboard */
var whiteboardURL = "whiteboard.php";
/* URL to the page that retrieves the requested RGB color of a point */
var getColorURL = "get_color.php";
/* mouse coordinates in page */
var mouseX = 0;
var mouseY = 0;
/* flag that indicates if the user has pressed the mouse (drawing) */
var isDrawing = false;
/* flag that specifies if the clear button has been pressed */
var isWhiteboardErased = false;
/* the id of the last line drawn as a server update in the client's
whiteboard*/
var lastDrawnLineId = 0;
/* the id in the server's database of the last line received as update */
var lastDbLineId = 0;
/* the id of the session as generated at the first request to the server
*/
var sessionId = "";
/* the array containing the updated lines */
var wbUpdatedLinesArray;
/* the number of lines in the wbUpdatedLinesArray */
var linesCount = 0;
/* the whiteboard object */
var oWhiteboard;
/* the control containing the RGB color */
var oColor;
/* whiteboard's position and dimensions */
var wbOffsetLeft;
var wbOffsetTop;
var wbOffsetWidth;
var wbOffsetHeight;
/* the RGB code of the current color */
var currentColor = "#000000";
/* when set to true, display detailed error messages */
var debugMode = true;
/* the status message object */
var oStatus;
/* the onload event is overwritten by our init function */
window.onload = init;
/* the start point offset coordinates for a line */
var lineStartPointOffsetX=0;
var lineStartPointOffsetY=0;
/* the XMLHttpRequest object used to send and retrieve updated lines */
var xmlHttpUpdateWhiteboard= createXmlHttpRequestObject();
/* the XMLHttpRequest object to retrieve the selected color */
var xmlHttpGetColor = createXmlHttpRequestObject();
/* creates an XMLHttpRequest instance */
function createXmlHttpRequestObject()
{
// will store the reference to the XMLHttpRequest object
var xmlHttp;
// this should work for all browsers except IE6 and older
try
{
// try to create XMLHttpRequest object
xmlHttp = new XMLHttpRequest();
}
catch(e)
{
// assume IE6 or older
var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
"MSXML2.XMLHTTP.5.0",
"MSXML2.XMLHTTP.4.0",
"MSXML2.XMLHTTP.3.0",
"MSXML2.XMLHTTP",
"Microsoft.XMLHTTP");
// try every prog id until one works
for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++)
{
try
{
// try to create XMLHttpRequest object
xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
}
catch (e) {}
}
}
// return the created object or display an error message
if (!xmlHttp)
alert("Error creating the XMLHttpRequest object.");
else
return xmlHttp;
}
/*
function that shows the status of the whiteboard
*/
function showStatus(message)
{
// update the status message
oStatus.innerHTML = message;
oStatus.style.visibility = "visible";
}
/*
function that draws a line using the Bresenham algorithm
*/
function lineBresenham(x0, y0, x1, y1,color)
{
var dy = y1 - y0;
var dx = x1 - x0;
var stepx, stepy;
if (dy < 0)
{
dy = -dy;
stepy = -1;
}
else
{
stepy = 1;
}
if (dx < 0)
{
dx = -dx;
stepx = -1;
}
else
{
stepx = 1;
}
dy <<= 1;
dx <<= 1;
createPoint(x0, y0,color);
if (dx > dy)
{
fraction = dy - (dx >> 1);
while (x0 != x1)
{
if (fraction >= 0)
{
y0 += stepy;
fraction -= dx;
}
x0 += stepx;
fraction += dy;
if(isInWhiteboard(x0,y0))
createPoint(x0, y0,color);
else
return;
}
}
else
{
fraction = dx - (dy >> 1);
while (y0 != y1)
{
if (fraction >= 0)
{
x0 += stepx;
fraction -= dy;
}
y0 += stepy;
fraction += dx;
if(isInWhiteboard(x0, y0))
createPoint(x0, y0,color);
else
return;
}
}
}
/*
function that checks if a point is within the whiteboard's boundaries
*/
function isInWhiteboard(x,y)
{
return (x < wbOffsetWidth-1 && x > 1 && y < wbOffsetHeight-1 && y > 1);
}
/*
function that handles the mouseout event
*/
function handleMouseOut(e)
{
// get mouse coordinates
getMouseXY(e);
// compute the current point's offset coordinates
lineStopPointOffsetX = mouseX - wbOffsetLeft;
lineStopPointOffsetY = mouseY - wbOffsetTop;
// check to see if the event occurs in the whiteboard
// when the mouse is over other divs
if(isInWhiteboard(lineStopPointOffsetX, lineStopPointOffsetY))
return;
// check to see if we are drawing
if(isDrawing == true)
{
// reset the drawing flag
isDrawing = false;
// draw the line by clipping it to the whiteboard's boundaries
lineBresenham(lineStartPointOffsetX, lineStartPointOffsetY,
lineStopPointOffsetX, lineStopPointOffsetY,
currentColor);
// add the line
addLine(lineStartPointOffsetX, lineStartPointOffsetY,
lineStopPointOffsetX, lineStopPointOffsetY,
currentColor);
// the start point of the new line is the stop point of the last line
lineStartPointOffsetX = lineStopPointOffsetX;
lineStartPointOffsetY = lineStopPointOffsetY;
}
}
/*
function for handling the mousedown event
*/
function handleMouseDown(e)
{
// set the flag for drawing
isDrawing = true;
// retrieve the event object
if(!e) e = window.event;
// get mouse coordinates
getMouseXY(e);
//set the start point's offset coordinates for the new line
lineStartPointOffsetX = mouseX - oWhiteboard.offsetLeft;
lineStartPointOffsetY = mouseY - oWhiteboard.offsetTop;
}
/*
function for handling the mouseup event
*/
function handleMouseUp(e)
{
// set the flag for drawing
isDrawing = false;
// retrieve the event object
if(!e) e = window.event;
// get mouse coordinates
getMouseXY(e);
// set the stop point for the line
lineStopPointOffsetX = mouseX - oWhiteboard.offsetLeft;
lineStopPointOffsetY = mouseY - oWhiteboard.offsetTop;
// draw the current line
lineBresenham(lineStartPointOffsetX, lineStartPointOffsetY,
lineStopPointOffsetX, lineStopPointOffsetY, currentColor);
// add the current line
addLine(lineStartPointOffsetX, lineStartPointOffsetY,
lineStopPointOffsetX, lineStopPointOffsetY, currentColor);
}
/*
the function handles the mousemove event inside the whiteboard
*/
function handleMouseMove(e)
{
// check to see if we are drawing
if(isDrawing)
{
// retrieve the event object
if(!e) e = window.event;
// retrieve the mouse coordinates
getMouseXY(e);
// set the stop point's offset coordinates for the current line
lineStopPointOffsetX = mouseX - oWhiteboard.offsetLeft;
lineStopPointOffsetY = mouseY - oWhiteboard.offsetTop;
// draw the current line
lineBresenham(lineStartPointOffsetX, lineStartPointOffsetY,
lineStopPointOffsetX, lineStopPointOffsetY, currentColor);
// add the line to the array of lines
addLine(lineStartPointOffsetX,lineStartPointOffsetY,
lineStopPointOffsetX,lineStopPointOffsetY,currentColor);
// set the start point's offset coordinates as
// the current stop point's offset coordinates
lineStartPointOffsetX=lineStopPointOffsetX;
lineStartPointOffsetY=lineStopPointOffsetY;
}
}
/*
the function adds a line to the array of drawn lines
*/
function addLine(offsetX1, offsetY1, offsetX2, offsetY2, color)
{
var newLine = color.substring(1,7) + ":" + offsetX1 + ":" +
offsetY1 + ":" + offsetX2 + ":" + offsetY2;
wbUpdatedLinesArray[linesCount++] = newLine;
}
/*
function that draws a point on the whiteboard
*/
function createPoint(offsetX, offsetY, color)
{
// create a new div for the point
oDiv = document.createElement("div");
// set the attributes
oDiv.className = "simple";
// set its color
if(color == "")
newColor = currentColor;
else
newColor = color;
// change color
oDivStyle = oDiv.style;
oDivStyle.backgroundColor = newColor;
// set its position
oDivStyle.left = offsetX + "px";
oDivStyle.top = offsetY + "px";
// add the point to the whiteboard
oWhiteboard.appendChild(oDiv);
}
/*
function that initiates the whiteboard
*/
function init()
{
// initiate the whiteboard, color and status objects
oWhiteboard = document.getElementById("whiteboard");
oColor = document.getElementById("color");
oStatus= document.getElementById("status");
// retrieve whiteboard dimensions and position
wbOffsetWidth = oWhiteboard.offsetWidth;
wbOffsetHeight = oWhiteboard.offsetHeight;
wbOffsetLeft = oWhiteboard.offsetLeft;
wbOffsetTop = oWhiteboard.offsetTop;
// initialize the array of updated lines and the new lines count
wbUpdatedLinesArray = new Array();
linesCount = 0;
// handle events
oWhiteboard.setAttribute("onmousedown", "handleMouseDown(event);");
oWhiteboard.setAttribute("onmouseup", "handleMouseUp(event);");
if(oWhiteboard.onmousedown)
{
oWhiteboard.onmousedown=handleMouseDown;
oWhiteboard.onmouseup=handleMouseUp;
}
// start updating the whiteboard
updateWhiteboard();
}
/*
function that clears the whiteboard
*/
function clearWhiteboard()
{
// shows clearing status
showStatus("Clearing...");
// clear variables
lastDrawnLineId = 0;
linesCount = 0;
isWhiteboardErased = true;
// delete all whiteboard's nodes
while(oWhiteboard.hasChildNodes())
oWhiteboard.removeChild(oWhiteboard.lastChild);
}
/*
the function sends the updated lines to the server
*/
function updateWhiteboard()
{
// continue only if we have a XMLHttpRequest object to work with
if(xmlHttpUpdateWhiteboard)
{
try
{
// let the user know what happens
showStatus("Updating...");
// continue only if the XMLHttpRequest object isn't busy
if (xmlHttpUpdateWhiteboard.readyState == 4 ||
xmlHttpUpdateWhiteboard.readyState == 0)
{
// we build the request's parameters
params = "";
// check to see if we erased the whiteboard
if(isWhiteboardErased == true)
{
params += "session_id=" + sessionId + "&mode=DeleteAndRetrieve";
isWhiteboardErased = false;
}
else
{
// check to see we have lines to send
if(linesCount > 0)
{
// build the params string
params="session_id=" + sessionId +
"&mode=SendAndRetrieve" +
"&last_id=" + lastDrawnLineId +
"&lines=";
// add all lines as parameters
for(i=0; i<linesCount; i++)
{
params += wbUpdatedLinesArray[i];
params += (i < linesCount-1) ? "," : "";
}
// reset the new lines count to 0
linesCount=0;
}
else
{
// no lines to send
params="session_id=" + sessionId +
"&mode=Retrieve&" +
"last_id=" + lastDrawnLineId;
}
}
// initiate the request
xmlHttpUpdateWhiteboard.open("POST", whiteboardURL, true);
xmlHttpUpdateWhiteboard.setRequestHeader("Content-Type",
"application/x-www-form-urlencoded");
xmlHttpUpdateWhiteboard.onreadystatechange =
handleUpdatingWhiteboard;
xmlHttpUpdateWhiteboard.send(params);
}
// if the XMLHttpRequest object is busy with another request,
// try again later
else
{
// we will check again in 1 second
setTimeout("updateWhiteboard();", 1000);
}
}
catch(e)
{
alert("Can't connect to server:\n" + e.toString());
}
}
else
{
alert("The XMLHttpRequest object is null !");
}
}
/*
function that handles the server's response to the whiteboard update
*/
function handleUpdatingWhiteboard()
{
//if the request is completed
if (xmlHttpUpdateWhiteboard.readyState == 4)
{
//if the HTTP response is ok
if (xmlHttpUpdateWhiteboard.status == 200)
{
try
{
// process the server's response
displayUpdates();
}
catch(e)
{
// display the error message
alert("Error updating the whiteboard: \n" + e.toString() + "\n" +
xmlHttpUpdateWhiteboard.responseText);
}
}
else
{
alert("There was a problem when updating the whiteboard :\n" +
xmlHttpUpdateWhiteboard.statusText);
}
}
}
/*
display the new lines retrieved from the server
*/
function displayUpdates()
{
// retrieve the response in text format to check if it's an error
response = xmlHttpUpdateWhiteboard.responseText;
// server error?
if (response.indexOf("ERRNO") >= 0
|| response.indexOf("error:") >= 0
|| response.length == 0)
throw(response.length == 0 ? "Can't update the whiteboard!" :
response);
// update the status message
showStatus("Drawing...");
// retrieve the document element
response = xmlHttpUpdateWhiteboard.responseXML.documentElement;
// we retrieve from the XML response the parameters
sessionId =response.getElementsByTagName("session_id").item(0).firstChild.data;
newLastDbLineId =
parseInt(response.getElementsByTagName("last_id").item(0).
firstChild.data);
// if the whiteboard has been cleared by another client
// we need to clear our own whiteabord
if(newLastDbLineId < lastDbLineId)
{
clearWhiteboard(oWhiteboard);
isWhiteboardErased = false;
}
else
// if new lines have been drawn by others we should also draw them
if(newLastDbLineId>lastDbLineId)
{
// retrieve the lines' parameters
idArray= response.getElementsByTagName("id");
colorArray= response.getElementsByTagName("color");
offsetX1Array= response.getElementsByTagName("offsetx1");
offsetY1Array=response.getElementsByTagName("offsety1");
offsetX2Array= response.getElementsByTagName("offsetx2");
offsetY2Array=response.getElementsByTagName("offsety2");
// draw the new lines
if(idArray.length>0)
updateLines(idArray,colorArray,offsetX1Array,offsetY1Array,
offsetX2Array,offsetY2Array);
}
// keep the id of the last line in the database
lastDbLineId = newLastDbLineId;
// update status message
showStatus("Idle");
// restart sequence after 1 second
setTimeout("updateWhiteboard();", 1000);
}
// function that draws the lines retrieved from the server
function updateLines(idArray, colorArray, offsetX1Array, offsetY1Array,
offsetX2Array, offsetY2Array)
{
// we process all the lines
for(var i=0; i<idArray.length; i++)
{
// draw the line
lineBresenham(parseInt(offsetX1Array[i].firstChild.data),
parseInt(offsetY1Array[i].firstChild.data),
parseInt(offsetX2Array[i].firstChild.data),
parseInt(offsetY2Array[i].firstChild.data),
"#"+colorArray[i].firstChild.data);
}
// we set the lastDrawnLineId to the value of the id of
// the last line retrieved from the server
lastDrawnLineId=idArray[i-1].firstChild.data;
}
/*
function that computes the mouse coordinates relative to the palette
and calls the server to retrieve the RGB code
*/
function getColor(e)
{
// gets current mouse position
getMouseXY(e);
// initialize the offset position with
// the mouse's current position in window
var offsetX = mouseX;
var offsetY = mouseY;
var oPalette=document.getElementById("palette");
var oTd=document.getElementById("colorpicker");
// compute the offset position in our window
if (window.ActiveXObject)
{
offsetX = window.event.offsetX;
offsetY = window.event.offsetY;
}
else
{
offsetX -= oPalette.offsetLeft+oTd.offsetLeft;
offsetY -= oPalette.offsetTop+oTd.offsetTop;
}
// continue only if we have valid XMLHttpRequest object
if(xmlHttpGetColor)
{
try
{
if (xmlHttpGetColor.readyState == 4 || xmlHttpGetColor.readyState == 0)
{
params="?offsetx="+offsetX+"&offsety="+offsetY;
xmlHttpGetColor.open("GET",getColorURL+params, true);
xmlHttpGetColor.onreadystatechange = handleGettingColor;
xmlHttpGetColor.send(null);
}
}
catch(e)
{
alert("Can't connect to server:\n" + e.toString());
}
}
}
/* function that handles the http response */
function handleGettingColor()
{
// if the process is completed, decide what to do with the returned data
if (xmlHttpGetColor.readyState == 4)
{
// only if HTTP status is "OK"
if (xmlHttpGetColor.status == 200)
{
try
{
//change the color
changeColor();
}
catch(e)
{
// display the error message
alert(e.toString() + "\n" + xmlHttpGetColor.responseText);
}
}
else
{
alert("There was a problem retrieving the color:\n" +
xmlHttpGetColor.statusText);
}
}
}
/* function that changes the color used for displaying our messages */
function changeColor()
{
response=xmlHttpGetColor.responseText;
// server error?
if (response.indexOf("ERRNO") >= 0
|| response.indexOf("error:") >= 0
|| response.length == 0)
throw(response.length == 0 ? "Can't change color!" : response);
// change color
var oSampleText=document.getElementById("sampleText");
oColor.value=response;
oSampleText.style.color=response;
currentColor = "#" + oColor.value.substring(1,7);
}
/* function that computes the mouse's coordinates in page */
function getMouseXY(e)
{
if(document.all)
{
mouseX = window.event.x + document.body.scrollLeft;
mouseY = window.event.y + document.body.scrollTop;
}
else
{
mouseX = e.pageX;
mouseY = e.pageY;
}
}