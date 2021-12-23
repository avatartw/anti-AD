<?php
/**
 * easylist extend
 *
 * @file easylist-extend.php
 * @date 2019-12-24
 * @author gently
 *
 */
set_time_limit(0);

error_reporting(7);
date_default_timezone_set('Asia/Taipei');
define('START_TIME', microtime(true));
define('ROOT_DIR', dirname(__DIR__) . '/');
define('LIB_DIR', ROOT_DIR . 'lib/');

$black_domain_list = require_once LIB_DIR . 'black_domain_list.php';
require_once LIB_DIR . 'addressMaker.class.php';
define('WILDCARD_SRC', ROOT_DIR . 'origin-files/wildcard-src-easylist.txt');
define('WHITERULE_SRC', ROOT_DIR . 'origin-files/whiterule-src-easylist.txt');

$ARR_MERGED_WILD_LIST = array(
    'ad*.udn.com' => null,
    'p*-ad-sign.byteimg.com' => null, // #529
    '*.mgr.consensu.org' => null,
    'vs*.gzcu.u3.ucweb.com' => null,
    'ad*.goforandroid.com' => null,
    'bs*.9669.cn' => null,
    '*serror*.wo.com.cn' => null,
    '*mistat*.xiaomi.com' => null,
    'affrh20*.com' => null,
    'assoc-amazon.*' => null,
    'clkservice*.youdao.com' => null,
    'dsp*.youdao.com' => null,
    'pussl*.com' => null,
    'putrr*.com' => null,
    't*.a.market.xiaomi.com' => null,
    'ad*.bigmir.net' => null,
    'log*.molitv.cn' => null,
    'adm*.autoimg.cn' => null,
    'cloudservice*.kingsoft-office-service.com' => null,
    'gg*.51cto.com' => null,
    'log.*.hunantv.com' => null,
    'iflyad.*.openstorage.cn' => null,
    '*customstat*.51togic.com' => null,
//    'appcloud*.zhihu.com' => null, // #344
    'ad*.molitv.cn' => null,
    'ads*-adnow.com' => null,
    'aeros*.tk' => null,
    'analyzer*.fc2.com' => null,
    'admicro*.vcmedia.vn' => null,
    'xn--xhq9mt12cf5v.*' => null,
    'freecontent.*' => null,
    'hostingcloud.*' => null,
    'jshosting.*' => null,
    'flightzy.*' => null,
    'sunnimiq*.cf' => null,
    'admob.*' => null,
    '*log.droid4x.cn' => null,
    '*tsdk.vivo.com.cn' => null,
    '*.mmstat.com' => null,
    //'sf*-ttcdn-tos.pstatp.com' => null,
    'f-log*.grammarly.io' => null,
    '24log.*' => null,
    '24smi.*' => null,
    'ad-*.wikawika.xyz' => null,
    'ablen*.tk' => null,
    'darking*.tk' => null,
    'doubleclick*.xyz' => null,
    'thepiratebay.*' => null,
    'adserver.*' => null,
    'clientlog*.music.163.com' => null,
    'brucelead*.com' => null,
    'gostats.*' => null,
    'gralfusnzpo*.top' => null,
    'oiwjcsh*.top' => null,
    '*-analytics*.huami.com' => null,
    'count*.pconline.com.cn' => null,
    'qchannel*.cn' => null,
    'sda*.xyz' => null,
    'ad-*.com' => null,
    'ad-*.net' => null,
    'webads.*' => null,
    'web-stat.*' => null,
    'waframedia*.*' => null,
    'wafmedia*.*' => null,
    'voluumtrk*.com' => null,
    'vmm-satellite*.com' => null,
    'vente-unique.*' => null,
    'vegaoo*.*' => null,
    'umtrack*.com' => null,
    'grjs0*.com' => null,
    'imglnk*.com' => null,
    '*ad.durasite.net' => null,
    'ad*.nownews.com' => null,
    'ad*.tmgrup.com.tr' => null,
    'counter*-yadro*-ru.unblocked.lol' => null,
    'pl.bitcoin*.track*.com' => null,
    'stat*.1internet.tv' => null,
    'admarvel*.*' => null,
    'admaster*.*' => null,
    'adsage*.*' => null,
    'adsensor*.*' => null,
    'adservice*.*' => null,
    'adsh*.*' => null,
    'adsmogo*.*' => null,
    'adsrvmedia*.*' => null,
    'adsserving*.*' => null,
    'adsystem*.*' => null,
    'adwords*.*' => null,
    'analysis*.*' => null,
    'applovin*.*' => null,
    'appsflyer*.*' => null,
    'domob*.*' => null,
    'duomeng*.*' => null,
    'dwtrack*.*' => null,
    'guanggao*.*' => null,
    //'lianmeng*.*' => null, // #448
    //'monitor*.*' => null,
    'omgmta*.*' => null,
    'omniture*.*' => null,
    'openx*.*' => null,
    'olx.pl-*.*' => null,
    'olx.pl.*.*' => null,
    'partnerad*.*' => null,
    'pingfore*.*' => null,
    'socdm*.*' => null,
    'supersonicads*.*' => null,
    'tracking*.*' => null,
    'usage*.*' => null,
    'wlmonitor*.*' => null,
    'zjtoolbar*.*' => null,
);

$ARR_REGEX_LIST = array(
    '/^([^\s\/]+\.)?9377[a-z0-9]{2}\.com$/$dnstype=A|AAAA' => null,
    '/^([^\s\/]+\.)?ad(s?[\d]+|m|s)?\./$denyallow=nucdn.net|azureedge.net|alibabacorp.com|alibabadns.com' => null,
    '/^([^\s\/]+\.)?affiliat(es|ion|e)\./' => null,
    '/^([^\s\/]+\.)?afgr[\d]{1,2}\.com$/' => null,
    '/^([^\s\/]+\.)?analytics(\-|\.)/' => null,
    '/^([^\s\/]+\.)?counter(\-|\.)/' => null,
    '/^([^\s\/]+\.)?pixels?\./' => null,
    '/^([^\s\/]+\.)?syma[a-z]\.cn$/' => null,
    '/^([^\s\/]+\.)?widgets?\./' => null,
    '/^([^\s\/]+\.)?(stat|webstats?|swebstats?|mywebstats?)\./' => null, // #366
    '/^([^\s\/]+\.)?track(ing)?\./' => null,
    '/^([^\s\/]+\.)?tongji\./' => null,
    '/^([^\s\/]+\.)?toolbar\./' => null,
    '/^([^\s\/]+\.)?adservice\.google\./' => null,
    '/^([^\s\/]+\.)?d[\d]+\.sina(img)?(\.com)?\.cn/' => null,
    '/^([^\s\/]+\.)?sax[\dns]?\.sina\.com\.cn/' => null,
    '/^([^\s\/]+\.)?delivery([\d]{2}|dom|modo).com$/' => null,
    '/^([^\s\/]+\.)?[c-s]ads(abs|abz|ans|anz|ats|atz|del|ecs|ecz|ims|imz|ips|ipz|kis|kiz|oks|okz|one|pms|pmz)\.com/' => null,
    '/^([^\s\/]+\.)?[0-9a-z\-]{26,}\.(com|net|cn)(\.cn)?$/' => null, //超長域名
    '/^([^\s\/]+\.)?11599[\da-z]{2,20}\.com$/' => null, //"澳門新葡京"系列
    '/^([^\s\/]+\.)?61677[\da-z]{0,20}\.com$/' => null, //"澳門新葡京"系列
    '/^([^\s\/]+\.)?[0-9a-f]{15,}\.com$/' => null, //15個字符以上的16進制域名
    '/^([^\s\/]+\.)?[0-9a-z]{16,}\.xyz$/' => null, //16個字符以上的.xyz域名
    '/^([^\s\/]+\.)?6699[0-9]\.top$/' => null, //連號
    '/^([^\s\/]+\.)?abie[0-9]+\.top$/' => null, //連號
    '/^([^\s\/]+\.)?ad[0-9]{3,}m.com$/' => null, //連號
    '/^([^\s\/]+\.)?aj[0-9]{4,}.online$/' => null, //連號
    '/^([^\s\/]+\.)?xpj[0-9]\.net$/' => null, //連號
    '/^([^\s\/]+\.)?ylx-[0-9].com$/' => null, //連號
    '/^([^\s\/]+\.)?ali2[a-z]\.xyz$/' => null, //連號
    '/^([^\s\/]+\.)?777\-?partners?\.(net|com)$/' => null, //組合
    '/^([^\s\/]+\.)?voyage-prive\.[a-z]+(\.uk)?$/' => null, //組合
    '/^([^\s\/]+\.)?e7[0-9]{2,4}\.(net|com)?$/' => null, //組合
    '/^([^\s\/]+\.)?g[1-4][0-9]{8,9}\.com?$/' => null, //批量組合
    '/^([^\s\/]+\.)?hg[0-9]{4,5}\.com?$/' => null, //批量組合
    '/213\.32\.115\..{100,}/' => null,
    '/217\.182\.11\..{100,}/' => null,
    '/51\.195\.31\..{100,}/' => null,
    '/^([\w]{1,4}\.)(\w+)?-?pocztex.*\d+-?(polska)?\.[\w]{2,14}/' => null,
    '/^([\w]{1,4}\.)?(\w+)?.?\w+-?poczta(\d+)?-?polska(\d+)?\.[\w]{2,14}/' => null,
    '/^([\w]{1,4}\.)?(\w+)?.?\w+-?polska(\d+)?-?poczta(\d+)?\.[\w]{2,14}/' => null,
    '/^([\w]{1,4}\.)?(\w+)?-?(\d+)?gwalt(fakty?|news|wiadomosci?|polska|monitoring)\.[\w]{2,14}/' => null,
    '/^([\w]{1,4}\.)?(\w+)?\.?poczta-?polska\d+\.[\w]{2,14}/' => null,
    '/^([\w]{1,4}\.)?(\w+)?\.\w+-?pocztex(\d+)?\.[\w]{2,14}/' => null,
    '/^([\w]{1,4}\.)?(apps?|best|competition|game|mobile|play|prize|reward|sweeps)[\d]{2,8}\.[a-z-]{4,22}[\d]{1,8}\.(agency|icu|life|live|loan)/' => null,
    '/^([\w]{1,4}\.)?(apps?|best|competition|game|mobile|play|prize|reward|sweeps)\.[a-z-]{4,22}[0-9]{1,8}\.info/' => null,
//    '/^([\w]{1,4}\.)?(copysubstancepattern|decimalprovehour|discusssheetenemy|educationbedring|effectstorestream|fingermilkorgan|flyingintheclouds|goedekans|historyalwayschildren|ideaanstudy|insectrunfollow|jsdevelopmentq|mindspellnothing|noseangerspend|occurthousandlast|payageround-|randalieren|roundsolutionbrought|sciencewhategg|shoutmostface|thinkwhilemelody|thoughcopyforest|togethercleareducation|waterdiepattern|whateyeweight|wildgrelns)[\d]{1,2}\.live/' => null,
//    '/^([^\s\/]+\.)?anzugreifen([1-9]|1[0-5])\.live/' => null,
//    '/^([^\s\/]+\.)?consquarters([1-9]|1[0-5])\.live/' => null,
//    '/^([^\s\/]+\.)?curtainhardsh([1-9]|1[0-9]|2[0-5])\.live/' => null,
//    '/^([^\s\/]+\.)?esoterisch([1-9]|1[0-5])\.live/' => null,
//    '/^([^\s\/]+\.)?garternal([1-9]|1[0-9]|20)\.live/' => null,
//    '/^([^\s\/]+\.)?greenelephants([1-9]|1[0-5])\.live/' => null,
//    '/^([^\s\/]+\.)?headregret([1-9]|1[0-9]|20)\.live/' => null,
//    '/^([^\s\/]+\.)?lifefordatings([1-9]|1[0-5])\.live/' => null,
//    '/^([^\s\/]+\.)?listentome([1-9]|1[0-5])\.live/' => null,
//    '/^([^\s\/]+\.)?matchwhytotal([1-9]|1[0-5])\.live/' => null,
//    '/^([^\s\/]+\.)?rainxpose([1-9]|1[0-9]|20)\.live/' => null,
//    '/^([^\s\/]+\.)?teckinharmux([1-9]|1[0-9]|20)\.live/' => null,
//    '/^([^\s\/]+\.)?tekerstreet([6-9]|1[0-9]|20)\.live/' => null,
//    '/^([^\s\/]+\.)?testing3srv([1-9]|10)\.live/' => null,
//    '/^([^\s\/]+\.)?thvedroisil([1-9]|1[0-5])\.live/' => null,
//    '/^([^\s\/]+\.)?waarschijnlijk([1-9]|1[0-5])\.live/' => null,
    '/^([\w]{1,4}\.)?.*-?(fakty?|news|wiadomosci?)gwalt(\d+)?\.[\w]{2,14}/' => null,
    '/^([\w]{1,4}\.)?.*-?emonitoring-?e?poczta[\w]{1,14}/' => null,
    '/^([\w]{1,4}\.)?\d+platnosci?\.online/' => null,
    '/^([\w]{1,4}\.)?allegro(finanse)?\d+\.pl/' => null,
    '/^([\w]{1,4}\.)?faktury\d+\.org/' => null,
    '/^([\w]{1,4}\.)?(probablerootport|ideaanstudy)-?[\d]{1,2}\.live/' => null,
    '/^([\w]{1,4}\.)?inwestpoland\d+\.site/' => null,

    // '/^([^\s\/]+\.)?(?=.*[a-f].*\.com$)(?=.*\d.*\.com$)[a-f0-9]{15,}\.com$/' => null,
);

//對通配符匹配或正則匹配增加的額外赦免規則
$ARR_WHITE_RULE_LIST = array(
    '@@||fonts.gstatic.com^' => 1,
    '@@||tongji.*kuwo.cn^' => 0,
    '@@||tracking.epicgames.com^' => 0,
    '@@||tracking.magnetmail.net^' => 0,
    '@@||tracker.eu.org^' => 1, //強制加白，BT tracker，有形如2.tracker.eu.org的域
    '@@||stats.uptimerobot.com^' => 1, //uptimerobot監測相關 //#38
    '@@||track.sendcloud.org^' => 0, //郵件退訂域名
    '@@||log.mmstat.com^' => 0, //修復優酷視頻顯示禁用了cookie
    '@@||adm.10jqka.com.cn^' => 0, //同花順
    '@@||center-h5api.m.taobao.com^' => 1, //h5頁面
    '@@||app.adjust.com^' => 1, //https://github.com/AdguardTeam/AdGuardSDNSFilter/pull/186
    '@@||widget.weibo.com^' => 0, //微博外鏈
    '@@||uland.taobao.com^' => 1, //淘寶coupon #83
    '@@||advertisement.taobao.com^' => 1, //CNAME 被殺，導致s.click.taobao.com等服務異常
    '@@||baozhang.baidu.com^' => 1, //CNAME e.shifen.com
    '@@||tongji.edu.cn^' => 1, // 同濟大學
    '@@||tongji.cn^' => 1, // 同濟大學 #281
    '@@||ad.siemens.com.cn^' => 1, // 西門子下載中心
    '@@||sdkapi.sms.mob.com^' => 1, // 短信驗證碼 #127
    //'@@||stats.gov.cn^' => 1, // 國家統計局 #144 // #366
    '@@||tj.gov.cn^' => 1,
    '@@||sax.sina.com.cn^' => 1, // #155
    '@@||api.ad-gone.com^' => 1, // #207
    '@@||news-app.abumedia.yql.yahoo.com^' => 1, // #206
    '@@||meizu.coapi.moji.com^' => 1, // #217
    '@@||track.cpau.info^' => 1, // #251
    '@@||passport.bobo.com^' => 1, // #265
    '@@||stat.jseea.cn^' => 1, // #279
    '@@||widget.intercom.io^' => 1, // #280
    '@@||track.toggl.com^' => 1, // #307
    '@@||www.msftconnecttest.com^' => 1, // #327
    '@@||storage.live.com^' => 1, // #333
    '@@||skyapi.onedrive.live.com^' => 1, // #333
    '@@||counter-strike.net^' => 1, // #332
    '@@|ftp.bmp.ovh^' => 1, // #353
    '@@||profile*.se.360.cn^' => 1, // #381
    '@@||pic.iask.cn^' => 1, // #397
    '@@||ad.jp^' => 1, // #399
    '@@||ad.azure.com^' => 1, // #399
    '@@||ad.cityu.edu.hk^' => 1, // #398
    '@@||edge-enterprise.activity.windows.com^' => 1, // #401
    '@@||edge.activity.windows.com^' => 1, // #401
    '@@||tracking-protection.cdn.mozilla.net^' => 1, // #407
    '@@||skydrivesync.policies.live.net^' => 1, // #409
    '@@||dxcloud.episerver.net^' => 1, // #418
    '@@||static3.iask.cn^' => 1, // #429
    '@@||login-ishare.iask.com.cn^' => 1, // #429
    '@@||wechat.ishare.iask.com.cn^' => 1, // #429
    '@@||dw.iask.com.cn^' => 1, // #429
    '@@||settings-win.data.microsoft.com^' => 1, // #426
    '@@||insideruser.microsoft.com^' => 1, // #426
    '@@||metrics.vrch.at^' => 1, // #440
    '@@||trackings.post.japanpost.jp^' => 1, // #441
    '@@||track.aliexpress.com^' => 1, // #446
    '@@||s.mvconf.f.360.cn^' => 1, // #462
    '@@||widget.1688.com^' => 1, // #469
    '@@||analytics.google.com^' => 1,
    '@@||widget.gleamjs.io^' => 1, // #472
    '@@||form.ict-toshiba.jp^' => 1,
    '@@||cart.matsuzaka-steak.com^' => 1,
    '@@||api.huangye.miui.com^' => 1, // #476
    '@@||ads.privacy.qq.com^' => 1, // #505
    '@@||wl.spotify.com^' => 1, // #508
    '@@||ad-putting.gw.zt-express.com^' => 1, // #534
);

//針對上游赦免規則anti-AD不予赦免的規則，即赦免名單的黑名單
$ARR_WHITE_RULE_BLK_LIST = array(
    '@@||ads.nipr.ac.jp^' => null,
);

//針對上游通配符規則中anti-AD不予採信的規則，即通配符黑名單
$ARR_WILD_BLK_LIST = array(
    'cnt*rambler.ru' => null,
    'um*.com' => null,
    'mkto-*.com' => null,
);

if(PHP_SAPI != 'cli'){
    die('nothing.');
}

$src_file = '';
try{
    $file = $argv[1];
    $src_file = ROOT_DIR . $file;
}catch(Exception $e){
    echo "get args failed.", $e->getMessage(), "\n";
    die(0);
}

if(empty($src_file) || !is_file($src_file)){
    echo 'src_file:', $src_file, ' is not found.';
    die(0);
}

if(!is_file(WILDCARD_SRC) || !is_file(WHITERULE_SRC)){
    echo 'key file is not found.';
    die(0);
}

$src_fp = fopen($src_file, 'r');
$wild_fp = fopen(WILDCARD_SRC, 'r');
$new_fp = fopen($src_file . '.txt', 'w');

$wrote_wild = array();
$arr_wild_src = array();

while(!feof($wild_fp)){
    $wild_row = fgets($wild_fp, 512);
    if(empty($wild_row)){
        continue;
    }
    if(!preg_match('/^\|\|?([\w\-\.\*]+?)\^(\$([^=]+?,)?(image|third-party|script)(,[^=]+)?)?$/', $wild_row, $matches)){
        continue;
    }

    if(array_key_exists($matches[1], $ARR_WILD_BLK_LIST)){
        continue;
    }

    $matched = false;
    foreach($ARR_REGEX_LIST as $regex_str => $regex_row){
        $arr_regex = explode('/$', $regex_str);
        $final_regex = $regex_str;
        if(count($arr_regex) > 1){
            $final_regex = $arr_regex[0] . '/';
        }
        if(preg_match($final_regex, str_replace('*', '',$matches[1]))){
            $matched = true;
        }
    }
    if($matched){
        continue;
    }
    $arr_wild_src[$matches[1]] = $wild_row;
}
fclose($wild_fp);

$arr_wild_src = array_merge($arr_wild_src, $ARR_MERGED_WILD_LIST);
$insert_pos = $written_size = $line_count = 0;
while(!feof($src_fp)){
    $row = fgets($src_fp, 512);
    if(empty($row)){
        continue;
    }

    if((substr($row, 0, 1) === '!')){
        if(substr($row, 0, 13) === '!Total lines:'){
            $insert_pos = $written_size;
        }
        $written_size += fwrite($new_fp, $row);
        continue;
    }

//    if(!preg_match('/^\|.+?/', $row)){
//        $written_size += fwrite($new_fp, $row);
//        continue;
//    }

    $matched = false;
    foreach($ARR_REGEX_LIST as $regex_str => $regex_row){
        $arr_regex = explode('/$', $regex_str);
        $final_regex = $regex_str;
        if(count($arr_regex) > 1){
            $final_regex = $arr_regex[0] . '/';
        }
        if(preg_match($final_regex, substr(trim($row), 2, -1))){
            $matched = true;
            if(!array_key_exists($regex_str, $wrote_wild)){
                $written_size += fwrite($new_fp, "${regex_str}\n");
                $line_count++;
                $wrote_wild[$regex_str] = 1;
            }
        }
    }

    if($matched){
        continue;
    }

    foreach($arr_wild_src as $core_str => $wild_row){
        $match_rule = str_replace(array('.', '*'), array('\\.', '.*'), $core_str);
        if(!array_key_exists($core_str, $wrote_wild)){
            $arr_wild_sub = explode('$', $core_str);
            if(count($arr_wild_sub) > 1){
                $written_size += fwrite($new_fp, "||${arr_wild_sub[0]}^\$${arr_wild_sub[1]}\n");
            }else{
                $written_size += fwrite($new_fp, "||${core_str}^\n");
            }

            $line_count++;
            $wrote_wild[$core_str] = 1;
        }
        if(preg_match("/\|(\S+\.)?${match_rule}/", $row)){
            $matched = true;
            break;
        }
    }

    if($matched){
        continue;
    }
    $written_size += fwrite($new_fp, $row);
    $line_count++;
}

//按需寫入白名單規則
$wrote_whitelist = array();
$whiterule = file(WHITERULE_SRC, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
$whiterule=array_fill_keys($whiterule, 0);
$ARR_WHITE_RULE_LIST = array_merge($whiterule, $ARR_WHITE_RULE_LIST);
foreach($ARR_WHITE_RULE_LIST as $row => $v){
    if(empty($row) || substr($row, 0, 1) !== '@' || substr($row, 1, 1) !== '@'){
        continue;
    }
    $matches = array();
    if(!preg_match('/@@\|\|([0-9a-z\.\-\*]+?)\^/', $row, $matches)){
        continue;
    }

    if(array_key_exists("@@||${matches[1]}^", $ARR_WHITE_RULE_BLK_LIST)){
        continue;
    }
    if($v === 1){
        $wrote_whitelist[$matches[1]] = null;
        fwrite($new_fp, "@@||${matches[1]}^\n");
        $line_count++;
        continue;
    }

    foreach($wrote_wild as $core_str => $val){
        if(substr($core_str, 0, 1) === '/'){
            $match_rule = $core_str;
            $arr_regex = explode('/$', $match_rule);
        }else{
            $match_rule = str_replace(array('.', '*'), array('\\.', '.*'), $core_str);
            $match_rule = "/^${match_rule}/";
        }
        

        $final_regex = $match_rule;
        if(count($arr_regex) > 1){
            $final_regex = $arr_regex[0] . '/';
        }


        if(preg_match($final_regex, $matches[1])){
            $domain = addressMaker::extract_main_domain($matches[1]);
            if(array_key_exists($domain, $black_domain_list) ||
                (is_array($black_domain_list[$domain]) && in_array($matches[1], $black_domain_list[$domain]))
            ){
                continue;
            }
            if(array_key_exists($matches[1], $wrote_whitelist)){
                continue;
            }
            $wrote_whitelist[$matches[1]] = null;
            fwrite($new_fp, "@@||${matches[1]}^\n");
            $line_count++;
        }
    }
}

if(($insert_pos > 0) && (fseek($new_fp, $insert_pos) === 0)){
    fwrite($new_fp, "!Total lines: {$line_count}\n");
}

fclose($src_fp);
fclose($new_fp);
rename($src_file . '.txt', $src_file);
file_put_contents($src_file . '.md5', md5_file($src_file));
echo 'Time cost:', microtime(true) - START_TIME, "s, at ", date('m-d H:i:s'), "\n";
