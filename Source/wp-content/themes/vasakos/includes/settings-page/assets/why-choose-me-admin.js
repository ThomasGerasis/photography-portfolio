jQuery(document).ready(function($) {
    'use strict';

    var rowIndex = $('.repeater-row').length;

    // Add new row
    $(document).on('click', '.add-repeater-row', function(e) {
        e.preventDefault();
        
        var template = $('#why-choose-me-row-template').html();
        template = template.replace(/{{INDEX}}/g, rowIndex);
        
        $('.repeater-items').append(template);
        rowIndex++;
        
        updateRowNumbers();
    });

    // Remove row
    $(document).on('click', '.remove-repeater-row', function(e) {
        e.preventDefault();
        
        if (confirm('Are you sure you want to remove this reason?')) {
            $(this).closest('.repeater-row').remove();
            updateRowNumbers();
        }
    });

    // Update row numbers
    function updateRowNumbers() {
        $('.repeater-row').each(function(index) {
            $(this).find('.repeater-row-title').text('Reason ' + (index + 1));
        });
    }

    // Make rows sortable (optional - requires jQuery UI)
    if ($.fn.sortable) {
        $('.repeater-items').sortable({
            handle: '.repeater-row-header',
            placeholder: 'repeater-row-placeholder',
            update: function(event, ui) {
                updateRowNumbers();
            }
        });
    }
});
