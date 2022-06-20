const search = document.getElementById('search');
const filter = document.getElementById('filter');
search.style.display = 'none';

filter.addEventListener('change', ()=>{
  if(!filter.value) {
    search.style.display = 'none';
  }else {
    search.style.display = 'block';
  }
})