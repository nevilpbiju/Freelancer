<?php
if($_POST){
    // header("Location: ../login/");
}
?>
<html>
<form class="input-area" autocomplete="off" method="post" id="myForm">
  <input type="text" placeholder="Type a message..." name="msg" id="send-text" maxlength="250" required>
  <button type="submit" id="send-btn">▶</button>
</form>

<script>
    $(document).ready(function() {
        $('#myForm').submit(function(event) {
            event.preventDefault(); // Prevent form submission

    // Get form data
    var formData = $(this).serialize();

    // Send form data using AJAX
    $.ajax({
      type: 'POST',
      url: 'process.php', // Replace with your server-side script URL
      data: formData,
      success: function(response) {
        // Handle the response from the server
        console.log(response); // Optional: Log the response

        // Clear form field
        $('#send-text').val('fsdfsdfsdfsdfsdf');
      }
    });
  });
});

    </script>
</html>