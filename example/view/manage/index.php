<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>后台</title>
    </head>
    <body>
        <table>
            <th>
                <td>表名</td>
                <td>注释</td>
            </th>
            <?php foreach($tables as $k => $v) { ?>
            <tr>
                <td><?=$v['TableName']?></td>
                <td><?=$v['Notes']?></td>
            </tr>
            <?php } ?>
        </table>
        <a href="<?=\ez\core\Route::createUrl('manage/addtable')?>">添加</a>
    </body>
</html>
