<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="../includes/style.css">
	<title>Notification</title>
</head>

<body>
	<?php
	session_start();
	include_once("../includes/utils.php");
	include_once("../includes/database.php");
	updateLastSeen($dbh, $_SESSION["userId"]);
	unsetSearchKey();
	function printTitle2($text)
	{
	?>
		<div class="container h2 col-10 justify-content-center text-center">
			<?php echo ($text); ?>
		</div>
	<?php
	}

	function chooseIconClass($type)
	{
		switch ($type) {
			case NotificationType::LIKE->value:
				return "bi bi-heart";
			case NotificationType::FOLLOWER->value:
				return "bi bi-hand-thumbs-up";
			case NotificationType::COMMENT->value:
				return "bi bi-person";
			default:
				return "bi bi-bell";
		}
	}

	function printTextInRectangle($val)
	{
		global $dbh;
		$text = $val["Description"];
		$iconClass = chooseIconClass($val["Type"]);
		$isRead = $val["IsRead"];
		if ($val["Type"] == NotificationType::COMMENT->value) {
			$query = "SELECT IdPost from usercomment WHERE IdComment = '{$val['IdTarget']}';";
		} else if ($val["Type"] == NotificationType::LIKE->value) {
			$query = "SELECT IdPost from vote WHERE IdVote = '{$val['IdTarget']}';";
		} else {
			$query = "SELECT IdSrc from follow WHERE Id = '{$val['IdTarget']}';";
		}
		$result = $dbh->execQuery($query);
		if ($val["Type"] == NotificationType::COMMENT->value || $val["Type"] == NotificationType::LIKE->value) {
			$path = "../post/viewPost.php?id=" . $result[0]['IdPost'];
		} else {
			$path = "../profile/profilePage.php?user=" . $result[0]['IdSrc'];
		}
	?>
		<div class="row-2">
			<a href="<?php echo $path ?>">
				<div class="container col-10 m-auto my-3 border border-3 rounded-3 border-<?php echo ($isRead ? "secondary" : "danger"); ?> p-auto ps-1">
					<span>
						<i class="<?php echo ($iconClass); ?>" style="font-size: 1rem;"></i>
					</span>
					<?php echo ($text); ?>
				</div>
			</a>
		</div>
	<?php
	}
	if (!isset($_SESSION["userId"])) {
		// login not done
		header("location:../login/login.php");
	}

	// logged user id
	$userId = $_SESSION["userId"];
	include_once("../includes/navbar.php");
	$bar = new Navbar("../");
	$bar->drawNavbar("Notification");
	?>
	<main>
		<div class="container-fluid overflow-x-hidden">
			<div class="row my-4">
				<div class="text-center">
					<h1>
						<span>
							<i class="bi bi-alarm pe-2"></i>
							Your last notifications
						</span>
					</h1>
				</div>
			</div>
			<div class="row mb-4">
				<?php
				$query = "SELECT *
                        FROM notification as n
                        WHERE n.IdUser = $userId AND n.IsRead = 0
						ORDER BY IdNotification DESC";
				$notif = $dbh->execQuery($query, MYSQLI_ASSOC);

				// no notifications available
				if (empty($notif)) {
					printTitle2("You have 0 new notification.");
				} else {
					printTitle2("You have " . sizeof($notif) . " new notification" . (sizeof($notif) > 1 ? "s." : "."));
				}

				$query = "SELECT *
                        FROM notification as n
                        WHERE n.IdUser = $userId
						ORDER BY IdNotification DESC";
				$notif = $dbh->execQuery($query, MYSQLI_ASSOC);
				// all notification
				foreach ($notif as $x) :
					printTextInRectangle($x);
				endforeach;

				// update IsRead col
				$query = "UPDATE notification
						SET IsRead = 1
						WHERE IdUser = $userId;";
				$dbh->execQuery($query);

				?>
			</div>
		</div>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>