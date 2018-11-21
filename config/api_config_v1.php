<?php

/**
 * +-----------------------------------
 * 接口对应参数配置
 * +-----------------------------------
 *
 * @Author: xujian <xujian@feeyo.com>
 */


return [
    'api_key'=>'api_key',

    'api_common'=>[
        'v'         => ['name' => '接口版本号', 'ismust' => false],
        'version'=>["name"=>"客户端版本",'ismust'=>false],
        'app_id'=>['name'=>'渠道id[1 长水常准 2 虹桥掌上放行3 飞常准业内 4:海南航空]','ismust'=>false],
        'device'    => ['name' => '设备类型，0:IOS，1：android', 'ismust' => false],
        'device_info'=> ['name' => '设备信息描述', 'ismust' => false],
        'device_id' => ['name' => '设备号(设备唯一id)', 'ismust' => false],
        'device_token' => ['name' => '推送token', 'ismust' => false],
        'request_time'  => ['name' => '请求时间', 'ismust' => true],
    ],

    'api_param'=>[
        'basic/soft/config' => [
            'ucode'    => ['name' => '用户id', 'ismust' => true],
        ],
    ],
];
