
#------------------------------------------------------------
# public ip => lxd container
#------------------------------------------------------------

INET=1.2.3.4
IDEV=eth0

SERVER=10.9.8.7

iptables -t nat -A PREROUTING -i $IDEV -d $INET -p tcp --dport    80  -j DNAT --to-destination $SERVER:80
iptables -t nat -A PREROUTING -i $IDEV -d $INET -p tcp --dport   443  -j DNAT --to-destination $SERVER:443

iptables -t nat -A PREROUTING -i $IDEV -d $INET -p tcp --dport 12345  -j DNAT --to-destination $SERVER:12345

#------------------------------------------------------------
