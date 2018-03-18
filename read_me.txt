מדריך הפעלה  Read Me –
על מנת להפעיל את הפרויקט דרושים כמה דברים.

1.	לשים בתיקיה את הקבצים ולשנות את הvhost & host.
Host - 127.0.0.1 theschool.local www.theschool.local
Vhost –
אתה מכניס לו את התיקיה שאתה רוצה שהוא יקח ממנה (זה השתבש קצת בעתקה בגלל הוורד)
<VirtualHost *:80>
    ServerName theschool.local
	ServerAlias www.theschool.local
    DocumentRoot D:\work\theschool

    <Directory "D:\work\theschool">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>

2.	להיכנס לקובץ local_conf.php  שנמצא ב  theschool\coreבתוך תיקית core ולשנות שם כמה דברים: א. החיבור לDB . ב. Environment , ststic_domain , static_base_domain

לשנות את זה לפי ההגדות שלך ,הכתובת של התיקיה בה שמת את הפרויקט.

