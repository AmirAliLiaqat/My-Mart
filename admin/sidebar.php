<ul class="menu-list">
    <li <?php if(basename($_SERVER['PHP_SELF']) == "dashboard.php") echo 'class="active"'; ?>><a href="dashboard.php">Dashboard</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "products.php") echo 'class="active"'; ?>><a href="products.php">Products</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "orders.php") echo 'class="active"'; ?>><a href="orders.php">Orders</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "users.php") echo 'class="active"'; ?>><a href="users.php">Users</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "messages.php") echo 'class="active"'; ?>><a href="messages.php">Messages</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == "options.php") echo 'class="active"'; ?>><a href="options.php">Options</a></li>
</ul>