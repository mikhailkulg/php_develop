<html>
    <head>
        <title>
            Images!
        </title>
    </head>
    <body>
        <?php
            //phpinfo();
            require 'DirectoryItems.php';
            //$di =& new DirectoryItems("images");
            $di = new DirectoryItems("images");
            $di->checkAllImage() or die("text3");
            echo '<div style="text-align: center;">';
            $size = 450;
            foreach ($di->getFileArray() as $key => $value){
                $path = "images/" . $key;
                echo "<img src=\"getthumb.php?path=$path&amp;size=$size\" /><br />\n";
            }
            echo '</div><br />';
        ?>
    </body>
</html>
