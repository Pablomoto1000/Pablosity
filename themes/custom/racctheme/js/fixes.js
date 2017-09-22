document.body.onload = function(){

  // Form Button Fix

  formbutton = document.getElementsByClassName('contact-message-need-more-info-form contact-message-form contact-form')[0];
  signupbutton = formbutton.getElementsByClassName('button button--primary js-form-submit form-submit')[0];
  signupbutton.value = 'Sign Up';


  // Footer logo icons

  footericons = document.getElementById('block-racctheme-socialicons').getElementsByClassName('menu')[0];
  // FB icon
  ffbli = footericons.getElementsByTagName('li')[0].getElementsByTagName('a')[0].className = "fa fa-facebook";
  // TW icon
  ftwli = footericons.getElementsByTagName('li')[1].getElementsByTagName('a')[0].className = "fa fa-twitter";
  // YT icon
  fytli = footericons.getElementsByTagName('li')[2].getElementsByTagName('a')[0].className = "fa fa-youtube";
  //LI icon
  lfili = footericons.getElementsByTagName('li')[3].getElementsByTagName('a')[0].className = "fa fa-linkedin";
  // SC icon
  fscli = footericons.getElementsByTagName('li')[4].getElementsByTagName('a')[0].className = "fa fa-google-plus";
  // IG icon
  figli = footericons.getElementsByTagName('li')[5].getElementsByTagName('a')[0].className = "fa fa-instagram";


  // // Lenguage link Fix
  //
  // languagelink = document.getElementsByClassName('fa fa-language sf-depth-1');
  // currenturl = window.location.href;
  // newurl = currenturl.replace("/pablosity/", "/pablosity/es");
  // languagelink.l);
  // languagelink.href = newurl;
  // if(window.location.href.indexOf("/pablosity/es") > -1) {
  //      currenturl = window.location.href.replace("/pablosity/es", "/pablosity");
  //      languagelink.href = currenturl;
  //   }


};
