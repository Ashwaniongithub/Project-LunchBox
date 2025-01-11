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



// delete confirmation
           
function confirmDelete(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to the delete link with the ID
            window.location.href = "customer.php?id=" + id;
        }
    });
};

function confirmtiffinDelete(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to the delete link with the ID
            window.location.href = "tiffin_type.php?id=" + id;
        }
    });
};

function confirmorderDelete(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to the delete link with the ID
            window.location.href = "add_tiffin_order.php?id=" + id;
        }
    });
};

function confirmexpenseDelete(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to the delete link with the ID
            window.location.href = "expenses.php?id=" + id;
        }
    });
};



    // tiffin order table
    function calculateAmount() {
    // Get selected tiffin price
    const tiffinPrice = document.getElementById("tiffinType").value;

    // Get tiffin count
    const tiffinCount = document.getElementById("tiffinCount").value;

    // Calculate amount
    const amount = tiffinPrice && tiffinCount ? tiffinPrice * tiffinCount : "";

    // Set the amount in the input field
    document.getElementById("amount").value = amount ? `₹${amount}` : "";
}