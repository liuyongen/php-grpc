# PHP client for GRPC

## 生成PHP源码

1. 安装 
     + protoc、 grpc_php_plugin安装 参考：https://grpc.io/docs/languages/php/basics/
     + PHP grpc扩展 参考：https://www.jianshu.com/p/2138141a05e0

2. pb协议(demo.proto)内容

``` pb

	//版本
	syntax = "proto3";

	//包名
	package Hello;

	//定义服务名及方法
	service Demo {
	    rpc GetDemo (GetDemoReq) returns (GetDemoReply) {}
	}

	//定义请求消息
	message GetDemoReq {
	    int64 user_id = 1;
	}

	//定义响应消息
	message GetDemoReply {
	    int64 user_id = 1;
	}

```

3. 执行  

	+ protos -I=协议目录 --php_out=客户端目录 --grpc_out=客户端目录 --plugin=插件(可缺省)  协议文件

	+ /usr/local/bin/protoc -I=./protos --php_out=./client --grpc_out=./client --plugin=protoc-gen-grpc=/usr/local/bin/grpc_php_plugin demo.proto
	
	+ 如加载了插件会直接生成客户端源码(DemoClient.php)，没装载需要手动添加客户端调用代码
	

4. 生成目录

``` php

	├── GPBMetadata
	│   └── Demo.php
	└── Hello
	    ├── DemoClient.php
	    ├── GetDemoReply.php
	    └── GetDemoReq.php

```
    

## Composer包依赖
``` json
{
    "require": {
        "grpc/grpc": "^v1.3.0",
        "google/protobuf": "^v3.3.0"
    }
}
```
## RPC调用


``` php

	require('vendor/autoload.php');
	
	//实例化
	$hostname = '127.0.0.1:51223';
	$client = new \Hello\DemoClient($hostname, [
	    'credentials' => \Grpc\ChannelCredentials::createInsecure(),
	]);


	//请求参数
	$req = new \Hello\GetDemoReq();
	$req->setUserId(3);

	//远程调用
	$res = $client->GetDemo($req);
	list($reply, $status) = $res;
	if ($status->code !== \Grpc\STATUS_OK) {
    	echo "ERROR: " . $status->code . ", " . $status->details . PHP_EOL;
    	exit(1);
	}
	var_dump($reply);
	

```