<?php 
 include ('dbcon.php')
 ?>

<?php 

// adding data php
$adddatamsg=false;
$validationerror=false;
$updatemsg=false;

if($_SERVER['REQUEST_METHOD']=="POST"){
 
    if(isset($_POST['addbtn'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];

  
        // form validation
        if($name==""||empty($name) && $email==""||empty($email) && $phone==""||empty($phone) && $address==""||empty($address)){
          $validationerror=true;
        }else{
            $query="INSERT into `customer` (`name`,`email` , `phone`,`address` , `date`) values ('$name','$email' , '$phone' , '$address' , current_timestamp()) ";
            $result=mysqli_query($connection,$query);
            if(!$result){
                die("query failed due to" .mysqli_error($connection));
            }else{
              $adddatamsg=true;
            }
  
        }
      }
  };

// edit data php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['updatebtn'])){
        $id = $_POST['id']; 
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
    
    
        $query = "UPDATE `customer` SET `name` = '$name', `email` = '$email' , `phone` = '$phone' , `address` ='$address'   WHERE `customer`.`id` = '$id' ";
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
if(isset($_GET['id'])){
    $id=$_GET['id'];

$query="DELETE from `customer` where `id`='$id'";
$result=mysqli_query($connection,$query);

    if(!$result){
        die("query failed".mysqli_error($connection));
    }else{
        header('location:customer.php');
    }
} 

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
                            <h1>CUSTOMER SECTION</h1><hr>
                            <div class="row mt-2">
                                <div class="col-lg-6 mt-2">
                                    <button class="button"  data-bs-toggle="modal" data-bs-target="#exampleModal"><img class="img-fluid pe-1" src="https://img.icons8.com/?size=24&id=84991&format=png" alt="">ADD Customer</button>
                                    <!-- add modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Fill Details To add Customer</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                   
                                                    <form method="post" action="customer.php">
                                                        <!-- Name -->
                                                        <div class="mb-3">
                                                          <label for="name" class="form-label">Name</label>
                                                          <input type="text" class="form-control" name="name" placeholder="Enter your name" >
                                                        </div>
                                                    
                                                        <!-- Email -->
                                                        <div class="mb-3">
                                                          <label for="email" class="form-label">Email</label>
                                                          <input type="email" class="form-control" name="email" placeholder="Enter your email" >
                                                        </div>
                                                    
                                                        <!-- Phone -->
                                                        <div class="mb-3">
                                                          <label for="phone" class="form-label">Phone</label>
                                                          <input type="tel" class="form-control" name="phone" placeholder="Enter your phone number" >
                                                        </div>
                                                    
                                                        <!-- Address -->
                                                        <div class="mb-3">
                                                          <label for="address" class="form-label">Address</label>
                                                          <input class="form-control" name="address"  placeholder="Enter your address" ></textarea>
                                                        </div>
                                                    
                                                        <!-- Submit Button -->
                                                        <button  name="addbtn" type="submit" class="button">Submit</button>
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
                                <strong>Customer Added</strong>
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
                                <strong>Customer Data Updated </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                ';
                            };
                             ?>
                             </div>
                            <div class="table-responsive mt-1">
                                <table id="example" class="display pt-3" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $query="select * from `customer`";
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
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['phone'] ?></td>
                                                <td><?php echo $row['address'] ?></td>
                                                <td class="d-flex ">
                                                    <a href="" class="button" data-bs-toggle="modal" data-bs-target="#customeredit<?php echo $row['id'] ?>"><img style="height: 20px;" src="https://cdn-icons-png.flaticon.com/128/9308/9308015.png" alt=""></a>
                                                    <!-- edit modal -->
                                                        <div class="modal fade" id="customeredit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Fill Details To add Customer</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="post"  action="customer.php" >
                                                                        <div class="mb-3" style="display: none;">
                                                                            <label for="name" class="form-label">Db Id</label>
                                                                            <input type="text" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                                                                            </div>
                                                                            <!-- Name -->
                                                                            <div class="mb-3">
                                                                            <label for="name" class="form-label">Name</label>
                                                                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>">
                                                                            </div>
                                                                        
                                                                            <!-- Email -->
                                                                            <div class="mb-3">
                                                                            <label for="email" class="form-label">Email</label>
                                                                            <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                                                                            </div>
                                                                        
                                                                            <!-- Phone -->
                                                                            <div class="mb-3">
                                                                            <label for="phone" class="form-label">Phone</label>
                                                                            <input type="tel" class="form-control" name="phone" value="<?php echo $row['phone'] ?>">
                                                                            </div>
                                                                        
                                                                            <!-- Address -->
                                                                            <div class="mb-3">
                                                                            <label for="address" class="form-label">Address</label>
                                                                            <input class="form-control" id="address" name="address" value="<?php echo $row['address'] ?>" >
                                                                            </div>
                                                                        
                                                                            <!-- Submit Button -->
                                                                            <button  type="submit" name="updatebtn" class="button">Submit</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                   
                                                    <a href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)"  class="button" type="submit" ><img style="height: 20px;" src="https://cdn-icons-png.flaticon.com/128/6861/6861362.png" alt=""></a>
                                                    
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