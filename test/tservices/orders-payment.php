<?php


ini_set('display_errors',1);
error_reporting(E_ALL ^ E_NOTICE);


ini_set('max_execution_time', 0);
ini_set('memory_limit', '512M');

if(!isset($_SERVER['DOCUMENT_ROOT']) || !strlen($_SERVER['DOCUMENT_ROOT']))
{    
    $_SERVER['DOCUMENT_ROOT'] = rtrim(realpath(pathinfo(__FILE__, PATHINFO_DIRNAME) . '/../../'), '/');
} 


require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/profiler.php");

require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/account.php");
//require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/mem_storage.php");


//------------------------------------------------------------------------------


$results = array();

//$profiler = new profiler();



//------------------------------------------------------------------------------


//$profiler->start('fill_frl_mem');


//------------------------------------------------------------------------------





//$results['test'] = 'test';
$uid = 6;

$account = new account();
$ok = $account->GetInfo($uid, true);
$results['GetInfo'] = (int)$ok;
if($ok)
{
    $sum = -777;
    $scomment = 'Это описание перевода для системы';
    $ucomment = 'Это описание перевода для "истории" в аккаунте юзера';
    $trs_sum = $sum;
    $op_date = date('c');//, strtotime($_POST['date']));
            
    $results['depositEx'] = $account->depositEx($account->id, $sum, $scomment, $ucomment, 134, $trs_sum, NULL, $op_date);
}





//------------------------------------------------------------------------------

//$profiler->stop('fill_frl_mem');

//------------------------------------------------------------------------------





//------------------------------------------------------------------------------



//------------------------------------------------------------------------------

array_walk($results, function(&$value, $key){
    $value = sprintf('%s = %s'.PHP_EOL, $key, $value);
});

print_r(implode('', $results));

exit;