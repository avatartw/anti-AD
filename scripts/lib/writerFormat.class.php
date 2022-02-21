<?php
/**
 * 定義輸出格式
 *
 *
 */

!defined('ROOT_DIR') && die('Access Denied.');

class writerFormat{
    /*dnsmasq支持格式的屏蔽廣告列表*/
    /*const DNSMASQ = array(
        'format' => 'address=/{DOMAIN}/',
        'header' => "#TITLE=anti-AD\n#VER={DATE}\n#URL={URL}\n#TOTAL_LINES={COUNT}\n",
        'full_domain' => 0,
        'name' => 'dnsmasq',
        'filename' => '../adblock-for-dnsmasq.conf',
        'whitelist_attached' => array(
            'base-dead-hosts.txt' =>array(
                'merge_mode' => 2, //0=單條，1=單條+子網域名稱，2=根網域名稱相當於1，非根網域名稱相當於0
            ),
        ),
        'src' => array(
            'base-src-easylist.txt' => array(
                'type' => 'easylist',
                'strict_mode' => false,
            ),
            'base-src-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => false,
            ),
            'base-src-strict-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => true,
            ),
        ),
    );*/

    /*easylist 相容格式的屏蔽廣告列表*/
    const EASYLIST = array(
        'format' => '||{DOMAIN}^',
        'header' => "!Title: anti-AD\n!Version: {DATE}\n!Homepage: {URL}\n!Total lines: 00000\n",
        'full_domain' => 0,
        'name' => 'easylist',
        'filename' => '../anti-ad-easylist.txt',
        'whitelist_attached' => array(
            'base-dead-hosts.txt' =>array(
                'merge_mode' => 2, //0=單條，1=單條+子網域名稱，2=根網域名稱相當於1，非根網域名稱相當於0
            ),
        ),
        'src' => array(
            'base-src-easylist.txt' => array(
                'type' => 'easylist',
                'strict_mode' => false,
            ),
            'base-src-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => false,
            ),
            'base-src-strict-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => true,
            ),
        ),
    );

    /*Surge 相容格式的屏蔽廣告列表*/
    /*const SURGE = array(
        'format' => 'DOMAIN-SUFFIX,{DOMAIN}',
        'header' => "#TITLE=anti-AD\n#VER={DATE}\n#URL={URL}\n#TOTAL_LINES={COUNT}\n",
        'full_domain' => 0,
        'name' => 'surge',
        'filename' => '../anti-ad-surge.txt',
        'whitelist_attached' => array(
            'base-dead-hosts.txt' =>array(
                'merge_mode' => 2, //0=單條，1=單條+子網域名稱，2=根網域名稱相當於1，非根網域名稱相當於0
            ),
        ),
        'src' => array(
            'base-src-easylist.txt' => array(
                'type' => 'easylist',
                'strict_mode' => false,
            ),
            'base-src-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => false,
            ),
            'base-src-strict-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => true,
            ),
        ),
    );*/

    /*Surge DOMAIN-SET格式的屏蔽廣告列表*/
    /*const SURGE2 = array(
        'format' => '.{DOMAIN}',
        'header' => "#TITLE=anti-AD\n#VER={DATE}\n#URL={URL}\n#TOTAL_LINES={COUNT}\n\n#DOMAIN-SET,https://anti-ad.net/surge2.txt,REJECT\n",
        'full_domain' => 0,
        'name' => 'surge2',
        'filename' => '../anti-ad-surge2.txt',
        'whitelist_attached' => array(
            'base-dead-hosts.txt' =>array(
                'merge_mode' => 2, //0=單條，1=單條+子網域名稱，2=根網域名稱相當於1，非根網域名稱相當於0
            ),
        ),
        'src' => array(
            'base-src-easylist.txt' => array(
                'type' => 'easylist',
                'strict_mode' => false,
            ),
            'base-src-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => false,
            ),
            'base-src-strict-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => true,
            ),
        ),
    );*/

    /*Domains 格式的屏蔽廣告列表，用於支持pi-hole等*/
    const DOMAINS = array(
        'format' => '{DOMAIN}',
        'header' => "#TITLE=anti-AD\n#VER={DATE}\n#URL={URL}\n#TOTAL_LINES={COUNT}\n",
        'full_domain' => 1, //保留子網域名稱，即使其上級網域名稱
        'name' => 'domains',
        'filename' => '../anti-ad-domains.txt',
        'whitelist_attached' => array(
            'base-dead-hosts.txt' =>array(
                'merge_mode' => 2, //0=單條，1=單條+子網域名稱，2=根網域名稱相當於1，非根網域名稱相當於0
            ),
        ),
        'src' => array(
            'base-src-easylist.txt' => array(
                'type' => 'easylist',
                'strict_mode' => false,
            ),
            'base-src-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => false,
            ),
            'base-src-strict-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => true,
            ),
        ),
    );

    /*smartdns支持格式的屏蔽廣告列表*/
    /*const SMARTDNS = array(
        'format' => 'address /{DOMAIN}/#',
        'header' => "#TITLE=anti-AD for SmartDNS\n#VER={DATE}\n#URL={URL}\n#TOTAL_LINES={COUNT}\n",
        'full_domain' => 0,
        'name' => 'dnsmasq',
        'filename' => '../anti-ad-smartdns.conf',
        'whitelist_attached' => array(
            'base-dead-hosts.txt' =>array(
                'merge_mode' => 2, //0=單條，1=單條+子網域名稱，2=根網域名稱相當於1，非根網域名稱相當於0
            ),
        ),
        'src' => array(
            'base-src-easylist.txt' => array(
                'type' => 'easylist',
                'strict_mode' => false,
            ),
            'base-src-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => false,
            ),
            'base-src-strict-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => true,
            ),
        ),
    );*/

    /*Clash RULE-SET 格式的屏蔽廣告列表*/
    /*const CLASH = array(
        'format' => '  - \'+.{DOMAIN}\'',
        'header' => "#TITLE=anti-AD\n#VER={DATE}\n#URL={URL}\n#TOTAL_LINES={COUNT}\n\n#RULE-SET,AntiAd,REJECT\npayload:\n",
        'full_domain' => 0,
        'name' => 'clash',
        'filename' => '../anti-ad-clash.yaml',
        'whitelist_attached' => array(
            'base-dead-hosts.txt' =>array(
                'merge_mode' => 2, //0=單條，1=單條+子網域名稱，2=根網域名稱相當於1，非根網域名稱相當於0
            ),
        ),
        'src' => array(
            'base-src-easylist.txt' => array(
                'type' => 'easylist',
                'strict_mode' => false,
            ),
            'base-src-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => false,
            ),
            'base-src-strict-hosts.txt' => array(
                'type' => 'hosts',
                'strict_mode' => true,
            ),
        ),
    );*/

    /*and etc...*/

}
