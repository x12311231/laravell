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
  1,任务失败后写入mysql failed_jobs表

#延时任务失败后的重试机制
  1,手动重试
   1)命令行查看失败任务：php artisan queue:failed
   2)命令行执行重试：php artisan queue:retry all(或者具体任务id)

#本地开发composer依赖
  1,在项目目录外初始化项目（composer init）
  2,项目根目录composer.json配置repository
  ```
      ...

      "repositories": {
              "local": {
                          "type": "path",
                          "url": "./vendordev/x12311231/rpc1/"
                      }
          }

  ```
  3,安装，composer require x12311231/rpc1:dev-master
  4,安装过程没有提示出错一般没问题，有五个匹配文件  vendor/composer/autoload_classmap.php,vendor/composer/autoload_psr4.php,vendor/composer/autoload_static.php,vendor/composer/installed.json,vendor/x12311231/rpc1/composer.json

```
[root@localhost example-app]# grep X12311231 vendor -rn
vendor/composer/autoload_classmap.php:5207:    'X12311231\\Rpc1\\Client\\Client' => $vendorDir . '/x12311231/rpc1/src/Client/Client.php',
    vendor/composer/autoload_classmap.php:5208:    'X12311231\\Rpc1\\Client\\SocketManager' => $vendorDir . '/x12311231/rpc1/src/Client/SocketManager.php',
    vendor/composer/autoload_classmap.php:5209:    'X12311231\\Rpc1\\Test1' => $vendorDir . '/x12311231/rpc1/src/Test1.php',
    vendor/composer/autoload_psr4.php:11:    'X12311231\\Rpc1\\' => array($vendorDir . '/x12311231/rpc1/src'),
    vendor/composer/autoload_static.php:52:            'X12311231\\Rpc1\\' => 15,
    vendor/composer/autoload_static.php:197:        'X12311231\\Rpc1\\' => 
    vendor/composer/autoload_static.php:5730:        'X12311231\\Rpc1\\Client\\Client' => __DIR__ . '/..' . '/x12311231/rpc1/src/Client/Client.php',
    vendor/composer/autoload_static.php:5731:        'X12311231\\Rpc1\\Client\\SocketManager' => __DIR__ . '/..' . '/x12311231/rpc1/src/Client/SocketManager.php',
    vendor/composer/autoload_static.php:5732:        'X12311231\\Rpc1\\Test1' => __DIR__ . '/..' . '/x12311231/rpc1/src/Test1.php',
    vendor/composer/installed.json:8282:                    "X12311231\\Rpc1\\": "src/"
    vendor/x12311231/rpc1/composer.json:5:            "X12311231\\Rpc1\\": "src/"
    vendor/x12311231/rpc1/src/Client/Client.php:2:namespace X12311231\Rpc1\Client;
    vendor/x12311231/rpc1/src/Client/SocketHelper.php:2:namespace X12311231/Rpc1/Client;
    vendor/x12311231/rpc1/src/Client/SocketManager.php:3:namespace X12311231\Rpc1\Client;
    vendor/x12311231/rpc1/src/Test1.php:2:namespace X12311231\Rpc1;
    
```

#laravel 注册服务提供者
  1,命令行创建php artisan make:provider TestServiceProvider
  2,config/app.php里providers数组添加服务提供者class

#laravel 分发延时队列任务时模型写入数据ModelNotFoundException问题


#laravel 统计失败任务数
  1,通过mysql查询

#javascript数组
```
var b = [['id','in',[1,3]],['is_close','=',0]]
```
  1,数组字符串元素必须用单引号
  
#javascript json
```angular2html
'[["id","in",[1,3]],["is_close","=",0]]'
```
  1,字符串用单引号
  2,字符串内用双引号分离元素

#引入了rabbitmq作为队列（20220508）https://www.5axxw.com/wiki/content/21fnkg
  1，直接输出hello的简单延时任务执行成功
  2，新增订单后延时修改状态的任务执行失败，这个在redis作为驱动时是成功的

#经测试Bus::chain()->catch(),捕获异常后无法进行回滚
```
022-05-09T08:20:04.448930Z	  293 Query	START TRANSACTION
2022-05-09T08:20:04.468456Z	  293 Query	COMMIT
2022-05-09T08:20:04.482259Z	  293 Quit
2022-05-09T08:20:04.859569Z	  253 Prepare	insert into `chains` (`name`, `updated_at`, `created_at`) values (?, ?, ?)
2022-05-09T08:20:04.860690Z	  253 Execute	insert into `chains` (`name`, `updated_at`, `created_at`) values ('chain1 task commit 20220509082004', '2022-05-09 08:20:04', '2022-05-09 08:20:04')
2022-05-09T08:20:04.865026Z	  253 Close stmt
2022-05-09T08:20:04.874945Z	  253 Prepare	insert into `chains` (`name`, `updated_at`, `created_at`) values (?, ?, ?)
2022-05-09T08:20:04.876039Z	  253 Execute	insert into `chains` (`name`, `updated_at`, `created_at`) values ('chain3 task commit 20220509082004', '2022-05-09 08:20:04', '2022-05-09 08:20:04')
2022-05-09T08:20:04.879728Z	  253 Close stmt
```

#事件是如何触发的？
答：event(new DemoEvent($obj))
如，注册事件
```
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];
```
答：
1，安装认证模块（http://laravel.p2hp.com/cndocs/8.x/starter-kits）

#事件是什么？
 1，事件以类的形式而存在，一般不存在过多的逻辑
 2，App\Providers\EventServiceProvider中可以注册事件的逻辑关系

 #配置机制

 #事件自动发现后（不用注册到服务提供者），
  1，事件监听会自动匹配吗(触发逻辑)？会
```

    /**
     * 确定是否应用自动发现事件和侦听器。
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return true;
    }
```

#事件可以实现ShouldQueue接口吗？还是事件监听可以？
 1，事件监听器队列（http://laravel.p2hp.com/cndocs/8.x/events#queued-event-listeners）

#队列默认监听default，如何监听所有？