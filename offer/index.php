<?php


$handler = opendir(__DIR__);
while (($filename = readdir($handler)) !== false) {
    if ($filename != "." && $filename != "..") {
        $files[] = $filename;
    }
}
closedir($handler);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <?php foreach ($files as $file) { ?>
        <a href="/<?php echo $file ?>"><?php echo $file ?></a><br />
        <?php } ?>  
</body>

</html>
