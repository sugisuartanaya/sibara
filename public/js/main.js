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
});