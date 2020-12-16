console.log('Test connexion popup.js')


// ----------------FENETRE POPUP----------------

var popupCovid = document.getElementById('popupCovid');
// console.log(popupCovid)

function popupCovidVisible(){
	popupCovid.style.display="block";
}

setTimeout(popupCovidVisible, 1000);

btnNo.addEventListener('click', function(){
	popupCovid.style.display="none";
})
