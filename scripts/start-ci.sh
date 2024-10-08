#!/bin/bash

source /etc/profile

cd $(cd "$(dirname "$0")";pwd)

easylist=(
##  "https://filters.adtidy.org/extension/chromium/filters/101_optimized.txt"
##  "https://filters.adtidy.org/extension/chromium/filters/104_optimized.txt"
##  "https://filters.adtidy.org/extension/chromium/filters/118_optimized.txt"
#  "https://raw.githubusercontent.com/avatartw/avatartw/main/219_optimized.txt"
#  "https://raw.githubusercontent.com/cjx82630/cjxlist/master/cjx-annoyance.txt"
##  "https://filters.adtidy.org/extension/chromium/filters/220_optimized.txt"
#  "https://easylist-downloads.adblockplus.org/fanboy-annoyance.txt"
##  "https://filters.adtidy.org/extension/chromium/filters/122_optimized.txt"
#  "https://raw.githubusercontent.com/easylist/easylist/master/fanboy-addon/fanboy_annoyance_thirdparty.txt"
#  "https://raw.githubusercontent.com/easylist/easylist/master/fanboy-addon/fanboy_notifications_thirdparty.txt"
#  "https://raw.githubusercontent.com/easylist/easylist/master/fanboy-addon/fanboy_social_thirdparty.txt"
#  "https://raw.githubusercontent.com/easylist/easylist/master/easylist_cookie/easylist_cookie_thirdparty.txt"
#  "https://raw.githubusercontent.com/easylist/easylist/master/fanboy-addon/fanboy_annoyance_specific_block.txt"
#  "https://raw.githubusercontent.com/easylist/easylist/master/fanboy-addon/fanboy_notifications_specific_block.txt"
#  "https://raw.githubusercontent.com/easylist/easylist/master/fanboy-addon/fanboy_social_specific_block.txt"
#  "https://raw.githubusercontent.com/easylist/easylist/master/easylist_cookie/easylist_cookie_specific_block.txt"
#  "https://raw.githubusercontent.com/easylist/easylist/master/fanboy-addon/fanboy_annoyance_international.txt"
#  "https://raw.githubusercontent.com/easylist/easylist/master/fanboy-addon/fanboy_social_international.txt"
#  "https://raw.githubusercontent.com/easylist/easylist/master/easylist_cookie/easylist_cookie_international_specific_block.txt"
#  "https://raw.githubusercontent.com/easylist/easylist/master/fanboy-addon/fanboy_annoyance_allowlist.txt"
#  "https://raw.githubusercontent.com/easylist/easylist/master/easylist_cookie/easylist_cookie_allowlist.txt"
##  "https://raw.githubusercontent.com/banbendalao/ADgk/master/ADgk.txt"
)

hosts=(
#  "https://raw.githubusercontent.com/hoshsadiq/adblock-nocoin-list/master/hosts.txt"
#  "https://zerodot1.gitlab.io/CoinBlockerLists/hosts_browser"
#  "https://raw.githubusercontent.com/avatartw/avatartw/main/hosts-anti-ad.txt"
#  "https://raw.githubusercontent.com/neoFelhz/neohosts/gh-pages/full/hosts.txt"
#  "https://raw.githubusercontent.com/jdlingyu/ad-wars/master/hosts"
#  "https://raw.githubusercontent.com/crazy-max/WindowsSpyBlocker/master/data/hosts/spy.txt"
#  "https://raw.githubusercontent.com/VeleSila/yhosts/master/hosts"
#  "https://raw.githubusercontent.com/PolishFiltersTeam/KADhosts/master/KADhosts.txt"
)

strict_hosts=(
#  "https://raw.githubusercontent.com/hoshsadiq/adblock-nocoin-list/master/hosts.txt"
#  "https://zerodot1.gitlab.io/CoinBlockerLists/hosts_browser"
)

dead_hosts=(
  "https://raw.githubusercontent.com/notracking/hosts-blocklists-scripts/master/domains.dead.txt"
  "https://raw.githubusercontent.com/notracking/hosts-blocklists-scripts/master/hostnames.dead.txt"
  "https://raw.githubusercontent.com/avatartw/avatartw/main/CNAME-trackers-list.txt"
  "https://raw.githubusercontent.com/AdguardTeam/cname-trackers/master/combined_disguised_trackers_justdomains.txt"
)

rm -f ./origin-files/easylist*
rm -f ./origin-files/hosts*
rm -f ./origin-files/strict-hosts*
rm -f ./origin-files/dead-hosts*


#cp ./origin-files/yhosts-latest.txt ./origin-files/hosts1000.txt
cp ./origin-files/some-else.txt ./origin-files/dead-hosts444.txt

#curl --connect-timeout 60 -s -o - https://raw.githubusercontent.com/ACL4SSR/ACL4SSR/master/Clash/BanProgramAD.list \
# | grep -F 'DOMAIN-SUFFIX,' | sed 's/DOMAIN-SUFFIX,/127.0.0.1 /g' >./origin-files/hosts999.txt
#curl --connect-timeout 60 -s -o - https://raw.githubusercontent.com/ACL4SSR/ACL4SSR/master/Clash/BanAD.list \
# | grep -F 'DOMAIN-SUFFIX,' | sed 's/DOMAIN-SUFFIX,/127.0.0.1 /g' >./origin-files/hosts998.txt


for i in "${!easylist[@]}"
do
  echo "開始下載 easylist${i}..."
  curl --connect-timeout 60 -s -o - "${easylist[$i]}" | grep -E "^[@\!\|]" | grep -v -E "\^\*|generichide|domain=" | sed 's/\r$//' > "./origin-files/easylist${i}.txt"
  # shellcheck disable=SC2181
  if [ $? -ne 0 ];then
    echo '下載失敗，請重試'
    exit 1
  fi
done

curl --connect-timeout 60 -s -o - https://raw.githubusercontent.com/avatartw/avatartw/main/my-anti-ad.txt | sed 's/\r$//' > ./origin-files/easylist100.txt

for i in "${!hosts[@]}"
do
  echo "開始下載 hosts${i}..."
  curl -o "./origin-files/hosts${i}.txt" --connect-timeout 60 -s "${hosts[$i]}"
  # shellcheck disable=SC2181
  if [ $? -ne 0 ];then
    echo '下載失敗，請重試'
    exit 1
  fi
done

for i in "${!strict_hosts[@]}"
do
  echo "開始下載 strict-hosts${i}..."
  curl -o "./origin-files/strict-hosts${i}.txt" --connect-timeout 60 -s "${strict_hosts[$i]}"
  # shellcheck disable=SC2181
  if [ $? -ne 0 ];then
    echo '下載失敗，請重試'
    exit 1
  fi
done

for i in "${!dead_hosts[@]}"
do
  echo "開始下載 dead-hosts${i}..."
  curl -o "./origin-files/dead-hosts${i}.txt" --connect-timeout 60 -s "${dead_hosts[$i]}"
  # shellcheck disable=SC2181
  if [ $? -ne 0 ];then
    echo '下載失敗，請重試'
    exit 1
  fi
done


cd origin-files

#cat hosts*.txt | grep -v -E "^((#.*)|(\s*))$" \
# | grep -v -E "^[0-9\.:]+\s+(ip6\-)?(localhost|loopback)$" \
# | sed s/0.0.0.0/127.0.0.1/g | sed s/::/127.0.0.1/g | sort \
# | uniq >base-src-hosts.txt

#cat strict-hosts*.txt | grep -v -E "^((#.*)|(\s*))$" \
# | grep -v -E "^[0-9\.:]+\s+(ip6\-)?(localhost|loopback)$" \
# | sed s/0.0.0.0/127.0.0.1/g | sed s/::/127.0.0.1/g | sort \
# | uniq >base-src-strict-hosts.txt

cat dead-hosts*.txt | grep -v -E "^(#|\!|\*|\/)" \
 | sort \
 | uniq >base-dead-hosts.txt


cat easylist*.txt | grep -E "^\|\|[^\*\^\/]+?\^" | sort | uniq >base-src-easylist.txt
cat easylist*.txt | grep -E "^\|\|([^\^=\/:]+)?\*([^\^=\/:]+)?\^" | sort | uniq >wildcard-src-easylist.txt
cat easylist*.txt | grep -E "^@@[^\^=\/:]+?\^([^\/=\*]+)?$" | sort | uniq >whiterule-src-easylist.txt
#cat easylist100.txt | grep -E "^\|\|([^\^=\/:]+)?\*([^\^=\/:]+)?\^" | sort | uniq >e0-wildcard-whiterule.txt
#cat easylist100.txt | grep -E "^@@" | sort | uniq >>e0-wildcard-whiterule.txt
cat easylist100.txt | grep -v -E "^\!|^\|\|.*\^$" >e-easylist.txt
cat easylist100.txt | grep -E "[$](\S+,)*(client|dnstype|dnsrewrite|important|badfilter|ctag)" | sort | uniq >rule-modifiers.txt
#cat easylist100.txt | grep -E "^[^@!]\S*[^\^]$" | sort | uniq >>base-src-easylist.txt
#sort base-src-easylist.txt | uniq >a.txt
#mv -f a.txt base-src-easylist.txt

cd ../

php make-addr.php
sed -i ../anti-ad-easylist.txt  -e "s/^||||/||/g" -e "s/^||be\^$//gI" -e "s/^||fr\^$//gI" -e "s/^||p\.de\^$//gI" -e "/^$/d"
echo
php ./tools/easylist-extend.php ../anti-ad-easylist.txt
cat ./origin-files/rule-modifiers.txt ./origin-files/e-easylist.txt >> ../anti-ad-easylist.txt
awk '!x[$0]++' ../anti-ad-easylist.txt > ../a.txt
sed -i ../a.txt  -e "s/^||||/||/g" -e "s/^||be\^$//gI" -e "s/^||fr\^$//gI" -e "s/^||p\.de\^$//gI" -e "/^$/d"
#(head -n 4 ../a.txt && tail -n +5 ../a.txt | sort) | uniq > ../anti-ad-easylist.txt
mv -f ../a.txt ../anti-ad-easylist.txt
