let profile = document.querySelector('.header .flex .profile');

document.querySelector('#userBtn').onclick = () =>{
  profile.classList.toggle('active');
  navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menuBtn').onclick = () =>{
  navbar.classList.toggle('active');
  profile.classList.remove('active');
}

window.onscroll = () =>{
  profile.classList.remove('active');
  navbar.classList.remove('active');
}