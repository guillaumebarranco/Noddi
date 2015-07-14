/*
*	FONCTIONS GENERIQUES
*/

var _this = this;

function makeAjax(type, url, data, callback) {

	$.ajax({
		type : type,
		url : url,
		data : data,
		success: function(response_get) {
			// La variable globale de reponse est remplacée à chaque requête AJAX
			_this.response = response_get;
			callback();
		},
		error: function(){
			console.log('error', url);
        }
	});
}

function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

function validateWebsite(website) {
    var re = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
    return re.test(website);
}

function calculateAge(date) { // birthday is a timestamp
    var ageDifMs = Date.now() - date;
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}