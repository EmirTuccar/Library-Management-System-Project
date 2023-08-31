import os

os.system("sudo iptables -I INPUT -p tcp --dport 12345 -j ACCEPT")
