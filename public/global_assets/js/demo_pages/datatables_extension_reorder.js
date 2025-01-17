/* ------------------------------------------------------------------------------
 *
 *  # Reorder Columns extension for Datatables
 *
 *  Demo JS code for datatable_extension_reorder.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var DatatableColumnReorder = function() {


    //
    // Setup module components
    //

    // Basic Datatable examples
    var _componentDatatableColumnReorder = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        // Setting datatable defaults
        $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            columnDefs: [{
                orderable: false,
                width: 100,
                targets: [ 5 ]
            }],
            colReorder: true,
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Search:</span> _INPUT_',
                searchPlaceholder: 'Type to search...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
            }
        });

        // Apply custom style to select
        $.extend( $.fn.dataTableExt.oStdClasses, {
            "sLengthSelect": "custom-select"
        });


        // Basic column reorder
        $('.datatable-reorder').DataTable();


        // Realtime updating
        $('.datatable-reorder-realtime').DataTable({
            colReorder: {
                realtime: false
            }
        });


        // Save state after reorder
        $('.datatable-reorder-state-saving').DataTable({
            stateSave: true
        });


        // Predefined column ordering
        $('.datatable-reorder-predefined').DataTable({
            colReorder: {
                order: [1, 3, 2, 4, 0, 5]
            }
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentDatatableColumnReorder();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    DatatableColumnReorder.init();
});
