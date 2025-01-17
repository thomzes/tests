/* ------------------------------------------------------------------------------
 *
 *  # Scroller extension for Datatables
 *
 *  Demo JS code for datatable_extension_scroller.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var DatatableScroller = function() {


    //
    // Setup module components
    //

    // Basic Datatable examples
    var _componentDatatableScroller = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        // Datatable defaults
        $.extend( $.fn.dataTable.defaults, {
            columnDefs: [
                {
                    width: 100,
                    targets: [ 0 ]
                },
                {
                    width: "23%",
                    targets: [ 1, 2, 3, 4 ]
                }
            ],
            dom: '<"datatable-header info-right"fi><"datatable-scroll"t>',
            ajax: '../../../../global_assets/demo_data/tables/datatable_2500.json',
            deferRender: true,
            scroller: true,
            scrollY: 419,
            scrollCollapse: true,
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


        // Table setup
        // ------------------------------

        // Basic scroller demo
        $('.datatable-scroller').DataTable();


        // Scroller with Buttons extension
        $('.datatable-scroller-buttons').DataTable({
            dom: '<"datatable-header dt-buttons-right"fB><"datatable-scroll"tS><"datatable-footer"i>',
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-light'
                    }
                },
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel'},
                    {extend: 'pdf'},
                    {extend: 'print'}
                ]
            }
        });


        // Saving state in scroller
        $('.datatable-scroller-state').DataTable({
            stateSave: true
        });


        // Using Scroller API
        $('.datatable-scroller-api').DataTable({
            stateSave: true,
            initComplete: function () {
                var api = this.api();
                api.scroller().scrollToRow(1000);
            }
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentDatatableScroller();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    DatatableScroller.init();
});
