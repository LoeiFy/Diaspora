# Diaspora
A WordPress theme

[Preview Diaspora →](http://isujin.com)

### 更新说明

> 1.2.0

自动引用图片作为特色图片

issue：https://github.com/LoeiFy/Diaspora/issues/10

说明：需要在 `images` 目录添加一张默认图片 `default.jpg`

> 1.2.2

修复音乐多重播放问题：在文章插入音频时候，需要去掉 `autoplay` 属性，不然会导致音乐多次播放问题。

### 相关说明

> 评论设置

主题使用 多说 评论，需要设置多说用户名

`header.php` 第 45 行：

```html
<script>var duoshuoQuery = {short_name:location.host.replace('.', '')};</script>
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
当 USE_TIMTHUMB 为 FALSE 时表示不是用 timthumb，当为 TRUE 是表示使用
默认为 FALSE 不使用
*/

define ('USE_TIMTHUMB', FALSE);
```

> 文章音乐

主题支持音乐播放，两种方式添加：

- 只需要在 WordPress 后台文章编辑页面插入音乐即可，主题会调用音乐播放
- 使用短代码，在文章编辑源代码使用 `[audio autoplay="auto" loop="ture" src="http://m1.music.126.net/Q2wx7EaeuS_bnqlEJ85u0Q==/2881819977150355.mp3"]` 即可

> 文章壁纸 Gallery

只需要在文章编辑后台添加图片即可，***注意不需要插入文章内容页面***，主题会调用壁纸显示

### 其他说明

> 关于主题评论说明：

https://github.com/LoeiFy/Diaspora/issues/19#issuecomment-223790862

> 主题有 4 个页面模板：

- `about` 关于模版，不可评论
- `Archive` 文章归档模版，不可评论
- `feedback` 评论模版，可以评论
- `links` 友情链接模版，可以评论

### 开发说明

主题使用了 `basket.js` 缓存静态资源，开发时候有点麻烦。

以下操作都在主题主目录下执行

> 安装 node.js

这个很多教程，这里不详细说了

> 安装相关 node 插件

```bash
# 安装 Grunt
sudo npm install -g grunt-cli

# 安装插件
npm i
```

> 开发

```bash
grunt dev
```

涉及修改主题的文件都在 `assets` 目录下：

- Diaspora.css 主题主要 css
- Diaspora.js 主题主要 js

> 生成正式代码：

代码修改完成，需要更新版本号才能使客户端更新

修改 `assets` 里的 `basket.html` 更新版本号，即 script 标签里面所涉及修改的版本号 unique 值

不需要把全部 unique 值增加，只需要把对应修改了的才增加

```html
<script>
	basket.require({ url: '<?php echo get_template_directory_uri(); ?>/dist/Diaspora.css', unique: 12,  execute: false })
	.then(function(responses) {
        _stylesheet.appendStyleSheet(responses[0], function() {});
		basket.require({ url: '<?php echo get_template_directory_uri(); ?>/static/jquery.min.js', unique: 10 })
		.then(function() {
			basket.require({ url: '<?php echo get_template_directory_uri(); ?>/dist/plugin.js', unique: 10 })
			.then(function() {
        		basket.require({ url: '<?php echo get_template_directory_uri(); ?>/dist/Diaspora.js', unique: 16 })
                .then(function() {
                    if (!window.$ || !window.DP) {
                        localStorage.clear()
                    }
                })
			})
		})
	});
</script>
```

例如修改了主题主要样式 `Diaspora.css`，需要修改的地方是

```js
// 修改 " unique: 12 " 为 " unique: 13 " 
basket.require({ url: '<?php echo get_template_directory_uri(); ?>/dist/Diaspora.css', unique: 12,  execute: false })
```

版本号修改完成后，运行

```bash
grunt
```

这时候 `dist` 目录会生成压缩后的静态文件。

> 线上更新静态文件

替换 `dist` 目录相关文件，同时需要替换 `header.php` 来使客户端更新静态文件版本

### 捐赠

如果你觉得这个主题不错，欢迎微信捐赠作者

![qr](https://cloud.githubusercontent.com/assets/2193211/15043958/e18cd400-1303-11e6-826f-e4495e210d11.jpg)

### License
MIT

### Related

<img src="https://cloud.githubusercontent.com/assets/2193211/15043747/08902c0c-1302-11e6-9a38-dcfa9daeec02.jpg" width="200" height="200" />

`Diaspora` by Robert de Boron
