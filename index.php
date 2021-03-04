<?php

require __DIR__ . '/vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('Google Sheets and PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');
$service = new Google_Service_Sheets($client);
$spreadsheetID = "1DG-pjW2GIGtXXU_k8MkQGACPCU7ewkjXoW3iUmGFSdA";

include 'sendemail.php'; 


// $range = "Database!A3:A7";

// $response = $service->spreadsheets_values->get($spreadsheetID, $range);
// $values = $response->getValues();
// if(empty($values)){
//     print "No data found.\n";
// }
// else {
//     print "Category:\n";
//     foreach ($values as $row) {
//         // Print columns A and E, which correspond to indices 0 and 4.
//         printf("%s\n", $row[0]);
//     }
// }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS-DO Mailing Page</title>
    <link rel="stylesheet" href="style4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  </head>
  <body>

    <!--alert messages start-->
    <?php echo $alert; ?>
    <!--alert messages end-->

    <!--contact section start-->
    <div class="contact-section">
      <div class="contact-info">
        <h2><center>CS - Office of the Dean <br>Mailing Page</center></h2>
        <div><i class="fas fa-map-marker-alt"></i>Address, City, eCountry</div>
        <div><i class="fas fa-phone"></i>+00 0000 000 000</div> 
        <div><i class="fas fa-clock"></i>Mon - Fri 8:00 AM to 5:00 PM</div>
      </div>

      <div class="contact-form">
        <form class="contact" name="google-sheet" method="post" enctype="multipart/form-data">
          <input type="text" name="name" class="text-box" placeholder="Your Name" required>
          <input type="email" name="email" class="text-box" placeholder="Your Email" required>
          <textarea name="message" rows="5" placeholder="Optional Message"></textarea>

          <label>Institute: </label>
          <select name="institute" id="instituteID" size="0" required>

            <?php
            $range1 = "Category!B3:C1000";
            $response1 = $service->spreadsheets_values->get($spreadsheetID, $range1);
            $values1 = $response1->getValues();

            if(!empty($values1)){
                foreach ($values1 as $row) {
            ?>

            <option value="<?php print_r($row[1]); ?>">
              <?php print_r($row[0]); ?>
            </option>
            
            <?php 
                }
            }
            ?>

          </select><br><br>

          <label>Choose What Type of Document to Submit: </label>
          <select name="docType" id="docs" size="0" required>

            <?php
            $range2 = "Category!A3:A1000";
            $response2 = $service->spreadsheets_values->get($spreadsheetID, $range2);
            $values2 = $response2->getValues();
            if(!empty($values2)){
                foreach ($values2 as $row) {
            ?>

            <option value="<?php print_r($row[0]); ?>">
              <?php print_r($row[0]); ?>
            </option>
            
            <?php 
                }
            }
            ?>

          </select><br><br>
          <label>Is it for Dean's Signature? </label>
          <input type="radio" id="yes" name="signature" value="Yes" required>
          <label for="yes">Yes</label>
          <input type="radio" id="no" name="signature" value="No">
          <label for="no">No</label><br><br>

          <label for="myfile">Select Attachment/s:</label>
          <input type="file" id="myFile" name="myFile" multiple required><br><br>

          <input type="submit" name="submit" class="send-btn" value="Send">
        </form>
      </div>
    </div>
    <!--contact section end-->


    <script type="text/javascript">
    if(window.history.replaceState){
      window.history.replaceState(null, null, window.location.href);
    }
    </script>

  </body>
</html>