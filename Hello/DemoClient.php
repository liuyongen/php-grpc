<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Hello;

/**
 * import "google/api/annotations.proto";
 *
 * option go_package = "api/demo/service/v1;v1";
 *
 */
class DemoClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Hello\GetDemoReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function GetDemo(\Hello\GetDemoReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/Hello.Demo/GetDemo',
        $argument,
        ['\Hello\GetDemoReply', 'decode'],
        $metadata, $options);
    }

}
