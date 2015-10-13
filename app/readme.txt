
Upgrade 新功能上線時要注意:

    SQL schema 是否已新增/更新
    app/config/config.php 設定檔是否已同步


Compatibility:

    PHP 5.5 and above
        curl
        GD
    mysql 5.0 and above
        InnoDB storage engine
    ImageMagick
        ( EX. apt-get install php-5.3-imagick-zend-server )
    Apache
        Apache rewrite_module


Admin css framework Twitter Bootstrap document:

    http://getbootstrap.com/css/
    CDN
        未使用

Admin css custom icon list:

    http://www.plugolabs.com/custom-twitter-bootstrap-button-generator-with-famfamfam-icons/


Clear cache:

    ./app/bin/cache_clean.php

    or

    rm -r app/tmp/cache/*


舊的路徑命名規則:

    path    表示實際的位置      如 /var/www/project1/js
    url     表示網站完整位置    如 http://localhost/project1/js
    uri     表示網站資源位置    如 /project1/js (這是錯的, 不要再使用)
    link    表示路徑與檔案名稱  如 /project1/js/script.js

新的命名規則:

    getPath()                       -> /var/www/project
    getPath('/hello')               -> /var/www/project/hello
    getUrl()                        -> /project
    getUrl('/hello')                -> /project/hello
    getScheme('/hello')             -> //project/heloo
    getScheme('/hello', 'http')     -> http://localhost/project/heloo
    getScheme('/hello', 'https')    -> https://localhost/project/heloo


URI 簡易說明: (https://en.wikipedia.org/wiki/URI_scheme)

    foo://username:password@example.com:8042/over/there/index.dtb?type=animal&name=narwhal#nose
    ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ url
    ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ protocol host
                            ^^^^^^^^^^^ host                      ^^^^^^^^^^^^^^^^^^^^^^^^ query
                                             ^^^^^^^^^^^^^^^^^^^^ path


Event List
    grep -nR 'Ydin\\Event::notify' .


CMS 命名

    Identifier:
        space

    Format by body tag:
        <body>
            [start]
            [content]
            [end]
        </body>

                        xxxxx-body-start-before
        body start   -> xxxxx-body-start
                        xxxxx-body-start-after

                        xxxxx-body-main-before
        body main    -> xxxxx-body-main
                        xxxxx-body-main-after
        
                        xxxxx-body-end-before
        body end     -> xxxxx-body-end
                        xxxxx-body-end-after

    Sample:
        head 關閉前     -> xxxxx-head-end-before
        body 一開始     -> xxxxx-body-start
        主要內容上方    -> xxxxx-content-start
        主要內容下方    -> xxxxx-content-end




其它未來要設定功能

    之後 js, css 做 compiler 之後會集成 one js , one css
    可以在設定某 cookie or session, 切換成無 compiler 的狀態

    在每一個重要函式 (php or js) 的前面加上 標示性的 log tag
    未來在追蹤程式時會有很好的效果
    
    
