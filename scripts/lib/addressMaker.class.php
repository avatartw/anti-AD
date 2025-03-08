<?php
/**
 * url地址相關的操作類
 * Formatter: https://www.duplichecker.com/php-formatter
 *
 * @file addressMaker.class.php
 * @author gently
 * @date 2017.12.31
 *
 *
 */
!defined("ROOT_DIR") && die("Access Denied.");

class addressMaker
{
    const LINK_URL = "https://github.com/avatartw/anti-AD";

    /**
     * 分離網域名稱
     *
     * @param $str_domain
     * @return string
     */
    public static function extract_main_domain($str_domain)
    {
        if (empty($str_domain)) {
            return "";
        }

        $str_reg = "/^(?:(?:[a-z0-9\-]*[a-z0-9]\.)*?|\.)?([a-z0-9\-]*[a-z0-9](";
        /************start CN網域名稱的特殊處理規則，其中包括了各行政區特別後綴的cn網域名稱*****************************/
        $str_reg .=
            "\.ac\.cn|\.ah\.cn|\.bj\.cn|\.com\.cn|\.cq\.cn|\.fj\.cn|\.gd\.cn|\.gov\.cn|\.gs\.cn";
        $str_reg .=
            "|\.gx\.cn|\.gz\.cn|\.ha\.cn|\.hb\.cn|\.he\.cn|\.hi\.cn|\.hk\.cn|\.hl\.cn|\.hn\.cn";
        $str_reg .=
            "|\.jl\.cn|\.js\.cn|\.jx\.cn|\.ln\.cn|\.mo\.cn|\.net\.cn|\.nm\.cn|\.nx\.cn|\.org\.cn";
        $str_reg .=
            "|\.qh\.cn|\.sc\.cn|\.sd\.cn|\.sh\.cn|\.sn\.cn|\.sx\.cn|\.tj\.cn|\.tw\.cn|\.xj\.cn";
        $str_reg .= "|\.xz\.cn|\.yn\.cn|\.zj\.cn|\.edu.cn";
        /************end CN網域名稱的特殊處理規則，其中包括了各行政區特別後綴的cn網域名稱******************************/
        $str_reg .=
            "|\.aaa|\.abbott|\.abogado|\.ac|\.aca|\.academy|\.accountant|\.accountants|\.acct|\.actor|\.ad|\.adult|\.ae|\.aero|\.aeroport|\.af|\.africa";
        $str_reg .=
            "|\.ag|\.agency|\.agro|\.ai|\.aid|\.aig|\.airforce|\.al|\.aliyu|\.alsace|\.am|\.amazon|\.amsterdam|\.ao|\.apartments|\.app|\.apple|\.ar|\.arab|\.arc";
        $str_reg .=
            "|\.archi|\.army|\.arpa|\.art|\.as|\.asia|\.assedic|\.asso|\.associates|\.at|\.atm|\.attorney|\.au|\.auction|\.audio|\.augustow|\.auto|\.autos";
        $str_reg .=
            "|\.avocat|\.avoues|\.awe|\.aws|\.ax|\.az|\.ba|\.babia-gora|\.baby|\.band|\.bank|\.bar|\.barcelona|\.bargains|\.basketball|\.bauhaus|\.bayern|\.bd";
        $str_reg .=
            "|\.be|\.beauty|\.bedzin|\.beer|\.berlin|\.beskidy|\.best|\.bet|\.bf|\.bg|\.bh|\.bi|\.bialowieza|\.bialystok|\.bible|\.bid|\.bielawa|\.bieszczady";
        $str_reg .=
            "|\.bike|\.bingo|\.bio|\.bit|\.biz|\.bj|\.bl|\.black|\.blackfriday|\.blog|\.blue|\.bm|\.bn|\.bnpparibas|\.bo|\.boleslawiec|\.bond|\.boom";
        $str_reg .=
            "|\.bot|\.boutique|\.br|\.broker|\.brussels|\.bs|\.bt|\.build|\.builders|\.bus|\.business|\.buzz|\.bw|\.by|\.bydgoszcz|\.bytom|\.bz|\.bzh";
        $str_reg .=
            "|\.c|\.ca|\.cab|\.cafe|\.cam|\.camera|\.camp|\.capetown|\.capital|\.cards|\.care|\.career|\.careers|\.cars|\.casa|\.cash|\.casino|\.cat";
        $str_reg .=
            "|\.catering|\.cc|\.cci|\.cd|\.center|\.ceo|\.cf|\.cfd|\.cg|\.ch|\.chambagri|\.chat|\.cheap|\.chi|\.chiro|\.chirurgiens-dentistes";
        $str_reg .=
            "|\.christmas|\.church|\.ci|\.cieszyn|\.cim|\.city|\.ck|\.cl|\.claims|\.cleaning|\.click|\.clinic|\.clothing|\.cloud|\.cloudfront|\.club|\.cm|\.cn";
        $str_reg .=
            "|\.co|\.coach|\.codes|\.coffee|\.college|\.cologne|\.com|\.comj|\.community|\.company|\.computer|\.comqq|\.condos|\.construction|\.consulting";
        $str_reg .=
            "|\.contact|\.contractors|\.cooking|\.cool|\.coop|\.corsica|\.country|\.coupons|\.courses|\.cpa|\.cr|\.credit|\.creditcard|\.cricket";
        $str_reg .=
            "|\.cruises|\.cu|\.cv|\.cw|\.cx|\.cy|\.cymru|\.cyou|\.cz|\.czeladz|\.czest|\.dance|\.date|\.dating|\.day|\.de|\.deals|\.degree|\.delivery";
        $str_reg .=
            "|\.democrat|\.den|\.dent|\.dental|\.dentist|\.desi|\.design|\.dev|\.diamonds|\.diet|\.digital|\.direct|\.directory|\.discount|\.dj|\.dk";
        $str_reg .=
            "|\.dlugoleka|\.dm|\.do|\.doctor|\.dog|\.domain|\.domains|\.download|\.dz|\.dzierzoniow|\.earth|\.ec|\.eco|\.edu|\.education|\.ee|\.eg|\.elblag|\.elk";
        $str_reg .=
            "|\.email|\.energy|\.eng|\.engineer|\.engineering|\.ens|\.enterprises|\.equipment|\.es|\.estate|\.et|\.eu|\.eus|\.events|\.example|\.exchange|\.expert";
        $str_reg .=
            "|\.experts-comptables|\.exposed|\.express|\.fail|\.faith|\.family|\.fan|\.fans|\.farm|\.fashion|\.feedback|\.fi|\.film|\.fin|\.finance";
        $str_reg .=
            "|\.financial|\.firm|\.fish|\.fishing|\.fit|\.fitness|\.fj|\.flights|\.florist|\.flowers|\.fly|\.fm|\.fo|\.football|\.forex|\.forsale";
        $str_reg .=
            "|\.foundation|\.fox|\.fr|\.fun|\.fund|\.furniture|\.futbol|\.fyi|\.ga|\.gal|\.gallery|\.game|\.games|\.garden|\.gay|\.gd|\.gdn|\.ge|\.gen";
        $str_reg .=
            "|\.geometre-expert|\.gf|\.gg|\.gh|\.gi|\.gift|\.gifts|\.gives|\.gl|\.glass|\.global|\.glogow|\.gm|\.gmbh|\.gmina|\.gniezno|\.gob|\.gold";
        $str_reg .=
            "|\.golf|\.goog|\.gorlice|\.gouv|\.gov|\.gp|\.gq|\.gr|\.grajewo|\.graphics|\.gratis|\.green|\.greta|\.gripe|\.group|\.gs|\.gsm|\.gt|\.guide";
        $str_reg .=
            "|\.guitars|\.guru|\.gw|\.gy|\.hair|\.hamburg|\.haus|\.health|\.healthcare|\.help|\.hiphop|\.hiv|\.hk|\.hm|\.hn|\.hockey|\.holdings|\.holiday";
        $str_reg .=
            "|\.home|\.homes|\.horse|\.hospital|\.host|\.hosting|\.house|\.how|\.hr|\.ht|\.htm|\.html|\.hu|\.huissier-justice|\.icu|\.id|\.ie|\.il";
        $str_reg .=
            "|\.ilawa|\.im|\.immo|\.immobilien|\.in|\.inc|\.ind|\.industries|\.info|\.ink|\.institute|\.insure|\.int|\.international|\.intl|\.investments";
        $str_reg .=
            "|\.io|\.iq|\.ir|\.irish|\.is|\.ist|\.istanbul|\.it|\.jaworzno|\.jcb|\.je|\.jelenia-gora|\.jetzt|\.jewelry|\.jgora|\.jm|\.jo|\.jobs|\.jp";
        $str_reg .=
            "|\.jpg|\.js|\.juegos|\.jur|\.kalisz|\.karpacz|\.kartuzy|\.kaszuby|\.katowice|\.kaufen|\.kazimierz-dolny|\.ke|\.kepno|\.ketrzyn|\.kg|\.kh";
        $str_reg .=
            "|\.ki|\.kim|\.kitchen|\.kiwi|\.klodzko|\.kn|\.kobierzyce|\.koeln|\.kolobrzeg|\.komatsu|\.konin|\.konskowola|\.koronowo|\.kpmg|\.kr|\.kutno";
        $str_reg .=
            "|\.kw|\.ky|\.kyoto|\.kz|\.l|\.la|\.land|\.lapy|\.lat|\.law|\.lawyer|\.lb|\.lc|\.lease|\.lebork|\.leclerc|\.legal|\.legnica|\.lezajsk|\.lgbt";
        $str_reg .=
            "|\.li|\.lib|\.life|\.lighting|\.limanowa|\.limited|\.limo|\.link|\.live|\.lk|\.llc|\.loan|\.loans|\.local|\.localdomain|\.lol|\.lomza";
        $str_reg .=
            "|\.london|\.love|\.lowicz|\.ls|\.lt|\.ltd|\.ltda|\.lu|\.lubin|\.lukow|\.luxe|\.luxury|\.lv|\.ly|\.m|\.ma|\.madrid|\.mail|\.maison|\.makeup|\.malbork";
        $str_reg .=
            "|\.malopolska|\.management|\.market|\.marketing|\.markets|\.mazowsze|\.mazury|\.mba|\.mc|\.md|\.me|\.med|\.medecin|\.media|\.meet";
        $str_reg .=
            "|\.melbourne|\.memorial|\.men|\.menu|\.mg|\.miami|\.miasta|\.mielec|\.mielno|\.mil|\.min|\.mk|\.ml|\.mm|\.mn|\.mo|\.mobi|\.moda|\.moe|\.moi";
        $str_reg .=
            "|\.mom|\.money|\.monster|\.mortgage|\.moscow|\.movie|\.mr|\.mragowo|\.ms|\.mt|\.mu|\.museum|\.mv|\.mw|\.mx|\.my|\.mz|\.na|\.nagoya|\.naklo";
        $str_reg .=
            "|\.name|\.nat|\.navy|\.ne|\.net|\.netbb-org|\.network|\.news|\.nf|\.ng|\.ngo|\.ni|\.nieruchomosci|\.ninja|\.nl|\.no|\.nom|\.notaires|\.nowaruda|\.np";
        $str_reg .=
            "|\.nr|\.nrw|\.ntt|\.nu|\.nur|\.nurse|\.nyc|\.nysa|\.nz|\.okinawa|\.olawa|\.olecko|\.olkusz|\.olsztyn|\.om|\.one|\.ong|\.onion|\.onl|\.online";
        $str_reg .=
            "|\.ooo|\.opoczno|\.opole|\.or|\.org|\.organic|\.osaka|\.ostroda|\.ostroleka|\.ostrowiec|\.ostrowwlkp|\.other|\.ovh|\.p|\.pa|\.page|\.paris";
        $str_reg .=
            "|\.partners|\.parts|\.party|\.pc|\.pe|\.perso|\.pet|\.pf|\.pg|\.ph|\.pharma|\.pharmacien|\.phone|\.photo|\.photography|\.photos|\.pics";
        $str_reg .=
            "|\.pictures|\.pila|\.pink|\.pisz|\.pizza|\.pk|\.pl|\.place|\.plc|\.plumbing|\.plus|\.pm|\.pn|\.podhale|\.podlasie|\.poker|\.pol|\.politie";
        $str_reg .=
            "|\.polkowice|\.pomorskie|\.pomorze|\.porn|\.port|\.powiat|\.pr|\.prd|\.press|\.presse|\.priv|\.pro|\.prochowice|\.productions|\.prof|\.promo";
        $str_reg .=
            "|\.properties|\.property|\.pruszkow|\.prx|\.przeworsk|\.ps|\.pt|\.pub|\.pulawy|\.pw|\.py|\.qa|\.quebec|\.quest|\.racing|\.radio|\.radom";
        $str_reg .=
            "|\.rawa-maz|\.re|\.realestate|\.realty|\.recht|\.recipes|\.red|\.rehab|\.reise|\.reisen|\.rel|\.ren|\.rent|\.rentals|\.repair|\.report";
        $str_reg .=
            "|\.republican|\.rest|\.restaurant|\.review|\.reviews|\.rich|\.rip|\.ro|\.rocks|\.rodeo|\.rs|\.ru|\.ruhr|\.run|\.rw|\.rybnik|\.ryukyu";
        $str_reg .=
            "|\.rzeszow|\.sa|\.saarland|\.sale|\.salon|\.sandvik|\.sanok|\.sarl|\.saxo|\.sb|\.sbs|\.sc|\.sch|\.school|\.schule|\.science|\.scot|\.sd|\.se";
        $str_reg .=
            "|\.security|\.sejny|\.services|\.sex|\.sexy|\.sg|\.sh|\.shiksha|\.shoes|\.shop|\.shopping|\.show|\.si|\.siedlce|\.singles|\.site|\.sk|\.ski";
        $str_reg .=
            "|\.sklep|\.skoczow|\.sky|\.sl|\.slask|\.slupsk|\.sm|\.sn|\.sncf|\.so|\.soccer|\.social|\.software|\.solar|\.solutions|\.sos|\.sosnowiec|\.soy";
        $str_reg .=
            "|\.space|\.sr|\.srl|\.st|\.stalowa-wola|\.starachowice|\.stargard|\.storage|\.store|\.stream|\.studio|\.study|\.style|\.su|\.sucks|\.supplies";
        $str_reg .=
            "|\.supply|\.support|\.surf|\.surgery|\.suwalki|\.sv|\.swidnica|\.swiebodzin|\.swinoujscie|\.swiss|\.sx|\.sy|\.systems|\.szczecin|\.szczytno";
        $str_reg .=
            "|\.szkola|\.taipei|\.targi|\.tarnobrzeg|\.tattoo|\.tax|\.taxi|\.tc|\.td|\.teach|\.team|\.tech|\.technology|\.tel|\.tennis|\.tf|\.tg|\.tgory";
        $str_reg .=
            "|\.th|\.theater|\.theatre|\.tickets|\.tienda|\.tips|\.tires|\.tirol|\.tj|\.tk|\.tl|\.tld|\.tm|\.tn|\.to|\.today|\.tokyo|\.tools|\.top|\.tourism";
        $str_reg .=
            "|\.tours|\.town|\.toys|\.tr|\.trade|\.trading|\.training|\.travel|\.tt|\.tube|\.turek|\.turystyka|\.tv|\.tw|\.tychy|\.tz|\.ua|\.ug|\.uk";
        $str_reg .=
            "|\.univ|\.university|\.uno|\.uol|\.us|\.ustka|\.uy|\.uz|\.vacations|\.vast|\.vc|\.ve|\.vegas|\.ventures|\.vet|\.veterinaire|\.vg|\.vi|\.viajes";
        $str_reg .=
            "|\.video|\.villas|\.vin|\.vip|\.vision|\.vlaanderen|\.vn|\.vodka|\.vote|\.voto|\.voyage|\.vru|\.vtt|\.vu|\.walbrzych|\.wales|\.wang|\.warmia";
        $str_reg .=
            "|\.warszawa|\.wasm|\.watch|\.waw|\.web|\.webcam|\.website|\.wedding|\.wegrow|\.weir|\.wf|\.wielun|\.wiki|\.win|\.wine|\.wlocl|\.wloclawek";
        $str_reg .=
            "|\.wlodawa|\.wodzislaw|\.wolomin|\.work|\.works|\.world|\.wroclaw|\.ws|\.wtf|\.xin|\.xn--[a-z0-9_\-]+";
        $str_reg .=
            "|\.xxx|\.xy|\.xyz|\.ye|\.yoga|\.yokohama|\.yt|\.za|\.zachpomor";
        $str_reg .=
            "|\.zagan|\.zarow|\.zgora|\.zgorzelec|\.zip|\.zm|\.zone|\.zw";
        $str_reg .= ")";

        $str_reg .=
            "(\.hk|\.tw|\.uk|\.jp|\.kr|\.th|\.au|\.ua|\.so|\.br|\.sg|\.pt|\.ec|\.ar|\.my";
        $str_reg .=
            "|\.tr|\.bd|\.mk|\.za|\.mt|\.sm|\.ge|\.kg|\.ke|\.de|\.ve|\.es|\.ru|\.pk|\.mx";
        $str_reg .= "|\.nz|\.py|\.pe|\.ph|\.pl|\.ng|\.pa|\.fj";

        $str_reg .= ')?)$/';
        if (preg_match($str_reg, $str_domain, $matches)) {
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
    public static function get_domain_from_easylist(
        $str_easylist,
        $strict_mode = false,
        $arr_whitelist = []
    ) {
        $strlen = strlen($str_easylist);
        if ($strlen < 10) {
            return [];
        }

        $str_easylist = $str_easylist . "\n"; //防止最後一行沒有換行符

        $i = 0;
        $arr_domains = [];
        while ($i < $strlen) {
            $end_pos = strpos($str_easylist, "\n", $i);
            $line = trim(substr($str_easylist, $i, $end_pos - $i));
            $i = $end_pos + 1;
            if (empty($line) || strlen($line) < 3) {
                continue;
            }

            if ($line[0] != "|" || $line[1] != "|") {
                continue;
            }

            if (
                preg_match(
                    '/^\|\|([0-9a-z\-\.]+[a-z]+)\^(\$([^=~]+?,)?(image|third-party|script)(,[^=~]+)?)?$/',
                    $line,
                    $matches
                )
            ) {
                //if(substr($matches[1], 0, 4) == 'www.'){
                //    $row = substr($matches[1], 4);
                //}else{
                $row = $matches[1];
                //}
                $main_domain = self::extract_main_domain($matches[1]);
                if (
                    $strict_mode &&
                    (!array_key_exists($main_domain, $arr_whitelist) ||
                        $arr_whitelist[$main_domain] >= 1)
                ) {
                    $arr_domains[$main_domain] = [$main_domain];
                } else {
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
    public static function get_domain_list(
        $str_hosts,
        $strict_mode = false,
        $arr_whitelist = []
    ) {
        $strlen = strlen($str_hosts);
        if ($strlen < 3) {
            return [];
        }

        $str_hosts = $str_hosts . "\n"; //防止最後一行沒有換行符

        $i = 0;
        $arr_domains = [];
        while ($i < $strlen) {
            $end_pos = strpos($str_hosts, "\n", $i);
            $line = trim(substr($str_hosts, $i, $end_pos - $i));
            $i = $end_pos + 1;
            if (empty($line) || $line[0] == "#") {
                //註解行忽略
                continue;
            }
            $line = strtolower(preg_replace('/[\s\t]+/', "/", $line));

            if (
                strpos($line, "127.0.0.1") === false &&
                strpos($line, "::") === false &&
                strpos($line, "0.0.0.0") === false
            ) {
                continue;
            }

            $row = explode("/", $line);
            if (strpos($row[1], ".") === false) {
                continue;
            }
            $main_domain = self::extract_main_domain($row[1]);
            if (
                $strict_mode &&
                (!array_key_exists($main_domain, $arr_whitelist) ||
                    $arr_whitelist[$main_domain] >= 1)
            ) {
                $arr_domains[$main_domain] = [$main_domain];
            } else {
                $arr_domains[$main_domain][] = $row[1];
            }
        }

        return $arr_domains;
    }

    private static function write_conf_header($fp, $header, $arr_params = [])
    {
        $header = str_replace("{DATE}", date("YmdHis"), $header);
        $header = str_replace("{URL}", self::LINK_URL, $header);

        foreach ($arr_params as $keyword => $val) {
            $header = str_replace("{" . $keyword . "}", $val, $header);
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
    public static function write_to_file(
        array $arr_src,
        array $arr_format,
        array $arr_whitelist = []
    ) {
        if (count($arr_src) < 1) {
            return false;
        }

        foreach ($arr_whitelist as $wlk => $wlv) {
            if (-1 === $wlv) {
                unset($arr_whitelist[$wlk]);
            }
        }

        $str_result = "";
        $line_count = 0;

        $arr_written = [];
        foreach ($arr_src as $main_domain => $arr_subdomains) {
            if (
                array_key_exists($main_domain, $arr_whitelist) &&
                $arr_whitelist[$main_domain] > 0
            ) {
                continue;
            }

            if (empty($main_domain)) {
                //不對應記錄（一般是不合法網網域名稱稱或者未收錄的後綴）
                continue;
            }

            if (
                1 !== $arr_format["full_domain"] &&
                !array_key_exists($main_domain, $arr_whitelist) &&
                (in_array($main_domain, $arr_subdomains) ||
                    //|| in_array('www.' . $main_domain, $arr_subdomains)
                    in_array("." . $main_domain, $arr_subdomains))
            ) {
                $str_result .=
                    str_replace(
                        "{DOMAIN}",
                        $main_domain,
                        $arr_format["format"]
                    ) . "\n";
                $line_count++;
                continue;
            }

            $arr_subdomains = array_fill_keys($arr_subdomains, 2);

            foreach ($arr_subdomains as $subdomain => $__) {
                if (array_key_exists($subdomain, $arr_whitelist)) {
                    continue;
                }

                $arr_tmp_domain = explode(".", $subdomain);
                $tmp_domain_len = count($arr_tmp_domain);
                if ($tmp_domain_len < 3) {
                    $str_result .=
                        str_replace(
                            "{DOMAIN}",
                            $subdomain,
                            $arr_format["format"]
                        ) . "\n";
                    $line_count++;
                    $arr_written[$subdomain] = 2;
                    continue;
                }

                $matched_flag = false;
                for ($pos = 3; $pos <= $tmp_domain_len; $pos++) {
                    $arr_tmp = array_slice($arr_tmp_domain, -1 * $pos);
                    $tmp = implode(".", $arr_tmp);

                    if (array_key_exists($tmp, $arr_whitelist)) {
                        $matched_flag = $arr_whitelist[$tmp] === 1;
                        break;
                    }

                    if (
                        $tmp === $subdomain ||
                        array_key_exists($tmp, $arr_subdomains)
                    ) {
                        if (!array_key_exists($tmp, $arr_written)) {
                            $str_result .=
                                str_replace(
                                    "{DOMAIN}",
                                    $tmp,
                                    $arr_format["format"]
                                ) . "\n";
                            $line_count++;
                            $arr_written[$tmp] = 2;
                        }
                        $matched_flag = 1 !== $arr_format["full_domain"];
                        break;
                    }
                }

                if ($matched_flag) {
                    continue;
                }

                if (!array_key_exists($subdomain, $arr_written)) {
                    $str_result .=
                        str_replace(
                            "{DOMAIN}",
                            $subdomain,
                            $arr_format["format"]
                        ) . "\n";
                    $line_count++;
                    $arr_written[$subdomain] = 3;
                }
            }
        }
        unset($arr_written);

        $fp = fopen(ROOT_DIR . $arr_format["filename"], "w");
        $write_len = self::write_conf_header($fp, $arr_format["header"], [
            "COUNT" => $line_count,
        ]);
        $write_len += fwrite($fp, $str_result);
        return $write_len;
    }
}
