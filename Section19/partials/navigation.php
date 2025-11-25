<nav>

<ul>

<li>
<a class="<?php echo setactiveclass("lesson19.php");

?>" href="lesson19.php">Home</a>
</li>

<?php if(is_user_logged_in()): ?>

<br>

<li>
<a class="<?php echo setactiveclass("admin.php");

?>"  
href="admin.php">Admin</a>
</li>

<br>

<li>
<a href="logout.php">Logout</a>
</li>

<?php else: ?>

<br>

<li>
<a class="<?php echo setactiveclass("login.php");

?>" 
href="login.php">Login</a>
</li>

<br>

<li>
<a class="<?php echo setactiveclass("register.php");

?>" 
href="register.php">Register</a>
</li>

<?php endif; ?>

</ul>

</nav>