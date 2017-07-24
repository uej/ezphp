<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <ul>
            <?php foreach ($data as $val) { ?>
            <li>ID:<?=$val['ID']?> Value:<?=$val['Value']?> Num:<?=$val['Num']?></li>
            <?php } ?>
        </ul>
        <?=$html?>
    </body>
</html>
