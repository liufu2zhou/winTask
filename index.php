<?php
//怎么判断 不能使用URL访问
//ignore_user_abort();//关闭浏览器后，继续执行php代码
//set_time_limit(0);//程序执行时间无限制
$sleep_time =  include 'sleeptime.php';//多长时间执行一次
$f_sleep_time =  include 'f_sleeptime.php';//多长时间执行一次

$switch = include 'switch.php';
$f_switch = include 'f_switch.php';

include 'config.php';

//TODO 需要两个守护 
//第一个守护 是一直跑着的
//第二个守护 是可以根据条件进行判断的
//怎么给每个任务分配不同的执行时间

while($f_switch){
	$f_switch = include 'f_switch.php';
	while($switch){
		$fileList = glob('.\tasks\*_task.php');
		
		$switch = include 'switch.php';
		
		foreach($fileList as $file){
				
				$fileInfo = include $file;
				
				//获取文件的统计信息
				$fstat = stat($file);
				
				//$xcTime = (time() - $fstat['mtime'])/60;//当前时间和文件最后修改时间相差多少秒
				$xcTime = intval((time() - $fstat['mtime'])%(3600*24));
				//echo $xcTime .'>='. $fileInfo['execTime'].PHP_EOL;
				if($xcTime >= $fileInfo['execTime']){
					//如果相差时间大于最后执行时间 则执行此任务
					CommondExeTask($fileInfo['url'],$fileInfo['data']);
					//修改文件最后访问时间
					touch($file);
					$del = isset($fileInfo['del'])?$fileInfo['del']:0;
					//如果是临时创建的任务则 执行完毕就删除
					if($del)
					{
					    unlink($file);
					}
				}
				
				clearstatcache();//每次清空缓存
				unset($fileInfo);
				unset($xcTime);
		}
		
		unset($fileList);
		sleep($sleep_time);
	}
	
	$switch = include 'switch.php';
	
	if(!$switch){
		echo date('Y-m-d H:i:s',time()).' task close!'.PHP_EOL;
	}
	sleep($f_sleep_time);
}
exit('task end');

function CommondExeTask($url,$data = array())
{
    $url = str_replace(array('\\','/'), ' ', $url);
    $commond = 'php \\index.php '.$url;//eg php index.php task task1 命令行执行
    echo $commond.PHP_EOL;
    system($commond);
    echo PHP_EOL;
}

function taskStart($url,$data = array()){
		
		if(!strstr($url,'http')){
			$url = SPMS_HOST.'/'.$url;
		}
        // 初始化一个 cURL 对象
        $curl = curl_init ();
        // 设置你需要抓取的URL
        curl_setopt ( $curl, CURLOPT_URL, $url );
        // 设置header
        curl_setopt ( $curl, CURLOPT_HEADER, 0 );
        // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
        // 开启POST提交
        curl_setopt ( $curl, CURLOPT_TIMEOUT, 1 );
        // 传递提交参数
        curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query($data));
        // 运行cURL，请求网页
        $data = curl_exec ( $curl );
		echo date('Y-m-d H:i:s',time()).' '.$url.PHP_EOL;
        // 关闭URL请求
        curl_close ( $curl );
}

