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
require_once (dirname(__FILE__) . '/class.basemapper.php');

class VisitedPageMapper extends BaseMapper {
	
	public function __construct(DBDriver $db, $model_name) {
 		parent::__construct($db, $model_name, array("opened", "updated"));	 	
  	}
  	
  	public function getVisitTimeByVisitSessionId($visitsessionid) {
  	  return $this->makeSearch('visitsessionid=:id', 
  	    array("id" => $visitsessionid),
  	    'max(WM_UNIX_TIMESTAMP("updated")) "timeend",
         min(WM_UNIX_TIMESTAMP("opened")) "timestart",
         WM_UNIX_TIMESTAMP(SYSDATE) "curtime",
         max(WM_UNIX_TIMESTAMP("updated")) - min(WM_UNIX_TIMESTAMP("opened")) "diff"'
  	  );
  	}
  	
  	public function enumByVisitSessionId($visitsessionid) {
  	  return $this->makeSearch('"visitsessionid"=:id',
  	    array("id" => $visitsessionid),
  	    '"uri",
         "referrer",
         WM_UNIX_TIMESTAMP("updated") "updatedtime",
         WM_UNIX_TIMESTAMP("opened") "openedtime",
         (WM_UNIX_TIMESTAMP("updated") - WM_UNIX_TIMESTAMP("opened")) "sessionduration"
        '
  	  );
  	}
  	
  	public function getFirstBySessionId($visitsessionid) {
  	  $sql = '
  	  			SELECT
                    vp.*,
                    WM_UNIX_TIMESTAMP("opened") as "tsopened",
                    WM_UNIX_TIMESTAMP("updated") as "tsupdated",
                    WM_UNIX_TIMESTAMP(SYSDATE) as "current"
                FROM "{visitedpage}" vp
                WHERE
                	"visitsessionid" = :id AND 
                	"opened" = 
                	(
                		SELECT
                			MIN("opened") 
                		FROM 
                			"{visitedpage}" vp
                		WHERE
                			"visitsessionid" = :id
                    )                  
  	  ';
  	  
  	  try {
  	  	$this->db->Query($sql, array("id" => $visitsessionid));
  	  	$this->db->nextRecord();
  	  	return $this->db->getRow();
  	  } catch (Exception $e) {

  	  	return null;
  	  }
  	}
  	
}
?>