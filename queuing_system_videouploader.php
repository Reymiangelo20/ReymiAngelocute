<?php
    session_start();
    require_once("fetch_videos.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUEUING VIDEO UPLOADER</title>
    <link rel="stylesheet" href="queuing_system_videouploader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="website icon" type="png" href="monitoring logbook logo.jpeg.png">
    <script src="https://kit.fontawesome.com/355342439a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<header>
    <img src="monitoring logbook logo.jpeg.png" alt="">
    <h1>  QUEUING SYSTEM VIDEO UPLOADER</h1> 
</header>
<input type="checkbox" name="" id="check">
    <div class="container1">
        <label for="check">
            <div class="menubar">
                <span class="bx bx-x" id="cross"></span>
                <span class="bx bx-menu" id="bars"></span>
            </div>
        </label>
        <div class="head">MENU</div>
        <ol>
         <li> <a href="e_logsHistory.php"><i class='bx bx-history'></i>E-LOG'S HISTORY</a></li>
            <li> <a href="unsuccessful_appointment.php"><i class='bx bx-clipboard'></i></i></i>UNSUCCESSFUL APPOINTMENTS</a></li>
            <li> <a href="appearance.php"><i class="fa-regular fa-file-lines" style="color: #f4f7fa;"></i>CERTIFICATE OF APPEARANCE</a></li>
            <li> <a href="user_accounts.php"><i class='bx bxs-user-account' ></i></i>USER ACCOUNTS</a></li>
            <li> <a href="ActivityLogs.php"><i class='bx bx-list-ul'></i>ACTIVITY LOG</a></li>
            <li> <a href="queuing_system_videouploader.php"><i class='bx bx-cloud-upload'></i>UPLOADER</a></li>
            <li> <a href="change_password.php"><i class='bx bx-lock-alt'></i>CHANGE PASSWORD</a></li>
            <li> <a href="log_out.php"><i class='bx bx-log-out'></i>LOGOUT</a></li>
        </ol>
    </div>     
<div class="container">
    <div class="main-video">
        <video src="<?php echo $videos[0]['location']; ?>" controls muted autoplay></video>
        <h3 class="title">Default</h3>
    </div>

    <div class="video-list">
        <?php foreach ($videos as $video): ?>
            <div class="vid">
                <video src="<?php echo $video['location']; ?>" muted></video>
                <h3 class="title"><?php echo $video['name']; ?></h3>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="buttons">
        <button id="playButton" class="playbutton">Play</button>
        <button class="deletebutton" id="deletebutton">Delete</button>
        <button type="button" class="upload-file" onclick="openAdd()"><i class = "fa fa-upload"></i> Upload File</button>
    </div>
</div>


<div class="popup" id="popup">
    <h2>UPLOAD FILE <span class="close"><i class='bx bx-x bx-tada' onclick="closeAdd()"></i></span></h2>  
    <form action="" id="uploadForm" method="post" enctype="multipart/form-data">
        <div class="files">
            <input type="file" id="file" class="hidden" name="file" required>
            <label for="file" class="selectfiles">Select Files</label>
        </div>
        <div class="pr">
            <strong>
                <h4 class="ex">PDF</h4>
                <h5 class="size">2.5kb</h5>
            </strong>
        </div>
        <span id="percent" class="percent">0%</span>
        <div class="progress">
            <div class="progress-bar"></div>
        </div>
        <span id="dataTransferred" class="total">Loaded/Total</span>
        <span id="Mbps" class="mbps">Mbps</span>
        <span id="timeLeft" class="timeleft">Time Left</span>
        <input type="submit" value="Upload" id="upload"class="uploadbtn" name="btn_upload">
        <span class="uploading">Uploading...<br><i class="fa-solid fa-circle-notch fa-spin"></i></span>
        <button id="cancel" class="cancel" disabled>Cancel</button>
    </form>
</div>
</body>
<script src="queuing_system_videouploader.js"></script>
<script src="disablebackbutton.js"></script>
</html>
