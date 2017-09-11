document.body.onload = function(){
  // Get Connected Fixes

  getconnectedicons = document.getElementsByClassName('view-id-get_connected view-display-id-block_1')[0];
  socialicons = getconnectedicons.getElementsByClassName('socialicons')[0];
  sociallist = socialicons.getElementsByClassName('item-list')[0];
  gcsquares = getconnectedicons.getElementsByClassName('horizontal cols-4')[0];
  // FB icon
  fbli = sociallist.getElementsByTagName('li')[0].getElementsByTagName('a')[0].className = "fa fa-facebook";
  // TW icon
  twli = sociallist.getElementsByTagName('li')[1].getElementsByTagName('a')[0].className = "fa fa-twitter";
  // YT icon
  ytli = sociallist.getElementsByTagName('li')[2].getElementsByTagName('a')[0].className = "fa fa-youtube";
  //LI icon
  lili = sociallist.getElementsByTagName('li')[3].getElementsByTagName('a')[0].className = "fa fa-linkedin";
  // SC icon
  scli = sociallist.getElementsByTagName('li')[4].getElementsByTagName('a')[0].className = "fa fa-google-plus";
  // IG icon
  igli = sociallist.getElementsByTagName('li')[5].getElementsByTagName('a')[0].className = "fa fa-instagram";

  // Id's and tw & ig discrimination
  for (var i = 1; i < 8; i++) {
    discriminator = gcsquares.getElementsByClassName('views-field-field-additional-info')[i].getElementsByClassName('field-content')[0];
    instext = gcsquares.getElementsByClassName('views-field-field-contact')[i].getElementsByClassName('field-content')[0];
    discriminator.className = 'fa fa-twitter';
    instext.id = 'twtext';
    text = discriminator.innerHTML;
    var insdisc = text.includes('ins');
    // alert(n)
    if (insdisc) {
      discriminator.className = 'fa fa-instagram';
      instext.id = 'insttext';
    }
  }


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
