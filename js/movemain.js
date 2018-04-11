var mX,mY, cmX, cmY, f= false;
onload = function() 
{ 
	drag("main");
 	document.onmousemove = function(e) { 
    	if(!e) e = event; 
	mX= e.clientX;
	mY= e.clientY;
	if(f== true)
	{
		var posX= mX-cmX;
		var posY= mY-cmY;
		var obj= document.getElementById("main").style;
		obj.marginTop= posY;
		obj.marginLeft= posX;
	}
  } 
}
function getmouse()
{
	var c= document.getElementById("main").getBoundingClientRect();
	cmX= mX-c.left;
	cmY= mY-c.top;
	f= true;
}
function breakmove()
{	
	f= false;
}
function drag(nm)
{
	document.getElementById(nm).addEventListener ("mousedown", getmouse, false);
	document.getElementById(nm).addEventListener ("mouseup", breakmove, false);
	document.getElementById(nm).style.cursor="move";
}