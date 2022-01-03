<?php
namespace X12311231\Rpc1\Client;

class Client {
    const PACKET_HEAD_LEN = 24;

    public function setLog($logger)
    {
        $this->log = $logger;
        return $this;
    }

    //网络数据包头
    public function netMsgHead($uSize, $uMainID, $uAssistantID)
    {
        $pack = '';
        $pack .= pack('L', $uSize);
        $pack .= pack('L', $uMainID);
        $pack .= pack('L', $uAssistantID);
        $pack .= pack('L', 0);
        $pack .= pack('L', 0);
        return $pack;
    }

    //中心数据包头
    public function centerMsgHead($uCenterID)
    {
        $pack = '';
        $pack .= pack('L', $uCenterID);
        return $pack;
    }

    //打包所有数据
    public function packAllMsg($netMsgHead, $centerMsgHead, $struct)
    {
        $pack = '';
        $pack .= $netMsgHead;
        $pack .= $centerMsgHead;
        $pack .= $struct;
        return $pack;
    }

    public function send($uCenterID, $struct, $uMainID = 0, $uAssistantID = 0)
    {
        //大小 包头28+结构体长度
        $uSize = self::PACKET_HEAD_LEN + strlen($struct);

        $netMsgHead = $this->netMsgHead($uSize, $uMainID, $uAssistantID);

        $centerMsgHead = $this->centerMsgHead($uCenterID);

        $data = $this->packAllMsg($netMsgHead, $centerMsgHead, $struct);

        $sendResult = SocketManager::getCenterSocket()->setLog($this->log)->send_data($data);
        //LogHelper::printInfo("send uCenterID={$uCenterID},targetID={$targetID},uMainID={$uMainID},uAssistantID={$uAssistantID}");
        //发送是否成功
        if (!$sendResult) {
            $this->log->error("发送数据失败 uCenterID={$uCenterID,uMainID={$uMainID},uAssistantID={$uAssistantID}");
            return false;
        }
        return true;
    }
}
