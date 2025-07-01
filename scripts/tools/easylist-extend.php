<?php
/**
 * easylist extend
 *
 * @file easylist-extend.php
 * @date 2021-05-01 23:14:30
 * @author gently
 *
 */
set_time_limit(0);

error_reporting(7);
date_default_timezone_set("Asia/Taipei");
define("START_TIME", microtime(true));
define("ROOT_DIR", dirname(__DIR__) . "/");
define("LIB_DIR", ROOT_DIR . "lib/");

$black_domain_list = require_once LIB_DIR . "black_domain_list.php";
require_once LIB_DIR . "addressMaker.class.php";
const WILDCARD_SRC = ROOT_DIR . "origin-files/wildcard-src-easylist.txt";
const WHITERULE_SRC = ROOT_DIR . "origin-files/whiterule-src-easylist.txt";

$ARR_MERGED_WILD_LIST = [
    'ad*.udn.com$dnstype=A|AAAA|CNAME' => null,
    'p*-ad-sign.byteimg.com' => null, // #529
    '*.mgr.consensu.org' => null,
    'vs*.gzcu.u3.ucweb.com' => null,
    'ad*.goforandroid.com' => null,
    'bs*.9669.cn' => null,
    '*serror*.wo.com.cn' => ['m' => '$dnstype=A|AAAA|CNAME'],
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
    'analytics*.clickdimensions.com' => null,
    'applovin*.*' => null,
    'appsflyer*.*' => null,
    'counter*.freecounter.ovh' => null,
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
    //'tracking*.*' => null, // #743
    'usage*.*' => null,
    'wlmonitor*.*' => null,
    'zjtoolbar*.*' => null,
];

$ARR_REGEX_LIST = [
    '/^([^\s\/]+\.)?9377[a-z0-9]{2}\.com$/' => ['m' => '$dnstype=A|AAAA'],
    '/^([^\s\/]+\.)?ad(s?[\d]+|m|s)?\.[0-9\-a-z]+\./' => [
        'm' =>
            '$denyallow=nucdn.net|azureedge.net|alibabacorp.com|alibabadns.com',
    ],
    '/^([^\s\/]+\.)?affiliat(es?[0-9a-z]*?|ion[0-9\-a-z]*?|ly[0-9a-z\-]*?)\./' => null, // fixed #406
    '/^([^\s\/]+\.)?afgr[\d]{1,2}\.com$/' => null,
    '/^([^\s\/]+\.)?analytics(\-|\.)/' => null,
    '/^([^\s\/]+\.)?counter(\-|\.)/' => null,
    '/^([^\s\/]+\.)?pixels?\./' => null,
    '/^([^\s\/]+\.)?syma[a-z]\.cn$/' => null,
    '/^([^\s\/]+\.)?widgets?\./' => null,
    '/^([^\s\/]+\.)?(stat|webstats?|swebstats?|mywebstats?)\./' => null, // #366
    //'/^([^\s\/]+\.)?track(ing)?\./' => null,
    '/^([^\s\/]+\.)?tongji\./' => null,
    '/^([^\s\/]+\.)?toolbar\./' => null,
    '/^([^\s\/]+\.)?adservice\.google\./' => null,
    '/^([^\s\/]+\.)?d[\d]+\.sina(img)?(\.com)?\.cn/' => null,
    '/^([^\s\/]+\.)?sax[\dns]?\.sina\.com\.cn/' => null,
    '/^([^\s\/]+\.)?delivery([\d]{2}|dom|modo).com$/' => null,
    '/^([^\s\/]+\.)?[c-s]ads(abs|abz|ans|anz|ats|atz|del|ecs|ecz|ims|imz|ips|ipz|kis|kiz|oks|okz|one|pms|pmz)\.com/' => null,
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
];

//對通配符匹配或正則匹配增加的額外赦免規則
$ARR_WHITE_RULE_LIST = [
    /**
     * 激進的 track(ing) 規則已被關閉，不再需要這些明確加白
     * '@@||track.cpau.info^' => 1, // #251
     * '@@||track.toggl.com^' => 1, // #307
     * '@@||tracking-protection.cdn.mozilla.net^' => 1, // #407
     * '@@||trackings.post.japanpost.jp^' => 1, // #441
     * '@@||track.aliexpress.com^' => 1, // #446
     * '@@||track.landmarkglobal.com^' => 1, // #631
     * '@@||track.bankcomm.com^' => 1, // #714
     * '@@||track.4px.com^' => 1, // #796
     * '@@||tracking.dpd.de^' => 1, // #877
     * '@@||tracking.ubisoft.com^' => 1, // #927
     * '@@||track.vontron.com^' => 1, // #985
     * '@@||tracking.doordash.com^' => 1, // #1011
     */
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
    '@@||passport.bobo.com^' => 1, // #265
    '@@||stat.jseea.cn^' => 1, // #279
    '@@||widget.intercom.io^' => 1, // #280
    '@@||www.msftconnecttest.com^' => 1, // #327
    '@@||storage.live.com^' => 1, // #333
    '@@||skyapi.onedrive.live.com^' => 1, // #333
    '@@||counter-strike.net^' => 1, // #332
    '@@||ftp.bmp.ovh^' => 1, // #353
    '@@||profile*.se.360.cn^' => 1, // #381
    '@@||pic.iask.cn^' => 1, // #397
    '@@||ad.jp^' => 1, // #399
    '@@||ad.azure.com^' => 1, // #399
    '@@||ad.cityu.edu.hk^' => 1, // #398
    '@@||edge-enterprise.activity.windows.com^' => 1, // #401
    '@@||edge.activity.windows.com^' => 1, // #401
    '@@||skydrivesync.policies.live.net^' => 1, // #409
    '@@||dxcloud.episerver.net^' => 1, // #418
    '@@||static3.iask.cn^' => 1, // #429
    '@@||login-ishare.iask.com.cn^' => 1, // #429
    '@@||wechat.ishare.iask.com.cn^' => 1, // #429
    '@@||dw.iask.com.cn^' => 1, // #429
    '@@||settings-win.data.microsoft.com^' => 1, // #426
    '@@||insideruser.microsoft.com^' => 1, // #426
    '@@||metrics.vrch.at^' => 1, // #440
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
    '@@||adm.crowdicity.com^' => 1, // #560
    '@@||iufostworldcongress-singapore.com^' => 1, // #563
    '@@||ad.ext.azure.com^' => 1, // #581
    '@@||ad.ext.azure.cn^' => 1, // #581
    '@@||api.browser.miui.com^' => 1, // #585
    '@@||pixel.prime.amazon.dev^' => 1, // #604
    '@@||microsoftazuresponsorships.com^' => 1, // #648
    '@@||adashx.ut.dingtalk.com^' => 1, // #662
    '@@||h-adashx.ut.dingtalk.com^' => 1, // #662
    '@@||ku.dk^' => 1, // #684
    '@@||ads.95516.com^' => 1, // #695
    '@@||tongji.koowo.cn^' => 1, // #742
    '@@||adverts.1foo.com^' => 1, // #782
    '@@||ads.smartmidea.net^' => 1, // #807
    '@@||widget.ezidebit.com.au^' => 1, // #834
    '@@||widget.rave.office.net^' => 1, // #837
    '@@||widget.sndcdn.com^' => 1, // #839
    '@@||ad.nl^' => 1, // #841
    '@@||code.sms.mob.com^' => 1, // #855
    '@@||api.slightcommunicativeinterconnectedness.xyz^' => 1, // #873
    '@@||openxlab.org.cn^' => 1, // #876
    '@@||ads.cdn.tvb.com^' => 1, // #911
    '@@||ads.console.aliyun.com^' => 1, // #912
    '@@||login-sh.aki-game.com^' => 1, // #945
    '@@||rocket.chat^' => 1, // #957
    '@@||usageapi.*.oraclecloud.com^' => 1, // #961
    '@@||download.falco.org^' => 1, // #993
    '@@||ad-block.dns.adguard.com^' => 1, // #1002
    '@@||app.powerbi.com^' => 1, // #1011
    '@@||analytics.meituan.net^' => 1, // #1052
];

//針對上游赦免規則anti-AD不予赦免的規則，即赦免名單的黑名單
$ARR_WHITE_RULE_BLK_LIST = [
    '@@||ads.nipr.ac.jp^' => null,
];

//針對上游通配符規則中anti-AD不予採信的規則，即通配符黑名單
$ARR_WILD_BLK_LIST = [
    'cnt*rambler.ru' => null,
    'um*.com' => null,
    'mkto-*.com' => null,
];

if (PHP_SAPI != 'cli') {
    die('nothing.');
}

$src_file = '';
try {
    $file = $argv[1];
    $src_file = ROOT_DIR . $file;
} catch (Exception $e) {
    echo "get args failed.", $e->getMessage(), "\n";
    die(0);
}

if (empty($src_file) || !is_file($src_file)) {
    echo 'src_file:', $src_file, ' is not found.';
    die(0);
}

if (!is_file(WILDCARD_SRC) || !is_file(WHITERULE_SRC)) {
    echo 'key file is not found.';
    die(0);
}

$wild_fp = fopen(WILDCARD_SRC, 'r');
$arr_wild_src = [];

while (!feof($wild_fp)) {
    $wild_row = fgets($wild_fp, 512);
    if (empty($wild_row)) {
        continue;
    }
    if (
        !preg_match(
            '/^\|\|?([\w\-\.\*]+?)\^(\$([^=]+?,)?(image|third-party|script)(,[^=]+)?)?$/',
            $wild_row,
            $matches
        )
    ) {
        continue;
    }

    if (array_key_exists($matches[1], $ARR_WILD_BLK_LIST)) {
        continue;
    }

    $matched = false;
    // TODO 此處對應似乎還不夠完美，需再次斟酌
    foreach ($ARR_REGEX_LIST as $regex_str => $regex_row) {
        if (
            preg_match($regex_str, (string) str_replace('*', '', $matches[1]))
        ) {
            $matched = true;
            break;
        }
    }
    if ($matched) {
        continue;
    }
    $arr_wild_src[$matches[1]] = [];
}
fclose($wild_fp);

$arr_wild_src = array_merge($arr_wild_src, $ARR_MERGED_WILD_LIST);

$written_size = $line_count = 0;

$src_content = file_get_contents($src_file);
$attached_content = '';
$tmp_replaced_content = '';

//按需寫入白名單規則
$whiterule = file(WHITERULE_SRC, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
$whiterule = array_fill_keys($whiterule, 0);
$ARR_WHITE_RULE_LIST = array_merge($whiterule, $ARR_WHITE_RULE_LIST);
$wrote_whitelist = [];
$remained_white_rule = [];
foreach ($ARR_WHITE_RULE_LIST as $row => $v) {
    if (empty($row) || $row[0] !== '@' || $row[1] !== '@') {
        continue;
    }
    $matches = [];
    if (!preg_match('/^@@\|\|([0-9a-z\.\-\*]+?)\^/', (string) $row, $matches)) {
        continue;
    }

    if(array_key_exists("@@||{$matches[1]}^", $ARR_WHITE_RULE_BLK_LIST)){
        continue;
    }

    if (array_key_exists($matches[1], $wrote_whitelist)) {
        continue;
    }

    if ($v === 1) {
        $wrote_whitelist[$matches[1]] = null;
        $attached_content .= "@@||{$matches[1]}^\n";
        $line_count++;
        continue;
    }

    $origin_white_rule = $matches[1];
    $wrote_whitelist[$origin_white_rule] = null;
    $matches[1] = str_replace('*', '.abc.', $matches[1]);
    $matches[1] = str_replace('..', '.', $matches[1]);
    $extract_domain = addressMaker::extract_main_domain($matches[1]);
    if (!$extract_domain) {
        $extract_domain = $matches[1];
    }

    // TODO 3級或以上網域名稱加白2級網域名稱的情況未納入
    if (!str_contains((string) $src_content, '|' . $extract_domain)) {
        $remained_white_rule[$origin_white_rule] = 1;
        continue;
    }

    $attached_content .= "@@||{$origin_white_rule}^\n";
    $line_count++;
}

unset($wrote_whitelist);

// 清洗正則表達式對應
foreach ($ARR_REGEX_LIST as $regex_str => $regex_row) {
    $php_regex = str_replace(['/^', '$/'], ['/^\|\|', '\^'], $regex_str);
    $php_regex = preg_replace('/(.+?[^$])\/$/', '\1.*\^', $php_regex);
    $php_regex .= "\n/m";

    $tmp_replaced_content = preg_replace($php_regex, "", $src_content);
    if ($tmp_replaced_content === $src_content) {
        continue;
    }
    $src_content = $tmp_replaced_content;
    $tmp_replaced_content = '';
    $attached_content .= $regex_str;
    if ($regex_row && is_array($regex_row) && $regex_row['m']) {
        $attached_content .= $regex_row['m'];
    }
    $attached_content .= "\n";
    $line_count++;

    foreach ($remained_white_rule as $rmk => $rmv) {
        if (
            preg_match(
                $php_regex,
                '||' . str_replace('*', '123', $rmk) . "^\n\n"
            )
        ) {
            $attached_content .= '@@||' . $rmk . "^\n";
            $line_count++;
            unset($remained_white_rule[$rmk]);
        }
    }
}

// 清洗*號模糊對應
$wrote_wild_list = [];
foreach ($arr_wild_src as $wild_rule => $wild_value) {
    if (array_key_exists($wild_rule, $wrote_wild_list)) {
        continue;
    }

    $php_regex =
        '/^\|\|(\S+\.)?' .
        str_replace(['.', '*', '-'], ['\\.', '.*', '\\-'], $wild_rule) .
        "\^\n/m";
    $tmp_replaced_content = preg_replace($php_regex, '', $src_content);
    if ($tmp_replaced_content == $src_content) {
        continue;
    }

    $wrote_wild_list[$wild_rule] = 1;

    $src_content = $tmp_replaced_content;
    $tmp_replaced_content = '';
    $attached_content .= '||' . $wild_rule;
    if ($wild_value && is_array($wild_value) && $wild_value['m']) {
        $attached_content .= '^' . $wild_value['m'] . "\n";
    } else {
        $attached_content .= "^\n";
    }

    $line_count++;

    foreach ($remained_white_rule as $rmk => $rmv) {
        if (
            preg_match(
                $php_regex,
                '||' . str_replace('*', '123', $rmk) . "^\n\n"
            )
        ) {
            $attached_content .= '@@||' . $rmk . "^\n";
            $line_count++;
            unset($remained_white_rule[$rmk]);
        }
    }
}

$line_count += substr_count($src_content, "\n");
$correct_magic = preg_match_all("/^\!.+?$/m", (string) $src_content);
$src_content = str_replace(
    "!Total lines: 00000\n",
    '!Total lines: ' .
        ($line_count - $correct_magic) .
        "\n" .
        $attached_content,
    $src_content
);

file_put_contents($src_file, $src_content);
file_put_contents($src_file . '.md5', md5_file($src_file));
echo 'Time cost:',
    microtime(true) - START_TIME,
    "s, at ",
    date('m-d H:i:s'),
    "\n";
