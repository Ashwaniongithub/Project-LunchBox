<?php 
include ('dbcon.php');
include ('header.php');
?>




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
                                                <td style="color: red;"   >  <?php echo $row ['total_expenses'] ?? 0 ?> RS</td>
                                                
                                                <?php
                                              
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
                                    <?php
                                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                            if(isset($_POST['filterbtn'])){
                                                $fromdate = $_POST['fromdate'];
                                                $todate = $_POST['todate'];

                                                $query = "SELECT SUM(tiffincount) AS total_tiffin
                                                        FROM tiffinorder 
                                                        WHERE date >= '$fromdate' AND date <= '$todate'";
                                                $result = mysqli_query($connection, $query);

                                                // Fetch result
                                                $row = mysqli_fetch_assoc($result);
                                                $total_tiffin = $row['total_tiffin'] ?? 0;
                                                ?> 
                                                <td style="color: orange;" >  <?php echo $row ['total_tiffin'] ?? 0 ?> </td>
                                                
                                                <?php
                                                // Close connection
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
                                    <th>Total Tiffin Sales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <?php
                                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                            if(isset($_POST['filterbtn'])){
                                                $fromdate = $_POST['fromdate'];
                                                $todate = $_POST['todate'];

                                                $query = "SELECT SUM(amount) AS total_amount
                                                        FROM tiffinorder
                                                        WHERE date >= '$fromdate' AND date <= '$todate'";
                                                $result = mysqli_query($connection, $query);

                                                // Fetch result
                                                $row = mysqli_fetch_assoc($result);
                                                $total_amount = $row['total_amount'] ?? 0;
                                                ?> 
                                                <td style="color: orange;"  >  <?php echo $row ['total_amount'] ?? 0 ?> </td>
                                                
                                                <?php
                                                
                                            }
                                        }

                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                      
                    <div class="row mt-2 d-flex justify-content-center">
                        <div class="col-lg-4">
                        <table class="table text-center table-bordered table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Profit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php
                                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                        if (isset($_POST['filterbtn'])) {
                                            $fromdate = $_POST['fromdate'];
                                            $todate = $_POST['todate'];

                                            // Query to calculate profit directly
                                            $query = "
                                                SELECT 
                                                    (IFNULL((SELECT SUM(amount) FROM tiffinorder WHERE date >= '$fromdate' AND date <= '$todate'), 0) - 
                                                    IFNULL((SELECT SUM(amount) FROM expense WHERE date >= '$fromdate' AND date <= '$todate'), 0)) AS profit
                                            ";

                                            $result = mysqli_query($connection, $query);

                                            if ($result) {
                                                $row = mysqli_fetch_assoc($result);
                                                $profit = $row['profit'] ?? 0;

                                                // Display profit
                                                ?>
                                              
                                                <td> <?php echo $profit; ?> RS</td>
                                                <?php
                                            } else {
                                                echo "Error: " . mysqli_error($connection);
                                            }

                                            // Close connection
                                            mysqli_close($connection);
                                        }
                                    }
                                    ?>
                                <!-- <td id="profit-box">0 </td> -->
                                </tr>   
                            </tbody>
                            </table> 
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </main>

        


<?php include 'footer.php' ?>









