var modalHeader, modalBody, modalFooter = '';

function genModalHide() {
  $("#genModal").modal('hide');

  $('#genModal').on('hidden.bs.modal', function(e) {
    $("#genModal .modal-header").prepend().html('');
    $("#genModal .modal-body").html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
    $("#genModal .modal-footer").html('');
    $("#genModal").modal('dispose');
  });
}

jQuery(function ($) {
  $.fn.hScroll = function (amount) {
      amount = amount || 1200;
      $(this).bind("DOMMouseScroll mousewheel", function (event) {
          var oEvent = event.originalEvent, 
              direction = oEvent.detail ? oEvent.detail * -amount : oEvent.wheelDelta, 
              position = $(this).scrollLeft();
          position += direction > 0 ? -amount : amount;
          $(this).scrollLeft(position);
          event.preventDefault();
      })
  };
});

$(document).ready(function() {
  $('.scroll-h-auto').hScroll(200); // You can pass (optionally) scrolling amount

  $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});