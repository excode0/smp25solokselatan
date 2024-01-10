<?PHP
include "db/config.php";;
if(isset($_SESSION['iduser'])){
	session_destroy();
	Header("Location:/smp25solokselatan/");
}
?>