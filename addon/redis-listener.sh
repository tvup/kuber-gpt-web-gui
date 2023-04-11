#!/bin/bash

# Variables
REDIS_HOST="usw1-known-yeti-33121.upstash.io"
REDIS_TLS_PORT=33121 # Replace with the TLS port for your Redis instance
CHANNEL="my-channel"
REDIS_PASSWORD="abb72ba1e5ac40b7b5ba07fb866f30ba" # Replace with your Redis password

function on_message_received() {
  local channel=$1
  local text=$2
  arrIN=(${text//;/ })
  local message=${arrIN[0]}
  local email=${arrIN[1]}
  echo "Message received on channel ${channel}: ${text}"
  cd /etc/openvpn/easy-rsa || exit
  export KEY_PASSWORD=`/usr/bin/pwgen -s 8 1`
  echo $KEY_PASSWORD > /etc/openvpn/easy-rsa/pki/private/"${message}".password.txt
  EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa --passin=file:/etc/openvpn/easy-rsa/pki/private/"${message}".password.txt --passout=file:/etc/openvpn/easy-rsa/pki/private/"${message}".password.txt gen-req "${message}"
  EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa sign-req client "${message}"

  cd /etc/openvpn/easy-rsa/pki || exit
  cat /var/www/html/addon/vpn_FULL_TCP_conf.ovpn > ./"${message}"_FULL.ovpn

  echo "<ca>" >> ./"${message}"_FULL.ovpn
  cat ca.crt  >> ./"${message}"_FULL.ovpn
  echo "</ca>" >> ./"${message}"_FULL.ovpn

  echo "<cert>" >> ./"${message}"_FULL.ovpn
  cat issued/"${message}".crt  >> .//"${message}"_FULL.ovpn
  echo "</cert>" >> ./"${message}"_FULL.ovpn

  echo "<key>" >> ./"${message}"_FULL.ovpn
  cat private/"${message}".key  >> ./"${message}"_FULL.ovpn
  echo "</key>" >> ./"${message}"_FULL.ovpn

  echo "<tls-auth>" >> ./"${message}"_FULL.ovpn
  cat ../../ta.key  >> ./"${message}"_FULL.ovpn
  echo "</tls-auth>" >> ./"${message}"_FULL.ovpn

  echo "<dh>" >> ./"${message}"_FULL.ovpn
  cat ../../dh2048.pem  >> ./"${message}"_FULL.ovpn
  echo "</dh>" >> ./"${message}"_FULL.ovpn

  /usr/bin/mailx "${email}" -s "VPN per "${message}" con password" -a From:admin@torbenit.dk -A "${message}"_FULL.ovpn < /etc/openvpn/easy-rsa/pki/private/"${message}".password.txt
}

# Connect to Redis server using TLS, authenticate and subscribe to the channel
if [[ -n "${CERT_PATH}" && -n "${KEY_PATH}" && -n "${CA_CERT_PATH}" ]]; then
  redis-cli --tls --cert "${CERT_PATH}" --key "${KEY_PATH}" --cacert "${CA_CERT_PATH}" --pass "${REDIS_PASSWORD}" -h "${REDIS_HOST}" -p "${REDIS_TLS_PORT}" --csv SUBSCRIBE "${CHANNEL}" | while IFS=, read -r type channel message; do
    on_message_received "$(echo "$channel" | tr -d '"')" "$(echo "$message" | tr -d '"')"
  done
else
  redis-cli --tls --pass "${REDIS_PASSWORD}" -h "${REDIS_HOST}" -p "${REDIS_TLS_PORT}" --csv SUBSCRIBE "${CHANNEL}" | while IFS=, read -r type channel message; do
    on_message_received "$(echo "$channel" | tr -d '"')" "$(echo "$message" | tr -d '"')"
  done
fi
