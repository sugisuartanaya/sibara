$(function() {
  function previewImage(input, previewId) {
      var fileInput = document.getElementById(input);
      var preview = document.getElementById(previewId);

      if (fileInput.files && fileInput.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              preview.src = e.target.result;
          };

          reader.readAsDataURL(fileInput.files[0]);

          // Tampilkan elemen gambar preview setelah memilih file
          preview.style.display = 'block';
      }
  }

  $('#image-ktp').on('change', function() {
      previewImage('image-ktp', 'image-preview-ktp');
  });

  $('#image-selfie').on('change', function() {
      previewImage('image-selfie', 'image-preview-selfie');
  });

  $(document).ready(function () {
    function updateDateTime() {
        var currentDateElement = $('#currentDate');
        var currentTimeElement = $('#currentTime');

        var now = new Date();

        // Format the date
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        var formattedDate = now.toLocaleDateString('id-ID', options);

        // Format the time
        var formattedTime = now.toLocaleTimeString();

        // Update the HTML elements
        currentDateElement.text(formattedDate);
        currentTimeElement.text(formattedTime);
    }

    setInterval(updateDateTime, 1000);

    updateDateTime();
    });

    $(document).ready(function() {
        var endDate = document.getElementById("end_date").getAttribute("dataEndDate");

        var myCountDown = new ysCountDown(endDate, function (remaining, finished) {
            console.log(myCountDown);
            if (finished) {
                document.getElementById("countdown").style.display = "none"; 
                document.getElementById("hide_countdown").style.display = "none"; 
                document.getElementById("end_event").style.display = "block";
            } else {
                document.getElementById("countdown").innerHTML = remaining.days + "d : "+ remaining.hours + "h : " + remaining.minutes + "m : " + remaining.seconds + "s";
            }
          
          });
    });

});