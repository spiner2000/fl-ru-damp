<?
$g_page_id = "0|1";
// Сѓ СЂР°Р·РґРµР»Р° СЃРґРµР»Р°СЋ СЃРІРѕРё РІРѕРїСЂРѕСЃС‹ РІ РѕРєРЅРµ РїРѕРјРѕС‰Рё
if (isset($_GET['kind']) && 8 == $_GET['kind']) {
    $g_help_id = 202;
}

// Р¤РѕСЂРјРёСЂСѓРµРј JS РІРЅРёР·Сѓ СЃС‚СЂР°РЅРёС†С‹
define('JS_BOTTOM', true);

// РїРµСЂРІС‹Рј РґРµР»РѕРј Р·Р°РїРѕРјРёРЅР°РµРј Р±С‹Р»Р° Р»Рё РїРѕРїС‹С‚РєР° РїРµСЂРµРєР»СЋС‡РёС‚СЊСЃСЏ РЅР° Р°РЅС‚РёСЋР·РµСЂР° РёР»Рё СЃРјРµРЅРёС‚СЊ Р°РЅС‚РёСЋР·РµСЂР°
// РёРЅР°С‡Рµ РїСЂРё РїРѕРґРєР»СЋС‡РµРЅРёРё /classes/stdf.php РѕС‡РёСЃС‚РёС‚СЃСЏ $_POST
// РїРѕРґСЂРѕР±РЅРµРµ С‚СѓС‚: #19492
$switch = (isset($_POST['action']) && 'switch' === $_POST['action']);
$change_au = (isset($_POST['action']) && 'change_au' === $_POST['action']);

require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/stdf.php");

require_once($_SERVER['DOCUMENT_ROOT'] . '/tu/yii/tinyyii.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/tservices/tservices_catalog.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/tservices/tservices_helper.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/tu/models/TServiceModel.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/tu/models/FreelancerModel.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/tu/widgets/TServiceFilter.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/tu/widgets/TServiceFreelancersCategories.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/tu/widgets/TServiceNavigation.php');

$g_folders = array(0=>1, 1=>1, 2=>3, 3=>2, 4=>4);
$main_page = true;

session_start();

if($_GET['full_site_version'] == 1) {
    $show_full_site_version = 1;
    setcookie("full_site_version", "1", time()+60*60*24*30, "/");
}

@$action = strip_tags(trim($_GET['action']));
if (!$action) @$action = strip_tags(trim($_POST['action']));
// РѕРїСЂРµРґРµР»СЏРµРј, Р±С‹Р» Р»Рё СЃР±СЂРѕСЃ РјР°СЃСЃРёРІР° POST
if (!$action && ($switch || $change_au)) {
    $action = "switch_error";
}

switch ($action)
{
    case "change_au": // РґРѕР±Р°РІР»СЏРµРј/РёР·РјРµРЅСЏРµРј Р°РЅС‚РёСЋР·РµСЂР°.
        $response = array();

        $location = ($_SESSION['ref_uri'])? HTTP_PFX.$_SERVER["HTTP_HOST"].urldecode($_SESSION['ref_uri']) :  HTTP_PFX.$_SERVER["HTTP_HOST"]."/";

        $_SESSION['pro_last'] = payed::ProLast($_SESSION['login']);
        $_SESSION['pro_last'] = $_SESSION['pro_last']['is_freezed'] ? false : $_SESSION['pro_last']['cnt'];
        $_SESSION['anti_pro_last'] = payed::ProLast($_SESSION['anti_login']);
        $_SESSION['anti_pro_last'] = $_SESSION['anti_pro_last']['is_freezed'] ? false : $_SESSION['anti_pro_last']['cnt'];
        if( !($uid=get_uid()) ) { header("Location: ".$location); exit; }

        $post_pwd   = stripslashes($_POST['passwd']);
        $anti_login = __paramInit('string',NULL,'a_login');

        // РїРѕР»СѓС‡Р°РµРј РєР»Р°СЃСЃ Р°РЅС‚РёСЋР·РµСЂР°. РћРЅ РІСЃРµРіРґР° РїСЂРѕС‚РёРІРѕРїРѕР»РѕР¶РµРЅ РєР»Р°СЃСЃСѓ СЋР·РµСЂР°.
        $anti_class = is_emp() ? 'freelancer' : 'employer';
        $anti = new $anti_class();
        // Р·Р°РїРѕРјРёРЅР°РµРј РґР°РЅРЅС‹Рµ Р°РЅС‚РёСЋР·РµСЂР°.
        $anti->GetUser($anti_login, true, true);
        $anti_uid = $anti->uid;
        $anti_uname = $anti->uname;
        $anti_usurname = $anti->usurname;


        if( !$anti_uid ) {
            echo json_encode(array('success' => false));
            exit;
        } // С‚.Рµ. РЅРµС‚ СЋР·РµСЂР° СЃ Р»РѕРіРёРЅРѕРј $anti_login СЃСЂРµРґРё $anti_class.

        // СЃРЅР°С‡Р°Р»Р° РёР·РјРµРЅСЏРµРј Р°РЅС‚РёСЋР·РµСЂР° Сѓ Р°РЅС‚РёСЋР·РµСЂР° (С‚.Рµ. СѓСЃС‚Р°РЅР°РІР»РёРІР°РµРј РµРјСѓ uid С‚РµРєСѓС‰РµРіРѕ СЋР·РµСЂР° РІ РїРѕР»Рµ anti_uid).
        $anti = new $anti_class();
        $anti->anti_uid = $uid;
        if( !$anti->Update($anti_uid, $res, "AND passwd = '".users::hashPasswd(iconv('UTF-8', 'windows-1251', $post_pwd))."'")
            && $res
            && pg_affected_rows($res) )
        {
          // СѓСЃС‚Р°РЅР°РІР»РёРІР°РµРј Р°РЅС‚РёСЋР·РµСЂР° С‚РµРєСѓС‰РµРјСѓ РїРѕР»СЊР·РѕРІР°С‚РµР»СЋ.
          $user_class = is_emp() ? 'employer' : 'freelancer';
          $user = new $user_class();
          $user->anti_uid = $anti_uid;
          if(!$user->Update($uid, $res) && $res && pg_affected_rows($res)) {
            $_SESSION['anti_uid'] = $anti_uid;
            $_SESSION['anti_login'] = $anti_login;
            $_SESSION['anti_name'] = $anti_uname;
            $_SESSION['anti_surname'] = $anti_usurname;
            if($user->is_verify=='t') {
              $anti->is_verify = 't';
              $anti->Update($anti_uid, $res);
            }
          }
          $action = "switch";
          $response['success'] = true;
        } else {
            echo json_encode(array('success' => false));
            exit;
        }

        unset($anti, $user, $post_pwd);
    
    case "switch": // РїРµСЂРµРєР»СЋС‡Р°РµРјСЃСЏ РЅР° Р°РЅС‚РёР»РѕРіРёРЅ.

        $adCatalog = $_SESSION['toppayed_catalog'];
        $adMain = $_SESSION['toppayed_main'];
        $adHead = $_SESSION['toppayed_head'];
        $adText = $_SESSION['toppayed_text'];

        $uid = get_uid(0);
        $anti_uid = $_SESSION['anti_uid'];
        // РїРµСЂРµРєР»СЋС‡Р°С‚СЊСЃСЏ РјРѕР¶РµС‚ С‚РѕР»СЊРєРѕ Р·Р°СЂРµРіРёСЃС‚СЂРёСЂРѕРІР°РЅС‹Р№ РїРѕР»СЊР·РѕРІР°С‚РµР»СЊ Рё РЅРµР»СЊР·СЏ РїРµСЂРµРєР»СЋС‡Р°С‚СЊСЃСЏ РЅР° СЃР°РјРѕРіРѕ СЃРµР±СЏ
        if (!$uid || !$anti_uid || $uid == $anti_uid) {
            $response['success'] = true;
            exit(json_encode($response));
        }
    case "login":  // Р»РѕРіРёРЅРёРјСЃСЏ.
        $_redirect = __paramInit('link', NULL, 'redirect');
        $guest_query = __paramInit('string', null, 'guest_query');
        
        if($_redirect) $_SESSION['ref_uri'] = trim($_redirect);
        $ref_uri = urldecode($_SESSION['ref_uri']);
        if(isset($_COOKIE['global_anchor']) && $_COOKIE['pathname_anchor'] == $ref_uri) {
            $anchor = $_COOKIE['global_anchor'];
        }
        $autologin = __paramInit('bool', NULL, 'autologin');

        $is_ajax = ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');

        if($action=='switch') {
            if( !($uid=get_uid()) || !$_SESSION['anti_uid'] ) break;
            $s_login = $_SESSION['anti_login'];
            $location = str_replace("/users/{$_SESSION['login']}/setup/", "/users/{$s_login}/setup/", $location);
            $user_class = is_emp() ? 'freelancer' : 'employer';
            $user = new $user_class();
            $pwd = $user->GetField($_SESSION['anti_uid'], $error, "passwd");
            logout();
        }
        else {
            $s_login = strip_tags(trim($_POST['login']));
            $pwd = users::hashPasswd(trim(stripslashes($_POST['passwd'])));
        }
        
        //Р•СЃР»Рё РїСѓСЃС‚Рѕ С‚Рѕ РґР°Р¶Рµ РЅРµРїСЂРѕР±СѓРµРј Р°РІС‚РѕСЂРёР·РѕРІР°С‚СЊСЃСЏ
        $is_log = 0;
        if (!empty($s_login) && !empty($pwd)) {
            $is_log = login($s_login, $pwd, $autologin);
        }
        unset($pwd);
        
        if($_redirect) $_SESSION['ref_uri'] = trim($_redirect);

        $default_location = is_emp() ? '/' : '/projects/';
        
        if (!$ref_uri || $ref_uri == '/') {
            $ref_uri = $default_location;
        }
        
        $location = HTTP_PFX . $_SERVER['HTTP_HOST'] . $ref_uri . $anchor;
        
        // #0012501
        $location = preg_replace("/\/router\.php\?pg=/", "", $location);
        
        // #0011589
        if(strpos($location, '/remind/') 
                || strpos($location, 'inactive.php')
                || strpos($location, 'checkpass.php')
                || strpos($location, '/registration/')
                || strpos($location, 'fbd.php')) 
                $location  = $default_location;
        
        if(!$is_ajax) {
            if ($is_log > 0){
               session_write_close();
            } elseif ($is_log == -1) {
               $_SESSION['rand'] = csrf_token();
               $location = "/banned.php?login={$s_login}&rnd={$_SESSION['rand']}";
            } elseif ($is_log == -2) {
               $location = '/inactive.php';
            } elseif ($is_log == -3) {
               $location = '/denyip.php?login='.$_POST['login'];
            } elseif ($is_log == users::AUTH_STATUS_2FA) {
               //Р РµРґРёСЂРµРєС‚ РЅР° 2РѕР№ Р°С‚Р°Рї Р°РІС‚РѕСЂРёР·Р°С†РёРё
               $location = '/auth/second/';
            } else {
               $location = '/remind/?incorrect_login=1';
            }
                        
            // ##0025730 - РђРІС‚РѕРјР°С‚РёС‡РµСЃРєРёР№ СЂРµРґРёСЂРµРєС‚ РЅР° СЃРѕР·РґР°РЅРёРµ РїСЂРѕРµРєС‚Р°, РµСЃР»Рё РЅРµР·Р°СЂРµРі. РїРѕР»СЊР·РѕРІР°С‚РµР»СЊ РЅР°Р¶Р°Р» РєРЅРѕРїРєСѓ "РћРїСѓР±Р»РёРєРѕРІР°С‚СЊ РїСЂРѕРµРєС‚"
            $_user_action = (isset($_REQUEST['user_action']) && $_REQUEST['user_action'])?substr(htmlspecialchars($_REQUEST['user_action']), 0, 25):'';
            switch($_user_action) {
              case 'tu':
                  //@todo: РІРѕР·РјРѕР¶РЅРѕ РєРѕРґ РЅРµ РёСЃРїРѕР»СЊР·СѓРµС‚СЃСЏ $redirect_to - РЅРµРёСЃРїРѕР»СЊР·СѓРµС‚СЃСЏ
                  $_redirect = trim($_redirect);
                  if($_redirect) {
                      $redirect_to = HTTP_PFX.$_SERVER["HTTP_HOST"].urldecode($_redirect);
                      $_SESSION['ref_uri2'] = NULL;
                  }
                  break; 
              case 'new_tu':
                if($is_log > 0) {
                    $location = '/users/'.$s_login.'/tu/new/';
                }
                break;
              case 'promo_verification':
                $location = '/promo/verification';
                break;
              case 'buypro':
                if($is_log > 0) {
                  if(is_emp()) {
                    $location = '/payed-emp/';
                  } else {
                    $location = '/payed/';
                  }
                }
                break;
              case 'masssending':
                if($is_log>0) { $location = '/masssending/'; }
                break;
            }
            
            if ((is_emp() || $is_log == users::AUTH_STATUS_2FA) && $guest_query) {
                require_once($_SERVER['DOCUMENT_ROOT'] . '/guest/models/GuestHelper.php');
                require_once($_SERVER['DOCUMENT_ROOT'] . '/guest/models/GuestMemoryModel.php');
                $dataForm = GuestHelper::overrideDataFromString($guest_query);
                
                if (isset($dataForm['kind']) && is_numeric($dataForm['kind'])) {
                    $guestMemoryModel = new GuestMemoryModel();
                    $hash = $guestMemoryModel->saveData($dataForm);
                    $_location = '/public/?step=1&kind=' . $dataForm['kind'] . '&hash=' . $hash;
                    if ($is_log == users::AUTH_STATUS_2FA) {
                        $_SESSION['ref_uri'] = $_location;
                    } else {
                        $location = $_location;
                    }
                }
            }
            
            header("Location: {$location}");
            exit;
        } else {

            $_SESSION['toppayed_catalog'] = $adCatalog;
            $_SESSION['toppayed_main'] = $adMain;
            $_SESSION['toppayed_head'] = $adHead;
            $_SESSION['toppayed_text'] = $adText;
            
            if ($is_log > 0){
               session_write_close();
               $response['redir'] = $location;
            } elseif ($is_log == -1) {
               $response['success'] = false;
               $_SESSION['rand'] = csrf_token();
               $response['redir'] = "/banned.php?login={$s_login}&rnd={$_SESSION['rand']}";
            } elseif ($is_log == -2) {
               $response['success'] = false;
               $response['redir'] = HTTP_PFX . $_SERVER["HTTP_HOST"] . '/inactive.php';
            } elseif ($is_log == -3) {
               $response['success'] = false;
               $response['redir'] = HTTP_PFX . $_SERVER["HTTP_HOST"] . '/denyip.php?login='.$s_login;
            } elseif ($is_log == users::AUTH_STATUS_2FA) {
               //Р РµРґРёСЂРµРєС‚ РЅР° 2РѕР№ Р°С‚Р°Рї Р°РІС‚РѕСЂРёР·Р°С†РёРё
               $response['success'] = false;           
               $response['redir'] = HTTP_PFX . $_SERVER['HTTP_HOST'] . '/auth/second/';
            } else {
               $response['success'] = false;
               $response['redir'] = HTTP_PFX . $_SERVER["HTTP_HOST"] . '/remind/?incorrect_login=1';
            }
            
            exit(json_encode($response));
            //exit;
        }
        break;
    case "switch_error":
        $response['success'] = true;
        exit(json_encode($response));
        break;
     case "postproject":
          include ("user/employer/setup/newproj.php");
          break;  
     case "prj_close":
          if ($_GET["prid"]) {
               require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/projects.php");
               $portf = new projects();
               if (intval($_GET["prid"])) {
                   if (!$portf->CheckBlocked(intval($_GET['prid'])) || hasPermissions('projects')) {
                       $error .= $portf->SwitchStatusPrj(get_uid(), intval($_GET["prid"]));
                       header("Location: /");
                       exit;
                   }
               }
          }
          break;

     case "warn":
          if (hasPermissions('projects')) {
               require_once(ABS_PATH . "/classes/messages.php");
               require_once(ABS_PATH . "/classes/users.php");
               require_once(ABS_PATH . "/classes/projects.php");
               $usr=new users();

               $usr->Warn($_GET["ulogin"]);
               $threadid = intval(trim($_GET['threadid']));
               $uid = get_uid();

               //messages::SendWarn($_GET["ulogin"],$_GET['blogid'],$_GET['threadid']); - СЌС‚Рѕ С‚СѓС‚ РЅРµ СЂР°Р±РѕС‚Р°РµС‚!

               $tprj=new projects();
               $tprj->DeletePublicProject(intval($_GET["prid"]) , get_uid() , hasPermissions('projects'));
          }
          break;
     case "post_offers_filter":
          $offers_filter = new offers_filter();
            
          $f_category = $_POST['pf_categofy'];
          
          if((int)$_POST['comboe_column_id'] === 1 && $_POST['comboe_db_id'] > 0 ) {
              $f_category[1][$_POST['comboe_db_id']] = 1;
          }
          if((int)$_POST['comboe_column_id'] === 0 && $_POST['comboe_db_id'] > 0 ) {
              $f_category[0][$_POST['comboe_db_id']] = 0;
          }
          
          if($_POST['pf_category'] && !$_POST['pf_subcategory']) {
              $f_category[0][$_POST['pf_category']] = 0;
          }
          if($_POST['pf_subcategory']) {
              $f_category[1][$_POST['pf_subcategory']] = 1;
          }
          $f_only_my_offs = $_POST['pf_only_my_offs'] ? true : false;
          $offers_filter->Save(get_uid(), $f_category, $f_only_my_offs);
          break;
     case "delete_offers_filter":
          $offers_filter = new offers_filter();
          $offers_filter->DeleteFilter(get_uid());
          break;
     case "activate_offers_filter":
          $offers_filter = new offers_filter();
          $offers_filter->ActivateFilter(get_uid());
          break;
     case "delete_offers":
          if(!hasPermissions('projects')) break;
          $fid = intval($_GET['fid']);
          $frl_offers->Delete($fid);
          $page_uri = $_GET['page']>1?"&page=".$_GET['page']:"";
          header("Location: /projects/?kind=8{$page_uri}");
          break;    
     case "unblock_offers": 
          if(!hasPermissions('projects')) break;
          $update = array("is_blocked" => 'f');
     case "block_offers":
          if(!hasPermissions('projects')) break;
          $fid = intval($_GET['fid']);
          if(!$update) $update = array("is_blocked" => 't');
          $frl_offers->Update($fid, $update);
          $page_uri = $_GET['page']>1?"&page=".$_GET['page']:"";
          header("Location: /projects/?kind=8{$page_uri}#offers".$fid);
          break; 
}


// Р”Р»СЏ Р°РІС‚РѕСЂРёР·РѕРІР°РЅРЅС‹С… РїРѕР»СЊР·РѕРІР°С‚РµР»РµР№ РЅРµ РїРѕРєР°Р·С‹РІР°РµРј Р»РµРЅРґРёРЅРі, РґРµР»Р°РµРј СЂРµРґРёСЂРµРєС‚ РЅР° РЅСѓР¶РЅС‹Р№ СЂР°Р·РґРµР»
/*if (is_emp()) {
    header('Location: /tu/');
    exit();
}
else if (get_uid(false)) {
    header('Location: /projects/');
    exit();
}*/

$rpath="../";

// Р”РѕРїРѕР»РЅРёС‚РµР»СЊРЅС‹Рµ СЃС‚РёР»Рё
//$css_file[] = "nav.css";

$js_file[] = "tservices/tservices_catalog.js";
//$js_file[] = "landings/livetex.js";

$landing_page = true;

// Р”РѕРїРѕР»РЅРёС‚РµР»СЊРЅС‹Р№ СЃС‚РёР»СЊ РґР»СЏ РѕС‚РѕР±СЂР°Р¶РµРЅРёСЏ С„РѕРЅР° СЃС‚СЂР°РЅРёС†С‹
$body_additional_class = 'landing-fon';

// РџСЂСЏС‡РµРј РєР°СЂСѓСЃРµР»СЊ РІРІРµСЂС…Сѓ СЃС‚СЂР°РЅРёС†С‹
$hide_carouser = true;

// РџСЂСЏС‡РµРј Р±Р»РѕРє СЃ СЃРѕРѕР±С‰РµРЅРёСЏРјРё
$hide_notification_bar = true;

$header = "../header.php";
$footer = "../footer.html";

/**
* РўРёРїРѕРІС‹Рµ СѓСЃР»СѓРіРё
**/
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/tservices/tservices_binds.php');

$page = 1;

// РљРѕР»РёС‡РµСЃС‚РІРѕ С‚РёРїРѕРІС‹С… СѓСЃР»СѓРі РЅР° РіР»Р°РІРЅРѕР№ СЃС‚СЂР°РЅРёС†Рµ 
$limit = 12; 

$tserviceModel = TServiceModel::model();
$freelancerModel = FreelancerModel::model();

$tservicesCatalogModel = new tservices_catalog();
$tservicesCatalogModel->setPage($limit, $page);

//РЎРЅР°С‡Р°Р»Р° Р±РµСЂРµРј Р·Р°РєСЂРµРїР»РµРЅРЅС‹Рµ
$tservices_binded = $tservicesCatalogModel->getBindedList(tservices_binds::KIND_LANDING);
$binded_ids = array();
if (count($tservices_binded)) {

    foreach ($tservices_binded as $tservice) {
        $binded_ids[] = $tservice['id'];
    }
    
    // СЂР°СЃС€РёСЂРµРЅРёРµ СЃРІРµРґРµРЅРёР№ Рѕ С‚РёРїРѕРІС‹С… СѓСЃР»СѓРіР°С…
    $tserviceModel
        ->extend($tservices_binded, 'id')
        ->readVideos($tservices_binded, 'videos', 'videos'); // РІРѕ РІСЃРµС… СЃС‚СЂРѕРєР°С… "СЂР°СЃРїР°РєРѕРІР°С‚СЊ" РјР°СЃСЃРёРІ РІРёРґРµРѕ-РєР»РёРїРѕРІ

    // СЂР°СЃС€РёСЂРµРЅРёРµ СЃРІРµРґРµРЅРёР№ Рѕ РїРѕР»СЊР·РѕРІР°С‚РµР»СЏС…
    $freelancerModel->extend($tservices_binded, 'user_id', 'user');
}


$popups = array();
$tservices_search = array();

if (count($tservices_binded) < $limit) { //Р•СЃС‚СЊ РјРµСЃС‚Р° РґР»СЏ РѕС‚РѕР±СЂР°Р¶РµРЅРёСЏ РЅРµР·Р°РєСЂРµРїР»РµРЅРЅС‹С… СѓСЃР»СѓРі
    // РїРѕРёСЃРє Р·Р°РїРёСЃРµР№
    $tservicesCatalogModel->setPage($limit, $page);
    $list = $tservicesCatalogModel->cache(300)->getList();
    $tservices_search = $list['list'];
    $total = $list['total'];

    // СЂР°СЃС€РёСЂРµРЅРёРµ СЃРІРµРґРµРЅРёР№ Рѕ С‚РёРїРѕРІС‹С… СѓСЃР»СѓРіР°С…
    $tserviceModel
        ->extend($tservices_search, 'id')
        ->readVideos($tservices_search, 'videos', 'videos'); // РІРѕ РІСЃРµС… СЃС‚СЂРѕРєР°С… "СЂР°СЃРїР°РєРѕРІР°С‚СЊ" РјР°СЃСЃРёРІ РІРёРґРµРѕ-РєР»РёРїРѕРІ

    // СЂР°СЃС€РёСЂРµРЅРёРµ СЃРІРµРґРµРЅРёР№ Рѕ РїРѕР»СЊР·РѕРІР°С‚РµР»СЏС…
    $freelancerModel->extend($tservices_search, 'user_id', 'user');
}


$tservices = $tservices_binded;

foreach ($tservices_search as $tservice) {
    if (!in_array($tservice['id'], $binded_ids) && count($tservices) < $limit) {
        $tservices[] = $tservice;
    }
}


$uid = get_uid(false);
if ($uid && !is_emp()) {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/xajax/quick_payment.common.php");
    $use_ajax = true;
    
    require_once($_SERVER['DOCUMENT_ROOT'] . '/tu/widgets/TServiceBindTeaser.php');
    $tserviceBindTeaser = new TServiceBindTeaser();
    $tserviceBindTeaser->init(array(
        'kind' => tservices_binds::KIND_LANDING,
        'uid' => $uid
    ));
    require_once($_SERVER['DOCUMENT_ROOT'] . '/tu/widgets/TServiceBindTeaserShort.php');
    $tServiceBindTeaserShort = new TServiceBindTeaserShort();
    
    $isExistsBindUp = false;
    
    //Р”РѕР±Р°РІР»СЏРµРј РїРѕРїР°РїС‹ РїСЂРѕРґР»РµРЅРёСЏ Рё РїРѕРґРЅСЏС‚РёСЏ Рє СѓСЃР»СѓРіР°Рј С‚РµРєСѓС‰РµРіРѕ СЋР·РµСЂР°
    foreach ($tservices as $key=>$tservice) {
        $is_owner = $tservice['user_id'] == $uid;
        if ($is_owner) {
            require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/quick_payment/quickPaymentPopupTservicebind.php');
            if (quickPaymentPopupTservicebind::getInstance()->inited == false) {
                quickPaymentPopupTservicebind::getInstance()->init(array(
                    'uid' => $uid,
                    'kind' => tservices_binds::KIND_LANDING
                ));
            }
            
            $popup_id = quickPaymentPopupTservicebind::getInstance()->getPopupId($tservice['id']);

            $popups[] = quickPaymentPopupTservicebind::getInstance()->render(array(
                'is_prolong' => true,
                'date_stop' => $tservice['date_stop'],
                'popup_id' => $popup_id,
                'tservices_cur' => $tservice['id'],
                'tservices_cur_text' => $tservice['title']
            ));


            if ($key > 0) {
                $isExistsBindUp = true;
                
                require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/quick_payment/quickPaymentPopupTservicebindup.php');
                if (quickPaymentPopupTservicebindup::getInstance()->inited == false) {
                    quickPaymentPopupTservicebindup::getInstance()->init(array(
                        'uid' => $uid,
                        'tservices_id' => $tservice['id'],
                        'tservices_title' => $tservice['title'],
                        'kind' => tservices_binds::KIND_LANDING
                    ));
                }
            
                $popup_id = quickPaymentPopupTservicebindup::getInstance()->getPopupId($tservice['id']);

                $popups[] = quickPaymentPopupTservicebindup::getInstance()->render(array(
                    'popup_id' => $popup_id,
                    'tservices_cur' => $tservice['id'],
                    'tservices_cur_text' => $tservice['title']
                ));
            }
        }
    }
    
    if ($isExistsBindUp) {
        $tservicesBinds = new tservices_binds(tservices_binds::KIND_LANDING);
        $bindUpPrice = $tservicesBinds->getPrice(true, $uid);
    }
    
}

$suffix = $uid <= 0? '_anon' : (is_emp()? '_emp' : '_frl');
$content_landing_image = $_SERVER['DOCUMENT_ROOT']."/templates/landings/tpl.landing_image{$suffix}.php";
$content = $_SERVER['DOCUMENT_ROOT']."/templates/landings/tpl.landing_tservices.php";

// РЎРїРёСЃРѕРє РїСЂРѕС„РµСЃСЃРёР№
$prfs = new professions();
$profs = $prfs->GetAllProfessions("",0, 1);

// РЎРѕСЂС‚РёСЂРѕРІРєР° РєР°С‚РµРіРѕСЂРёР№ РїСЂРѕС„РµСЃСЃРёР№ РїРѕ РЅР°Р·РІР°РЅРёСЋ
//usort($profs, function($a, $b) { return strcmp($a['groupname'], $b['groupname']);});

$page_title = 'Р¤СЂРёР»Р°РЅСЃ СЃР°Р№С‚ СѓРґР°Р»РµРЅРЅРѕР№ СЂР°Р±РѕС‚С‹ в„–1. Р¤СЂРёР»Р°РЅСЃРµСЂС‹, СЂР°Р±РѕС‚Р° РЅР° РґРѕРјСѓ, freelance : FL.ru';

// РѕС‚СЂРёСЃРѕРІРєР° СЃС‚СЂР°РЅРёС†С‹
include ($_SERVER['DOCUMENT_ROOT']."/template3.php");    

