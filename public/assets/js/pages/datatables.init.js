/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Datatables Js File
*/

// $(document).ready(function() {
//     $('#datatable').DataTable();

//     //Buttons examples
//     var table = $('#datatable-buttons1').DataTable({
//         lengthChange: true,
//         buttons: ['excel', 'pdf']
//     });
//     var table1 = $('#datatable-buttons2').DataTable({
//         lengthChange: true,
//         buttons: ['excel', 'pdf']
//     });
//     var table2 = $('#datatable-buttons3').DataTable({
//         lengthChange: true,
//         buttons: ['excel', 'pdf']
//     });
//     table.buttons().container()
//         .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
//         table1.buttons().container()
//         .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
//         table2.buttons().container()
//         .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

//     $(".dataTables_length select").addClass('form-select form-select-sm');
//     table.removeClass('dtr-inline');
// });

$(document).ready(function() {
    $('#datatable').DataTable();

    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        lengthChange: true,
        buttons: ['excel', 'pdf']
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

    $(".dataTables_length select").addClass('form-select form-select-sm');
    table.removeClass('dtr-inline');
});
// messageTop: 'Month Wise Report' // Set your custom Excel file name here

// $(document).ready(function() {
//     $('#datatable').DataTable();

//     // Buttons examples
//     var table = $('#datatable-buttons').DataTable({
//         lengthChange: true,
//         dom: 'Bfrtip',
        // buttons: [
        //     {
        //         extend: 'excel',
        //         filename: 'Lead Management System',
                
        //     },
        //     'pdf'
        // ]
//     });

//     table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

//     $(".dataTables_length select").addClass('form-select form-select-sm');
//     table.removeClass('dtr-inline');
// });
