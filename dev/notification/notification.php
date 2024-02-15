<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
	<link rel="stylesheet" href="../includes/style.css" />
    <link rel="icon" href="../nfa-icon.png" type="image/x-icon" />
	<title>NFA - Notification</title>
</head>

<body>
	<?php
	session_start();
	if (!isset($_SESSION["userId"])) {
        header("location:../login/login.php");
    }
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
				return "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-hand-thumbs-up' viewBox='0 0 16 16'>" .
							"<path d='M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z'/>" .
					"</svg>";
			case NotificationType::FOLLOWER->value:
				return "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person' viewBox='0 0 16 16'>" .
							"<path d='M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z'/>" .
					"</svg>";
			case NotificationType::COMMENT->value:
				return "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chat-left-text' viewBox='0 0 16 16'>" .
							"<path d='M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z'/>" .
							"<path d='M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5'/>" .
					"</svg>";
			default:
				return "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-bell' viewBox='0 0 16 16'>" .
							"<path d='M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6'/>" .
					"</svg>";
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
			<div class="container col-10 m-auto my-3 border border-3 rounded-3 border-<?php echo ($isRead ? "secondary" : "danger"); ?> p-auto ps-1">
				<a href="<?php echo $path ?>">
					<span>
						<?php echo ($iconClass); ?>
					</span>
					<?php echo ($text); ?>
				</a>
			</div>
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
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
							<path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9z"/>
							<path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1zm1.038 3.018a6 6 0 0 1 .924 0 6 6 0 1 1-.924 0M0 3.5c0 .753.333 1.429.86 1.887A8.04 8.04 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5M13.5 1c-.753 0-1.429.333-1.887.86a8.04 8.04 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1"/>
						</svg>
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