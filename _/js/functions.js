// remap jQuery to $
(function($){})(window.jQuery);


/* trigger when page is ready */
$(document).ready(function (){

  // ------------------------------
  // Form Input Placeholder
  // ------------------------------
  if (!Modernizr.inputtypes.email)
  {
    $('input[placeholder], textarea[placeholder]').each(function(i, input){
      var $input = $(input);

      // Initially load the placeholder value
      if ($input.val() == '') { $input.val($input.attr('placeholder')); }

      $input
        .bind('focusin', function(){
          var $this = $(this);
          if ($this.val() == $input.attr('placeholder')) { $this.val(''); }
        })
        .bind('focusout', function(){
          var $this = $(this);
          if ($this.val() == '') { $this.val($input.attr('placeholder')); }
        });
    });
  }

  // ------------------------------------------------------
  // Switch out "DOMAIN" to be whatever the site domain is.
  // ie. "colorjar" for http://colorjar.com
  // ------------------------------------------------------
  /*
  $.map($('a'), function(link){
    if (link.href.search(/.DOMAIN./) === -1){
      $(link).attr('target', '_blank');
    }
  });
  */

});


/* optional triggers

$(window).load(function() {

});

$(window).resize(function() {

});

*/
