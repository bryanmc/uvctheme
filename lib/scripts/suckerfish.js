startpriList=function(){if(document.all&&document.getElementById){navRoot=document.getElementById("primary_nav");for(i=0;i<navRoot.childNodes.length;i++){node=navRoot.childNodes[i];if(node.nodeName=="LI"){node.onmouseover=function(){this.className+=" over"}node.onmouseout=function(){this.className=this.className.replace(" over","")}}}}}startsecList=function(){if(document.all&&document.getElementById){navRoot=document.getElementById("secondary_nav");for(i=0;i<navRoot.childNodes.length;i++){node=navRoot.childNodes[i];if(node.nodeName=="LI"){node.onmouseover=function(){this.className+=" over"}node.onmouseout=function(){this.className=this.className.replace(" over","")}}}}}window.onload=startpriList;window.onload=startsecList;