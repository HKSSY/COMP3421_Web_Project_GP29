<?php
session_start();
include('functions.php');
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
//Connect to database
include('php/database_connect.php');
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT nickname, password, email, dob, gender, permission FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($nickname, $password, $email, $dob, $gender, $permission);
$stmt->fetch();
$stmt->close();
$dob_to_age = $dob;
$today = date("Y-m-d");
$diff = date_diff(date_create($dob_to_age), date_create($today));
$age = $diff->format('%y');
$stmt = $con->prepare('SELECT filepath FROM profile_images WHERE userid = ? AND profile_image = 1');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows < 1) {
	$filepath = 'img/default_profile_image.png';
	$stmt->close();
}else{
	$stmt->bind_result($filepath);
	$stmt->fetch();
	$stmt->close();
}
?>

<?=template_header('Profile')?>
<div class="content">
	<h2>Profile Page</h2>
	<div>
		<p>Your account details are below:</p>
		<table>
		<tr>
			<td>User image:</td>
				<td><img src="<?=$filepath?>" width=auto height="200"></td>
			</tr>
			<tr>
			<td>User id:</td>
				<td><?=$_SESSION['id']?></td>
			</tr>
			<tr>
				<td>Nickname:</td>
				<td><?=htmlspecialchars($nickname, ENT_QUOTES, 'UTF-8')?></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><?=$password?></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><?=htmlspecialchars($email, ENT_QUOTES, 'UTF-8')?></td>
			</tr>
			<tr>
				<td>Date of born:</td>
				<td><?=htmlspecialchars($dob, ENT_QUOTES, 'UTF-8')?></td>
			</tr>
			<tr>
				<td>Age:</td>
				<td><?=htmlspecialchars($age, ENT_QUOTES, 'UTF-8')?></td>
			</tr>
			<tr>
				<td>Gender:</td>
				<td><?=htmlspecialchars($gender, ENT_QUOTES, 'UTF-8')?></td>
			</tr>
		</table>
	</div>
	<div>
		<p>User function:</p>
		<input type="submit" value="Change password" onclick="window.location.href='change_password.php';">
		<input type="submit" value="Change profile image" onclick="window.location.href='upload_profile_image.php';">
		<input type="submit" value="List order record" onclick="window.location.href='view_order_record.php?id=<?=$_SESSION['id']?>';">
		<!--
		<input type="submit" value="Read my message" onclick="window.location.href='message.php?id=<?=$_SESSION['id']?>';">
		-->
	</div>
	<?php if ($permission != 0){ ?>
		<div>
			<p>Administration function:</p>
			<input type="submit" value="Release product" onclick="window.location.href='create_product.php';">
			<input type="submit" value="View products list" onclick="window.location.href='products_list.php';">
			<input type="submit" value="View sales record" onclick="window.location.href='sales_record.php';">
		</div>
	<?php } ?>
</div>

<?=template_footer()?>