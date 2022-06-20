// The delete myFunction
function deleteft(delet,name){
  var modal= document.getElementById('id01');
  var deletebtn=document.querySelector('.deletebtn');
  var nom=document.getElementById('nom');
  deletebtn.value=delet;
  modal.style.display="block";
  nom.innerHTML=name;


  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
}
}

function tableFilter() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.querySelector(".table");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}


const links = document.querySelectorAll('.link');

function showBlock(e) {
  const teachers = document.getElementById('teachers');
  const users = document.getElementById('users');
  switch (e) {
    case 'teachers-link':
      teachers.style.display = 'block';
      users.style.display = 'none';
      break;

    case 'users-link':
      users.style.display = 'block';
      teachers.style.display = 'none';
      break;

    default:
      teachers.style.display = 'block';
      users.style.display = 'none';
      break;
  }
}

links.forEach((element) => {
  element.addEventListener('click', (e) => {
    showBlock(element.id);
    const [current] = document.getElementsByClassName('active');
    current.className = current.className.replace(' active', '');
    e.target.className += ' active';
  });
});



// Rating codes

function rates(id, tid) {
  
  const box = document.getElementById(id);
  const parent = box.parentNode;
  parent.parentElement.querySelector('.rateValue').innerHTML = box.value;
  
};