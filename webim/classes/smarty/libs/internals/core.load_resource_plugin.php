<?php
/* 
 * 
 * Р”Р°РЅРЅС‹Р№ С„Р°Р№Р» СЏРІР»СЏРµС‚СЃСЏ С‡Р°СЃС‚СЊСЋ РїСЂРѕРµРєС‚Р° Р’РµР± РњРµСЃСЃРµРЅРґР¶РµСЂ.
 * 
 * Р’СЃРµ РїСЂР°РІР° Р·Р°С‰РёС‰РµРЅС‹. (c) 2005-2009 РћРћРћ "РўРћРџ".
 * Р”Р°РЅРЅРѕРµ РїСЂРѕРіСЂР°РјРјРЅРѕРµ РѕР±РµСЃРїРµС‡РµРЅРёРµ Рё РІСЃРµ СЃРѕРїСѓС‚СЃС‚РІСѓСЋС‰РёРµ РјР°С‚РµСЂРёР°Р»С‹
 * РїСЂРµРґРѕСЃС‚Р°РІР»СЏСЋС‚СЃСЏ РЅР° СѓСЃР»РѕРІРёСЏС… Р»РёС†РµРЅР·РёРё, РґРѕСЃС‚СѓРїРЅРѕР№ РїРѕ Р°РґСЂРµСЃСѓ
 * http://webim.ru/license.html
 * 
 */
?>
<?php




// $type

function smarty_core_load_resource_plugin($params, &$smarty)
{
    

    $_plugin = &$smarty->_plugins['resource'][$params['type']];
    if (isset($_plugin)) {
        if (!$_plugin[1] && count($_plugin[0])) {
            $_plugin[1] = true;
            foreach ($_plugin[0] as $_plugin_func) {
                if (!is_callable($_plugin_func)) {
                    $_plugin[1] = false;
                    break;
                }
            }
        }

        if (!$_plugin[1]) {
            $smarty->_trigger_fatal_error("[plugin] resource '" . $params['type'] . "' is not implemented", null, null, __FILE__, __LINE__);
        }

        return;
    }

    $_plugin_file = $smarty->_get_plugin_filepath('resource', $params['type']);
    $_found = ($_plugin_file != false);

    if ($_found) {            
        include_once($_plugin_file);

        
        $_resource_ops = array('source', 'timestamp', 'secure', 'trusted');
        $_resource_funcs = array();
        foreach ($_resource_ops as $_op) {
            $_plugin_func = 'smarty_resource_' . $params['type'] . '_' . $_op;
            if (!function_exists($_plugin_func)) {
                $smarty->_trigger_fatal_error("[plugin] function $_plugin_func() not found in $_plugin_file", null, null, __FILE__, __LINE__);
                return;
            } else {
                $_resource_funcs[] = $_plugin_func;
            }
        }

        $smarty->_plugins['resource'][$params['type']] = array($_resource_funcs, true);
    }
}



?>
