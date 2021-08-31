<?php
session_start();
ob_start();
require_once("config/connection.php");
require_once("views/fixed/head.php");
?>

<!--sadrzaj -->
<?php
require_once("views/fixed/nav.php");

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'home':
            require_once("views/home.php");
            break;
        case 'steps':
            require_once("views/steps.php");
            break;
        case 'list':
            require_once("views/list.php");
            break;
        case 'contact':
            require_once("views/contact.php");
            break;
        case 'register':
            require_once("views/register.php");
            break;
        case 'login':
            require_once("views/login.php");
            break;
        case 'logout':
            require_once("models/user/logout.php");
            break;
        case 'bucket':
            require_once("views/user/bucket.php");
            break;
        case 'create-goal':
            require_once("views/user/create.php");
            break;
        case 'admin-panel':
            require_once("views/admin/panel.php");
            break;
        case 'admin-menu':
            require_once("views/admin/menu.php");
            break;
        case 'admin-category':
            require_once("views/admin/category.php");
            break;
        case 'admin-user':
            require_once("views/admin/user.php");
            break;
        case 'admin-list':
            require_once("views/admin/list.php");
            break;
        case 'author':
            require_once("views/author.php");
            break;

        default:
            require_once("views/home.php");
            break;
    }
} else {
    require_once("views/home.php");
}
?>
    <!-- futer -->
    <?php require_once("views/fixed/footer.php"); ?>