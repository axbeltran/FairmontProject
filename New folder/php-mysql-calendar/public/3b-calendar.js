var cal = {
  list: function () {
  // list() : show calendar for selected month & year

    // DATA
    var data = new FormData();
    data.append('req', 'list');
    data.append('month', document.getElementById("month").value);
    data.append('year', document.getElementById("year").value);

    // AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "2c-ajax-calendar.php", true);
    xhr.onload = function () {
      document.getElementById("event").innerHTML = "";
      document.getElementById("container").innerHTML = this.response;
    };
    xhr.send(data);
  },

  show: function(day) {
  // show() : show event for selected day
  // PARAM day : selected date

    // DATA
    var data = new FormData();
    data.append('req', 'show');
    data.append('date', day);

    // AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "2c-ajax-calendar.php", true);
    xhr.onload = function () {
      document.getElementById("event").innerHTML = this.response;
    };
    xhr.send(data);
  },

  save: function() {
  // save() : save event for selected day

    // DATA
    var data = new FormData();
    data.append('req', 'save');
    data.append('date', document.getElementById('evt-date').innerHTML);
    data.append('details', document.getElementById('evt-details').value);

    // AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "2c-ajax-calendar.php", true);
    xhr.onload = function(){
      if (this.response=="OK") {
        cal.list();
      } else {
        alert("Error saving event");
      }
    };
    xhr.send(data);
    return false;
  },

  del: function() {
  // del() : delete event for selected day

    if (confirm("Delete event?")) {
      // DATA
      var data = new FormData();
      data.append('req', 'del');
      data.append('date', document.getElementById('evt-date').innerHTML);

      // AJAX
      var xhr = new XMLHttpRequest();
      xhr.open('POST', "2c-ajax-calendar.php", true);
      xhr.onload = function(){
        if (this.response=="OK") {
          cal.list();
        } else {
          alert("Error deleting event");
        }
      };
      xhr.send(data);
    }
  }
};

window.addEventListener("load", cal.list);