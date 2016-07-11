# Diaspora
A WordPress theme

[Preview Diaspora →](http://isujin.com)

> ghost 版，感谢 @PeterCxy

https://github.com/PeterCxy/ghost-diaspora

### 更新说明

> 1.2.4

添加关闭多说评论功能。PS：自带评论并无样式，需要自己添加

> 1.2.3

方便用户自行修改主题，移除 basket.js 以及相关开发部署插件

> 1.2.2

修复音乐多重播放问题：在文章插入音频时候，需要去掉 `autoplay` 属性，不然会导致音乐多次播放问题。

> 1.2.0

自动引用图片作为特色图片

issue：https://github.com/LoeiFy/Diaspora/issues/10

说明：需要在 `images` 目录添加一张默认图片 `default.jpg`

### 相关说明

> 评论设置

主题使用 多说 评论，需要设置多说用户名

`header.php` 第 44 行：

```html
<script>var duoshuoQuery={short_name:'test123456'}</script>
```

替换成：

```html
<script>var duoshuoQuery = {short_name: '你的多说用户名'};</script>
```

> 网站图标相关

网站需要 3 个 logo 图片，分别是：

- `images/logo.png` (124x52) 网站首页 logo
- `images/logo_black.png` (124x52) 网站弹出菜单时候的深色 logo
- `images/logo_min.png` (48x48) 网站文章详细页面的小 logo

另外 32－144 名字的图片为网站 favicon 以及添加到手机屏幕所需要的小图片

> 缩略图相关

网站正常显示需要每篇文章都必须设置特色图片。

文章页面的显示壁纸 gallery 所需要的缩略图是 300x...，需要在 WordPress 后台 媒体选项 将 缩略图大小 设置为 宽度 300 高度 0。（推荐：其他都设置为 0）

首页显示文章缩略图大小是 680x440，有两种模式产生缩略图，一种是用原生 WordPress 提供的裁切图片功能，一种是使用 timthumb.php。

相关设置：

`config.php` 

```php
/*
当 USE_TIMTHUMB 为 FALSE 时表示不使用 timthumb，当为 TRUE 是表示使用
默认为 FALSE 不使用
*/

define ('USE_TIMTHUMB', FALSE);
```

> 文章音乐

主题支持音乐播放，两种方式添加：

- 只需要在 WordPress 后台文章编辑页面插入音乐即可，主题会调用音乐播放
- 使用短代码，在文章编辑源代码使用 `[audio loop="ture" src="http://m1.music.126.net/Q2wx7EaeuS_bnqlEJ85u0Q==/2881819977150355.mp3"]` 即可

***注意要去除 `autoplay` 属性，不然会引起多次播放 bug***

> 文章壁纸 Gallery

只需要在文章编辑后台添加图片即可，***注意不需要插入文章内容页面***，主题会调用壁纸显示

### 其他说明

> 关于主题评论说明：

`config.php`

```php
/*
当 DEFAULT_COMMENT 为 FALSE 时表示不使用默认评论，当为 TRUE 是表示使用
默认为 FALSE 不使用
*/

define ('DEFAULT_COMMENT', FALSE);
```

注：默认评论需要自行添加样式

> 主题有 4 个页面模板：

- `about` 关于模版，不可评论
- `Archive` 文章归档模版，不可评论
- `feedback` 评论模版，可以评论
- `links` 友情链接模版，可以评论

### 开发说明

> 主题使用了 5 个 js 插件：

- jquery.justifiedGallery.js
- Chocolate.js
- jquery.qrcode.js
- jquery.parallax.js
- Vibrant.js

这些插件都合并在一个文件上：`static/plugin.js`

修改 css 只需要修改 `assets/Diaspora.css`

修改 js 只需要修改 `assets/Diaspora.js`

> 插件问题

主题默认去掉 `<?php wp_head() ?>` 以及 `<?php wp_footer() ?>` 。这时候会导致一些插件使用不了，你可以按你自己需求加回去

之所以去掉原因是这两个函数会带一堆无关资源加载

### 捐赠

如果你觉得这个主题不错，欢迎微信捐赠作者

![qr](https://cloud.githubusercontent.com/assets/2193211/15043958/e18cd400-1303-11e6-826f-e4495e210d11.jpg)

### License
MIT

### Related

<img src="https://cloud.githubusercontent.com/assets/2193211/15043747/08902c0c-1302-11e6-9a38-dcfa9daeec02.jpg" width="200" height="200" />

`Diaspora` by Robert de Boron
