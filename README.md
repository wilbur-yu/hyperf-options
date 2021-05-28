> 该组件移植于 [appstract/laravel-options](https://github.com/appstract/laravel-options), 
感谢 [作者](https://github.com/appstract) 的开源作品

# 安装

```
composer require wilbur-yu/hyperf-options
php ./bin/hyperf.php vendor:publish wilbur-yu/hyperf-options
php ./bin/hyperf.php migarte
```
# 说明
```php
<?php
use WilburYu\HyperfOptions\OptionService;
// 使用全局函数
options()->set('key', 'value', 'desc'); // 创建或更新
options()->get('key');
options()->exists('key');
options()->remove('key');

// 使用服务类
$options = make(OptionService::class);
$options->set('key', 'value', 'desc');
$options->get('key');
$options->exists('key');
$options->remove('key');
```
得益于 `hyperf` 完善的组件生态, 监听 `Option` 模型的 `Deleted 和 Saved` 事件, 搭配 `Cache 注解`,
可以很容易的完成 `option 键值对` 的缓存生命周期的维护.