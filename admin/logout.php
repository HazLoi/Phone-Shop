<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

include '../include/global.php';
include '../include/session.php';
// unset($_COOKIE['id']);
unset($_COOKIE['password']);
unset($_COOKIE['fullname']);
// unset($_COOKIE['gid']);

// setcookie( 'id', '44', time() - 3600);
setcookie( 'password', '44', time() - 3600);
setcookie( 'fullname', '44', time() - 3600);
// setcookie( 'gid', '44', time() - 3600);

// unset($_SESSION['id']);
unset($_SESSION['password_client']);
unset($_SESSION['fullname_client']);
// unset($_SESSION['gid']);
session_destroy ();
?>

<script type="text/javascript">    
    if(localStorage.getItem('itemCart')){
        localStorage.removeItem('itemCart');
    }
    if(localStorage.getItem('list_shipment_by_supplier')){
        localStorage.removeItem('list_shipment_by_supplier');
    }
    if(localStorage.getItem('listSupplier')){
        localStorage.removeItem('listSupplier');
    }
    if(localStorage.getItem('object_customer')){
        localStorage.removeItem('object_customer');
    }
    if(localStorage.getItem('itemCustomer')){
        localStorage.removeItem('itemCustomer');
    }
    if(localStorage.getItem('type_order')){
        localStorage.removeItem('type_order');
    }
</script>

<?php
$main->redirect ( '/' );

?>
