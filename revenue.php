<?php 
include ('dbcon.php')
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--========== BOX ICONS ==========-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <!--========== CSS ==========-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- DataTables CSS -->
         <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
            <!-- Buttons CSS -->
         <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.min.css">

        <link rel="stylesheet" href="css/style.css">
        <title>LunchBox</title>
    </head>
    <body>
        <!--========== HEADER ==========-->
        <header class="header">
            <div class="header__container">
                <img src="assets/img/perfil.jpg" alt="" class="header__img">

                <a href="#" class="header__logo">LunchBox</a>
    
                <div class="header__search">
                    <input type="search" placeholder="Search" class="header__input">
                    <i class='bx bx-search header__icon'></i>
                </div>
    
                <div class="header__toggle">
                    <i class='bx bx-menu' id="header-toggle"></i>
                </div>
            </div>
        </header>

        <!--========== NAV ==========-->
        <div class="nav" id="navbar">
            <nav class="nav__container">
                <div>
                    <a href="#" class="nav__link nav__logo">
                        <i class='bx bxs-disc nav__icon' ></i>
                        <span class="nav__logo-name">LUNCHBOX</span>
                    </a>
    
                    <div class="nav__list">
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Profile</h3>
    
                            <a href="dashboard.html" class="nav__link active">
                                <i class='bx bx-home nav__icon' ></i>
                                <span class="nav__name">Dashboard</span>
                            </a>
                            <a href="customer.html" class="nav__link ">
                                <i class='bx bx-group nav__icon' ></i>
                                <span class="nav__name">Customer</span>
                            </a>
                            <a href="tiffin_type.html" class="nav__link">
                                <i class='bx bx-food-menu nav__icon' ></i>
                                <span class="nav__name">Tiffin</span>
                            </a>
                            <a href="add_tiffin_order.html" class="nav__link">
                                <i class='bx bx-stats nav__icon' ></i>
                                <span class="nav__name">Tiffin Record</span>
                            </a>
                            <a href="expenses.html" class="nav__link">
                                <i class='bx bx-wallet nav__icon' ></i>
                                <span class="nav__name">Expenses</span>
                            </a>
                            <a href="revenue.html" class="nav__link">
                                <i class='bx bx-dollar nav__icon' ></i>
                                <span class="nav__name">Revenue</span>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="index.html" class="nav__link nav__logout">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <!--========== CONTENTS ==========-->
        <main>
            <section>
                <div class="content-card">
                    <div class="container-fluid container-text mt-3">
                      <div class="row">
                            <h1>REVENUE SECTION</h1><hr>
                            <div class="col-lg-6">
                                <form method="Post" action="revenue.php" class="row g-3 justify-content-center">
                                    <!-- From Date -->
                                    <div class="col-md-4">
                                        <label for="fromDate" class="form-label">From Date</label>
                                        <input type="date"  class="form-control" name="fromdate" required>
                                    </div>
                                    
                                    <!-- To Date -->
                                    <div class="col-md-4">
                                        <label for="toDate" class="form-label">To Date</label>
                                        <input type="date" name="todate" class="form-control" required>
                                    </div>
                                    
                                    <!-- Submit Button -->
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="submit" name="filterbtn" class="button">Filter</button>
                                    </div>
                                </form>
                            </div>
                      </div>

                      <div class="row mt-5 ">
                        <h4 class="text-left">Statistics</h4>
                        <div class="col-lg-4  text-center mt-3">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Total Expenses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <?php
                                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                            if(isset($_POST['filterbtn'])){
                                                $fromdate = $_POST['fromdate'];
                                                $todate = $_POST['todate'];

                                                $query = "SELECT SUM(amount) AS total_expenses 
                                                        FROM expense 
                                                        WHERE date >= '$fromdate' AND date <= '$todate'";
                                                $result = mysqli_query($connection, $query);

                                                // Fetch result
                                                $row = mysqli_fetch_assoc($result);
                                                $total_expenses = $row['total_expenses'] ?? 0;
                                                ?> 
                                                <td style="color: red;" >  <?php echo $row ['total_expenses'] ?? 0 ?> RS</td>
                                                
                                                <?php
                                                // Close connection
                                                mysqli_close($connection);
                                            }
                                        }

                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-4 text-center mt-3">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>Total Tiffin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td class="text-warning"><b>39</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-4 text-center mt-3">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>Total Profit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td class="text-success"><b>8282</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                      
                    </div>
                </div>
            </section>
        </main>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <!-- Buttons JS -->
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/vfs_fonts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.all.min.js"></script>

        <!--========== MAIN JS ==========-->
        <script src="js/script.js"></script>
    </body>
</html>










