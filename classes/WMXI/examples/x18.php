<?php

	include('_header.php');

	# http://wiki.webmoney.ru/wiki/show/Interfeys_X18
	$res = $wmxi->X18(
		PRIMARY_WMID,     # Р’Рњ-РёРґРµРЅС‚РёС„РёРєР°С‚РѕСЂ РїРѕР»СѓС‡Р°С‚РµР»СЏ РёР»Рё РїРѕРґРїРёСЃРё
		PRIMARY_PURSE,    # Р’Рњ-РєРѕС€РµР»РµРє РїРѕР»СѓС‡Р°С‚РµР»СЏ РїР»Р°С‚РµР¶Р°
		1,                # РЅРѕРјРµСЂ РїР»Р°С‚РµР¶Р°
		'qw3t4WQ$CTtcA',  # СЃРµРєСЂРµС‚РЅРѕРµ СЃР»РѕРІРѕ
	);

	print_r($res->toObject());


?>