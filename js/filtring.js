
let region = new Set(['Ashanti Region', 'Volta Region', 'Eastern Region', 'Greater Accra Region', 'Central Region',
  'Oti Region', 'Northern Region', 'Upper East', 'Upper West', 'Western Region', 'Western North Region', 'Ahafo Region',
  'Bono Region', 'Bono East Region', 'Savannah Region', 'North East Region'
]);

let subject = new Set(['BIOLOGY', 'GENERAL ARTS', 'LITERATURE IN ENGLISH', 'FRENCH', 'ECONOMICS', 'GEOGRAPHY', 'HISTORY', 'GOVERNMENT', 'RELIGIOUS STUDIES', 'BUSINESS', 'ACCOUNTING',
  'BUSINESS MANAGEMENT', 'PRINCIPLE OF COSTING', 'VISUAL ARTS', 'GENERAL KNOWLEDGE IN ARTS', 'TEXTILE', 'GRAPHIC DESIGN',
  'BASKETRY', 'LEATHER WORK', 'PICTURE MAKING', 'CERAMICS AND SCULPTURE', 'HOME ECONOMICS', 'MANAGEMENT IN LIVING', 'FOOD AND NUTRITION',
  'Technical', 'Building Construction Technology', 'Carpentry And Joinery', 'Catering', 'Electrical Installation Work', 'Electronics', 'Fashion And Design', 'General Textiles',
  'Industrial Mechanics', 'Mechanical Engineering Craft Practice', 'Metal Work', 'Photography', 'Plumbing Craft', 'Printing Craft', 'Welding And Fabrication',
  'Wood Work', 'GENERAL SCIENCE', 'PHYSICS', 'CHEMISTRY', 'ELECTIVE MATHS']);

let search = document.getElementById('search');
let filter = document.getElementById('filter');

search.style.display = 'none';

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
    a.style.backgroundColor = 'rgba(255, 255, 255, 0.85)';
    a.style.position = 'absolute';
    a.style.zIndex = 1;
    this.parentNode.appendChild(a);
    for (i = 0; i < arr.length; i++) {
      if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
        b = document.createElement("DIV");
        b.style.padding = '8px';
        b.style.borderBottom = '1px solid #ccc';
        b.style.pointer = 'cursor';
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

filter.addEventListener('change', () => {
  if (!filter.value) {
    search.style.display = 'none';
  } else {
    search.style.display = 'block';
    switch (filter.value) {
      case 'region':
        search.addEventListener('keydown', () => {
          autocomplete(search, Array.from(region));
        });
        break;
      case 'subject':
        search.addEventListener('keydown', () => {
          autocomplete(search, Array.from(subject));
        });
        break;
    }
  }
});
