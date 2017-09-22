var ajaxcall = document.getElementById('socialfeedblock');

var everythingLoaded = setInterval(function() {
  if (/loaded|complete/.test(document.readyState)) {
    clearInterval(everythingLoaded);
    ajaxreturn(); // this is the function that gets called when everything is loaded.
  }
}, 10);

function ajaxreturn () {
  var loaderGif = document.getElementById('ajax-loader');
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    loaderGif.style.display = 'none';
     document.getElementById('socialfeedblock').innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "http://localhost/pablosity/socialfeed", true);
  xhttp.send();
}
