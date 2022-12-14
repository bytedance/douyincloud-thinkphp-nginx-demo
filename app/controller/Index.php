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
use app\model\Factory;
use think\response\Json;

class Index extends BaseController
{

    public function sayHello(): Json
    {
        $target = $this->request->param('target');
        if(is_null($target)){
            return self::getResponse(-1, 'invalid params', '');
        }
        $com = Factory::createComponent($target);
        if(is_null($com)){
            return self::getResponse(-1, 'invalid params', '');
        }
        $res = $com->getComponentName('name');
        return self::getResponse(0, 'success', $res);
    }

    public function setName(): Json
    {
        $target = $this->request->post('target');
        $value = $this->request->post('name');

        if(is_null($target) || is_null($value)){
            return self::getResponse(-1, 'invalid params', '');
        }

        $com = Factory::createComponent($target);
        if(is_null($com)){
            return self::getResponse(-1, 'invalid params', '');
        }

        if(!$com->setComponentName('name', $value)){
            return self::getResponse(-1, 'set component error', '');
        }

        return self::getResponse('0','success', '');
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
