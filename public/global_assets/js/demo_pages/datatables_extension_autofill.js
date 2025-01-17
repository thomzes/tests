/* ------------------------------------------------------------------------------
 *
 *  # Autofill extension for Datatables
 *
 *  Demo JS code for datatable_extension_autofill.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var DatatableAutofill = function() {


    //
    // Setup module components
    //

    // Basic Datatable examples
    var _componentDatatableAutofill = function() {
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
            dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
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


        // Basic initialization
        $('.datatable-autofill-basic').DataTable({
            autoFill: true
        });


        // Always confirm action
        $('.datatable-autofill-confirm').DataTable({
            autoFill: {
                alwaysAsk: true
            },
        });


        // Click focus
        $('.datatable-autofill-click').DataTable({
            autoFill: {
                focus: 'click'
            }
        });


        // Column selector
        $('.datatable-autofill-column').DataTable( {
            columnDefs: [
                {
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                },
                {
                    orderable: false,
                    width: 100,
                    targets: 6
                }
            ],
            select: {
                style: 'os',
                selector: 'td:first-child'
            },
            order: [[1, 'asc']],
            autoFill: {
                columns: ':not(:first-child)'
            }
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentDatatableAutofill();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    DatatableAutofill.init();
});
