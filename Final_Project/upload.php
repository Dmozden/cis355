 <?php
    if(isset($_FILES['image'])){
      $errors= array();
	  $move = __DIR__ . 'img/';
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 50000000){
         $errors[]='File size too large';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"./".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   } 
?>
<html>
   <body>
      <form action="upload.php" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" />
         <input type="submit"/>
		 
		 <ul>
            <li>Sent file: <?php echo $_FILES['image']['name'];  ?>
            <li>File size: <?php echo $_FILES['image']['size'];  ?>
            <li>File type: <?php echo $_FILES['image']['type'] ?>
         </ul>
		 <a class="btn" href="Index.php">Back</a>
      </form
   </body>
</html> 