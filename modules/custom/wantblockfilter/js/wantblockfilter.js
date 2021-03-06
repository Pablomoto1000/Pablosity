(function ($) {

	/**
   * Set active class on Views AJAX filter
   * on selected category
   */

  var active=1;
  if ( $(window).width() < 1030 ) {
    var active = 0;
  }

  Drupal.behaviors.exposedfilter_buttons = {
    attach: function(context, settings) {
      $('.filter-tab a').on('click', function(e) {
        e.preventDefault();

        // Get ID of clicked item
        var id = $(e.target).attr('id');

        // Set the new value in the SELECT element
        var filter = $('#views-exposed-form-wantblockk-block-1 select[name="nid"]');
        filter.val(id);

        // Set active to the id value for background color on selected li
        active = id;

        // Do it! Trigger the select box
        //filter.trigger('change');
        $('#views-exposed-form-wantblockk-block-1 select[name="nid"]').trigger('change');
        $('#views-exposed-form-wantblockk-block-1 input.form-submit').trigger('click');
        return active;
      } );

      lists = document.getElementsByClassName('pop-list')[0];
      var snitch = document.getElementsByClassName("wantblock")[0];
      var lol = snitch.getElementsByClassName("gradient")[0];
      lol.setAttribute("id", "wantblockimageoff")
      wantblock = document.getElementsByClassName('wantblock')[0];
      wbcontent = wantblock.getElementsByClassName('view-content')[0];
      stlifeli = document.getElementById('racc-nav-bottom-menu-link-content56787153-55ed-4600-8816-a2a99fac104c');
      abouraccli = document.getElementById('racc-nav-bottom-menu-link-content73aa9bdf-4f27-495c-a041-be7b5aa1f666');
      var c = lists.children;

      if ( $(window).width() > 1029 ) {
      for (i = 0; i < 4; i++) {
        singlelist = lists.getElementsByTagName('LI')[i];
        singlelist.setAttribute("id", "b"+(i+1));
        if (active==(i+1)) {
          singlelist.addEventListener("mouseover", function mouseOverLi() {lol.setAttribute("id", "wantblockimage")});
          singlelist.addEventListener("mouseout", function mouseOutLi() {lol.setAttribute("id", "wantblockimageoff")});
          singlelist.style.background = '#ff3333';
        }
      }
      }
      listnum = lists.getElementsByTagName("li").length;

      // Creates LI if it's a mobile, and check if its created already
      if ( $(window).width() < 1030 && !(lists.contains(enrollnow)) && listnum < 5 ) {
        var enrollnow = document.createElement("LI");
        lists.insertBefore(enrollnow, lists.childNodes[0]);
        enrollnow = lists.getElementsByTagName('LI')[0];
        enrollnow.setAttribute("id", "enrollnow");
        var enrolltag = document.createElement("A");
        enrollnow.appendChild(enrolltag);
        enrolltag.innerHTML = "ENROLL NOW";
      }

      if ( $(window).width() < 1030 ) {
        wbcontent.style.display = 'none';
        for (i = 1; i < 5; i++) {
          // var c = lists.children;
          c[i].setAttribute("id", "b"+(i));
          if (active==i) {
            c[i].addEventListener("mouseover", function mouseOverLi() {lol.setAttribute("id", "wantblockimage")});
            c[i].addEventListener("mouseout", function mouseOutLi() {lol.setAttribute("id", "wantblockimageoff")});
            c[i].style.background = '#ff3333';
            c[i].appendChild(wbcontent);
            c[i].style.marginBottom = "54rem";
            wbcontent.style.display = 'block';

          }
        }
      }

      // Fixes main menu in determined sizes
      if ( $(window).width() > 1030 && $(window).width() < 1226) {
        abouraccli.style.width = '15.2%';
        stlifeli.style.width = '16.5%';
      }

      // Triggers the event when screen it's resized
      document.getElementsByTagName("BODY")[0].onresize = function(){
        lists = document.getElementsByClassName('pop-list')[0];
        enrollnow = document.getElementById('enrollnow');

        // Fixes main menu in determined sizes
        if ( $(window).width() > 1030 && $(window).width() < 1226) {
          abouraccli.style.width = '15.2%';
          stlifeli.style.width = '16.5%';
        }
        // Removes LI when screen gets Desktop size
        if ( $(window).width() > 1029 && lists.contains(enrollnow)) {
          lists.removeChild(lists.childNodes[0]);
          wantblock.appendChild(wbcontent);
          for (i = 0; i < 4; i++) {
            if (active==(i+1)) {
              c[i].style.marginBottom = "0";
            }
          }
        }
        // Creates LI if it's a mobile, and check if its created already
        if ( $(window).width() < 1030 && !(lists.contains(enrollnow)) && listnum < 5 ) {
          var enrollnow = document.createElement("LI");
          lists.insertBefore(enrollnow, lists.childNodes[0]);
          enrollnow = lists.getElementsByTagName('LI')[0];
          enrollnow.setAttribute("id", "enrollnow");
          var enrolltag = document.createElement("A");
          enrollnow.appendChild(enrolltag);
          enrolltag.innerHTML = "ENROLL NOW";
        }
      };
    }
  };
})(jQuery);
