<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
?>
<nav class="navbar navbar-expand-sm fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand animate__animated animate__slideInDown" href="../index.php">
            <img src="../img/Spartan_Marketplace_Icon.svg" alt="GTS Tours Logo" style="width:11em;"> 
        </a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link 
                    <?php
                        if($page == 'Home' || $page == "Secure") 
                        { 
                            echo 'active';
                        }
                    ?>"
                href=<?php 
                        if(isset($_SESSION["isSecure"]))
                        {
                            if($_SESSION["isSecure"])
                            {
                                echo 'publicsecuresection.php';
                            }
                            else
                            {
                                echo '../index.php';
                            }
                        }
                        else if(isset($_SESSION["isAdmin"]))
                        {
                            if($_SESSION["isAdmin"])
                            {
                                echo 'securesection.php';
                            }
                        }
                        else
                        {
                            echo '../index.php';
                        }
                    ?>
                >HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($page == 'About') { echo 'active';}?>" 
                href=<?php if($page != 'Home') { echo 'about.php';} else { echo 'includes/about.php';}?>
                >ABOUT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($page == 'Products') { echo 'active';}?>" 
                href=<?php if($page != 'Home') { echo 'products.php';} else { echo 'includes/products.php';}?>>PRODUCTS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($page == 'News') { echo 'active';}?>" 
                href=<?php if($page != 'Home') { echo 'news.php';} else { echo 'includes/news.php';}?>>NEWS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($page == 'Contact') { echo 'active';}?>" 
                href=<?php if($page != 'Home') { echo 'contacts.php';} else { echo 'includes/contacts.php';}?>>CONTACTS</a>
            </li>
            <?php
                if(isset($_SESSION["isAdmin"]))
                {
                    if($_SESSION["isAdmin"])
                    {
                        echo "
                        <li class='nav-item'>
                            <a class='nav-link ";
                            if($page == 'Users') { echo 'active';}
                        echo "'href="; 
                        if($page != 'Home') { echo 'users.php';} else { echo 'includes/users.php';} 
                        echo ">USERS</a>
                        </li>";
                    }
                }
            ?>
            <?php
                if(isset($_SESSION["isSecure"]))
                {
                    if($_SESSION["isSecure"])
                    {
                        echo "<li class='nav-item'>
                            <a class='nav-link' 
                            href='logout.php'>LOGOUT</a>
                        </li>";
                    }
                }
                else if(isset($_SESSION["isAdmin"]))
                {
                    if($_SESSION["isAdmin"])
                    {
                        echo "<li class='nav-item'>
                            <a class='nav-link' 
                            href='logout.php'>LOGOUT</a>
                        </li>";
                    }
                }
            ?>
        </ul>
    </div>
</nav>