<?php
include "koneksi.php";
require_once "controllers/ProdukController.php";

$controller = new ProdukController($koneksi);

$aksi = $_GET['aksi'] ?? 'index';

switch ($aksi) {
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'update':
        $controller->update();
        break;
    default:
        $controller->index();
        break;
}
?>