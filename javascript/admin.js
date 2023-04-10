/*let profile = document.querySelector('.header .flex .profile');
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

*/

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

subImages = document.querySelectorAll('.updateProduct .imageContainer .subImages img');
mainImage = document.querySelector('.updateProduct .imageContainer .mainImage img');

subImages.forEach(images =>{
  images.onclick = () =>{
  let src = images.getAttribute('src');
  mainImage.src = src;
  }
});
  
