 $(document).ready(function(){

   $('#personal_info_update').on('submit', function(e){
   	var user_id         = $('#user_id').val();
    var full_name       = $('#full_name').val();
    var user_phone      = $('#user_phone').val();
    var users_email     = $('#users_email').val();
    var users_institute = $('#users_institute').val();
    var user_fb         = $('#user_fb').val();
    var user_ing        = $('#user_ing').val();
    var user_wp         = $('#user_wp').val();
    var user_tw         = $('#user_tw').val();

    if (user_phone == "" || user_phone == 0) {
      $('#user_phone').addClass('is-invalid');
      $('#err_phone').css('display:block');
      return false;
    } else if(user_phone.length > 15 || user_phone.length < 9){
      $('#user_phone').addClass('is-invalid');
      $('#err_phone').css('display:block');
      $('#err_phone').html("Phone must be between 9 and 15 Characters!");
      return false;
    } else{

       if (users_email != "") {
       	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (regex.test(users_email) === false) {
        	$('#users_email').addClass('is-invalid');
        	$('#err_email').css('display:block');
        }
       }

      $('#full_name').addClass('is-valid');
      $('#user_phone').addClass('is-valid');
      $('#users_email').addClass('is-valid');
      $('#users_institute').addClass('is-valid');

        var form_data = new FormData();
        form_data.append('user_id', user_id);
        form_data.append('full_name',full_name);
        form_data.append('user_phone',user_phone);
        form_data.append('users_email',users_email);
        form_data.append('users_institute',users_institute);
        form_data.append('user_fb', user_fb);
        form_data.append('user_ing', user_ing);
        form_data.append('user_wp', user_wp);
        form_data.append('user_tw', user_tw);
        form_data.append('pro_up',2);

        e.preventDefault();
        $.ajax({
          type: "post",
          url: "../ajax/sign-up.php",
          data: form_data,
          processData: false,
          cache: false,
          contentType: false,
          success:function(signup_data) {
           var profile_twod = signup_data.substring(0,2);
              if (profile_twod == 65) {               
                var successdatad = signup_data.substring(2);
                $('#output_message').html(successdatad);                 
                setTimeout(function(){
                 location.reload();
                },1000);
              }else{
                $('#output_message').html(signup_data);
              }
          }
        });
        return false;
    }

   });
  });