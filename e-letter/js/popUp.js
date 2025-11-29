// JavaScript Document

var arrNewPop = new Array();

function PopWindow(theUrl, theName, theWidth, theHeight) 
{
	var theAttributes = ''
	if(arguments[4]!=null) theAttributes = arguments[4]
	
	if (theUrl==null || theWidth==null || theHeight==null || theUrl.length==0 || theWidth.length==0 || theHeight.length==0)
		return false;

	var theLeft = Math.ceil((screen.width - 10 - theWidth) / 2);
	var theTop = Math.ceil((screen.height - 30 - theHeight) / 2);
		
	var varAttributes = "width="+theWidth+",height="+theHeight+",left="+theLeft+",top="+theTop;	
	
	if(theAttributes.length==0)
		varAttributes = varAttributes + ",toolbar=0,location=0,directories=0,status=0,menubar=-0,scrollbars=1,resizable=1";
	else
		varAttributes = varAttributes + "," + theAttributes;
	return window.open(theUrl, theName, varAttributes);		
}
