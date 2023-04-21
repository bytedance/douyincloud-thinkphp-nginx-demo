# douyincloud-thinkphp-nginx-demo
本项目是抖音云平台基于php语言thinkphp框架的开发模版，模版通过使用Redis和MongoDB实现了简单的hello-world功能。\
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
│ ├── model                 模型目录
│ │ ├── Factory.php         工厂文件
│ │ ├── HelloComponent.php  HelloComponent接口文件
│ │ ├── MongoComponent.php  Mongo组件
│ │ └── RedisComponent.php  Redis组件
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
前往抖音云托管平台「调试」功能界面，进行请求调试。

## API说明
### `GET /api/hello`
对组件打招呼

### 请求参数
- `target`：`string` 组件名：redis，mongodb

### 响应结果
```json
{
    "err_no": 0,
    "err_msg": "success",
    "data": "hello,redis"
}
```

### `POST /api/set_name`
给组件设置名称

### 请求参数
- `target`:`string` 组件名：redis，mongodb
- `name`:`string` 名称

### 响应结果
```json
{
    "err_no": 0,
    "err_msg": "success",
    "data": ""
}
```

### 组件使用注意事项
在抖音云托管平台上启用组件后，抖音云平台会自动将组件的地址，账号，密码以环境变量的方式注入到容器中。\
以Redis为例，在抖音云托管平台启用Redis组件后，平台会生成 `REDIS_ADDRESS`，`REDIS_USERNAME`，`REDIS_PASSWORD`三个环境变量，在业务代码中可以使用如下代码获取相应值。
```
	$redisAddr = getenv("REDIS_ADDRESS");
	$redisUserName = getenv("REDIS_USERNAME");
	$redisPassword = getenv("REDIS_PASSWORD");
```

## License

This project is licensed under the [Apache-2.0 License](LICENSE).
