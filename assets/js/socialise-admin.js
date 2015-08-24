(function($) {
  $(function() {
    $('#sc-tiles').sortable();

    $('#sc-tiles li').click(function() {
      if ($(this).hasClass('sc-tile-enabled')) {
        $(this).removeClass('sc-tile-enabled');
        $(this).find('input').val(0);
      } else {
        $(this).addClass('sc-tile-enabled');
        $(this).find('input').val(1);
      }
    });
  });
})(jQuery);
