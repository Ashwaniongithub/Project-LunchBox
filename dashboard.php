<?php include 'header.php' ?>
<?php include 'dbcon.php' ?>    
        <!--========== CONTENTS ==========-->
        <main>
            <section>
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-lg-4 mt-3 d-flex justify-content-center">
                                <div class="metric-card">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="metric-label">TOTAL CUSTOMERS</div>
                                            <?php 
                                             $query = "SELECT Count(*) AS customer_count 
                                             FROM customer ";
                                            $result = mysqli_query($connection, $query);

                                            // Fetch result
                                            $row = mysqli_fetch_assoc($result);
                                            $customer_count = $row['customer_count'] ;
                                            ?>
                                            <div class="metric-value"> <?php echo $row ['customer_count']  ?></div>
                                            <div class="metric-change">
                                                <span class="negative">↓ 3.48%</span>
                                                <span class="text-muted">Since last week</span>
                                            </div>
                                        </div>
                                        <div class="icon-circle">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-3  d-flex justify-content-center">
                                <div class="metric-card">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="metric-label">REVENUE </div>
                                            <div class="metric-value">2356 RS</div>
                                            <div class="metric-change">
                                                <span class="negative">↓ 3.48%</span>
                                                <span class="text-muted">Last Month</span>
                                            </div>
                                        </div>
                                        <div class="icon-circle" style="background-color: rgb(210, 253, 172);">
                                            <i style="color: green;" class="fa-solid fa-money-bill"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-3  d-flex justify-content-center">
                                <div class="metric-card">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                        <?php 
                                             $query = "SELECT sum(amount) AS total_expense 
                                             FROM expense ";
                                            $result = mysqli_query($connection, $query);

                                            // Fetch result
                                            $row = mysqli_fetch_assoc($result);
                                            $total_expense = $row['total_expense'] ;
                                            ?>
                                            <div class="metric-label">EXPENSE</div>
                                            <div class="metric-value"> <?php echo $row ['total_expense']  ?> RS</div>
                                            <div class="metric-change">
                                                <span class="negative">↓ 3.48%</span>
                                                <span class="text-muted">Till Now</span>
                                            </div>
                                        </div>
                                        <div class="icon-circle" style="background-color: rgb(255, 185, 185);">
                                            <i style="color: rgb(255, 5, 1);" class="fa-solid fa-wallet"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </main>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!--========== MAIN JS ==========-->
        <script src="js/script.js"></script>
    </body>
</html>