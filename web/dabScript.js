function clickToDab(dab_inc)
{
	addDabs(dab_inc);
	
	if (document.getElementById('dabber').innerHTML == "\\ o &gt;")
	{
		document.getElementById('dabber').innerHTML = "&lt; o /";
	}
	else if (document.getElementById('dabber').innerHTML = "&lt; o /")
	{
		document.getElementById('dabber').innerHTML = "\\ o &gt;";
		//document.getElementById('dabber').innerHTML = "⊗ &otimes;";
	}
}

function addDabs(n)
{
	dabs = parseInt(document.getElementById('dab_number').innerHTML); 
	dabs += n;
	document.getElementById('dab_number').innerHTML = dabs;
};