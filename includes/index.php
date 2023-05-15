<!DOCTYPE html>
<html lang="en">
<head>
<title>File Upload And Listin</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>

<h1>EKITI STATE UNIVERSITY 2023 YEARBOOK</h1>
     
    <form method="POST" action="./includes/upload.php" enctype="multipart/form-data">
        <label for="file" class="col-6" style="padding-top: 20px; padding-bottom: 20px; background-color: turquoise; padding: 12px; color: white; border-radius: 5px; border: 2px dashed grey;">Choose a file</label>
        <input type="file" style="display: none" name="fileToUpload" id="file"><br>
        <textarea class="form-control" ></textarea>
        <input type="submit" name="submit" value="Upload File">
    </form>

    <?php


  //  Function to get a list of files in a directory
//     function getFileList($dir) {
//         $fileList = [];
//         $files = scandir($dir);
       
//         foreach ($files as $file) {
//             if ($file != '.' && $file != '..') {
//                 $fileList[] = $file;
//             }
//         }
//         return $fileList;
//     }

//     // Directory to store uploaded files
//     $uploadDir = 'uploads/';

//   //  Handle file upload
//     if (isset($_POST['submit'])) {
//         $fileName = $_FILES['file']['name'];
//         $filePath = $uploadDir . $fileName;


//         if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
//             $gg = $fileName;
//             $joe=$_SESSION['id'];
//             $statement=$conn->prepare("INSERT INTO uploads VALUES(NULL,:ui,:pn,NULL)");
//             $statement->bindParam(":ui",$joe);
//             $statement->bindParam(":pn",$gg);
//             $statement->execute();
            
//             echo '<p>File uploaded successfully!</p>';
//         } else {
//             echo '<p>Failed to upload file.</p>';
//         }
//     }

  //  List user's files
    echo '<h2>Your Files</h2>';

        echo '<ul>';
            
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<img style="width:100px; height:auto"  src="./includes/uploads/'. $row['pics_name'].'" > ';
  }
     
        echo '</ul>';


   // List all files
    echo '<h2>All Files</h2>';
   
    echo '<ul>';
            
    while($rowm = $stmtt->fetch(PDO::FETCH_ASSOC)) {
        echo '<img style="width:100px; height:auto"  src="./includes/uploads/'. $rowm['pics_name'].'" > ';
      }
         
            echo '</ul>';
    ?>

     <!-- <script src="script.js"></script> -->
</body>
</html>