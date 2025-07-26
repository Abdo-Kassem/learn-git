$(document).ready(function(){
    // Start Datatable ...
    $('#datatable').DataTable();

      // Image Preview
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('.image-preview').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]);
        }
      }
      
      $(".image").change(function() {
        readURL(this);
      });


      // Image Preview
      function readURL2(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('.image-preview2').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]);
        }
      }
      
      $(".image2").change(function() {
        readURL2(this);
      });


});