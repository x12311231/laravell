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
