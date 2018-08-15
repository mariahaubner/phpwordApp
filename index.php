<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once __DIR__ . '/vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__ . '/src');
$twig = new Twig_Environment($loader);

$page = 'templates/index.twig';
if (isset($_GET['page'])) {
    $_page = $_GET['page'];
    if (preg_match('{^\w+$}', $_page) && file_exists("./src/{$_page}/index.twig")) {
        $page = "{$_page}/index.twig";
    }
}

echo $twig->render($page);
