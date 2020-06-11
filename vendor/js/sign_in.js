 $(document).ready(function(){
   $('#signinform').on('submit', function(e){
    var username = $('#username').val();
    var password = $('#password').val();

    if ((username =="" || username == 0) && (password == "" || password == 0)) {
      $('#username').addClass('is-invalid');
      $('#password').addClass('is-invalid');
      $('#err_username').css('display:block');
      $('#err_password').css('display:block');
      return false;
    }else if(username =="" || username == 0){
      $('#username').addClass('is-invalid');
      $('#err_username').css('display:block');
      return false;
    }else if(password == "" || password == 0){
      $('#password').addClass('is-invalid');
      $('#err_password').css('display:block');
      return false;
    } else if(username.length > 100 || username.length < 4){
      $('#username').addClass('is-invalid');
      $('#err_username').css('display:block');
      $('#err_username').html("Username must be between 4 and 100 Letter!");
      return false;
    } else if(password.length > 32 || password.length < 6){
      $('#password').addClass('is-invalid');
      $('#err_password').css('display:block');
      $('#err_password').html("Password must be between 6 and 32 Letter!");
      return false;
    } else{
      $('#username').addClass('is-valid');
      $('#password').addClass('is-valid');

        var form_data = new FormData();
        form_data.append('username',username);
        form_data.append('password',password);
        form_data.append('sign_in', 99);

        e.preventDefault();
        $.ajax({
          type: "post",
          url: "ajax/sign-in.php",
          data: form_data,
          processData: false,
          cache: false,
          contentType: false,
          success:function(sign_data) {

            if (sign_data == "login") {
              window.location.href="/cadmus/users";
            }else{
              $('#output_message').html(sign_data);
            }
           
          }
        });
        return false;
    }

   });
  });