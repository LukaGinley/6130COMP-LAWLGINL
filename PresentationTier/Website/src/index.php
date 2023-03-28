<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Runners Euro Comp</title>
	<style>
		body {
			font-family: 'Open Sans', sans-serif;
			background: url('https://wallpaperset.com/w/full/9/4/3/185419.jpg') no-repeat center center fixed;
			background-size: cover;
		}
		h1 {
			color: #fff;
			text-align: center;
			margin-top: 50px;
			font-size: 3em;
			text-shadow: 1px 1px #000;
		}
		form {
			max-width: 500px;
			margin: 0 auto;
			background-color: rgba(255, 255, 255, 0.8);
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
			margin-top: 20px;
		}
		label {
			display: block;
			font-size: 1.2em;
			font-weight: bold;
			margin-bottom: 5px;
			color: #fff;
			text-shadow: 1px 1px #000;
		}
		input[type="text"],
		input[type="email"],
		textarea {
			display: block;
			width: 100%;
			padding: 1px;
			margin-bottom: 8px;
			border-radius: 5px;
			border: none;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
			font-size: 1.2em;
		}
		input[type="submit"] {
			background-color: #28a745;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			transition: background-color 0.3s ease-in-out;
			font-size: 1.2em;
			text-transform: uppercase;
		}
		input[type="submit"]:hover {
			background-color: #218838;
		}
	</style>
</head>
<div class="col-6 p-5">
    <h1>Runners Euro Comp</h1>
</div>
<form class="col-5" method="post" action="backend.php">
    <div class="mb-3 row">
        <label for="name" class="col-form-label">Name</label>
        <div class="col-8">
            <input id="name" name="name" type="text" required="required"
                maxlength="100" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="email" class="form-label">Email</label>
        <div class="col-8">
            <input id="email" name="email" type="email" required="required"
                class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="address" class="form-label">Address</label>
        <div class="col-8">
            <input id="address" name="address" type="text"
                class="form-control" required="required">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="code" class="form-label">10 Digit Hex Code</label>
        <div class="col-8">
            <div class="input-group">
                <input id="code" name="code" type="text" pattern="^[0-9A-Fa-f]{10}$"
                   maxlength="10" class="form-control" required="required">
            </div>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="playerName" class="form-label">Best Player's Name</label>
        <div class="col-8">
            <div class="input-group">
                <input id="best_player" name="best_player" type="text" maxlength="100"
                    class="form-control" required="required">
            </div>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-8">
            <button name="submit" type="submit" class="submit">Submit</button>
        </div>
    </div>
</form>

<!-- <body>
	<h1>Runners Euro Comp</h1>
	<form action="form.php" method="POST">
		<label for="name">Name:</label>
		<input type="text" id="name" name="name" required>

		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required>

		<label for="address">Address:</label>
		<textarea id="address" name="address" required></textarea>

		<label for="code">10 digit hexadecimal code:</label>
		<input type="text" id="code" name="code" required>

		<label for="best_player">Best player in the game:</label>
		<input type="text" id="best_player" name="best_player" required>

		<input type="submit" value="Submit">
	</form>
</body>
</html> 
-->