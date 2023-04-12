#!/bin/bash

# Variables
REDIS_HOST=""
REDIS_PORT=0 # Replace with the TLS port for your Redis instance
REDIS_CREATE_CHANNEL=""
REDIS_REVOKE_CHANNEL=""
REDIS_PASSWORD="" # Replace with your Redis password

while read -r line; do
    key=$(awk -F '=' '{print $1}' <<< $line)
    val=$(awk -F '=' '{print $2}' <<< $line)

    if [ "$key" = "REDIS_HOST" ]; then
        REDIS_HOST=$val
    elif [ "$key" = "REDIS_PORT" ]; then
        REDIS_PORT=$val
    elif [ "$key" = "REDIS_CREATE_CHANNEL" ]; then
        REDIS_CREATE_CHANNEL=$val
    elif [ "$key" = "REDIS_REVOKE_CHANNEL" ]; then
        REDIS_REVOKE_CHANNEL=$val
    elif [ "$key" = "REDIS_PASSWORD" ]; then
        REDIS_PASSWORD=$val
    fi

done <<< "$(cat ../.env)"


function on_message_received() {
  local channel=$1
  local text=$2
  if [ "${channel}" = "${REDIS_CREATE_CHANNEL}" ]; then
      arrIN=(${text//;/ })
      local message=${arrIN[0]}
      local email=${arrIN[1]}
      cd /etc/openvpn/easy-rsa || exit
      export KEY_PASSWORD=`/usr/bin/pwgen -s 8 1`
      echo $KEY_PASSWORD > /etc/openvpn/easy-rsa/pki/private/"${message}".password.txt
      EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa --passin=file:/etc/openvpn/easy-rsa/pki/private/"${message}".password.txt --passout=file:/etc/openvpn/easy-rsa/pki/private/"${message}".password.txt gen-req "${message}"
      EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa sign-req client "${message}"

      cd /etc/openvpn/easy-rsa/pki || exit
      cat /home/forge/secure.torbenit.dk/addon/vpn_FULL_TCP_conf.ovpn > ./"${message}"_FULL.ovpn

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
      cat ../ta.key  >> ./"${message}"_FULL.ovpn
      echo "</tls-auth>" >> ./"${message}"_FULL.ovpn

      /usr/bin/mailx "${email}" -s "VPN per "${message}" con password" -a From:admin@torbenit.dk -A "${message}"_FULL.ovpn < /etc/openvpn/easy-rsa/pki/private/"${message}".password.txt
      sudo setfacl -m u:forge:rwx /etc/openvpn/easy-rsa/pki
      sudo setfacl -m u:forge:rw /etc/openvpn/easy-rsa/pki/index.txt
  elif [  "${channel}" = "${REDIS_REVOKE_CHANNEL}" ]; then
      cd /etc/openvpn/easy-rsa || exit
      EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa revoke "${text}"
      sudo setfacl -m u:forge:rwx /etc/openvpn/easy-rsa/pki
      sudo setfacl -m u:forge:rw /etc/openvpn/easy-rsa/pki/index.txt
  fi
}

# Connect to Redis server using TLS, authenticate and subscribe to the channel
if [[ -n "${CERT_PATH}" && -n "${KEY_PATH}" && -n "${CA_CERT_PATH}" ]]; then
  redis-cli --tls --cert "${CERT_PATH}" --key "${KEY_PATH}" --cacert "${CA_CERT_PATH}" --pass "${REDIS_PASSWORD}" -h "${REDIS_HOST}" -p "${REDIS_PORT}" --csv SUBSCRIBE "${REDIS_CREATE_CHANNEL}" "${REDIS_REVOKE_CHANNEL}" | while IFS=, read -r type channel message; do
      echo "Message received on channel $channel: $message"
      if [ "$channel" != '' ] && [ "$message" != '1' ]; then
        on_message_received "$(echo "$channel" | tr -d '"')" "$(echo "$message" | tr -d '"')"
      fi
  done
else
  redis-cli --tls --pass "${REDIS_PASSWORD}" -h "${REDIS_HOST}" -p "${REDIS_PORT}" --csv SUBSCRIBE "${REDIS_CREATE_CHANNEL}" "${REDIS_REVOKE_CHANNEL}" | while IFS=, read -r type channel message; do
      echo "Message received on channel $channel: $message"
      if [ "$channel" != '' ] && [ "$message" != '1' ]; then
        on_message_received "$(echo "$channel" | tr -d '"')" "$(echo "$message" | tr -d '"')"
      fi
  done
fi
