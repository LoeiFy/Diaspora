# Diaspora
http://guo.lu

## 主题声明
- 可以 使用供个人网站使用（可以商业网站）
- 不可以 任何方式散布主题源码

### 设置网站关键字
`header.php` 第 4 行：$keywords = "这里填写关键字，逗号分割"

### 网站 logo 设置
替换 `static/` 目录下的 32 － 144 图片

### duoshuo 留言设置
主题使用的是 多说 评论，账号设置在 `header.php`  文件 99 行

`<script>var duoshuoQuery = {short_name:'这里填写你的多说账号'}</script>`

### 缩略图设置
在 wordpress 后台 媒体选项 将 缩略图大小 设置为 宽度 300 高度 0。（可选：其他都设置为 0）

### 可选设置
guo.lu 首页文章特色图片是通过 timthumb 产生的 680x440 图片，你可以选择使用：将 `post_timthumb.php` 改名为 `post.php` 替换原来文件即可

### 其他
有 4 个页面模板：

- `about` 模版：不可评论
- `Archive` 模版：文章归档
- `feedback` 模版：可以评论
- `links` 模版：友情链接