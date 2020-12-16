console.log("Test de connexion script.js")


// ----------------MENU BURGER------------------------

var btn = document.querySelector('.toggle_btn');
var nav = document.querySelector('.nav');

btn.onclick = function(){
	nav.classList.toggle("nav_open");
}


//-----------LOGO-MINI + NAV FIXED-----------


var navigation = document.querySelector('#navigation');
var miniLogo = document.querySelector('#dv');
var boutonMenu = document.getElementsByClassName('boutonmenu')

window.addEventListener('scroll', ()=>{
    if (window.scrollY > 142) {
		navigation.style.position = "fixed";
        navigation.style.top = "0";
		navigation.style.left = "0";
		miniLogo.style.marginLeft = '5%';
    }else{
		navigation.style.position = "relative";
		miniLogo.style.marginLeft = '-20%';
		
	}
})

// ----------------BOUTON DE RETOUR EN HAUT DE PAGE----------------


var hautdepage = document.querySelector('#hautdepage')

window.addEventListener('scroll', ()=>{
    if (window.scrollY > 250) {
        hautdepage.style.opacity = "1";
        hautdepage.style.transition = "0.5s"
        
    }else{
        hautdepage.style.opacity = '0';
    }
})

hautdepage.addEventListener('click', function(){
	window.scrollTo({
		top:0,
		left:0,
		behavior:'smooth'
	});
});











