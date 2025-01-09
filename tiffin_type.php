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
        $price=$_POST['price'];

  
        // form validation
        if($name==""||empty($name) && $price==""||empty($price) ){
          $validationerror=true;
        }else{
            $query="INSERT into `tiffintype` (`name`,`price` , `date`) values ('$name','$price'  , current_timestamp()) ";
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
        $price=$_POST['price'];
    
        $query = "UPDATE `tiffintype` SET `name` = '$name', `price` = '$price'  WHERE `tiffintype`.`id` = '$id'";
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

$query="DELETE from `tiffintype` where `id`='$id'";
$result=mysqli_query($connection,$query);

    if(!$result){
        die("query failed".mysqli_error($connection));
    }else{
        header('location:tiffin_type.php');
    }
} 

?>

        <!--========== CONTENTS ==========-->
        <main>
            <section>
                <div class="content-card">
                    <div class="container-fluid container-text mt-3">
                      <div class="row">
                            <h1>TIFFIN SECTION</h1><hr>
                            <div class="row mt-2">
                                <div class="col-lg-6 mt-2">
                                    <button class="button"  data-bs-toggle="modal" data-bs-target="#exampleModal"><img class="img-fluid pe-1" src="https://img.icons8.com/?size=24&id=84991&format=png" alt="">ADD Tiffin Type</button>
                                    <!-- add modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Fill Details To add Customer</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="tiffin_type.php">
                                                        <!-- Name -->
                                                        <div class="mb-3">
                                                          <label for="name" class="form-label">Tiffin Name</label>
                                                          <input type="text" class="form-control" name="name" placeholder="Enter Tiffin name" >
                                                        </div>
                                                         <!-- Name -->
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Tiffin Price</label>
                                                            <input type="number" class="form-control" name="price" placeholder="Enter Tiffin Price" >
                                                        </div>
                                                        <!-- Submit Button -->
                                                        <button name="addbtn"  type="submit" class="button">Submit</button>
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
                                        <th>Tiffin Name</th>
                                        <th>Tiffin Price (RS Per TIFFIN)</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query="select * from `tiffintype`";
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
                                                <td><?php echo $row ['name'] ?></td>
                                                <td><?php echo $row ['price'] ?></td>
                                                <td>
                                                    <a href="" class="button" data-bs-toggle="modal" data-bs-target="#tiffinedit<?php echo $row['id'] ?>"><img style="height: 20px;" src="https://cdn-icons-png.flaticon.com/128/9308/9308015.png" alt=""></a>
                                                    <!-- edit modal -->
                                                        <div class="modal fade" id="tiffinedit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Fill Details To add Customer</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" action="tiffin_type.php">
                                                                            <div class="mb-3" style="display: none;">
                                                                            <label for="name" class="form-label">Db Id</label>
                                                                            <input type="text" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                                                                            </div>
                                                                        <!-- Name -->
                                                                        <div class="mb-3">
                                                                        <label for="name" class="form-label">Tiffin Name</label>
                                                                        <input type="text" class="form-control" name="name" value="<?php echo $row ['name'] ?>">
                                                                        </div>
                                                                        <!-- Name -->
                                                                        <div class="mb-3">
                                                                            <label for="name" class="form-label">Tiffin Price</label>
                                                                            <input type="number" class="form-control" name="price" value="<?php echo $row ['price'] ?>">
                                                                        </div>
                                                                        <!-- Submit Button -->
                                                                        <button name="updatebtn" type="submit" class="button">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    <a href="#"  onclick="confirmtiffinDelete(<?php echo $row['id']; ?>)"   class="button"><img style="height: 20px;" src="https://cdn-icons-png.flaticon.com/128/6861/6861362.png" alt=""></a>

                                                </td>
                                            </tr>
                                        <?php 
                                                }
                                            }
                                        ?>
                                    </tbody>
                                  </table>
                            </div>
                      </div>
                    </div>
                </div>
            </section>
        </main>

<?php include 'footer.php' ?>