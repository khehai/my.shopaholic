<?php

define("ROOT", dirname(__DIR__));

const VIEWS = ROOT.'/app/Views';

const CONFIG = ROOT.'/config';
const DB_CONFIG_FILE = ROOT.'/config/db.php';

const MEDIA = '/storage';
define('STORAGE', $_SERVER['DOCUMENT_ROOT'].MEDIA);

require_once __DIR__.'/autoload.php';

// function conf($mix) {
//     $url = CONFIG."/${mix}.json";
//     $json = file_get_contents($url);
//     return json_decode($json, True);
// }


(new Core\App())->run();
