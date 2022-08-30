<?php include "header.php";
include "config.php";

if(isset($_POST['submit']))
{
    $cat_id=$_POST['cat_id'];
    $cat_name=mysqli_real_escape_string($conn,$_POST['cat_name']);

    echo $sql1="UPDATE category SET category_name='$cat_name' WHERE category_id=$cat_id ";
    $data=mysqli_query($conn,$sql1) or die('query Faied');
    if($data)
    {
        header('location:category.php');
    }


}




$id=$_GET['id'];
$sql="SELECT * FROM category Where category_id='$id'";
$res=mysqli_query($conn,$sql)

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="" method ="POST">
                  <?php 
                          if(mysqli_num_rows($res) > 0)
                          {
                            while($row=mysqli_fetch_assoc($res))
                            {

                                ?>
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id']; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          
                 <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'];?>"  placeholder="" required>
                      
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                      <?php
                          
                        }
                    }
                          ?>
                </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
