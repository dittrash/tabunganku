var button = document.getElementById('edit')
				button.addEventListener('click',show,false);
var button = document.getElementById('cancel')
				button.addEventListener('click',hide,false);
function show() {
	document.getElementById('cancel').style.visibility = 'visible'; 
	document.getElementById('editProfile').style.visibility = 'visible'; 
	document.getElementById('editPhoto').style.visibility = 'visible'; 
	document.getElementById('delete').disabled = true;
	document.getElementById('gender').removeAttribute("readonly");
	var x = document.getElementsByTagName("input");
	var i;
	for (i = 1; i < 8; i++) {
		x[i].removeAttribute("readonly");
	}
	this.disabled = true;
}   
function hide() {
	document.getElementById('editProfile').style.visibility = 'hidden';
	document.getElementById('editPhoto').style.visibility = 'hidden'; 
	document.getElementById('edit').removeAttribute("disabled");
	document.getElementById('delete').removeAttribute("disabled");
	document.getElementById('gender').setAttribute("readonly","readonly");
	var x = document.getElementsByTagName("input");
	var i;
	for (i = 1; i < 8; i++) {
		x[i].setAttribute("readonly","readonly");
	}
	this.style.visibility = 'hidden';
}
