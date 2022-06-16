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