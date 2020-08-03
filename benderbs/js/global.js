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

/**
 * Copy to Clipboard
 * From: https://stackoverflow.com/questions/23048550/how-to-copy-a-divs-content-to-clipboard-without-flash
 *
 * You can copy to clipboard almost in any browser from input elements only (elements that has .value property),
 * but you can’t from elements like <div>, <p>, <span>… (elements that has .innerHTML property).
 *
 * You use this trick to do so:
 *
 * 1. Create a temporary input element, say <textarea>.
 * 2. Copy innerHTML from <div> to the newly created <textarea>.
 * 3. Copy .value of <textarea> to clipboard.
 * 4. Remove the temporary <textarea> element we just created.
 */
function copyToClipboard(containerid) {
    // 1. Create a new textarea element and give it id='temp_element'
    var textarea = document.createElement('textarea')
    textarea.id = 'temp_element'
    // Optional step to make less noise on the page, if any!
    textarea.style.height = 0

    // 2. Now append it to your page somewhere, I chose <body>
    document.body.appendChild(textarea)
    // Give our textarea a value of whatever inside the div of id=containerid
    textarea.value = document.getElementById(containerid).innerText

    // 3. Now copy whatever inside the textarea to clipboard
    var selector = document.querySelector('#temp_element')
    selector.select()
    try {
        var success = document.execCommand('copy')
        if (success) {
            // 4. Remove the textarea
            document.body.removeChild(textarea)

            // Change tooltip message to "Copied!"
            return true
        } else {
            // Handle error. Perhaps change tooltip message to tell user to use Ctrl-c
            // instead.
            return false
        }
    } catch (err) {
        // Handle error. Perhaps change tooltip message to tell user to use Ctrl-c
        // instead.
        return false
    }
}

// Horizontal Scrolling
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
    // Horizontal Scrolling to layout
    $('.scroll-h-auto').hScroll(200); // You can pass (optionally) scrolling amount

    // Show tooltips in all site
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});