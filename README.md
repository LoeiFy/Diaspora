# Diaspora
A WordPress theme

[Preview Diaspora →](http://isujin.com)

现在有移植版本

- Ghost：https://github.com/PeterCxy/ghost-diaspora
- Hexo：https://github.com/Fechin/hexo-theme-diaspora
- 微信小程序: https://github.com/LoeiFy/Softtyms 
- Ghost: https://github.com/MoeLoli/Diaspora-Ghost
- Typecho: https://github.com/MoeLoli/Diaspora-Typecho
- hugo: https://github.com/honjun/hugo-theme-diaspora

![px](https://user-images.githubusercontent.com/2193211/42122301-3b0b4ba4-7c72-11e8-80a0-f7b62ae03f9b.jpg)

## 相关说明

### 网站图标相关

网站需要 3 个 logo 图片，分别是：

- `images/logo.png` (124x52) 网站首页 logo
- `images/logo_black.png` (124x52) 网站弹出菜单时候的深色 logo
- `images/logo_min.png` (48x48) 网站文章详细页面的小 logo

另外 32－144 名字的图片为网站 favicon 以及添加到手机屏幕所需要的小图片

### 缩略图相关

网站正常显示需要每篇文章都必须设置特色图片。

- 显示壁纸 gallery 所需要的缩略图是 300x...，需要在 WordPress 后台 媒体选项 将 缩略图大小 设置为 宽度 300 高度 0。（推荐：其他都设置为 0）
- 首页显示文章缩略图大小是 680x440，有两种模式产生缩略图，一种是用原生 WordPress 提供的裁切图片功能，一种是使用 timthumb.php。

> 自动引用图片作为特色图片

issue：https://github.com/LoeiFy/Diaspora/issues/10

说明：需要在 `images` 目录添加一张默认图片 `default.jpg`

相关设置：

`config.php` 

```php
/*
当 USE_TIMTHUMB 为 FALSE 时表示不使用 timthumb，当为 TRUE 是表示使用
默认为 FALSE 不使用
*/

define ('USE_TIMTHUMB', FALSE);
```

### 文章音乐

主题支持音乐播放，两种方式添加：

- 只需要在 WordPress 后台文章编辑页面插入音乐即可，主题会调用音乐播放
- 使用短代码，在文章编辑源代码使用 `[audio loop="ture" src="http://m1.music.126.net/Q2wx7EaeuS_bnqlEJ85u0Q==/2881819977150355.mp3"]` 即可

***注意要去除 `autoplay` 属性，不然会引起多次播放 bug***

### 文章壁纸 Gallery

只需要在文章编辑后台添加图片即可，***注意不需要插入文章内容页面***，主题会调用壁纸显示

### 菜单设置

菜单连接支持不跳转预览，只需要在对应菜单加上一个 class `pview`，然后这个链接支持快速预览。注意这个只能是本地页面或者文章才可以，外链会跳转过去

## 其他说明

主题有 4 个页面模板：

- `about` 关于模版，不可评论
- `Archive` 文章归档模版，不可评论
- `feedback` 评论模版，可以评论
- `links` 友情链接模版，可以评论

## 开发说明

主题使用了 5 个 js 插件：

- jquery.justifiedGallery.js
- Chocolate.js
- jquery.qrcode.js
- jquery.parallax.js
- Vibrant.js

这些插件都合并在一个文件上：`static/plugin.js`

修改 css 只需要修改 `assets/Diaspora.css`

修改 js 只需要修改 `assets/Diaspora.js`

## 捐赠

如果你觉得这个主题不错，欢迎微信捐赠作者

![qr](https://cloud.githubusercontent.com/assets/2193211/15043958/e18cd400-1303-11e6-826f-e4495e210d11.jpg)

## License
MIT

## Related

<img src="https://cloud.githubusercontent.com/assets/2193211/15043747/08902c0c-1302-11e6-9a38-dcfa9daeec02.jpg" width="200" height="200" />

`Diaspora` by Robert de Boron
