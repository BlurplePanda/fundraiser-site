<?php $current = basename($_SERVER['PHP_SELF']) // Assign current base url (filename) to a variable ?>

<!-- Logo image -->
<img src='images/rundfaise-logo.png' alt='Rundfaise logo and text: Donate - Support - Fundraise' class='center'>

<!-- Nav bar (links) -->
<nav>
    <a href='index.php' class='button'
        <?php if ($current == 'index.php') { // If currently on index/home page
            echo " id='current'"; // Make the link look different (see css)
        } ?>> Home </a>

    <a href='campaign_list.php' class='button'
        <?php if ($current == 'campaign_list.php') {
            echo " id='current'";
        } ?>> Campaigns </a>

    <!-- If the user is logged in, show links to more pages including logout button -->
    <?php if (isset($_SESSION['user'])) {

        echo "<a href='user_campaigns.php' class='button'";
        if ($current == 'user_campaigns.php' or $current == 'delete_campaign.php') {
            echo "id='current'";
        }
        echo "> My campaigns </a>";

        echo "<a href='create_campaign.php' class='button'";
        if ($current == 'create_campaign.php' or $current == 'insert_campaign.php') {
            echo " id='current'";
        }
        echo "> Start a campaign </a>";

        echo "<a href='process_logout.php' class='button'";
        if ($current == 'process_logout.php') {
            echo " id='current'";
        }
        echo "> Log out </a>";
    }

    // If not logged in, just show the login button
    else {
        echo "<a href='login.php' class='button'";
        if ($current == 'login.php') {
            echo " id='current'";
        }
        echo "> Log in </a>";
    } ?>
</nav>