<div class="ui top attached inverted large menu" style="background: saddlebrown;color: black;">
    <div class="item">
        <div class="ui white header">
            <i class="bus icon" style="color:white;"></i>
            <div class="content"><a href="index.php" style="color: white;">Transcomfy</a></div>
        </div>
    </div>
    <div class="right menu">
        <?php
            if(isset($_SESSION['user_name'])){
                echo "<div class=\"item\">".$_SESSION['user_name']."</div>";
                echo "<div class=\"link item\"><a href='logout.php'>Log Out</a></div>";
            }
        ?>
    </div>
</div>