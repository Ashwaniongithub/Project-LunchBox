/*==================== SHOW NAVBAR ====================*/
const showMenu = (headerToggle, navbarId) =>{
    const toggleBtn = document.getElementById(headerToggle),
    nav = document.getElementById(navbarId)
    
    // Validate that variables exist
    if(headerToggle && navbarId){
        toggleBtn.addEventListener('click', ()=>{
            // We add the show-menu class to the div tag with the nav__menu class
            nav.classList.toggle('show-menu')
            // change icon
            toggleBtn.classList.toggle('bx-x')
        })
    }
}
showMenu('header-toggle','navbar')

/*==================== LINK ACTIVE ====================*/
const linkColor = document.querySelectorAll('.nav__link')

function colorLink(){
    linkColor.forEach(l => l.classList.remove('active'))
    this.classList.add('active')
}

linkColor.forEach(l => l.addEventListener('click', colorLink))



// datatable js
$(document).ready(function () {
  // Initialize DataTable
  var table = $('#example').DataTable({
      buttons: [
          {
              extend: 'excelHtml5',
              title: 'LunchBox',
              exportOptions: {
                  columns: ':not(:last-child)' // Exclude the last column
              }
          },
          {
              extend: 'pdfHtml5',
              title: 'LunchBox',
              exportOptions: {
                  columns: ':not(:last-child)' // Exclude the last column
              }
          },
          {
              extend: 'print',
              title: 'LunchBox',
              exportOptions: {
                  columns: ':not(:last-child)' // Exclude the last column
              }
          }
      ]
  });

  // Custom Button Handlers
  $('#btnExcel').on('click', function () {
      table.button('.buttons-excel').trigger();
  });

  $('#btnPDF').on('click', function () {
      table.button('.buttons-pdf').trigger();
  });

  $('#btnPrint').on('click', function () {
      table.button('.buttons-print').trigger();
  });
});



//   sweet alert js
function showSuccessAlert() {
    Swal.fire({
        title: 'Success!',
        text: 'Data has been added successfully',
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#3085d6',
        timer: 2000,
        timerProgressBar: true,
        toast: false,
        position: 'center',
        showConfirmButton: true
    }).then((result) => {
        // You can handle post-alert actions here
        if (result.isConfirmed) {
            // Do something when user clicks OK
            console.log('User clicked OK');
        }
    });
}



// delete sweet alert
document.getElementById('delete-button').addEventListener('click', function () {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
    }).then((result) => {
      if (result.isConfirmed) {
        // Handle the deletion logic here
        Swal.fire(
          'Deleted!',
          'Your data has been deleted.',
          'success'
        );
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire(
          'Cancelled',
          'Your data is safe :)',
          'error'
        );
      }
    });
  });