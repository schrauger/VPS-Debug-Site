# VPS-Debug-Site
This barebones website lets you debug specific portions of the web server to determine if any parts are not running correctly.

Clicking on the various links lets you know if your php processor or database are down.

If the main website is down, loading this debug site will help narrow the problem to a specific service.

## Page checks
### index.html
If this loads, nginx is running correctly (assuming you use nginx instead of apache). 

If it fails to load, then your web service isn't processing any web pages.
* nginx service has stopped or is misconfigured (did you `restart` without a `reload`? if a config file is incorrect, nginx won't restart until it's fixed)
* firewall is blocking port 80/443
* network connection is down
* actual server is offline

### index.php
If this loads, your php processor is running.

If it fails to load, you can't process php. Both hhvm and php7.4-fpm are down.
* `service restart hhvm; service restart php7.4-fpm`

### db.php
If this loads, your SQL database service is running.

If it fails to load, mysql may have crashed.
* `service mysql restart`
 
Or it may be refusing to start due to a galera cluster issue. Read the galera documentation for solutions. (Likely involving a force restart and manual sync).

### hhvm.php
If this loads, then `hhvm` is running.

If not, `hhvm` crashed.
* `service hhvm restart`

### phpfpm.php
If this loads, then `php7.4-fpm` is running.

If not, `php7.4-fpm` crashed.
* `service php7.4-fpm restart`

## Config
### Clone
First, clone this repo into /var/www/
* `cd /var/www`
* `git clone https://github.com/schrauger/VPS-Debug-Site.git`

### config.php
You have to modify config.php to set up the base url as well as mysql credentials and config.

### index.html
Since raw html can't include other html without javascript or iframes, you'll need to manually edit the quick links at the bottom for vps1, vps2, etc.

### mysql user permissions
To check the galera cluster status, a user with the proper credentials must be created. It does *not* need any `GRANT` privileges to any tables. The only thing this user must be able to do is read a status line from the mysql database, which is a privilege implicitely granted to all users. Feel free to be as lax or strict with the password as you see fit.

Connect to mysql using mysqlclient (or use your favorite program to connect and add the user)

* `mysql -p`

Create the user, modifying the password as you see fit. Use these credentials in the config.php file.
* `CREATE USER 'vpstest'@'localhost' IDENTIFIED BY 'vpstest';`
* 

### nginx config

Include this nginx config file in your `sites-enabled` folder.

```
upstream vpsphpconfig {
	server 127.0.0.1:9000;
	server 127.0.0.1:8000 backup;
}

server {
	listen 80;
	server_name vps1.address.com;
	server_name vps2.address.com;


	# Define the index search
	index index.html index.php index.htm;

	access_log /var/log/nginx/vps.address.com.access_log;
	error_log /var/log/nginx/vps.address.com.error_log;

	root /var/www/VPS-Debug-Site/;

	# Directly serve these static files
	location ~* \.(js|css|png|jpg|jpeg|gif|ico|html)$ {
		expires max;
		log_not_found off;
	}

	location = /phpfpm.php {
		fastcgi_pass 	127.0.0.1:9000;
		fastcgi_index 	phpfpm.php;
		include /etc/nginx/conf.d/fastcgi_params;
		add_header Cache-Control no-cache;
	}
	location = /hhvm.php {
		fastcgi_pass 	127.0.0.1:8000;
		fastcgi_index 	hhvm.php;
		include /etc/nginx/conf.d/fastcgi_params;
		add_header Cache-Control no-cache;
	}

	# Process php using hhvm or php7.4-fpm
	location ~ /(index)|(db).php {
		fastcgi_pass 	vpsphpconfig; # reference upstream directive defined at top of file
		fastcgi_index 	index.php;
		include /etc/nginx/conf.d/fastcgi_params;
		add_header Cache-Control no-cache;
	}

}
```

### fastcgi_params
This config file must also be created for nginx.

```
fastcgi_param	QUERY_STRING		$query_string;
fastcgi_param	REQUEST_METHOD		$request_method;
fastcgi_param	CONTENT_TYPE		$content_type;
fastcgi_param	CONTENT_LENGTH		$content_length;

fastcgi_param	SCRIPT_FILENAME		$request_filename;
fastcgi_param	SCRIPT_NAME		$fastcgi_script_name;
fastcgi_param	REQUEST_URI		$request_uri;
fastcgi_param	DOCUMENT_URI		$document_uri;
fastcgi_param	DOCUMENT_ROOT		$document_root;
fastcgi_param	SERVER_PROTOCOL		$server_protocol;

fastcgi_param	GATEWAY_INTERFACE	CGI/1.1;
fastcgi_param	SERVER_SOFTWARE		nginx/$nginx_version;

fastcgi_param	REMOTE_ADDR		$remote_addr;
fastcgi_param	REMOTE_PORT		$remote_port;
fastcgi_param	SERVER_ADDR		$server_addr;
fastcgi_param	SERVER_PORT		$server_port;
fastcgi_param	SERVER_NAME		$server_name;

fastcgi_param	HTTPS			$https if_not_empty;

# PHP only, required if PHP was built with --enable-force-cgi-redirect
fastcgi_param	REDIRECT_STATUS		200;
```
