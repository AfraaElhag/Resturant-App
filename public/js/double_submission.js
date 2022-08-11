    // jQuery plugin to prevent double submission of forms
    jQuery.fn.preventDoubleSubmission = function() {
        $(this).on('submit',function(e){
            var $form = $(this);

            if ($form.data('submitted') === true) {
                // Previously submitted - don't submit again
                e.preventDefault();
                
            } else {
                // Mark it so that the next submit can be ignored

                $form.data('submitted', true);
                $form.find("button").append('<span class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></span>');
               
            }
        });

        // Keep chainability
        return this;
    };
        $('#add').preventDoubleSubmission();
        $('#login').preventDoubleSubmission();
        $('#signup').preventDoubleSubmission();
        $('#inputform').preventDoubleSubmission();
        $('#profile').preventDoubleSubmission();
        $('#checkout').preventDoubleSubmission();
        $('#delivery_type').preventDoubleSubmission();
        $('#edit_time').preventDoubleSubmission();
        $('#product').preventDoubleSubmission();
        $('#edit_product').preventDoubleSubmission();

