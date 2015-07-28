<?
$g_page_id = "0|52";
require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/stdf.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/payed.php");
session_start();


$months = __paramInit('int', 'months', null, 0);

if (!get_uid(0) || !is_emp() || !$months) {
    include $_SERVER['DOCUMENT_ROOT']."/403.php";
    exit;
}

//$weeks = __paramInit('int', 'weeks', null, 0);
$cost = $months * (payed::PRICE_EMP_PRO);
$period = $months . " " . ending($months, "месяц", "месяца", "месяцев");

/*if ($month) {
    $period = $month . " " . ending($month, "месяц", "месяца", "месяцев");
} elseif ($weeks) {
    $period = $weeks . " " . ending($weeks, "неделя", "недели", "недель");
}*/

$stretch_page = true;
$header  = "../header.php";
$footer  = "../footer.html";
$content = "tpl.pro_payed.php";

include ("../template2.php");
?>