<?php

namespace X12311231\Rpc1\Client;

/**
 * SocketHelper instance 管理类
 * Class SocketManager
 */
class SocketManager
{
    private $log;
    private static $_instance = array();

    private function __clone()
    {
    }

    public function setLog($loger)
    {
        $this->log = $loger;
        return $this;
    }

    /**
     * 获取一个SocketHelper实例
     * @param $socketType
     * @param $socketConfig
     * @return mixed|SocketHelper
     */
    private static function getInstance($socketType, $socketConfig)
    {
        $instance = isset(self::$_instance[$socketType]) ? self::$_instance[$socketType] : null;
        if (!$instance instanceof SocketHelper) {

            $host = $socketConfig['host'];
            $port = $socketConfig['port'];
            $ipv6 = $socketConfig['ipv6'];
            $udp = $socketConfig['udp'];
            $nonblock = $socketConfig['nonblock'];

            //LogHelper::printInfo(['socketConfig', $socketConfig]);
            $instance = new SocketHelper($host, $port, $ipv6, $udp, $nonblock);
            $instance->setLog($this->log);
            self::$_instance[$socketType] = $instance;
        }
        //检查连接
//        $instance->checkConnect();
        return $instance;
    }

    /**
     * 获取中心服socket
     * @return mixed|SocketHelper
     */
    public static function getCenterSocket()
    {
        return self::getInstance('center', config('socket.center'));
    }

    /**
     * 获取中心服socket
     * @return mixed|SocketHelper
     */
    public static function getRobotSocket()
    {
        return self::getInstance('robot', config('socket.robot'));
    }

    /**
     * 关闭所有的socket连接
     */
    public static function closeAllSocket()
    {
        foreach (self::$_instance as $key => &$instance) {
            if ($instance instanceof SocketHelper) {
                $instance->close();
                $instance = NULL;
            }
        }
    }

}

