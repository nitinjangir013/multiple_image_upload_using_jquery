<?php

  // Save the file names in the database
  $db = new PDO('mysql:host=localhost;dbname=multiple_image', 'root', '');
// Get the uploaded files
$files = $_FILES['file'];

// Loop through the files
foreach ($files['name'] as $key => $value) {
  // Get the file extension
  $ext = pathinfo($value, PATHINFO_EXTENSION);

  // Check if the file extension is allowed
  $allowed_extensions = array('jpg', 'jpeg', 'png');
  if (!in_array($ext, $allowed_extensions)) {
    echo "Invalid file extension: $value";
    exit;
  }

  // Move the file to the upload directory
  $new_file_name = uniqid() . '.' . $ext;
  move_uploaded_file($files['tmp_name'][$key], 'uploads/' . $new_file_name);

  $sql = "INSERT INTO images (name) VALUES ('$new_file_name')";
  $db->exec($sql);
}
echo "Files uploaded successfully";
?>
