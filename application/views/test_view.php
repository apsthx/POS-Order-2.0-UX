<?php

header('content-type: text/html; charset=tis-620;');
$url = 'http://track.thailandpost.co.th/trackinternet/Default.aspx';
$signature = 'http://track.thailandpost.co.th/trackinternet/signature.aspx';

$ckfile = tempnam("/tmp", "CURLCOOKIE");
$useragent = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.2 (KHTML, like Gecko) Chrome/5.0.342.3 Safari/533.2';

/**
  Get __VIEWSTATE & __EVENTVALIDATION
 */
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
$html = curl_exec($ch);
curl_close($ch);

preg_match('~<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />~', $html, $viewstate);
preg_match('~<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />~', $html, $eventValidation);

$viewstate = $viewstate[1];
$eventValidation = $eventValidation[1];

/**
  Get Result from TRACKING NUMBER
 */
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

// Collecting all POST fields
$post = array();
$post['__EVENTTARGET'] = "Login";
$post['__EVENTARGUMENT'] = "";
$post['__VIEWSTATE'] = $viewstate;
$post['__EVENTVALIDATION'] = $eventValidation;
$post['TextBarcode'] = $_GET['track'];

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$c = curl_exec($ch);
curl_close($ch);

if (preg_match_all('~(<td style="width:[^"]+">.+)<\/td>~', $c, $m)) {
    echo '<table>';
    foreach ($m[1] as $k => $v) {
        echo '<tr>' . str_replace('signature.aspx', $signature, $v) . '</tr>';
    }
    echo '</table>';
} else {
    echo 'Not found!!!';
}
?>