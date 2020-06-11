    </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->
  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/js/jquery.dataTables.min.js"></script>
  <script src="../vendor/js/dataTables.bootstrap4.min.js"></script>
  <script src="../vendor/textboxio/textboxio.js"></script>
  <!-- Menu Toggle Script -->
  <script>
   
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    $(document).ready(function() {
      $('#asqtable').DataTable();
    }); 
      
    function instantiateTextbox(){
   // textboxio.replaceAll('#description');
  }
  </script>
 </body>
</html>