//FUNCTION FOR VIDEO SELECTOR COLOR
let listVideo = document.querySelectorAll('.video-list .vid');
        let mainVideo = document.querySelector('.main-video video');
        let title = document.querySelector('.main-video .title');

        listVideo.forEach(video =>{
            video.onclick = () =>{
                listVideo.forEach(vid => vid.classList.remove('active'));
                video.classList.add('active');
                if(video.classList.contains('active')){
                    let src = video.children[0].getAttribute('src');
                    mainVideo.src = src;
                    let text = video.children[1].innerHTML;
                    title.innerHTML = text;
                };
            };
        });


//FUNCTION TO PLAY VIDEO IN QUEUING SYSTEM WHEN THE USER CLICK THE PLAY BUTTON
$(document).ready(function() {
    $("#playButton").on("click", function() {
        var mainVideoName = $(".main-video .title").text();
        var mainVideoLocation = $(".main-video video").attr("src");

        if (mainVideoName !="Default"){
            $.ajax({
                url: "display_vid_queuingsystem.php", 
                method: "POST",
                data: { name: mainVideoName, location: mainVideoLocation },
                success: function() {
                    console.log("Data successfully sent to the server");
                    Swal.fire({
                        title: 'Success',
                        text: 'The video is now playing in Queuing System',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    })
                },
                error: function(error) {
                    console.error("Error sending data to the server", error);
                }
            });
        }
        else{
            Swal.fire({
                title: 'Error Playing Video',
                text: 'Please Select A Video First',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
});


//FUNCTION TO DELETE VIDEO
$(document).ready(function() {
    $("#deletebutton").on("click", function() {
        var mainVideoName = $(".main-video .title").text();
        var mainVideoLocation = $(".main-video video").attr("src");
        
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed && mainVideoName !="Default") {
                $.ajax({
                    url: "delete_video.php", 
                    method: "POST",
                    data: { name: mainVideoName, location: mainVideoLocation },
                    success: function() {
                        console.log("Data successfully sent to the server");
                    },
                    error: function(error) {
                        console.error("Error sending data to the server", error);
                    }
                });
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success",
                    confirmButtonText: 'OK'
                }).then((result)=>{
                    if(result.isConfirmed){
                        location.reload();
                    }
                });
              
            }
            else if (result.dismiss !== Swal.DismissReason.cancel) {
                Swal.fire({
                    title: "Error Deleting Video",
                    text: "Please Select A Video First!",
                    icon: "error",
                });
            }
          });
    });
});


//FUNCTION FOR POPUP UPLOAD
//Add Popup animation
let popup = document.getElementById("popup");

function openAdd(){
    popup.classList.add("open-popup");

}
function closeAdd(){
    popup.classList.remove("open-popup");
}

// Draggable Div Element for upload videos
const popup1 = document.querySelector(".popup");
const h2 = popup1.querySelector("h2");
let isDragging = false;
let initialX, initialY;

function onDragStart(e) {
    isDragging = true;
    initialX = e.clientX;
    initialY = e.clientY;
}

function onDrag(e) {
    if (!isDragging) return;

    const deltaX = e.clientX - initialX;
    const deltaY = e.clientY - initialY;
    initialX = e.clientX;
    initialY = e.clientY;

    let getStyle = window.getComputedStyle(popup1);
    let left = parseInt(getStyle.left);
    let top = parseInt(getStyle.top);

    const newLeft = left + deltaX;
    const newTop = top + deltaY;

    popup1.style.left = `${newLeft}px`;
    popup1.style.top = `${newTop}px`;
}

function onDragEnd() {
    isDragging = false;
}

h2.addEventListener("mousedown", onDragStart);
document.addEventListener("mousemove", onDrag);
document.addEventListener("mouseup", onDragEnd);



//FUNCTION FOR DISPLAY THE FILE TYPE AND FILE SIZE AND ALSO THE NAME OF THE FILE
let file = document.getElementById('file');

file.oninput = () =>{
    let filename = file.files[0].name;
    let extension = filename.split('.').pop();
    let filesize = file.files[0].size;
    let maximum = "LARGE"

    if(filesize <=1000000){
        filesize = (filesize/1000).toFixed(2) + 'kb';
    }
    if(filesize == 1000000 || filesize <=1000000000){
        filesize = (filesize/1000000).toFixed(2) + 'mb';
    }
    if(filesize == 1000000000 || filesize <=1000000000000){
        filesize = (filesize/1000000000).toFixed(2) + 'gb';
    }
    if (filesize == 1073741824){
        document.querySelector('.size').innerText = maximum;
    }
    document.querySelector('.selectfiles').innerText = filename;
    document.querySelector('.ex').innerText = extension;
    document.querySelector('.size').innerText = filesize;
    getFile(filename);
}
function getFile(fileName){
    if (fileName){
        document.querySelector('.pr').style.display = "block";
    }
}



//FUNCTION FOR UPLOADING PROGRESS BAR
$("#upload").on("click", function() {
    var filesize =  $('#file')[0].files[0].size;
    if(filesize > 1000000000){
        Swal.fire({
            title: "FILE TOO LARGE!",
            icon: "error",
            text: "The maximum file size is 1GB",
            confirmButtonText:"OK"
        }).then(function(){
            location.reload();
        })
    }
    else if($('#file').val()) {
        getprogress(true);
    }
});

$("#cancel").on("click", function() {
    cancelbtn(true);
});

$("#uploadForm").on('submit', function (e) {
    e.preventDefault();
    // get start time
    var startTime = new Date().getTime();
    var xhr = $.ajax({
        xhr: function () {
            var xhr = new XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (e) {
                if (e.lengthComputable) {
                    var percentComplete = ((e.loaded / e.total) * 100);

                    // e.loaded is in bytes convert it to kb, mb or gb. your choice
                    var mbTotal = Math.floor(e.total/(1024*1024));
                    var mbLoaded = Math.floor(e.loaded/(1024*1024));

                    // calculate data transfer per sec
                    var time = ( new Date().getTime() - startTime ) / 1000;
                    var bps = e.loaded / time;
                    var Mbps = Math.floor(bps / (1024*1024));
    
                    // calculate remaining time
                    var remTime = (e.total - e.loaded) / bps;
                    var seconds = Math.floor(remTime % 60);
                    var minutes = Math.floor(remTime / 60);
                    
                    // give output
                    $('#dataTransferred').html(`${mbLoaded}/${mbTotal} MB`)
                    $('#Mbps').html(`${Mbps} Mbps`)
                    $('#timeLeft').html(`${minutes}:${seconds}s`);
                    $("#percent").html(Math.floor(percentComplete) + '%');
                    $(".progress-bar").width(percentComplete + '%');

                    // cancel button only work when file is uploading
                    if(percentComplete > 0 && percentComplete < 100){
                        $('#cancel').prop('disabled', false);
                    }else{
                        $('#cancel').prop('disabled', true);
                    }
                }
            }, false);
            return xhr;
        },
        type: 'POST',
        url: 'upload_video.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            // add some preloader or perform any action before uploading
            $("#percent").html('0%');
            $(".progress-bar").width('0%');
        },
        error: function () {
            // if request not complete
            console.log('Please try again');
        },
        success: function (response) {
            // get response on successful uploading
            $("#percent").html('Uploaded');
            location.reload();
        }
    });
    // for cancel file transfer
    $('#cancel').on("click", (event) => {
        event.preventDefault();
        xhr.abort().then(
            $("#percent").html('Canceled'),
            $(".progress-bar").width('0%')
        )
    });
    // remove value form input button
    $('#file').prop('value', '')
});
function getprogress(progress){
    if (progress){
        document.querySelector('.cancel').style.display = "block";
        document.querySelector('.progress').style.display = "block";
        document.querySelector('.percent').style.display = "block";
        document.querySelector('.total').style.display = "block";
        document.querySelector('.mbps').style.display = "block";
        document.querySelector('.timeleft').style.display = "block";
        document.querySelector('.uploading').style.display = "block";
    }
}

function cancelbtn(cancel){
    if(cancel){
        document.querySelector('.uploading').style.display = "none";
    }
}

  

