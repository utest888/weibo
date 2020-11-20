<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>重置密码链接</title>
</head>

<body>
    <h1>您正在 Weibo App 网站进行重置密码！</h1>
    <p>
        请点击下面的链接完成注册：
        <a href="{{ route('password.reset', $token) }}">
            {{ route('password.reset', $token)}}
        </a>
    </p>
    <p>
        如果这不是您本人的操作，请忽略此邮件。
    </p>
</body>

</html>