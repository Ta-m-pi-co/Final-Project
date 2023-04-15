let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');
let menubtn = document.querySelector('#menuBtn');
let userbtn = document.querySelector('#userBtn');

menubtn.onclick = function() {
  console.log('menuBtn clicked');
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

userbtn.onclick = function(){
  console.log('userBtn clicked');
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = function() {
   navbar.classList.remove('active');
   profile.classList.remove('active');
};