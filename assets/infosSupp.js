console.log('Test connexion infoSupp.js')

// ----------------PLUS D INFORMATIONS (page Equipe)------------------------


var plusdInfos = document.getElementsByClassName('plusdInfos')
// console.log('plusdInfos')

for (var i=0; i<plusdInfos.length; i++){

	plusdInfos[i].addEventListener('click', function(){

		var infos = this.nextElementSibling;
		// console.log(infos)

		if (infos.style.display == 'block') {
			infos.style.display = 'none';
		}else{
			infos.style.display = 'block';
		}
	})
}