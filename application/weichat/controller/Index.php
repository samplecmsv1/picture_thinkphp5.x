<?php
namespace app\weichat\controller;
use cms\base as Base;

use cms\db;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Text;
class Index {
	protected $config;
	function __construct(){
		$this->config = config('qihe');
		
	}


	function index(){
		$options = [
		    
		    'app_id'    => $this->config['app_id'],
		    'secret'    => $this->config['secret'],
		    'token'     => $this->config['token'],
		    'aes_key'     => $this->config['aes_key'],
		    
		    /*'debug'     => true,
		    'log' => [
		        'level' => 'debug',
		        'file'  => RUNTIME_PATH.'/easywechat.log',
		    ],*/
		    
		];


		$app = new Application($options);
		$server = $app->server;

		$server->setMessageHandler(function ($message) {
		    return "您好！欢迎关注我!";
		});


		$server->serve()->send();


	}

	function hongbao(){
		$options = [
		    // payment
		    'payment' => [
		        'merchant_id'        => 'your-mch-id',
		        'key'                => 'key-for-signature',
		        'cert_path'          => 'path/to/your/cert.pem',
		        'key_path'           => 'path/to/your/key',
		        // ...
		    ],
		];

		$app = new Application($options);

		$luckyMoney = $app->lucky_money;

		

		$luckyMoneyData = [
		    'mch_billno'       => 'xy123456',
		    'send_name'        => '测试红包',
		    're_openid'        => 'oxTWIuGaIt6gTKsQRLau2M0yL16E',
		    'total_num'        => 1,  //普通红包固定为1，裂变红包不小于3
		    'total_amount'     => 100,  //单位为分，普通红包不小于100，裂变红包不小于300
		    'wishing'          => '祝福语',
		    'client_ip'        => '192.168.0.1',  //可不传，不传则由 SDK 取当前客户端 IP
		    'act_name'         => '测试活动',
		    'remark'           => '测试备注',
		    // ...
		];

		$result = $luckyMoney->send($luckyMoneyData, \EasyWeChat\Payment\LuckyMoney\API::TYPE_NORMAL);
 




	}







	
 
}