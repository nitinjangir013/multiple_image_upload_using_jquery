$(document).ready(function() {
  $('#file').on('change', function() {
    var files = $(this).get(0).files;
    var preview = $('#preview');
    preview.empty();

    for (var i = 0; i < files.length; i++) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var image = document.createElement('img');
        image.src = e.target.result;
        preview.append(image);
      }
      reader.readAsDataURL(files[i]);
    }
  });

  $('#submit').on('click', function() {
    var formData = new FormData();
    var files = $('#file')[0].files;

    for (var i = 0; i < files.length; i++) {
      formData.append('file[]', files[i]);
    }

    $.ajax({
      url: 'data_sent.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
        alert(data);
      }
    });
  });
});
