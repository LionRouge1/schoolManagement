// The delete myFunction

function deleteft(delet, name) {
  var modal = document.getElementById('id01');
  var deletebtn = document.querySelector('.deletebtn');
  var nom = document.getElementById('nom');
  deletebtn.value = delet;
  modal.style.display = "block";
  nom.innerHTML = name;


  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
}


// Rating codes

function rates(id, tid) {
  const box = document.getElementById(id);
  const parent = box.parentNode;
  parent.parentElement.querySelector('.rateValue').innerHTML = box.value;
};

