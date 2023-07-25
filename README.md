# douyincloud-thinkphp-nginx-demo
本项目是抖音云平台基于php语言thinkphp框架的开发模版，模版实现了简单的云调用与获取openID的功能。\
抖音云平台支持基于Git代码和Docker镜像部署两种方式。其中，Dockerfile文件可以参考本项目中的Dockerfile文件。\
部署在抖音云平台的服务日志需要重定向到标准输出，并在抖音云平台日志功能中查看。
## 目录结构
~~~
.
├── Dockerfile              Dockerfile文件
├── LICENSE.txt
├── README.md               Readme文件
├── app                     应用服务目录
│ ├── AppService.php          
│ ├── BaseController.php
│ ├── ExceptionHandle.php
│ ├── Request.php
│ ├── common.php
│ ├── controller            控制器目录
│ │ └── Index.php           index控制器
│ ├── event.php
│ ├── middleware.php
│ ├── provider.php
│ └── service.php
├── composer.json           composer依赖管理
├── composer.lock           composer依赖管理
├── conf                    配置文件目录
│ └── nginx.conf            nginx配置
├── config                  thinkphp框架配置目录
│ ├── app.php
│ ├── cache.php             缓存配置目录
│ ├── console.php
│ ├── cookie.php
│ ├── database.php          数据库配置目录
│ ├── filesystem.php
│ ├── lang.php
│ ├── log.php
│ ├── middleware.php
│ ├── route.php
│ ├── session.php
│ ├── trace.php
│ └── view.php
├── extend
├── public                  
│ ├── favicon.ico           图标
│ ├── index.php             thinkphp框架入口文件
│ ├── robots.txt
│ ├── router.php            快速测试
│ └── static                静态资源
├── route                   thinkphp框架路由目录
│ └── app.php               路由配置文件
├── run.sh                  容器启动时运行脚本
├── runtime                 运行时目录
│ └── log                   日志目录
├── think
├── vendor                  第三方类库目录

~~~

## 请求方法
前往抖音云托管平台「接口调试」功能界面，进行请求调试。

## API说明
### `GET /api/get_open_id`
获取openid，当未绑定用户时会返回获取openid失败的错误


### 响应结果
```json
{
    "err_no": 0,
    "err_msg": "success",
    "data": "xxx"
}
```

### `POST /api/text/antidirt`
云调用示例，调用抖音开放平台的OpenApi进行脏词检测

### 请求参数
- `content`:`string` 待检测的内容

### 响应结果
```json
{
  "err_no": 0,
  "err_msg": "success",
  "data": ""
}
```

## License

This project is licensed under the [Apache-2.0 License](LICENSE).
