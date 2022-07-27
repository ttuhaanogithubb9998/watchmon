
<h1> HOME Page   </h1>

<a href="/admin/product">San pham</a>

<?php


for($i=0;$i<3;$i++){
    $s = new DateTime();
    var_dump($s);
    $time =  $s->format('Y-m-d H:i:s.u');
    var_dump(md5($time));
}
 ?>
 <form action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>