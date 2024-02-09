<div align="center">
 <h1> YoMarket Website </h1>
 <p> The Official Source for YoMarket Website</p>
</div>

 # Installing Dependencies

<p>Packages/Libraries</p>

```
sudo apt-get install php-gd
```

# Configure the profile search system

<p>// Edit and add the 404 Redirection below for Profile Search</p>
<p>ErrorDocument 404 /profile.php</p>

```
$ nano /etc/apache2/sites-enabled/000-default.conf
```

<p>// Edit and modify the AllowOverride line to the following directory tags below</p>
<p>// 'Override None' to 'Override All'</p>

```
$ nano /etc/apache2/apache2.conf
```

<p>// Restart Apache</p>

```
$ service apache2 restart
```

