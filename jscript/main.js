function sendhideform(docurl,cmd,docparams)
	{
	document.hideform.action=docurl;
	document.hideform.cmd.value=cmd;
	document.hideform.argv.value=docparams;
	document.hideform.submit();
	return(true);
	}

function makeradiores(obj)
	{
	for(i=0;i<obj.length;i++)
		{
		if(obj[i].checked) return(obj[i].value);
		}
	}
	
function testchecked(chcount)
{

q='checksel=';
for(i=0;i<chcount;i++) 
	{
	if(document.all['chname'+i].checked) q+=document.all['chhname'+i].value+",";
	}
if(q!='')
	{
	res=q.substring(0,q.length-1);
	return(res);
	}
else return('');

}
