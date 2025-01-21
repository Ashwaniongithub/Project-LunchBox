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
  
        };
        // header("location:customer.php?msg=Data Added Successfully");
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
                             if (isset($_GET['msg'])) {
                                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">'
                                    . htmlspecialchars($_GET['msg']) .
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                            };
                          
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
                                                <td >
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

<?php include ('footer.php') ?>