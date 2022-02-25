<?php
/**
 * url地址相關的操作類
 *
 * @file addressMaker.class.php
 * @author gently
 * @date 2017.12.31
 *
 *
 */
!defined('ROOT_DIR') && die('Access Denied.');

class addressMaker{

    const LINK_URL = 'https://github.com/avatartw/anti-AD';

    /**
     * 分離網域名稱
     *
     * @param $str_domain
     * @return string
     */
    public static function extract_main_domain($str_domain){
        if(empty($str_domain)){
            return "";
        }

        $str_reg = '/^(?:(?:[a-z0-9\-]*[a-z0-9]\.)*?|\.)?([a-z0-9\-]*[a-z0-9](';
        /************start CN網域名稱的特殊處理規則，其中包括了各行政區特別後綴的cn網域名稱*****************************/
        $str_reg .= '\.ac\.cn|\.ah\.cn|\.bj\.cn|\.com\.cn|\.cq\.cn|\.fj\.cn|\.gd\.cn|\.gov\.cn|\.gs\.cn';
        $str_reg .= '|\.gx\.cn|\.gz\.cn|\.ha\.cn|\.hb\.cn|\.he\.cn|\.hi\.cn|\.hk\.cn|\.hl\.cn|\.hn\.cn';
        $str_reg .= '|\.jl\.cn|\.js\.cn|\.jx\.cn|\.ln\.cn|\.mo\.cn|\.net\.cn|\.nm\.cn|\.nx\.cn|\.org\.cn';
        $str_reg .= '|\.qh\.cn|\.sc\.cn|\.sd\.cn|\.sh\.cn|\.sn\.cn|\.sx\.cn|\.tj\.cn|\.tw\.cn|\.xj\.cn';
        $str_reg .= '|\.xz\.cn|\.yn\.cn|\.zj\.cn|\.edu.cn';
        /************end CN網域名稱的特殊處理規則，其中包括了各行政區特別後綴的cn網域名稱******************************/
        $str_reg .= '|\.abbott|\.abogado|\.ac|\.academy|\.accountant|\.actor|\.ad|\.adult|\.ae|\.aero|\.af|\.africa|\.ag|\.agency|\.ai|\.aig|\.airforce|\.al';
        $str_reg .= '|\.am|\.amazon|\.amsterdam|\.ao|\.apartments|\.app|\.apple|\.ar|\.arab|\.archi|\.army|\.arpa|\.art|\.as|\.asia|\.associates|\.at';
        $str_reg .= '|\.attorney|\.au|\.auction|\.auto|\.awe|\.ax|\.az|\.ba|\.baby|\.band|\.bank|\.bar|\.barcelona|\.basketball|\.bauhaus|\.bayern|\.bd|\.be';
        $str_reg .= '|\.beer|\.berlin|\.best|\.bet|\.bf|\.bg|\.bh|\.bi|\.bid|\.bike|\.bingo|\.bit|\.biz|\.bj|\.bl|\.black|\.blog|\.blue|\.bm|\.bn|\.bnpparibas';
        $str_reg .= '|\.bo|\.bond|\.boom|\.bot|\.br|\.brussels|\.bs|\.bt|\.build|\.builders|\.business|\.buzz|\.bw|\.by|\.bz|\.bzh|\.ca|\.cab|\.cafe|\.cam';
        $str_reg .= '|\.camera|\.camp|\.capetown|\.capital|\.cards|\.care|\.careers|\.cars|\.casa|\.cash|\.casino|\.cat|\.cc|\.cd|\.center|\.ceo|\.cf|\.cfd';
        $str_reg .= '|\.cg|\.ch|\.chat|\.cheap|\.church|\.ci|\.city|\.ck|\.cl|\.click|\.clinic|\.clothing|\.cloud|\.cloudfront|\.club|\.cm|\.cn|\.co|\.coach';
        $str_reg .= '|\.codes|\.coffee|\.college|\.cologne|\.com|\.comj|\.community|\.company|\.computer|\.construction|\.consulting|\.contact|\.contractors';
        $str_reg .= '|\.cool|\.coop|\.cr|\.credit|\.creditcard|\.cricket|\.cu|\.cv|\.cw|\.cx|\.cy|\.cyou|\.cz|\.dance|\.date|\.day|\.de|\.deals|\.delivery';
        $str_reg .= '|\.dental|\.desi|\.design|\.dev|\.digital|\.direct|\.directory|\.dj|\.dk|\.dm|\.do|\.dog|\.domains|\.download|\.dz|\.earth|\.ec|\.eco';
        $str_reg .= '|\.edu|\.education|\.ee|\.eg|\.email|\.energy|\.engineer|\.engineering|\.equipment|\.es|\.et|\.eu|\.eus|\.events|\.exchange|\.expert';
        $str_reg .= '|\.exposed|\.express|\.fail|\.faith|\.family|\.fan|\.fans|\.farm|\.fashion|\.fi|\.film|\.finance|\.financial|\.fish|\.fishing|\.fit';
        $str_reg .= '|\.fitness|\.fj|\.florist|\.fly|\.fm|\.fo|\.football|\.foundation|\.fox|\.fr|\.fun|\.fund|\.fyi|\.ga|\.gallery|\.game|\.games|\.garden';
        $str_reg .= '|\.gay|\.gd|\.gdn|\.ge|\.gf|\.gg|\.gh|\.gi|\.gift|\.gifts|\.gives|\.gl|\.glass|\.global|\.gm|\.gmbh|\.gold|\.goog|\.gov|\.gp|\.gq|\.gr';
        $str_reg .= '|\.gratis|\.green|\.group|\.gs|\.gt|\.guide|\.guru|\.gw|\.gy|\.hair|\.hamburg|\.health|\.healthcare|\.help|\.hk|\.hm|\.hn|\.holdings';
        $str_reg .= '|\.holiday|\.home|\.homes|\.horse|\.host|\.hosting|\.house|\.how|\.hr|\.ht|\.htm|\.html|\.hu|\.icu|\.id|\.ie|\.il|\.im|\.immo|\.in|\.inc';
        $str_reg .= '|\.industries|\.info|\.ink|\.institute|\.int|\.international|\.investments|\.io|\.iq|\.ir|\.irish|\.is|\.ist|\.it|\.jcb|\.je|\.jetzt';
        $str_reg .= '|\.jewelry|\.jm|\.jo|\.jobs|\.jp|\.jpg|\.js|\.kaufen|\.ke|\.kg|\.kh|\.ki|\.kim|\.kitchen|\.kiwi|\.kn|\.koeln|\.komatsu|\.kpmg|\.kr|\.kw';
        $str_reg .= '|\.ky|\.kz|\.la|\.land|\.lat|\.law|\.lb|\.lc|\.leclerc|\.legal|\.lgbt|\.li|\.lib|\.life|\.lighting|\.limited|\.limo|\.link|\.live|\.lk';
        $str_reg .= '|\.llc|\.loan|\.loans|\.local|\.localdomain|\.lol|\.london|\.love|\.ls|\.lt|\.ltd|\.lu|\.luxe|\.lv|\.ly|\.m|\.ma|\.management|\.market';
        $str_reg .= '|\.marketing|\.markets|\.mba|\.mc|\.md|\.me|\.media|\.meet|\.melbourne|\.men|\.menu|\.mg|\.miami|\.mil|\.mk|\.ml|\.mm|\.mn|\.mo|\.mobi';
        $str_reg .= '|\.moda|\.moe|\.moi|\.money|\.monster|\.mortgage|\.moscow|\.movie|\.mr|\.ms|\.mt|\.mu|\.museum|\.mv|\.mw|\.mx|\.my|\.mz|\.na|\.name|\.navy';
        $str_reg .= '|\.ne|\.net|\.network|\.news|\.nf|\.ng|\.ngo|\.ni|\.ninja|\.nl|\.no|\.np|\.nr|\.nrw|\.ntt|\.nu|\.nyc|\.nz|\.okinawa|\.om|\.one|\.ong';
        $str_reg .= '|\.onion|\.onl|\.online|\.ooo|\.or|\.org|\.ovh|\.pa|\.page|\.paris|\.partners|\.parts|\.party|\.pe|\.pet|\.pf|\.pg|\.ph|\.photo';
        $str_reg .= '|\.photography|\.photos|\.pics|\.pictures|\.pink|\.pizza|\.pk|\.pl|\.plus|\.pm|\.pn|\.poker|\.politie|\.porn|\.pr|\.press|\.pro|\.promo';
        $str_reg .= '|\.properties|\.property|\.ps|\.pt|\.pub|\.pw|\.py|\.qa|\.quest|\.racing|\.radio|\.re|\.realty|\.recipes|\.red|\.reisen|\.ren|\.rent';
        $str_reg .= '|\.rentals|\.report|\.rest|\.review|\.reviews|\.rich|\.rip|\.ro|\.rocks|\.rodeo|\.rs|\.ru|\.run|\.rw|\.sa|\.sale|\.salon|\.sandvik|\.sarl';
        $str_reg .= '|\.saxo|\.sb|\.sbs|\.sc|\.school|\.science|\.scot|\.sd|\.se|\.security|\.services|\.sex|\.sexy|\.sg|\.sh|\.shiksha|\.shoes|\.shop';
        $str_reg .= '|\.shopping|\.show|\.si|\.singles|\.site|\.sk|\.ski|\.sky|\.sl|\.sm|\.sn|\.sncf|\.so|\.social|\.software|\.solar|\.solutions|\.space|\.sr';
        $str_reg .= '|\.srl|\.st|\.store|\.stream|\.studio|\.style|\.su|\.supplies|\.supply|\.support|\.surf|\.sv|\.swiss|\.sx|\.sy|\.systems|\.tattoo|\.tax';
        $str_reg .= '|\.taxi|\.tc|\.td|\.team|\.tech|\.technology|\.tel|\.tennis|\.tf|\.tg|\.th|\.theater|\.tienda|\.tips|\.tj|\.tk|\.tl|\.tm|\.tn|\.to|\.today';
        $str_reg .= '|\.tokyo|\.tools|\.top|\.tours|\.town|\.toys|\.tr|\.trade|\.trading|\.training|\.travel|\.tt|\.tube|\.tv|\.tw|\.tz|\.ua|\.ug|\.uk';
        $str_reg .= '|\.university|\.uno|\.uol|\.us|\.uy|\.uz|\.vacations|\.vc|\.ve|\.ventures|\.vet|\.vg|\.vi|\.video|\.vin|\.vip|\.vision|\.vn|\.vote|\.voto';
        $str_reg .= '|\.vru|\.vtt|\.vu|\.wales|\.wang|\.wasm|\.watch|\.webcam|\.website|\.wedding|\.weir|\.wf|\.wiki|\.win|\.wine|\.work|\.works|\.world|\.ws';
        $str_reg .= '|\.wtf|\.xin|\.xn--6qq986b3xl|\.xn--80adxhks|\.xn--90ais|\.xn--fiqs8s|\.xn--io0a7i|\.xn--j6w193g|\.xn--mxtq1m|\.xn--ngbrx|\.xn--node';
        $str_reg .= '|\.xn--p1acf|\.xn--p1ai|\.xxx|\.xy|\.xyz|\.ye|\.yoga|\.yt|\.za|\.zip|\.zm|\.zone|\.zw';
        $str_reg .= ')';

        $str_reg .= '(\.hk|\.tw|\.uk|\.jp|\.kr|\.th|\.au|\.ua|\.so|\.br|\.sg|\.pt|\.ec|\.ar|\.my';
        $str_reg .= '|\.tr|\.bd|\.mk|\.za|\.mt|\.sm|\.ge|\.kg|\.ke|\.de|\.ve|\.es|\.ru|\.pk|\.mx';
        $str_reg .= '|\.nz|\.py|\.pe|\.ph|\.pl|\.ng|\.pa|\.fj';

        $str_reg .= ')?)$/';
        if(preg_match($str_reg, $str_domain, $matches)){
            return strval($matches[1]);
        }

        return "";

    }

    /**
     * 從 easylist類源檔案中提取可用地址
     *
     * @param String $str_easylist 原始的easylist列表字串
     * @param Boolean $strict_mode 嚴格模式，啟用時將屏蔽該域所在的主網網域名稱稱，例如www.baidu.com，將獲取到baidu.com並寫入最終列表
     * @param Array $arr_whitelist 白名單列表
     * @return array
     */
    public static function get_domain_from_easylist($str_easylist, $strict_mode = false, $arr_whitelist = array()){
        $strlen = strlen($str_easylist);
        if($strlen < 10){
            return array();
        }

        $str_easylist = $str_easylist . "\n"; //防止最後一行沒有換行符

        $i = 0;
        $arr_domains = array();
        while($i < $strlen){
            $end_pos = strpos($str_easylist, "\n", $i);
            $line = trim(substr($str_easylist, $i, $end_pos - $i));
            $i = $end_pos + 1;
            if(empty($line) || strlen($line) < 3){
                continue;
            }

            if($line[0] != '|' || $line[1] != '|'){
                continue;
            }

            if(preg_match('/^\|\|([0-9a-z\-\.]+[a-z]+)\^(\$([^=]+?,)?(image|third-party|script)(,[^=]+)?)?$/', $line, $matches)){

                //if(substr($matches[1], 0, 4) == 'www.'){
                //    $row = substr($matches[1], 4);
                //}else{
                    $row = $matches[1];
                //}
                $main_domain = self::extract_main_domain($matches[1]);
                if($strict_mode && (!array_key_exists($main_domain, $arr_whitelist) || ($arr_whitelist[$main_domain] >= 1))){
                    $arr_domains[$main_domain] = array($main_domain);
                }else{
                    $arr_domains[$main_domain][] = $row;
                }
            }
        }

        return $arr_domains;
    }

    /**
     * 從hosts或dnsmasq類檔案中提取地址
     *
     * @param String $str_hosts 原始的hosts字串
     * @param Boolean $strict_mode 嚴格模式，啟用時將屏蔽該域所在的主網網域名稱稱，例如www.baidu.com，將獲取到baidu.com並寫入最終列表
     * @param Array $arr_whitelist 白名單
     * @return array
     */
    public static function get_domain_list($str_hosts, $strict_mode = false, $arr_whitelist = array()){
        $strlen = strlen($str_hosts);
        if($strlen < 3){
            return array();
        }

        $str_hosts = $str_hosts . "\n"; //防止最後一行沒有換行符

        $i = 0;
        $arr_domains = array();
        while($i < $strlen){
            $end_pos = strpos($str_hosts, "\n", $i);
            $line = trim(substr($str_hosts, $i, $end_pos - $i));
            $i = $end_pos + 1;
            if(empty($line) || ($line[0] == '#')){//註解行忽略
                continue;
            }
            $line = strtolower(preg_replace('/[\s\t]+/', "/", $line));

            if((strpos($line, '127.0.0.1') === false) &&
                (strpos($line, '::') === false) &&
                (strpos($line, '0.0.0.0') === false)){
                continue;
            }

            $row = explode('/', $line);
            if(strpos($row[1], '.') === false){
                continue;
            }
            $main_domain = self::extract_main_domain($row[1]);
            if($strict_mode && (!array_key_exists($main_domain, $arr_whitelist) || ($arr_whitelist[$main_domain] >= 1))){
                $arr_domains[$main_domain] = array($main_domain);
            }else{
                $arr_domains[$main_domain][] = $row[1];
            }
        }

        return $arr_domains;
    }

    private static function write_conf_header($fp, $header, $arr_params = array()){
        $header = str_replace('{DATE}', date('YmdHis'), $header);
        $header = str_replace('{URL}', self::LINK_URL, $header);

        foreach($arr_params as $keyword => $val){
            $header = str_replace('{' . $keyword . '}', $val, $header);
        }
        return fwrite($fp, $header);
    }

    /**
     * 寫入結果到最終檔案
     *
     * @param array $arr_src
     * @param $arr_format
     * @param array $arr_whitelist
     * @return false|int
     */
    public static function write_to_file(array $arr_src, array $arr_format, array $arr_whitelist = array()){

        if(count($arr_src) < 1){
            return false;
        }

        foreach($arr_whitelist as $wlk => $wlv){
            if(-1 === $wlv){
                unset($arr_whitelist[$wlk]);
            }
        }

        $str_result = '';
        $line_count = 0;

        $arr_written = [];
        foreach($arr_src as $main_domain => $arr_subdomains){

            if(array_key_exists($main_domain, $arr_whitelist) && ($arr_whitelist[$main_domain] > 0)){
                continue;
            }

            if(empty($main_domain)){//不對應記錄（一般是不合法網網域名稱稱或者未收錄的後綴）
                continue;
            }


            if(
                (1 !== $arr_format['full_domain'])
                && (!array_key_exists($main_domain, $arr_whitelist))
                && (in_array($main_domain, $arr_subdomains)
                    //|| in_array('www.' . $main_domain, $arr_subdomains)
                    || in_array('.' . $main_domain, $arr_subdomains)
                    )
            ){
                $str_result .= str_replace('{DOMAIN}', $main_domain, $arr_format['format']) . "\n";
                $line_count ++;
                continue;
            }

            $arr_subdomains = array_fill_keys($arr_subdomains, 2);

            foreach($arr_subdomains as $subdomain => $__){
                if(array_key_exists($subdomain, $arr_whitelist)){
                    continue;
                }

                $arr_tmp_domain = explode('.', $subdomain);
                $tmp_domain_len = count($arr_tmp_domain);
                if($tmp_domain_len < 3){
                    $str_result .= str_replace('{DOMAIN}', $subdomain, $arr_format['format']) . "\n";
                    $line_count ++;
                    $arr_written[$subdomain] = 2;
                    continue;
                }

                $matched_flag = false;
                for($pos = 3; $pos <= $tmp_domain_len; $pos ++){
                    $arr_tmp = array_slice($arr_tmp_domain, -1 * $pos);
                    $tmp = implode('.', $arr_tmp);

                    if(array_key_exists($tmp, $arr_whitelist)){
                        $matched_flag = $arr_whitelist[$tmp] === 1;
                        break;
                    }

                    if(($tmp === $subdomain) || array_key_exists($tmp, $arr_subdomains)){
                        if(!array_key_exists($tmp, $arr_written)){
                            $str_result .= str_replace('{DOMAIN}', $tmp, $arr_format['format']) . "\n";
                            $line_count ++;
                            $arr_written[$tmp] = 2;
                        }
                        $matched_flag = 1 !== $arr_format['full_domain'];
                        break;
                    }
                }

                if($matched_flag){
                    continue;
                }

                if(!array_key_exists($subdomain, $arr_written)){
                    $str_result .= str_replace('{DOMAIN}', $subdomain, $arr_format['format']) . "\n";
                    $line_count ++;
                    $arr_written[$subdomain] = 3;
                }
            }
        }
        unset($arr_written);

        $fp = fopen(ROOT_DIR . $arr_format['filename'], 'w');
        $write_len = self::write_conf_header($fp, $arr_format['header'], array('COUNT' => $line_count));
        $write_len += fwrite($fp, $str_result);
        return $write_len;
    }
}
