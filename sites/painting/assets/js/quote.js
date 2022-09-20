$(function () {
    
    "use strict";

    // init the validator
    $('#quote-contact').validator();

    // when the form is submitted
    $('#quote-contact').on('submit', function (e) {

        // if the validator does not prevent form submit
        if (!e.isDefaultPrevented()) {
            var url = "assets/php/quote.php";

            // POST values in the background the the script URL
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data)
                {

                    // data = JSON object that contact.php returns
                    $( "#msgSubmit1" ).removeClass( "hidden" );
                    $('#quote-contact')[0].reset();
                    
                }
            });
            return false;
        }
    })
});