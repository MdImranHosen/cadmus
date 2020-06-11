 $(document).ready(function(){
   $('#loginform').on('submit', function(e){
    var admin_user = $('#admin_user').val();
    var admin_pass = $('#admin_pass').val();

    if ((admin_user =="" || admin_user == 0) && (admin_pass == "" || admin_pass == 0)) {
      $('#admin_user').addClass('is-invalid');
      $('#admin_pass').addClass('is-invalid');
      $('#err_admin_user').css('display:block');
      $('#err_admin_pass').css('display:block');
      return false;
    }else if(admin_user =="" || admin_user == 0){
      $('#admin_user').addClass('is-invalid');
      $('#err_admin_user').css('display:block');
      return false;
    }else if(admin_pass == "" || admin_pass == 0){
      $('#admin_pass').addClass('is-invalid');
      $('#err_admin_pass').css('display:block');
      return false;
    } else if(admin_user.length > 100 || admin_user.length < 4){
      $('#admin_user').addClass('is-invalid');
      $('#err_admin_user').css('display:block');
      $('#err_admin_user').html("Username must be between 4 and 100 Letter!");
      return false;
    } else if(admin_pass.length > 32 || admin_pass.length < 6){
      $('#admin_pass').addClass('is-invalid');
      $('#err_admin_pass').css('display:block');
      $('#err_admin_pass').html("Password must be between 6 and 32 Letter!");
      return false;
    } else{
      $('#admin_user').addClass('is-valid');
      $('#admin_pass').addClass('is-valid');

        var form_data = new FormData();
        form_data.append('admin_user',admin_user);
        form_data.append('admin_pass',admin_pass);
        form_data.append('login_admin', 88);

        e.preventDefault();
        $.ajax({
          type: "post",
          url: "../ajax/log_in.php",
          data: form_data,
          processData: false,
          cache: false,
          contentType: false,
          success:function(login_data) {
            if (login_data == "adminlogin") {
              window.location.href="/cadmus/admin";
            }else{
              $('#output_message').html(login_data);
            }
           
          }
        });
        return false;
    }

   });
  });