  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/js/jquery-key-restrictions.js"></script>  
  <!-- Input filed Only Number Type Script --> 
  <script type="text/javascript">
    $(document).ready(function() {
        $("#phone").numbersOnly();
        $("#dynamic_otp").numbersOnly();
        //$("#text").alphaNumericOnly();
        //$("#text").lettersOnly();
    });
    </script>
</body>
</html>

