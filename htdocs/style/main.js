function showContent(link, id) {
	var cont = document.getElementById(id);
	
	var http = createRequestObject();
	if( http ) {
		http.open('get', link);
		http.onreadystatechange = function () {
			if(http.readyState == 4) {
				cont.innerHTML = http.responseText;
				tt_updatePosition();
			}
		}
		http.send(null);    
	}
};

function createRequestObject() {
	try { return new XMLHttpRequest() }
	catch(e) {
		try { return new ActiveXObject('Msxml2.XMLHTTP') }
		catch(e) {
			try { return new ActiveXObject('Microsoft.XMLHTTP') }
			catch(e) { return null; }
		}
	}
};

function refresh_s_status() {
	showContent('./modules/s_status/s_status.php', 'sb_main');
	
};