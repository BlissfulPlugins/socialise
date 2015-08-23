(function($) {
  $(function() {
    $('.socialise a').click(function(event) {

      event.preventDefault();

      var url = $(this).attr('href');

      var width  = 550;
      var height = 254;
      var left   = (screen.width / 2) - (width / 2);
      var top    = (screen.height / 2) - (height / 2);

      window.open(url, '_blank', 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top + ',location=no,menubar=no,resizeable=no,scrollbars=no,status=no,titlebar=no,toolbar=no');

      return false;

    });
  });
})(jQuery);
