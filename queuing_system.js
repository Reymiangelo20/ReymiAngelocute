//FUNCTION FOR DATE AND TIME
const timeElement = document.querySelector(".time");
const dateElement = document.querySelector(".date");

/**
 * @param {Date} date
 */
function formatTime(date) {
  const hours12 = date.getHours() % 12 || 12;
  const minutes = date.getMinutes();
  const seconds = date.getSeconds();
  const isAm = date.getHours() < 12;

  return `${hours12.toString().padStart(2, "0")}:${minutes
    .toString() 
    .padStart(2, "0")}:${seconds.toString().padStart(2, "0")} ${isAm ? "AM" : "PM"}`;
}

/**
 * @param {Date} date
 */
function formatDate(date) {
  const DAYS = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday"
  ];
  const MONTHS = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
  ];

  return `${DAYS[date.getDay()]}, ${
    MONTHS[date.getMonth()]
  } ${date.getDate()}, ${date.getFullYear()}`;
}

setInterval(() => {
  const now = new Date();

  timeElement.textContent = formatTime(now);
  dateElement.textContent = formatDate(now);
}, 200);



//---------------FUNCTION FOR REALTIME FETCHING AND DISPLAYING IN THE ASSIGN TABLE---------------//

var lastData = []; // initialize lastData to null
// FUNCTION FOR NOT DISPLAYING THE SAME DATA OF VISITOR_NAME AND DEPARTMENT
function removeDuplicates(data) {
  const uniqueData = [];
  const uniqueEntries = new Set();

  data.forEach(visitor => {
    const key = visitor.visitor_name + visitor.department;
    if (!uniqueEntries.has(key)) {
      uniqueEntries.add(key);
      uniqueData.push(visitor);
    }
  });

  return uniqueData;
}

function update_visitor_data() {
  $.ajax({
    url: 'queuing_system_realtime_display.php',
    dataType: 'json',
    success: function(data) {
      // Check if the data has changed
      if (JSON.stringify(data) !== JSON.stringify(lastData)) {
        // Play the notification sound
        var notificationSound = document.getElementById("notification");
        notificationSound.currentTime = 0; // reset the sound to the beginning
        notificationSound.play();

        // Remove duplicate entries
        var uniqueData = removeDuplicates(data);

        // Update the visitor table
        var table = $('#visitor_table');
        table.empty();
        table.append('<tr><th class="name_of_visitors">VISITORS:</th><th class="department">DEPARTMENT:</th></tr>');
        $.each(uniqueData.filter(function(visitor) {
          return visitor.department !== "Curriculum Implementation Division" && visitor.department !=="School Governance Operations Division";
        }).slice(0 , 10),function(index, visitor){
          table.append('<tr><td class="name">' + visitor.visitor_name + '</td><td class="department">' + visitor.department + '</td></tr>');
        });

        // Update the CID table
        var cid_table = $('.table-cid');
        cid_table.empty();
        cid_table.append('<tr><th class="name_of_visitors">VISITORS:</th></tr>');
        $.each(uniqueData.filter(function(visitor) {
          return visitor.department === "Curriculum Implementation Division";
        }).slice(0 , 5), function(index, visitor) {
          cid_table.append('<tr><td class="name">' + visitor.visitor_name + '</td></tr>');
        });

        // Update the SGOD table
        var sgod_table = $('.table-sgod');
        sgod_table.empty();
        sgod_table.append('<tr><th class="name_of_visitors">VISITORS:</th></tr>');
        $.each(uniqueData.filter(function(visitor) {
          return visitor.department === "School Governance Operations Division";
        }).slice(0 , 5), function(index, visitor) {
          sgod_table.append('<tr><td class="name">' + visitor.visitor_name + '</td></tr>');
        });

        // Update lastData to the new data
        lastData = data;
      }
    }
  });
}
setInterval(update_visitor_data, 1000);

//FUNCTION FOR REALTIME DISPLAYING THE VIDEO
$(document).ready(function() {
  setInterval(function() {
    $.ajax({
      url: "queuing_system_realtime_video.php",
      dataType: "json",
      success: function(data) {
        // Check if the video file path has changed
        var currentSrc = $("#video source").attr("src");
        if (data.videoFilePath && currentSrc !== data.videoFilePath) {
          // Update the video player source with the latest video file path
          $("#video source").attr("src", data.videoFilePath);

          // Load the new video file
          $("#video")[0].load();

          // Play the video if it was playing before
          if (!$("#video")[0].paused) {
            $("#video")[0].play();
          }
        }
      }
    });
  }, 1000); // Send AJAX request every 5 seconds
});
