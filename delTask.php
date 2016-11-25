<?php
/**
 * 删除定时任务
 * @author zan.z.liu@integle.com
 *
 */
class delTask{
	
	public function index()
	{
		$this->dTask();
	}
	
	public function dTask()
	{
		$tasks = $this->getTasks();
		
		foreach ($tasks as $item)
		{
			$file = './tasks/'.$item;
			
			unlink($file);
			
			echo $file.PHP_EOL;
		}
	}
	
	private function getTasks()
	{
		$task [] = 'edisRgdtlFunds_task.php';//退货课题经费使用统计
		$task [] = 'edisSoDtlFunds_task.php';//出库课题经费使用统计
		$task [] = 'goodHandleRgDtl_task.php';//产品类别入库统计
		$task [] = 'goodHandleSoDtl_task.php';//产品类别出库统计
		$task [] = 'suppHandleRgDtl_task.php';//库房入库统计
		$task [] = 'suppHandleSoDtl_task.php';//库房出库统计
		$task [] = 'timecost_task.php';//经费统计
		return $task;
	}
}

$delTask = new delTask();
$delTask->dTask();
