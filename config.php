<?php
 define('ENVIRONMENT', 'production');//正式的 就是production
 
 $hostList = array('company'=>'','production'=>'','hom'=>'','integle'=>'');
 
 $host = $hostList[ENVIRONMENT];
 
 define('SPMS_HOST',  $host);//正式的 就是production
