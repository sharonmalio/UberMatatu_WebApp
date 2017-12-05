<!DOCTYPE html>
<html>
<?php
    require('head.php');
?>
<body>
<?php
    require('navigation.php');
?>
<div class="ui fluid bottom attached basic segment" style="min-height: 100%;background: lightgrey;">
    <?php
        require($content);
    ?>
</div>
<?php
require('footer.php')
?>
</body>
</html>