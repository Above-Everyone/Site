<div align="center">
 <h1> YoMarket Website </h1>
 <p> The Official Source for YoMarket Website</p>
</div>

 # How to install

<p>// Edit and add the 404 Redirection below for Profile Search</p>
<p>// ErrorDocument 404 /profile.php</p>
```$ nano /etc/apache2/sites-enabled/000-default.conf```

<p>// Edit and modify the AllowOverride line to the following directory tags below</p>
<p>// 'Override None' to 'Override All'</p>
```<Directory />
        Options FollowSymLinks
        AllowOverride All
        Require all denied
</Directory>

<Directory /usr/share>
        AllowOverride All
        Require all granted
</Directory>

<Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>```

<p>// Restart Apache</p>
```
$ service apache2 restart
```
