<?php
// update.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted data
    $id = $_POST['id'];
    $categoryId = $_POST['categoryId'];
    $categoryName = $_POST['categoryName'];
    $categoryDesc = $_POST['categoryDesc'];

    // Perform the database update (replace this with your actual update logic)
    // Example: $mysqli->query("UPDATE your_table SET category_name = '$categoryName' WHERE id = $id");

    // Respond with a success message
    echo json_encode(['status' => 'success', 'message' => 'Data updated successfully']);
} else {
    // Invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
<script>
  function updateData(id) {
    var categoryId = $("#categoryId[data-id='" + id + "']").text();
    var categoryName = $("#categoryName[data-id='" + id + "']").text();
    var categoryDesc = $("#categoryDesc[data-id='" + id + "']").text();

    // Send the updated data to the server using AJAX
    $.ajax({
      type: "POST",
      url: "update.php", // Replace with the actual path to your PHP script
      data: {
        id: id,
        categoryId: categoryId,
        categoryName: categoryName,
        categoryDesc: categoryDesc
      },
      success: function(response) {
        // Handle the server response
        console.log(response);
      },
      error: function(error) {
        console.error(error);
      }
    });
  }
</script>

