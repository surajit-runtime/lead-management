/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Table editable Init Js File
*/

// table edits table


// -----------------------------------------------------------------------------------------correct js start-------------------------------------------------------------
    

// $(function () {
//     var pickers = {};
  
//     const callCenterValues = {
//         'Call Center 1': 1,
//         'Call Center 2': 2,
//         'Call Center 3': 3,
//         'Call Center 4': 4
//     };
    
  
//     $('.table-edits tr').editable({
//       dropdowns: {
//         zone: ['Call Center 1', 'Call Center 2', 'Call Center 3', 'Call Center 4']
//       },
//       edit: function (values, cell) {
//         // Convert the call center name to its corresponding value
//         values.zone = callCenterValues[values.zone];
  
//         $(".edit i", this)
//           .removeClass('fa-pencil-alt')
//           .addClass('fa-save')
//           .attr('title', 'Save');
//       },
//       save: function (values, cell) {
       
//         var row = $(this);
//         var z_id = callCenterValues[values.zone];
//         $(".edit i", this)
//           .removeClass('fa-save')
//           .addClass('fa-pencil-alt')
//           .attr('title', 'Edit');
  
//         if (this in pickers) {
//           pickers[this].destroy();
//           delete pickers[this];
//         }
  
//         Swal.fire({
//           title: 'Confirm Update',
//           text: 'Do you want to assign this Call Center?',
//           icon: 'question',
//           showCancelButton: true,
//           confirmButtonText: 'Yes',
//           cancelButtonText: 'No'
//         }).then((result) => {
//           if (result.isConfirmed) {
//             $.ajax({
//                 type: 'POST',
//                 url:'update-zone', // Replace with your Laravel route URL
//                 data: {
//                     id: row.data('id'),
//                     zone_id: z_id
//                 },
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 },
//                 success: function (response) {
//                     // alert(response);
                    
//                     if (response.success) {
//                         // alert( row.data('id'));
//                         // alert(zone);
//                         $("#rowsno-"+row.data('id')).css({"display":"none"});
//                         Swal.fire('Success', 'Call Center assigned successfully!', 'success');
//                     } else {
//                         // alert( );
//                         // alert(zone);
//                         Swal.fire('Error',' Failed to assign the Call Center!', 'error');
//                     }
//                 },
//                 // error: function () {
//                 //     alert( row.data('id'));
//                 //     alert(zone);
//                 //     Swal.fire('Error', 'An error occurred while updating the zone.', 'error');
//                 // }
//                 error: function (jqXHR, textStatus, errorThrown) {
//                     // alert( row.data('id'));
//                     // alert(zone);
//                      var errorMessage = 'An error occurred while assigning the Call Center.';
//                     // var errorMessage = jqXHR.responseJSON.error;
//                     if (jqXHR.responseJSON && jqXHR.responseJSON.error) {
//                         errorMessage = jqXHR.responseJSON.error;
//                     }
//                     Swal.fire('Error', errorMessage, 'error');
//                 }
                
//             });
//           }
//         });
//       },
//       cancel: function (values) {
//         $(".edit i", this)
//           .removeClass('fa-save')
//           .addClass('fa-pencil-alt')
//           .attr('title', 'Edit');
  
//         if (this in pickers) {
//           pickers[this].destroy();
//           delete pickers[this];
//         }
//       }
//     });


    

//   });
  
// -----------------------------------------------------------------------------------------correct js end-------------------------------------------------------------


$(function () {
  var pickers = {};

  const callCenterValues = {
      'Call Center 1': 1,
      'Call Center 2': 2,
      'Call Center 3': 3,
      'Call Center 4': 4
  };
  

  $('.table-edits tr').editable({
    dropdowns: {
      zone: ['Call Center 1', 'Call Center 2', 'Call Center 3', 'Call Center 4']
    },
    edit: function (values, cell) {
      // Convert the call center name to its corresponding value
      values.zone = callCenterValues[values.zone];

      $(".edit i", this)
        .removeClass('fa-pencil-alt')
        .addClass('fa-save')
        .attr('title', 'Save');
    },
    save: function (values, cell) {
     
      var row = $(this);
      var z_id = callCenterValues[values.zone];
      $(".edit i", this)
        .removeClass('fa-save')
        .addClass('fa-pencil-alt')
        .attr('title', 'Edit');

      if (this in pickers) {
        pickers[this].destroy();
        delete pickers[this];
      }

      Swal.fire({
        title: 'Confirm Update',
        text: 'Do you want to assign this Call Center?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
              type: 'POST',
              url:'update-zone', // Replace with your Laravel route URL
              data: {
                  id: row.data('id'),
                  zone_id: z_id
              },
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function (response) {
                  // alert(response);
                  
                  if (response.success) {
                      // alert( row.data('id'));
                      // alert(zone);
                       $("#rowsno-"+row.data('id')).css({"display":"none"});
                    
   
    

                      Swal.fire('Success', 'Call Center assigned successfully!', 'success');

                     
                  } else {
                      // alert( );
                      // alert(zone);
                      Swal.fire('Error',' Failed to assign the Call Center!', 'error');
                  }
              },
              // error: function () {
              //     alert( row.data('id'));
              //     alert(zone);
              //     Swal.fire('Error', 'An error occurred while updating the zone.', 'error');
              // }
              error: function (jqXHR, textStatus, errorThrown) {
                  // alert( row.data('id'));
                  // alert(zone);
                   var errorMessage = 'An error occurred while assigning the Call Center.';
                  // var errorMessage = jqXHR.responseJSON.error;
                  if (jqXHR.responseJSON && jqXHR.responseJSON.error) {
                      errorMessage = jqXHR.responseJSON.error;
                  }
                  Swal.fire('Error', errorMessage, 'error');
              }
              
          });
        }
      });
    },
    cancel: function (values) {
      $(".edit i", this)
        .removeClass('fa-save')
        .addClass('fa-pencil-alt')
        .attr('title', 'Edit');

      if (this in pickers) {
        pickers[this].destroy();
        delete pickers[this];
      }
    }
  });

  var selectedIDs = [];

  // When individual checkbox is checked/unchecked
  $('.editor-active').on('change', function() {
      var id = $(this).val();

      if ($(this).is(':checked')) {
          selectedIDs.push(id); // Add ID to the selectedIDs array
      } else {
          var index = selectedIDs.indexOf(id);
          if (index > -1) {
              selectedIDs.splice(index, 1); // Remove ID from the array
          }
      }
  });

  // When "Select All" checkbox is clicked
  $('#select-all').on('change', function() {
      $('.editor-active').prop('checked', $(this).prop('checked')); // Check/Uncheck all checkboxes

      if ($(this).is(':checked')) {
          // Add all IDs to the selectedIDs array
          selectedIDs = $('.editor-active').map(function() {
              return this.value; // Collect values directly, not the jQuery object
          }).get();
      } else {
          selectedIDs = []; // Clear the selected IDs array
      }
  });

  

});
