<?php
/**
 * 删除定时任务
 * @author 1197680861@qq.com
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
		$task [] = '';//任务列表
		
		return $task;
	}
}

$delTask = new delTask();
$delTask->dTask();
