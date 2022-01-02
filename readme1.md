#添加延时任务队列
  准备工作：
  1,配置.env队列驱动为redis
  2,composer require predis依赖
  3,开启队列监听，php artisan queue:work
  创建任务:
  1,php artisan make:job JobName
  2,JobName依赖注入处理对象，handle进行任务处理
  3,任务分发，JobName::dispatch($object)

#延时任务失败处理

