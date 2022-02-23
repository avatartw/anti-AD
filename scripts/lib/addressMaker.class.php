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
        $str_reg .= '|\.ac|\.academy|\.accountant|\.ad|\.ae|\.ag|\.agency|\.ai|\.al|\.am|\.app|\.art|\.as|\.asia|\.at|\.au';
        $str_reg .= '|\.awe|\.az|\.ba|\.bar|\.be|\.best|\.bet|\.bg|\.bi|\.bid|\.biz|\.bl|\.blog|\.blue|\.bo|\.boom';
        $str_reg .= '|\.br|\.buzz|\.bw|\.by|\.bz|\.ca|\.cam|\.camp|\.casa|\.cash|\.cat|\.cc|\.cd|\.center|\.cf|\.ch';
        $str_reg .= '|\.city|\.cl|\.click|\.cloud|\.cloudfront|\.club|\.cm|\.cn|\.co|\.codes|\.com|\.company|\.cool|\.cr|\.cricket|\.cu';
        $str_reg .= '|\.cx|\.cy|\.cyou|\.cz|\.date|\.de|\.deals|\.delivery|\.design|\.dev|\.digital|\.direct|\.dk|\.do|\.dog|\.download';
        $str_reg .= '|\.ec|\.edu|\.ee|\.email|\.es|\.eu|\.events|\.exchange|\.fi|\.fm|\.foundation|\.fr|\.fun|\.fyi|\.ga|\.games';
        $str_reg .= '|\.gd|\.gdn|\.ge|\.gg|\.gh|\.gift|\.gifts|\.glass|\.global|\.gold|\.gov|\.gq|\.gr|\.gratis|\.group|\.gs|\.gt';
        $str_reg .= '|\.guru|\.hk|\.hn|\.host|\.house|\.how|\.hr|\.ht|\.hu|\.icu|\.id|\.ie|\.il|\.im|\.in|\.info';
        $str_reg .= '|\.ink|\.io|\.ir|\.is|\.it|\.jo|\.jobs|\.jp|\.js|\.ki|\.kim|\.kr|\.kz|\.la|\.land|\.li';
        $str_reg .= '|\.life|\.link|\.live|\.lk|\.loan|\.lol|\.love|\.lt|\.ltd|\.lu|\.lv|\.ly|\.ma|\.management|\.marketing|\.md';
        $str_reg .= '|\.me|\.media|\.men|\.museum|\.mg|\.mk|\.ml|\.mm|\.mn|\.mobi|\.moe|\.money|\.monster|\.ms|\.mx|\.my|\.mz';
        $str_reg .= '|\.name|\.ne|\.net|\.network|\.news|\.nf|\.ng|\.ngo|\.ninja|\.nl|\.no|\.np|\.nu|\.nyc|\.nz|\.om';
        $str_reg .= '|\.one|\.ong|\.online|\.ooo|\.or|\.org|\.ovh|\.pa|\.page|\.partners|\.party|\.pe|\.pet|\.ph|\.photo';
        $str_reg .= '|\.photos|\.pink|\.pk|\.pl|\.plus|\.pm|\.porn|\.press|\.pro|\.promo|\.pt|\.pub|\.pw|\.racing|\.re|\.red';
        $str_reg .= '|\.ren|\.report|\.rest|\.review|\.ro|\.rocks|\.rs|\.ru|\.run|\.sa|\.sbs|\.sc|\.school|\.science|\.se|\.services';
        $str_reg .= '|\.sex|\.sexy|\.sg|\.sh|\.shop|\.show|\.si|\.singles|\.site|\.sk|\.sn|\.sncf|\.so|\.social|\.solutions|\.space';
        $str_reg .= '|\.st|\.store|\.stream|\.studio|\.style|\.su|\.supply|\.support|\.surf|\.sx|\.systems|\.tc|\.team|\.tech|\.technology|\.tel';
        $str_reg .= '|\.tf|\.tips|\.tj|\.tk|\.tl|\.tm|\.to|\.today|\.tools|\.top|\.tr|\.trade|\.tt|\.tv|\.tw|\.tz|\.ua|\.ug';
        $str_reg .= '|\.uk|\.uno|\.us|\.uy|\.uz|\.vc|\.ve|\.vg|\.video|\.vip|\.vn|\.wang|\.wasm|\.watch|\.webcam|\.website|\.wiki';
        $str_reg .= '|\.win|\.work|\.works|\.world|\.ws|\.wtf|\.xin|\.xn--fiqs8s|\.xn--io0a7i|\.xn--p1ai|\.xxx|\.xy|\.xyz|\.zip|\.zone|\.zw';
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
