<?php
 define('ENVIRONMENT', 'production');//正式的 就是production
 
 $hostList = array('company'=>'spms.dev.com/index.php/','production'=>'spms.sioc.ac.cn/index.php/','hom'=>'spms.dev.com/index.php/','integle'=>'spms.integle.com.cn/index.php/');
 
 $host = $hostList[ENVIRONMENT];
 
 define('SPMS_HOST',  $host);//正式的 就是production
