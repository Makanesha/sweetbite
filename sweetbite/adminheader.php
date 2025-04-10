<div class="navbar">
        <div>
            <a href="admin_dashboard.php">Users</a>
             <!-- Dropdown for Courses -->
        <div style="display: inline-block; position: relative;">
            <a href="#" onclick="toggleDropdown()" style="cursor:pointer;">Courses ▼</a>
            <div id="courseDropdown" style="display:none; position:absolute; background:#333; padding:5px; border-radius:4px;">
                    <a href="course_cake.php" style="display:block; color:white; text-decoration:none; padding:5px;">Cake</a>
                    <a href="course_cookie.php" style="display:block; color:white; text-decoration:none; padding:5px;">Cookie</a>
                    <a href="course_pastry.php" style="display:block; color:white; text-decoration:none; padding:5px;">Pastry</a>
                    <a href="course_combo.php" style="display:block; color:white; text-decoration:none; padding:5px;">Combination</a>
            </div>
        </div>
            <a href="admin_announcement.php">Announcements</a>
            <a href="item_management.php">Events</a>
        </div>
        <a href="register.php">Logout</a>
    </div>
