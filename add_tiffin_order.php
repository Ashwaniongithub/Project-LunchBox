<?php 
 include ('dbcon.php');
 include ('header.php')
 ?>

<?php 
// adding data php
$adddatamsg=false;
$validationerror=false;
$updatemsg=false;

if($_SERVER['REQUEST_METHOD']=="POST"){
 
    if(isset($_POST['addbtn'])){
        $customer=$_POST['customer'];
        $date=$_POST['date'];
        $mealtime=$_POST['mealtime'];
        $tiffinname=$_POST['tiffinname'];
        $tiffinprice=$_POST['tiffinprice'];
        $tiffincount=$_POST['tiffincount'];
        $amount=$_POST['amount'];
        $status=$_POST['status'];

        // form validation
        if($customer==""||empty($customer) && $date==""||empty($date) && $mealtime==""||empty($mealtime) && $tiffinname==""||empty($tiffinname) && $tiffincount==""||empty($tiffincount) ){
          $validationerror=true;
        }else{
            $query="INSERT into `tiffinorder` (`customer`,`date` , `mealtime` , `tiffinname` , `tiffinprice` , `tiffincount` , `amount` , `status`) values ('$customer','$date' , '$mealtime' ,'$tiffinname' ,'$tiffinprice'  , '$tiffincount' , '$amount' , '$status' )";
            $result=mysqli_query($connection,$query);
            if(!$result){
                die("query failed due to" .mysqli_error($connection));
            }else{
              $adddatamsg=true;
            }
  
        }
      }
  };


// edit data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['updatebtn'])){
        $id = $_POST['id']; 
        $mealtime=$_POST['mealtime'];
        $tiffintype=$_POST['tiffintype'];
        $tiffincount=$_POST['tiffincount'];
        $status=$_POST['status'];
    
        $query = "UPDATE `tiffinorder` SET  `mealtime` ='$mealtime' , `tiffintype` ='$tiffintype' , `tiffincount` ='$tiffincount' , `status`='$status'  WHERE `tiffinorder`.`id` = '$id'";
        $result = mysqli_query($connection, $query);
    
        if ($result) {
            // header("Location:customer.php");
            $updatemsg=true;
            
        } else {
            echo "Error updating record: " . mysqli_error($connection);
        }
    }
  }



// delete data php
// delete data php
if(isset($_GET['id'])){
    $id=$_GET['id'];

$query="DELETE from `tiffinorder` where `id`='$id'";
$result=mysqli_query($connection,$query);

    if(!$result){
        die("query failed".mysqli_error($connection));
    }else{
        // header('location:add_tiffin_order.php');
    }
} 



?>


<?php

// Initialize price variable
$price = '';

// Fetch items from the database
$items = [];
$sql = "SELECT name, price FROM tiffintype"; 
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[$row['name']] = $row['price'];
    }
}

?>




        <!--========== CONTENTS ==========-->
        <main>
            <section>
                <div class="content-card">
                    <div class="container-fluid container-text mt-3">
                      <div class="row">
                            <h1>ADD TIFFIN SECTION</h1><hr>
                            <div class="row mt-2">
                                <div class="col-lg-6 mt-2">
                                    <button class="button"  data-bs-toggle="modal" data-bs-target="#exampleModal"><img class="img-fluid pe-1" src="https://img.icons8.com/?size=24&id=84991&format=png" alt="">ADD TIFFIN order</button>
                                    <!-- add modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Fill Details To Tiffin Order</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="add_tiffin_order.php">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Select Customer</label>
                                                            <select class="form-select" name="customer" aria-label="Default select example">
                                                                <option >Open this select Customer</option>
                                                                <?php
                                                                    $query="select * from `customer`";
                                                                    $result=mysqli_query($connection, $query);
                                                                    if(!$result){
                                                                        die("Query failed due to" .mysqli_error($connection));
                                                                    }else{
                                                                        while($row=mysqli_fetch_assoc($result)){
                                                                ?>
                                                                <option value="<?php echo $row['name']?>"><?php echo $row['name']  ?></option>
                                                                <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                         <!-- Name -->
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Date</label>
                                                            <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d'); ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Select Meal Time</label>
                                                            <select class="form-select" name="mealtime" aria-label="Default select example">
                                                                <option >Open this select  time</option>
                                                                <option value="Lunch">Lunch</option>
                                                                <option value="Dinner">Dinner</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Select Tiffin Name</label>
                                                            <select class="form-select" id="name" name="tiffinname" aria-label="Default select example" onchange="updatePrice()">
                                                                <option value="" selected>Select Tiffin</option>
                                                            <?php foreach ($items as $itemName => $itemPrice) { ?>
                                                                    <option value="<?php echo $itemName; ?>"><?php echo $itemName; ?></option>
                                                                    <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Tiffin Price</label>
                                                            <input type="text" class="form-control" id="price" name="tiffinprice" value="<?php echo $price; ?>" placeholder="Price">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Tiffin Count</label>
                                                            <input type="text" class="form-control" id="count" name="tiffincount" placeholder="Enter Tiffin Count">
                                                        </div>
                                                        <!-- Amount -->
                                                        <div class="mb-3">
                                                            <label for="amount" class="form-label">Amount</label>
                                                            <input type="text" id="amount" name="amount" class="form-control" readonly placeholder="Amount will be calculated">
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Select Status</label>
                                                            <select class="form-select" name="status"  aria-label="Default select example">
                    
                                                                <option selected value="Delivered">Delivered</option>
                                                                <option value="Pending">Pending</option>
                                                                <option value="Cancel">Cancel</option>
                                                            </select>
                                                        </div>
                                                        <!-- Submit Button -->
                                                        <button name="addbtn" type="submit" class="button">Submit</button>
                                                      </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-6 mt-2 d-flex justify-content-end">
                                    <div class="custom-buttons">
                                        <button class="button"  id="btnExcel"><img style="height: 20px;" src="https://img.icons8.com/?size=48&id=117561&format=png" alt="">Excel</button>
                                        <button class="button" id="btnPDF"><img src="https://img.icons8.com/?size=80&id=d2H6kHCiPSIg&format=png" style="height: 20px;" alt="">PDF</button>
                                        <button class="button" id="btnPrint"><img src="https://img.icons8.com/?size=32&id=tJ0vYdxun5fl&format=png" style="height: 20px;" alt="">Print</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 mb-3"> 
                                 <!-- alert message php -->
                            <?php
                            if($adddatamsg){
                                echo '
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Tiffin Added</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                ';
                            };
                            if($validationerror){
                                echo '
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Please Fill The Full Form </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                ';
                            };
                           
                            if($updatemsg){
                                echo '
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Tiffin Data Updated </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                ';
                            };
                             ?>
                            </div>
                            <div class="table-responsive mt-2">
                                <table id="example" class="display pt-3" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>Sr no.</th>
                                        <th>Customer Name</th>
                                        <th>Date</th>
                                        <th>Meal Time</th>
                                        <th>Tiffin Name</th>
                                        <th>Tiffin Price</th>
                                        <th>Tiffin Count</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $query="select * from `tiffinorder`";
                                            $result=mysqli_query($connection, $query);
                                            $sno=0;
                                            if(!$result){
                                                die("Query failed due to" .mysqli_error($connection));
                                            }else{
                                                while($row=mysqli_fetch_assoc($result)){
                                                $sno=$sno + 1;
                                         ?>
                                            <tr>
                                                <td><?php echo $sno ?></td>
                                                <td><?php echo $row ['customer'] ?></td>
                                                <td><?php echo $row ['date'] ?></td>
                                                <td><?php echo $row ['mealtime'] ?></td>
                                                <td><?php echo $row ['tiffinname'] ?></td>
                                                <td><?php echo $row ['tiffinprice'] ?></td>
                                                <td><?php echo $row ['tiffincount'] ?></td>
                                                <td><?php echo $row ['amount'] ?></td>
                                                <td><?php echo $row ['status'] ?></td>
                                                <td>
                                                    <a href="" class="button" data-bs-toggle="modal" data-bs-target="#tiffinorderedit<?php echo $row['id'] ?>"><img style="height: 20px;" src="https://cdn-icons-png.flaticon.com/128/9308/9308015.png" alt=""></a>
                                                    <!-- edit modal -->
                                                        <div class="modal fade" id="tiffinorderedit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Fill Details To add Customer</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="add_tiffin_order.php">
                                                                    <div class="mb-3" style="display: none;" >
                                                                    <label for="name" class="form-label">Db Id</label>
                                                                    <input type="text" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                                                                    </div>
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Select Customer</label>
                                                                            <select class="form-select" name="customer"  aria-label="Default select example" disabled>
                                                                                <option selected><?php echo $row['customer'] ?></option>      
                                                                            </select>
                                                                        </div>
                                                                        <!-- Name -->
                                                                        <div class="mb-3">
                                                                            <label for="name" class="form-label">Date</label>
                                                                            <input type="date" class="form-control" name="date" value="<?php echo $row['date']  ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Select Meal Time</label>
                                                                            <select class="form-select" name="mealtime"  aria-label="Default select example">
                                                                                <option selected><?php echo $row['mealtime']  ?></option>
                                                                                <option value="Lunch">Lunch</option>
                                                                                <option value="Dinner">Dinner</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Enter Tiffin Count</label>
                                                                            <input type="number" name="tiffincount" id="" value="<?php echo $row['tiffincount']  ?>" class="form-control">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Select Status</label>
                                                                            <select class="form-select" name="status" aria-label="Default select example">
                                                                                <option selected><?php echo $row ['status'] ?></option>
                                                                                <option value="Delivered">Delivered</option>
                                                                                <option value="Pending">Pending</option>
                                                                                <option value="Cancel">Cancel</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Select Tiffin Type</label>
                                                                            <select class="form-select" name="tiffintype" aria-label="Default select example">
                                                                                <option selected></option>
                                                                                
                                                                            </select>
                                                                        </div>
                                                                        
                                                                       
                                                                        <!-- Submit Button -->
                                                                        <button  type="submit" name="updatebtn" class="button">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    <a href="#" onclick="confirmorderDelete(<?php echo $row['id']; ?>)" class="button"><img style="height: 20px;" src="https://cdn-icons-png.flaticon.com/128/6861/6861362.png" alt=""></a>

                                                </td>
                                            </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                      <!-- Add more rows as needed -->
                                    </tbody>
                                  </table>
                            </div>
                      </div>
                    </div>
                </div>
            </section>
        </main>

  



<script type="text/javascript">
        function updatePrice() {
            // Get selected item name
            var itemName = document.getElementById('name').value;

            // Define a mapping of items and prices (use PHP data for this)
            var items = <?php echo json_encode($items); ?>;

            // Get the price for the selected item
            if (items[itemName]) {
                document.getElementById('price').value = items[itemName];
            } else {
                document.getElementById('price').value = '';
            }
        }
    </script>
   <script>
    // Get input elements
    const priceInput = document.getElementById('price');
    const countInput = document.getElementById('count');
    const amountInput = document.getElementById('amount');

    // Add event listeners
    priceInput.addEventListener('input', calculateAmount);
    countInput.addEventListener('input', calculateAmount);

    function calculateAmount() {
        // Get values
        const price = parseFloat(priceInput.value) || 0;
        const count = parseInt(countInput.value) || 0;

        // Calculate amount
        const amount = price * count;

        // Update amount input
        amountInput.value = amount.toFixed(2); // Format to 2 decimal places
    }
</script>
<?php include ('footer.php') ?>