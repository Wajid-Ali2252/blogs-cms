<?php include "header.php"; 
include "config.php";
$error=array();
if(isset($_POST['submit']))

{
    $title=mysqli_real_escape_string($conn,$_POST['post_title']);
    $desc=mysqli_real_escape_string($conn,$_POST['postdesc']);
    $category=mysqli_real_escape_string($conn,$_POST['category']);
    $date=date('d M,Y');
    $author=$_SESSION['user_id'];
    if(isset($_FILES['fileToUpload']))
    {
        $filename=$_FILES['fileToUpload']['name'];
        $filesize=$_FILES['fileToUpload']['size'];
        $file_tmp=$_FILES['fileToUpload']['tmp_name'];
        $filetype=$_FILES['fileToUpload']['type'];
        $file_ext=end(explode('.',$filename));
        $extentions=array("jpeg","jpg","png");
        if(in_array($file_ext,$extentions)==false)
        {
             $error[]="This Extension File In Not Allowed";
        }
        if($filesize>2097152)
        {
            $error[]="File Size Must Be 2MB or Lower";
        }
        if(empty($error)==true)
        {
            move_uploaded_file($file_tmp,"upload/".$filename);
        }
        else{
            print_r($error);
            die();
        }

    }
    $sql="INSERT INTO post(title,description,category,post_date,author,post_img)
    VALUES('$title','$desc','$category','$date','$author','$filename');";

    $sql.="UPDATE category SET post=post+1";
    $data=mysqli_multi_query($conn,$sql);


}

?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                            <?php
                            $sql="SELECT * FROM category";
                            $res=mysqli_query($conn,$sql);
                            if(mysqli_num_rows($res))
                            {
                  while($row=mysqli_fetch_assoc($res))
                  {
         echo "<option value='{$row['category_id']}' selected>{$row['category_name']}</option>";
}
}
                            ?>
                              
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
