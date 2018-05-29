server {
        listen          80;

        listen          443 http2;
        ssl                  on;
        ssl_certificate      /etc/nginx/ssl/ubuntu-co.com/ubuntu-co.com.crt-combined;
        ssl_certificate_key  /etc/nginx/ssl/ubuntu-co.com/ubuntu-co.com.key;
        keepalive_timeout    70;


        access_log  /var/log/nginx/ubuntu-co.com.access.log vhost;
        server_name  ubuntu-co.com www.ubuntu-co.com ;
    root    /var/www/ubuntu-co.com ;
    error_page 502 503 504 /50x.html;


        include /etc/nginx/conf.d/vhost.inc;
        if ($scheme = http) { rewrite ^/(.*) https://$host/$1 permanent; }

    if ($request_uri ~ ^/wp-content/uploads/.*\.php$) {return 403;}
    if ($request_uri ~ ^/wp-content/w3tc/objectcache ) { return 403;}
    if ($request_uri ~ ^/wp-content/w3tc/dbcache ) { return 403;}

        location / {
                index   index.html index.htm index.php;
                if (!-e $request_filename) { rewrite . /index.php last; }
        }

        location ~ .php$ {
            fastcgi_pass   unix:/var/run/php5-fpm.sock ;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            include        fastcgi_params;
        }

        location ~ /\.ht {
                deny  all;
        }

        location ~ \.(jpg|gif|png|ico|jpeg)$ {
        expires 7d;
        }


include /etc/nginx/conf.d/w3tc/w3tc_page_cache.inc;
include /etc/nginx/conf.d/w3tc/w3tc_browser.inc;
include /etc/nginx/conf.d/w3tc/w3tc_page_cache_core.inc;

}
