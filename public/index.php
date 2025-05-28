<?php
require_once __DIR__ . '/../app/core/Router.php';

$action = $_GET['action'] ?? 'login';
Router::route($action);
?>