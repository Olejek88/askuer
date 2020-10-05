var XML;
var req;
req = null;

function loadXMLDoc(url) {
	if (window.XMLHttpRequest)
		req = new XMLHttpRequest(); 
	else 
	 if (window.ActiveXObject) 
		req = new ActiveXObject("Microsoft.XMLHTTP"); 
         if (req) 
	    {
	        req.onreadystatechange = function() { 
		    if (req.readyState == 4) {
		    if (req.status == 200) {
			XML = req.responseXML;
			var xmlDat=XML;
		        var zagl="<tr><td bgcolor=#e6e6e6><font class=main>Название узла</font></td></td>";
			zagl=+ "<td bgcolor=#e6e6e6><font class=main>Дата</font></td><td bgcolor=#e6e6e6><font class=main>Соед</td>";
			zagl=+ "<td bgcolor=#e6e6e6><font class=main>P1</td>";
			zagl=+ "<td bgcolor=#e6e6e6><font class=main>P2</td><td bgcolor=#e6e6e6><font class=main>P3</td><td bgcolor=#e6e6e6><font class=main>P4</td></tr>";
		        var tab="<table valign=top border=0 cellpadding=1 cellspacing=0 border=0><tr><td valign=top><table border=1 cellpadding=2 cellspacing=0 border=0>"+zagl;
		        var lDatRoot=xmlDat.getElementsByTagName("uzels")[0];
		        var uDatRoot=xmlDat.getElementsByTagName("uzel")[0];
			var qnt=lDatRoot.childNodes.length/2-1;
			if (lDatRoot)
			    {
			     for(var i=0;i<qnt;i++)
				 {
  				   var tn= new Date();
				   var hour = tn.getHours();
					var min = tn.getMinutes();
					var sec = tn.getSeconds();
					if (hour<10) hour="0"+hour;
					if (min<10) min="0"+min;
					if (sec<10) sec="0"+sec;
				   var tm=hour+"-"+min+"-"+sec;
			           var uDatRoot=xmlDat.getElementsByTagName("uzel")[i];
				   var attrs=uDatRoot.attributes;
			           name=attrs.getNamedItem("title").value;
			 	   if (i%2==0) tab+= "<tr bgcolor=#e8e8e8>";
				   else  tab+= "<tr bgcolor=#ffffff>";
				   tab+= "<td><font class=dd>"+name+"</font></td>";
				   tab+="<td><font class=dd>"+tm+"</font></td>";
				   tab+="<td><font class=dd>"+attrs.getNamedItem("conn").value+"</font></td>";
				   tab+="<td><font class=dd>"+attrs.getNamedItem("P1").value+"</font></td>";
				   tab+="<td><font class=dd>"+attrs.getNamedItem("P2").value+"</font></td>";
				   tab+="<td><font class=dd>"+attrs.getNamedItem("P3").value+"</font></td>";
				   tab+="<td><font class=dd>"+attrs.getNamedItem("P4").value+"</font></td>";
				   tab+="</tr>";
				  if (i==77) tab+="</table></td><td valign=top><table border=1 cellpadding=2 cellspacing=0 border=0>"+zagl;
				}
			    }
			  objj=document.getElementById("ftable");
			  tab+="</table></td></tr></table>";
			  objj.innerHTML = tab;
			}}
		    };
	        req.open("GET", url, true);
	        req.send(null);
	    }
}

function loadXMLAv(url) {
	if (window.XMLHttpRequest)
		req = new XMLHttpRequest(); 
	else 
	 if (window.ActiveXObject) 
		req = new ActiveXObject("Microsoft.XMLHTTP"); 
         if (req) 
	    {
	        req.onreadystatechange = function() { 
		    if (req.readyState == 4) {
		    if (req.status == 200) {
			XML = req.responseXML;									
			var xmlDat=XML;
		        var zagl="<tr><td bgcolor=#e6e6e6><font class=main>Время перерыва</font></td></td>"
			+ "<td bgcolor=#e6e6e6><font class=main>Длительность</font></td><td bgcolor=#e6e6e6><font class=main>Номер логики</font></td></tr>";
		        var tab="<table valign=top border=1 cellpadding=1 cellspacing=0 border=0>"+zagl;
		        var lDatRoot=xmlDat.getElementsByTagName("events")[0];
		        var uDatRoot=xmlDat.getElementsByTagName("event")[0];
			var qnt=lDatRoot.childNodes.length/2-1;
			if (lDatRoot)
			    {
			     for(var i=0;i<qnt;i++)
				 {
			           var uDatRoot=xmlDat.getElementsByTagName("event")[i];
				   var attrs=uDatRoot.attributes;
				   tab+="<tr><td><font class=dd>"+attrs.getNamedItem("time").value+"</font></td>";
				   tab+="<td><font class=dd>"+attrs.getNamedItem("period").value+"</font></td>";
				   tab+="<td><font class=dd>"+attrs.getNamedItem("logika").value+"</font></td>";
				   tab+="</tr>";
				}
			    }
			  objj=document.getElementById("fevents");
			  tab+="</table>";
			  objj.innerHTML = tab;
			}}
		    };
	        req.open("GET", url, true);
	        req.send(null);
	    }
}

function loadLog(url) {
	if (window.XMLHttpRequest)
		req = new XMLHttpRequest(); 
	else 
	 if (window.ActiveXObject) 
		req = new ActiveXObject("Microsoft.XMLHTTP"); 
         if (req) 
	    {
	        req.onreadystatechange = function() { 
		    if (req.readyState == 4) {
		    if (req.status == 200) {
			XML = req.responseText;
			objj=document.getElementById("flogs");
			  objj.innerHTML = XML;
			}}
		    };
	        req.open("GET", url, true);
	        req.send(null);
	    }
}
function startShow()
{  
 setInterval ("loadXMLDoc('instdata.xml')",5000);
 setInterval ("loadXMLAv('instav.xml')",5500);
 setInterval ("loadLog('servlast.log')",3500);
}

