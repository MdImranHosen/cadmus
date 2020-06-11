$(document).ready(function() {

   /*$("#username").keyup(function() {    
    $('#username').addClass('is-invalid');
    $('#err_username').css('display:block');
  });*/

  $("#username").blur(function() {

      var username = $('#username').val();

      // if username field is null then return
      if(username == "") {
        $('#username').addClass('is-invalid');
        $('#err_username').css('display:block');
        return;
      }

      // send ajax request if username is not empty
      $.ajax({
          url: 'ajax/sign-up.php',
          type: 'post',
          data: {
            'username':username,
            'username_check':1,
        },

        success:function(response) { 

          if (response == "ready") {
           $("#err_username").remove();
           $('#username').addClass('is-valid');
          }else{
            // clear span before error message
          $("#err_username").remove();

          // adding span after username textbox with error message
          $("#username").after("<div id='err_username' class='alert alert-danger'>"+response+"</div>");
          /*$('#username').addClass('is-invalid');
          $('#err_username').css('display:block');
          $('#err_username').html(response);*/

          }
          
        },

        error:function(e) {
         // $("#result").html("Something went wrong");
         alert("Something went wrong");
        }

      });
    });

});

// User Sign up Script with ajax...Start..

  $(document).ready(function(){

   $('#signupform').on('submit', function(e){
    var username = $('#username').val();
    var phone    = $('#phone').val();
    var password = $('#password').val();

    if ((username =="" || username == 0) && (phone == "" || phone == 0) && (password == "" || password == 0)) {
      $('#username').addClass('is-invalid');
      $('#phone').addClass('is-invalid');
      $('#password').addClass('is-invalid');
      $('#err_username').css('display:block');
      $('#err_phone').css('display:block');
      $('#err_password').css('display:block');
      return false;
    } else if(username =="" || username == 0){
      $('#username').addClass('is-invalid');
      $('#err_username').css('display:block');
      return false;
    } else if(phone == "" || phone == 0){
      $('#phone').addClass('is-invalid');
      $('#err_phone').css('display:block');
      return false;
    } else if(password == "" || password == 0){
      $('#password').addClass('is-invalid');
      $('#err_password').css('display:block');
      return false;
    } else if(username.length > 100 || username.length < 4){
      $('#username').addClass('is-invalid');
      $('#err_username').css('display:block');
      $('#err_username').html("Username must be between 4 and 100 Letter!");
      return false;
    } else if(phone.length > 15 || phone.length < 9){
      $('#phone').addClass('is-invalid');
      $('#err_phone').css('display:block');
      $('#err_phone').html("Phone must be between 9 and 15 Characters!");
      return false;
    } else if(password.length > 32 || password.length < 6){
      $('#password').addClass('is-invalid');
      $('#err_password').css('display:block');
      $('#err_password').html("Password must be between 6 and 32 Letter!");
      return false;
    } else{
      $('#username').addClass('is-valid');
      $('#phone').addClass('is-valid');
      $('#password').addClass('is-valid');

        var form_data = new FormData();
        form_data.append('username',username);
        form_data.append('phone',phone);
        form_data.append('password',password);
        form_data.append('save',1);

        e.preventDefault();
        $.ajax({
          type: "post",
          url: "ajax/sign-up.php",
          data: form_data,
          processData: false,
          cache: false,
          contentType: false,
          success:function(signup_data) {
            var strFirstTwo = signup_data.substring(0,2);
            if (strFirstTwo == "11") {
              var otpform = signup_data.substring(2);              
              $('#output_otpfrom').html(otpform);

              $('#otp_form').on('submit',function(){

                var user_id     = $('#user_id').val();
                var dynamic_otp = $('#dynamic_otp').val();

                if (dynamic_otp == "" || dynamic_otp == 0) {
                  $('#dynamic_otp').addClass('is-invalid');
                  $('#err_dynamic_otp').css('display:block');
                  return false;
                } else if(dynamic_otp.length > 6 || dynamic_otp.length < 3){
                  $('#dynamic_otp').addClass('is-invalid');
                  $('#err_dynamic_otp').css('display:block');
                  $('#err_dynamic_otp').html("OTP must be between 3 and 6 Number!");
                  return false;
                } else{

                  $.ajax({
                       type: "post",
                       url:  "ajax/sign-up.php",
                       data: {user_id:user_id,dynamic_otp:dynamic_otp,otp:1},
                       success:function(otp_data) {
                        var otpFirstTwo = otp_data.substring(0,2);

                        if (otpFirstTwo == "44") {
                          var otpdata = otp_data.substring(2);              
                          $('#output_otpfrom').html(otpdata);
                        } else{
                           $('#otp_msg').html(otp_data);
                         }
                         
                       }
                  });
                 return false;
                }
              });

            } else{
             $('#output_message').html(signup_data); 
           }                       
           
          }
        });
        return false;
    }

   });
  });