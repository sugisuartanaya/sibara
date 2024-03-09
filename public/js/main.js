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
                document.getElementsByClassName("badge-container")[0].style.display = "none"; 
                document.getElementById("hide_countdown").style.display = "none"; 
                document.getElementById("end_event").style.display = "block";
            } else {
                document.getElementById("countdown").innerHTML = remaining.days + "d : "+ remaining.hours + "h : " + remaining.minutes + "m : " + remaining.seconds + "s";
            }
          
          });
    });

    $(document).ready(function() {
        $('.batas').each(function(index, element) {
            var endDate = $(element).data("end-date");
            var countdownElement = $(element).closest('.col-md-4').find('.countdownWinner');
            var myCountDown = new ysCountDown(endDate, function (remaining, finished) {
                if (finished) {
                    countdownElement.css("display", "none");
                } else {
                    countdownElement.text(remaining.hours + "h : " + remaining.minutes + "m : " + remaining.seconds + "s");
                }
            });
        });
    });

    $(document).ready(function() {
        var endDate = document.getElementById("batas").getAttribute("dataEndDate");
        var myCountDown = new ysCountDown(endDate, function (remaining, finished) {
            console.log(myCountDown);
            if (finished) {
                document.getElementById("batas").style.display = "block";
            } else {
                document.getElementById("countdownWinner").innerHTML = remaining.hours + "h : " + remaining.minutes + "m : " + remaining.seconds + "s";
            }
          
          });
    });
    

    $(document).ready(function() {
        $('#select-urutan').change(function() {
            $('#filter').submit();
        });
    });

    //active class preview barang
	$(document).ready(function(){
		$('#thumbnailCarousel .thumbnail').click(function(){
            $('#thumbnailCarousel .thumbnail').removeClass('active');
            $(this).addClass('active');
		});
	});

	//zoom hover thumbnail
	$(document).ready(function() {
        var magnifyingGlass = $('.magnifying-glass');

        $('#produkCarousel .carousel-inner').hover(
            function() {
                magnifyingGlass.show();
            },
            function() {
                magnifyingGlass.hide();
                resetImageSize();
            }
        ).mousemove(function(e) {
            var parentOffset = $(this).offset();
            var x = e.pageX - parentOffset.left;
            var y = e.pageY - parentOffset.top;

            var scale = 1.5; // Sesuaikan faktor zoom sesuai keinginan
            var transformValue = 'scale(' + scale + ')';
            
            magnifyingGlass.css({
                left: x - magnifyingGlass.width() / 2,
                top: y - magnifyingGlass.height() / 2,
                transform: transformValue,
                'transform-origin': x + 'px ' + y + 'px'
            });

            $('#produkCarousel .carousel-item.active img').css({
                transform: transformValue,
                'transform-origin': x + 'px ' + y + 'px'
            });
        });

        function resetImageSize() {
            $('#produkCarousel .carousel-item.active img').css({
                transform: 'scale(1)',
                'transform-origin': 'center center'
            });
        }
	});

    $(document).ready(function() {
        $("#penawaran").on("input", function() {
            formatAngka();
        });
    
        function formatAngka() {
            var inputElem = $("#penawaran");
            
            // hapus karakter selain angka
            var nilaiInput = inputElem.val().replace(/\D/g, '');
    
            // split angka dengan titik
            var nilaiFormatted = !isNaN(nilaiInput) && nilaiInput !== '' ? parseFloat(nilaiInput).toLocaleString('id-ID') : '';
    
            inputElem.val(nilaiFormatted);
        }
    });

    $(document).ready(function() {
        $("#minimum").on("input", function() {
            formatAngka($("#minimum"));
        });
    
        $("#maximum").on("input", function() {
            formatAngka($("#maximum"));
        });
    
        function formatAngka(inputElem) {
            // hapus karakter selain angka
            var nilaiInput = inputElem.val().replace(/\D/g, '');
    
            // split angka dengan titik
            var nilaiFormatted = !isNaN(nilaiInput) && nilaiInput !== '' ? parseFloat(nilaiInput).toLocaleString('id-ID') : '';
    
            inputElem.val(nilaiFormatted);
        }
    });

    $(document).ready(function() {
        $(document).ready(function() {
            $('.share-facebook').on('click', function(event) {
                event.preventDefault();
                var url = encodeURIComponent($(this).data('url'));
                var shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + url;
                window.open(shareUrl, 'facebook-share-dialog', 'width=626,height=436');
            });
        });
    });

    $(document).ready(function () {
        // Tambahkan kelas animasi saat halaman dimuat
        $('.animated-element').addClass('animated');
    });

    $(document).ready(function() {
        var buttonUpdate = $('#buttonUpdate');
        var cancelUpdate = $('#cancelUpdate');
        var formUpdate = $('#formUpdate');

        buttonUpdate.click(function() {
            showForm();
        });

        cancelUpdate.click(function() {
            hideForm();
        });

        function showForm() {
            formUpdate.show();
            buttonUpdate.hide();
            cancelUpdate.show();
        }

        function hideForm() {
            formUpdate.hide();
            buttonUpdate.show();
            cancelUpdate.hide();
        }
    });

    $(document).ready(function () {
        var toast = new bootstrap.Toast(document.querySelector('.toast'));
        toast.show();
    });

    // $(document).ready(function() {
    //     $('#myModal').modal('show');
    // });

    $(document).ready(function () {
        var lastModalTime = getCookie('lastModalTime');
        var currentTime = Math.floor(new Date().getTime() / 1000); // Waktu saat ini dalam detik
    
        if (!lastModalTime || isDifferentDay(lastModalTime, currentTime)) {
            var myModal = new bootstrap.Modal(document.getElementById('myModal'));
            myModal.show();
            setCookie('lastModalTime', currentTime, 365); // Cookie akan kedaluwarsa dalam 1 tahun
        }
    });
    
    function setCookie(name, value, days) {
        var expires = '';
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = '; expires=' + date.toUTCString();
        }
        document.cookie = name + '=' + value + expires + '; path=/';
    }
    
    function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    }
    
    function isDifferentDay(lastTime, currentTime) {
        var lastDate = new Date(lastTime * 1000);
        var currentDate = new Date(currentTime * 1000);
    
        return (
            lastDate.getUTCFullYear() !== currentDate.getUTCFullYear() ||
            lastDate.getUTCMonth() !== currentDate.getUTCMonth() ||
            lastDate.getUTCDate() !== currentDate.getUTCDate()
        );
    }

});