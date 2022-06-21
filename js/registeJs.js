var currentTab = 0;
const regions = new Set(['Ashanti Region', 'Volta Region', 'Eastern Region', 'Greater Accra Region', 'Central Region',
'Oti Region', 'Northern Region', 'Upper East', 'Upper West', 'Western Region', 'Western North Region', 'Ahafo Region',
'Bono Region', 'Bono East Region', 'Savannah Region', 'North East Region'
]);

const subjects = new Set(['BIOLOGY', 'GENERAL ARTS', 'LITERATURE IN ENGLISH', 'FRENCH', 'ECONOMICS', 'GEOGRAPHY', 'HISTORY', 'GOVERNMENT', 'RELIGIOUS STUDIES', 'BUSINESS', 'ACCOUNTING',
  'BUSINESS MANAGEMENT', 'PRINCIPLE OF COSTING', 'VISUAL ARTS', 'GENERAL KNOWLEDGE IN ARTS', 'TEXTILE', 'GRAPHIC DESIGN',
  'BASKETRY', 'LEATHER WORK', 'PICTURE MAKING', 'CERAMICS AND SCULPTURE', 'HOME ECONOMICS', 'MANAGEMENT IN LIVING', 'FOOD AND NUTRITION', 
  'Technical', 'Building Construction Technology', 'Carpentry And Joinery', 'Catering', 'Electrical Installation Work', 'Electronics', 'Fashion And Design', 'General Textiles', 
  'Industrial Mechanics', 'Mechanical Engineering Craft Practice', 'Metal Work', 'Photography', 'Plumbing Craft', 'Printing Craft', 'Welding And Fabrication', 
  'Wood Work', 'GENERAL SCIENCE', 'PHYSICS', 'CHEMISTRY', 'ELECTIVE MATHS']);
showTab(currentTab);


function showTab(n) {
  var x = document.getElementsByClassName("champ");
  x[n].style.display = "block";
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  fixStepIndicator(n)
}

function nextPrev(n) {
  var x = document.getElementsByClassName("champ");
  if (n == 1 && !validateForm()) return false;
  x[currentTab].style.display = "none";
  currentTab = currentTab + n;
  if (currentTab >= x.length) {
    document.getElementById("regForm").submit();
    return false;
  }
  showTab(currentTab);
}

function validateForm() {
  var x, y, i, contact, valid = true;
  x = document.getElementsByClassName("champ");
  y = x[currentTab].querySelectorAll('.required > input, select');
  contact = document.getElementById('contact');
  let region = document.getElementById('myInput');
  let subject = document.getElementById('subject');

  for (i = 0; i < y.length; i++) {
    if (y[i].value == "") {
      y[i].className += " invalid";
      valid = false;
    }

    if(y[i] == contact) {
      if(onlyNumber(contact.value) == false) {
        y[i].className += " invalid";
        valid = false
      }
    }

    if(y[i] == region) {
      if(!regions.has(y[i].value)) {
        y[i].className += " invalid";
        valid = false;
      }
    }
    if(y[i] == subject) {
      if(!subjects.has(y[i].value)) {
        y[i].className += " invalid";
        valid = false;
      }
    }
  }
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid;
}

function fixStepIndicator(n) {
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  x[n].className += " active";
}



var loadFile = function (event) {
  var image = document.getElementById('output');
  image.src = URL.createObjectURL(event.target.files[0]);
};



function autocomplete(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function (e) {
    var a, b, i, val = this.value;
    closeAllLists();
    if (!val) { return false; }
    currentFocus = -1;
    a = document.createElement("DIV");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    this.parentNode.appendChild(a);
    for (i = 0; i < arr.length; i++) {
      if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
        b = document.createElement("DIV");
        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
        b.innerHTML += arr[i].substr(val.length);
        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
        b.addEventListener("click", function (e) {
          inp.value = this.getElementsByTagName("input")[0].value;
          closeAllLists();
        });
        a.appendChild(b);
      }
    }
  });
  inp.addEventListener("keydown", function (e) {
    var x = document.getElementById(this.id + "autocomplete-list");
    if (x) x = x.getElementsByTagName("div");
    if (e.keyCode == 40) {
      currentFocus++;
      addActive(x);
    } else if (e.keyCode == 38) { 
      currentFocus--;
      addActive(x);
    } else if (e.keyCode == 13) {
      e.preventDefault();
      if (currentFocus > -1) {
        if (x) x[currentFocus].click();
      }
    }
  });
  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  document.addEventListener("click", function (e) {
    closeAllLists(e.target);
  });
}

autocomplete(document.getElementById("myInput"), Array.from(regions));
autocomplete(document.getElementById("subject"), Array.from(subjects));


// contact



function onlyNumber(n) {
  const contact = document.getElementById('contact');
  const arr = ['+', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', ' ']
  const new_arr = contact.value.split('');
  
  for(let i = 0; i< new_arr.length; i++)
  {
    if(!arr.includes(new_arr[i])) {
      return false;
    }
  }
}


