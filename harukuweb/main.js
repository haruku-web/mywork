const menu = document.getElementById('menu');
const overlay = document.querySelector('.overlay');
const headernav = document.querySelector('.header-nav');
const home = document.querySelector('home');
const about = document.querySelector('about');
const works = document.querySelector('works');
const skills = document.querySelector('skills');
const contact = document.querySelector('contact');


menu.addEventListener('click', () => {
  headernav.classList.toggle('menu-open');
});
menu.addEventListener('click', () => {
  overlay.classList.toggle('show');
});


const up = document.querySelector('.up');
const wb1 = document.querySelector('.wb1');
const wb2 = document.querySelector('.wb2');
const wb3 = document.querySelector('.wb3');

const cb = function(entries, observer){
  entries.forEach(entry =>{
    if(entry.isIntersecting){
      entry.target.classList.add('inview');
    }else{
      entry.target.classList.remove('inview');
    }
  });
}
const io = new IntersectionObserver(cb);
io.observe(up);
io.observe(wb1);
io.observe(wb2);
io.observe(wb3);