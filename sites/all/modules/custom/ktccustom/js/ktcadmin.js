(function ($) {

    $(document).ready(function() {
        
        // add some extra js for the content edit pages
        // for example, showing/hiding document type fields
        // depending on what type of document it is.
        $('#edit-field-doc-type-und').change(function() {
            var doctype = $('#edit-field-doc-type-und option:selected').val();
            if (doctype == 24) {  // locally uploaded
                $('form.node-document-form div.field-widget-link-field').hide();
                $('form.node-document-form div.field-name-field-document-file').show();
            }
            else if (doctype == 25) {
                $('form.node-document-form div.field-widget-link-field').show();
                $('form.node-document-form div.field-name-field-document-file').hide();
            }
        });
        
    });
    
})(jQuery);