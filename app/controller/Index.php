<?php
/**
Copyright (year) Bytedance Inc.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
 */
namespace app\controller;

use app\BaseController;
use think\Http;
use think\response\Json;

class Index extends BaseController
{

    public function getOpenID(): Json
    {
        $target = $this->request->header('X-Tt-OPENID');
        if(is_null($target)){
            return self::getResponse(-1, 'invalid params', '');
        }
        return self::getResponse(0, 'success', $target);
    }

    public function textAntidirt(): Json
    {
        $content = $this->request->post('content');

        $data = array('tasks' =>
            array(array('content' => $content))
        );
        $data_string = json_encode( $data );
        $url = 'http://developer.toutiao.com/api/v2/tags/text/antidirt';

        $request = curl_init();

        curl_setopt($request, CURLOPT_URL,$url);
        curl_setopt($request, CURLOPT_POST, 1);
        curl_setopt($request, CURLOPT_POSTFIELDS, $data_string);

        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        $response = curl_exec($request);

        curl_close ($request);
        $res = json_decode($response, true);
        return self::getResponse('0','success', $res);
    }


    public function getResponse($err_no, $err_msg, $data): Json
    {
        $out = array(
            'err_no'    => $err_no,
            'err_msg'   => $err_msg,
        );
        if(!is_null($data)){
            $out['data'] = $data;
        }
        return json($out);
    }
}
