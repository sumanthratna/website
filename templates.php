<?php
require_once dirname(__FILE__).'/../private/keys.php';
$hit = array(
    "URL" => (isset($_SERVER["HTTPS"]) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
    "IP" => $_SERVER['REMOTE_ADDR'],
    "referrer" => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']:''
);
// error_log('HIT '.json_encode($hit, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
if ($_SERVER['HTTP_HOST']==="2022sratna.sites.tjhsst.edu") {
    header("Location: https://sumanthratna.ml$_SERVER[REQUEST_URI]");
}

require_once dirname(__FILE__).'/setup.php';
$smarty = new CustomSmarty();

function socials()
{
    global $smarty;
    $smarty->display('socials.tpl');
}
function posts()
{
    $data = file_get_contents(__DIR__."/index.json");
    return json_decode($data, true);
}
function get_header($page)
{
    global $smarty;
    $smarty->assign('page', $page);
    $smarty->display('header.tpl');
}
function get_footer()
{
    global $smarty;
    $smarty->assign('email', "sratna@".$_SERVER['HTTP_HOST']);
    $smarty->assign('posts', posts());
    $smarty->display('footer.tpl');
}
