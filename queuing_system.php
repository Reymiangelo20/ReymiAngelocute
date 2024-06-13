<?php 
session_start();
require_once("queuing_system_display.php")
 ?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="queuing_system.css">
    <link rel="website icon" type="png" href="monitoring logbook logo.jpeg.png">
    <title>QUEUING SYSTEM</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <div class="datetime">
            <div class="time"></div>
            <div class="date"></div>
        </div>
        <img src="monitoring logbook logo.jpeg.png" alt="deped">
        <div class="headerTitles">
            <h3>Republic of the Philippines</h3> <br>
            <h2>Department of Education</h2> <br>
            <h3>Region III</h3> <br>
            <h1>SCHOOLS DIVISION OF CITY OF SAN JOSE DEL MONTE</h1>
        </div>  
    </header>

    <audio id="notification">
        <source src="queuing_system_announcement.mp3" type="audio/mp3"> 
    </audio>
    
<div class="container">
    <div class="video">
        <video id="video" autoplay muted loop>
            <source src="<?php echo $videoFilePath; ?>" type="video/mp4">
        </video>
    </div>

    <div class="OSDS">
        <h3>Office of the Schools Division Superintendent</h3>
        <table id="visitor_table">
            <tr>
                <th class="name_of_visitors">VISITORS:</th>
                <th class="department">DEPARTMENT:</th>
            </tr>
        </table>
    </div>

    <div class="CID">
        <h3>Curriculum Implementation Division</h3>
        <table class="table-cid">
            <tr>
                <th class="name_of_visitors">VISITORS:</th>
            </tr>
        </table>
    </div>

    <div class="SGOD">
        <h3>School Governance Operations Division</h3>
        <table class="table-sgod">
            <tr>
                <th class="name_of_visitors">VISITORS:</th>
            </tr>
        </table>
    </div>
    </div>
</body>
<script src="queuing_system.js"></script>
</html>