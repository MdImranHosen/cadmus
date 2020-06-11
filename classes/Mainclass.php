<?php 
$filepath = realpath(dirname(__FILE__));								
include_once ($filepath.'/../lib/Session.php');
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
 Session::init();
 
 class Mainclass{
 	
 	protected $db;
 	protected $fm;
	public function __construct(){

	 $this->db = new Database();
   $this->fm = new Format();
	}
      public function url(){
            return sprintf(
                "%s://%s%s",
                isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                $_SERVER['SERVER_NAME'],
                $_SERVER['REQUEST_URI']
            );
      }

  public function get_client_ip() {
          $ipaddress = '';
          if (isset($_SERVER['HTTP_CLIENT_IP']))
              $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
          else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
              $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
          else if(isset($_SERVER['HTTP_X_FORWARDED']))
              $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
          else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
              $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
          else if(isset($_SERVER['HTTP_FORWARDED']))
              $ipaddress = $_SERVER['HTTP_FORWARDED'];
          else if(isset($_SERVER['REMOTE_ADDR']))
              $ipaddress = $_SERVER['REMOTE_ADDR'];
          else
              $ipaddress = 'UNKNOWN';
          return $ipaddress;
      }

    public function textFormat($text, $limit=60) {
    try {

      $result = $this->fm->textMqShorten($text,$limit);
      return $result;
      
    } catch (Exception $e) {
      
    }
   }
   public function data_con() {
    try {

      $con = $this->db->link;
      return $con;
      
    } catch (Exception $e) {
      
    }
   }

   public function data_vendorrun($sql) {
    try {

     $result = $this->db->runQuery($sql);
      return $result;
      
    } catch (Exception $e) {
      
    }
   }

   public function data_num_rows($query) {
    try {

     $result = $this->db->numRows($query);
      return $result;
      
    } catch (Exception $e) {
      
    }
   }

}

include_once "UsersClass.php";
include_once "AdminClass.php";
/*if (realpath(dirname(__FILE__))) {
  foreach (glob("classes/*.php") as $filename)
   {
    include_once $filename;
   }
}*/
