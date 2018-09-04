#!/bin/bash

UTENTE_ID=$1
if [[ -z $1 ]]; then
	echo "Errore aggiungere id utente come parametro. Es script-revoke.sh ub32"
	exit
fi
cd /etc/openvpn/ca
. ./vars

 ./revoke-full $UTENTE_ID
echo "restart openvpn deamons" 
systemctl restart openvpn@openvpn
systemctl restart openvpn@openvpn-udp
systemctl restart openvpn@openvpn-ts
