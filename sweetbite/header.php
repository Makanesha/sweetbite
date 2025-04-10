<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<header class="l-header" id="header">
    <nav class="nav bd-container">
        <a href="index.php" class="nav__logo">SWEET BITE</a>
        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item"><a href="index.php" class="nav__link <?php if($current_page == 'index.php') echo 'active-link'; ?>">Home</a></li>
                <li class="nav__item"><a href="index.php#about" class="nav__link <?php if($current_page == 'index.php' && isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '#about') !== false) echo 'active-link'; ?>">About</a></li>
                <li class="nav__item"><a href="course.php" class="nav__link <?php if($current_page == 'course.php') echo 'active-link'; ?>">Courses</a></li>
                <li class="nav__item"><a href="announcement.php" class="nav__link <?php if($current_page == 'announcement.php') echo 'active-link'; ?>">Announcements</a></li>
                <li class="nav__item"><a href="events.php" class="nav__link <?php if($current_page == 'events.php') echo 'active-link'; ?>">Events</a></li>
                <li class="nav__item"><a href="register.php" class="nav__link logout__button <?php if($current_page == 'register.php') echo 'active-link'; ?>">Logout</a></li>
            </ul>
        </div>
    </nav>
</header>
