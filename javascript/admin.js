let profile = document.querySelector('.header .flex .profile');
let navbar = document.querySelector('.header .flex .navbar');


document.querySelector('#userBtn').onclick = () =>{
  profile.classList.toggle('active');
  navbar.classList.remove('active');
}

document.querySelector('#menuBtn').onclick = () =>{
  navbar.classList.toggle('active');
  profile.classList.remove('active');
}

window.onscroll = () =>{
  profile.classList.remove('active');
  navbar.classList.remove('active');
}