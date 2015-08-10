function Message( msg){
		alert(msg);
}

function centrer_la_fenetre(page,largeur,hauteur,options) {
  var top=(screen.height-hauteur)/2;
  var left=(screen.width-largeur)/2;
  window.open(page,"","top="+top+",left="+left+",width="+largeur+",height="+hauteur+","+options);
}

function Reporter(l) {
	var choix=l.options[l.options.selectedIndex].value;
	window.opener.document.forms["origine"].elements["choix"].value=choix;
}