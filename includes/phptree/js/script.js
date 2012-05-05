function Highlight(span)
{	if(span.className!="regular")	   return;	span.className="highlighted";}function Lowlight(span)
{	if(span.className!="highlighted")	   return;	span.className="regular";}
 function __TreeMenuPostBack(node)
 {
    var id    = (node.parentNode.id != null) ? node.parentNode.id : '';
	document.getElementById('nodeid').value = id;
    document.getElementById('frmnodes').submit();
} 
function Switch(node,style)
{
    if(node.parentNode.className=="expanded")
    {
       if(node.className=="image-last")
          node.src="styles/"+style+"/images/plus-last.jpg";
       else node.src="styles/"+style+"/images/plus.jpg";
       node.parentNode.className="collapsed";
       
       document.getElementById("node"+node.parentNode.id).value="c";
    }
    else if(node.parentNode.className=="collapsed")
    {
       if(node.className=="image-last")
          node.src="styles/"+style+"/images/minus-last.jpg";
       else node.src="styles/"+style+"/images/minus.jpg";
       node.parentNode.className="expanded";
       
       document.getElementById("node"+node.parentNode.id).value="e";
    }
    
}