<?php
require_once __DIR__ . '/../controllers/AuthController.php';

class Router {
    public static function route($action) {
        $auth = new AuthController();

        switch ($action) {
            case 'login':
                $auth->login();
                break;
            case 'google_callback':
                $auth->googleCallback();
                break;
            case 'dashboard':
                $auth->dashboard();
                break;
            case 'logout':
                $auth->logout();
                break;
            default:
                $auth->login();
        }
    }
}
?>