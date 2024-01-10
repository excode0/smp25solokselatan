<?php
include "db/config.php";
function MessagePopUp($message, $RedirectTo)
{
    //     echo "<div id='dialog' title='Basic dialog'>
    //   <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the &apos;x&apos; icon.</p>
    // </div>";
    echo "<script>window.location.href='" . $RedirectTo . "';alert('" . $message . "');</script>";
}
if (isset($_GET['tipe'])) {
    if ($_GET['tipe'] == 'login') {
        $queryLoginHandler = mysqli_query($konek, "SELECT * FROM users WHERE username='$_POST[username]' AND password='$_POST[password]';");
        if (mysqli_num_rows($queryLoginHandler) == 1) {
            while ($user = mysqli_fetch_array($queryLoginHandler)) {
                $_SESSION['iduser'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['akses'] = $user['akses'];
                Header("Location:dashboard");
            }
        } else {
            MessagePopUp("Mohon maaf user tidak di temukan", "login");
        }
    }
}

?>