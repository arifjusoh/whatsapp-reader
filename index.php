<?php
/**
 * @Author: prabhakar
 * @Date:   2016-04-26 13:58:12
 * @Last Modified by:   Prabhakar Gupta
 * @Last Modified time: 2016-06-15 01:08:17
 */


require 'inc/header.inc.php';
require 'inc/navbar.inc.php';



?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="upload-popup">
				Upload Whatsapp Text (.txt) file and view chat in a readable format<br>
				<form enctype="multipart/form-data">
					<input type="file" name="file" required>
					<input type="submit" class="btn btn-warning" value="Get Conversation">
				</form>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



<script type="text/javascript">

$('form').on('submit', uploadFiles);

var files;

// Add events
$('input[type=file]').on('change', prepareUpload);

// Grab the files and set them to our variable
function prepareUpload(event)
{
  files = event.target.files;
}

// Catch the form submit and upload the files
function uploadFiles(event)
{
  event.stopPropagation(); // Stop stuff happening
    event.preventDefault(); // Totally stop stuff happening

    // START A LOADING SPINNER HERE

    // Create a formdata object and add the files
    var data = new FormData();
    $.each(files, function(key, value)
    {
        data.append(key, value);
    });

    $.ajax({
        url: 'upload-file.php',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function(data, textStatus, jqXHR)
        {
            if(typeof data.error === 'undefined')
            {
                // Success so call function to process the form
                submitForm(event, data);
            }
            else
            {
                // Handle errors here
                console.log('ERRORS: ' + data.error);
            }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            // Handle errors here
            console.log('ERRORS: ' + textStatus);
            // STOP LOADING SPINNER
        }
    });
}
</script>

</body>
</html>
