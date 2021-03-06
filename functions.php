<?php
if (realpath($_SERVER['SCRIPT_FILENAME']) == realpath(__FILE__)) { die('This page is not meant to be accessed directly.'); }
$reservedPages = array();
$beforeLoad = array();
$header = array();
$beforeContent = array();
$afterContent = array();
$footer = array();
$jsScripts = array();
$cssStyles = array();
$footerTxt = array();
$modifiedPageNames = array();
function newAction($event, $action) {
    global $beforeLoad, $header, $beforeContent, $afterContent, $footer, $jsScripts, $cssStyles, $footerTxt;
    if($event=="beforeLoad") { array_push($beforeLoad, $action); }
    elseif($event=="header") { array_push($header, $action); }
    elseif($event=="beforeContent") { array_push($beforeContent, $action); }
    elseif($event=="afterContent") { array_push($afterContent, $action); }
    elseif($event=="footer") { array_push($footer, $action); }
    elseif($event=="jsScripts") { array_push($jsScripts, $action); }
    elseif($event=="cssStyles") { array_push($cssStyles, $action); }
    elseif($event=="footerTxt") { array_push($footerTxt, $action); }
    else { return false; break; }
}
function runEvent($event) {
    global $beforeLoad, $header, $beforeContent, $afterContent, $footer, $jsScripts, $cssStyles, $footerTxt;
    if($event=="beforeLoad") { $loop = $beforeLoad; }
    elseif($event=="header") { $loop = $header; }
    elseif($event=="beforeContent") { $loop = $beforeContent; }
    elseif($event=="afterContent") { $loop = $afterContent; }
    elseif($event=="footer") { $loop = $footer; }
    elseif($event=="jsScripts") { $loop = $jsScripts; }
    elseif($event=="cssStyles") { $loop = $cssStyles; }
    elseif($event=="footerTxt") { $loop = $footerTxt; }
    else { return false; break; }
    foreach($loop as $action) {
        $action();
    }
}
function modify_page_name($page) {
    global $modifiedPageNames;
    foreach($modifiedPageNames as $modPage) {
        if($modPage==$page) { return false; break;}
    }
    array_push($modifiedPageNames, $page);
}
function get_mod_page_name($page) {
    global $modifiedPageNames;
    $newname = ucwords(str_replace("-"." ",$page));
    foreach($modifiedPageNames as $modPage) {
        if($modPage==$page) {
            $action = "getmodpagename_" . str_replace("-","_",$page);
            $newname = $action();
            break;
        }
    }
    return $newname;
}
function reserve_page($name) {
    global $reservedPages;
    if(file_exists("pages/" . $name . ".php")) { return false; break; }
    foreach($reservedPages as $resPage) {
        if($resPage==$name) { return false; break;}
    }
    array_push($reservedPages, $name);
}
function getContent() {
   global $callPage;
   if($callPage=="action") {
        global $page;
        $action = "getpage_" . str_replace("-","_",$page);
        $action();
    }
    else { require "$callPage"; }
}
?>
