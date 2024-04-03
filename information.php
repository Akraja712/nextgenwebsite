<?php
session_start();

$servername = "localhost";
$username = "u152146582_nextgencareer";
$password = "Nextgen@2023";
$database = "u152146582_nextgencareer";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT question, answer FROM faq ";
$result = $conn->query($sql);

$faqs = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $faqs[] = $row;
    }
}

$sql = "SELECT name, link FROM youtube_link ";
$result = $conn->query($sql);

$youtube_link = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $youtube_links[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXTGEN COURSES</title>
    <link rel="stylesheet" href="new.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<style>
  
   #information {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color:#febd59;
    justify-content: center;
  }
  .faq-item {
    display: flex;
    flex-direction: column;
    text-align: left;
    color: black;
    margin-bottom: 20px; /* Adjust margin as needed */
    width: 80%; /* Adjust width as needed */
    max-width: 600px; /* Adjust max-width as needed */

  }
  .faq-item h5 {
    margin-bottom: 10px; /* Adjust margin as needed */
  }
    #information img {
    width: 150px;
    height: 150px;
    border-radius: 90px;
    display: flex;

}


@media (max-width: 768px) {
.container {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
}

#video {
    width: 100%;
    height:250px;
}
.faq-item h5 {
                font-size: 15px; /* decrease font size for smaller screens */
            }

            .faq-item ul li {
                font-size: 13px; /* decrease font size for smaller screens */
            }
}
#videos h3 {
                font-size: 18px; /* Adjust the font size as needed */
            }
</style>
<body>
<section id="information">
    <center>
  <img src="faq.jpeg" data-aos="fade-up" class="img-fluid">
  <br>
  <?php $counter = 1; ?>
<?php foreach ($faqs as $faq) { ?>
  <div class="faq-item">
    <h5><?php echo $counter++; ?>. <?php echo $faq['question']; ?></h5>
    <ul>
      <li><?php echo $faq['answer']; ?></li>
    </ul>
  </div>
<?php } ?>
  </center>
</section>
<br>
<section id="videos">
<?php 
// Counter variable to keep track of the video numbers
$counter = 1;

foreach ($youtube_links as $youtube_link) {
    if(isset($youtube_link['name']) && isset($youtube_link['link'])) {
        // Regular expression to extract video ID from YouTube link
        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $youtube_link['link'], $matches);

        // Check if a valid YouTube video ID was found
        if(isset($matches[1])) {
            $video_id = $matches[1];
            $embed_link = "https://www.youtube.com/embed/$video_id";

            ?>
             <div class="container">
                <h3><u><?php echo $counter . ". " . $youtube_link['name']; ?></u></h3>
            </div> <!-- Close container -->
            <br> <!-- Add a gap between videos -->
            <div class="container">
                <!-- Embedded YouTube video -->
                <iframe id="video" width="50%" height="315" src="<?php echo $embed_link; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <br> <!-- Add a gap between videos -->
            <br>
            <?php
            // Increment the counter
            $counter++;
        }
    }
} ?>
</section>


</body>
</html>
