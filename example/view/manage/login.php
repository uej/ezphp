<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>登录</title>
    </head>
    <body>
        <form action="<?=\ez\core\Route::createUrl('manage/login')?>" method="post">
            <?=\ez\core\Form::input_text(['name' => 'Name'], ['placeholder' => '用户名'], FALSE)?><br>
            <?=\ez\core\Form::input_password(['name' => 'Password'], ['placeholder' => '密码'], FALSE)?><br>
            <?=\ez\core\Form::input_submit(['value' => '登录'])?>
        </form>
    </body>
</html>
