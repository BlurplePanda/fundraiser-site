<?php $current = basename($_SERVER['PHP_SELF'])?>
<img src='images/rundfaise-logo.png' alt='Rundfaise logo and text: Donate - Support - Fundraise' class='center'>
<nav>
    <a href='index.php' class='button'
        <?php if($current == 'index.php'){
        echo " id='current'";}?>> Home </a>
    <a href='campaign_list.php' class='button'
        <?php if($current == 'campaign_list.php'){
            echo " id='current'";}?>> Campaigns </a>
    <?php if(isset($_SESSION['user'])){
        echo "<a href='process_logout.php' class='button'";
        if($current == 'process_logout.php'){ echo " id='current'"; }
        echo "> Log out </a>";
    } else {
        echo "<a href='login.php' class='button'";
        if($current == 'login.php'){ echo " id='current'"; }
        echo "> Log in </a>";
    }?>
</nav>