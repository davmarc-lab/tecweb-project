<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<title>Notification</title>
</head>

<body>
	<?php
	function printTitle2($text)
	{
	?>
		<div class="container h2 col-10 justify-content-center text-center">
			<?php echo ($text); ?>
		</div>
	<?php
	}

	function printTextInRectangle($text)
	{
	?>
		<div class="container col-10 border border-3 rounded-3 border-dark">
			<?php echo ($text); ?>
		</div>
	<?php
	}
	require_once("../includes/database.php");
	if (!isset($_SESSION["userId"])) {
		// login not done
		header("location:../login/login.php");
	}

	// logged user id
	// $userId = $_SESSION["userId"];
	$userId = 2;        // to remove when login page works
	?>

	<div class="row m-auto mb-4">
		<?php
		include_once("../includes/navbar.php");
		drawNavbar("Notification");
		?>
	</div>
	<main>
		<div class="row">
			<div class="container-fluid">
				<?php
				$query = "SELECT n.Description, n.IsRead
                        FROM notification as n
                        WHERE n.IdUser = $userId";
				$notif = $dbh->execQuery($query, MYSQLI_ASSOC);

				// no notifications available
				if (empty($notif)) {
					printTitle2("You have 0 notification.");
				} else {
					printTitle2("You have " . sizeof($notif) . " notification" . (sizeof($notif) > 1 ? "s." : "."));

					// all notification
					foreach ($notif as $x) :
						printTextInRectangle($x["Description"]);
					endforeach;
				}

				?>
			</div>
		</div>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>