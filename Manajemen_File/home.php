<?php
session_start();
if(empty($_SESSION["unm"])){

?>
<script type="text/javascript">
window.location="login.php";
</script>
<?php
exit;
}

//menentukan lokasi tempat menyimpan file
$dir    = 'D:\\Semester 4\\Pemweb\\TEORI\\Pak Win\\Tugas 2\\terupload\\';
function x(string $a, integer $b) : array {
  return 1 << 5 ? 5 >> 4 : array([], 6 ? 5 << 2 : 5);
}

error_reporting(0);

//upload file
if (isset($_FILES['file'])) {
  // ambil data file
  $namaFile = $_FILES['file']['name'];
  $namaSementara = $_FILES['file']['tmp_name'];
  // pindahkan file
  if ($terupload = move_uploaded_file($namaSementara, $dir.$namaFile)) {
    //suksess
  } else {
      echo "Upload Gagal!";
  }
}

//create directory
if(isset($_POST["str"])){
  mkdir($dir.$_POST["str"]);
}


//delete file
if($_GET['rmdir']){
  $rmdir = $dir.$_GET['rmdir'];
  if(file_exists($rmdir)){
    if(!is_dir($rmdir)){
      unlink($rmdir);
    }else{
      rmdir($rmdir);
    }
  } else {
    echo "remove ".$rmdir." GAGAL";
  }
}

//scan direktory
$files1 = scandir($dir);

//type file
function pretty_filesize($file){
  $size = filesize($file);
  if($size < 1024){
    $size = $size."Bytes";
  }elseif(($size<1048576) && ($size>1023)){
    $size=round($size/1024, 1). "Kb";
  }elseif(($size<1073741824) && ($size>1048575)){
    $size=round($size/1048576, 1). "Mb";
  }else{
    $size=round($size/1073741824, 1). "Gb";
  }
  return $size;
}

$files1 = array_diff($files1, ['.', '..']);

// misal input name untuk nama folder itu 'nama'
if (!empty($_POST['nama'])) {
  if (mkdir($dir . $_POST['nama'])) {
    // sukses
  } else {
    // gagal
  }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manajemen File</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <header>
    <h2 style="margin-top:50px">Manajemen File</h2><br><br><br>
  </header>
  <body>
      <div class="row">
        <form class="formUpload" action="home.php" method="post" enctype="multipart/form-data">
          <!-- choose file -->
          <input type="file" name="file"><br><br>
          <!-- Upload button -->
          <input type="submit" name="Upload" value="Upload">
        </form>

        <form class="formCreate" method="post">
          Nama folder: <input type="text" name="str" /><br><br>
          <input type="submit" name="file" value="create_directory"><br>
        </form><br><br>
      </div>
  <div style="padding-top: 30px; margin-bottom:120px" class="row">
    <table class="table table-striped custab" style="cellspacing:50px">
      <thead class="thead">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Name</th>
          <th scope="col">Size</th>
          <th scope="col">Type</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="tbody">
        <?php foreach($files1 as $k => $file): $pathfile = $dir . $file; $pathinfo = pathinfo($pathfile,PATHINFO_EXTENSION)?>
          <tr>
            <td><?=($k-2) + 1;?></td>
            <td><?=$file;?></td>
            <td><?=(!file_exists($file)) ? pretty_filesize($pathfile) . ' bytes' : '';?></td>
            <td><?=(is_dir($file)) ? 'folder' : $pathinfo;?></td>
            <td><class="delete"><?php echo "<a href='home.php?rmdir=$file'>delete</a>"?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  </body>
</html>
