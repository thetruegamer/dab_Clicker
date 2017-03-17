// la monnaie du jeu : le dab
var dabs = 0;
// le nombre de dabs gagnés quand on clique : 1 au début, peut changer selon les upgrades
var dab_inc = 1;

function clickToDab()
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
	dabs += n;
	document.getElementById('dab_number').innerHTML = dabs;
};