<?php
include('navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h4 {
            text-align: center;
            color: #333;
            font-family: Arial;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        label {
            margin-top: 10px;
        }

        input, select, textarea, button {
            margin-top: 5px;
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .status {
        padding: 20px;
        text-align: center;
        margin-top: 10px;
        border-radius: 5px;
        font-weight: bold;
        }

        .success {
            padding: 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            margin-bottom: 10px;
        }

        .error {
            padding: 20px;
            background-color: #f44336;
            color: white;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
    <?php
        if(isset($_SESSION['statusD'])){
            $statusMessage = $_SESSION['statusD'];
            $statusClass = ($_SESSION['status_type'] == 'success') ? 'success' : 'error';
            unset($_SESSION['statusD']);
            unset($_SESSION['status_type']);
            echo "<div class='$statusClass'>$statusMessage</div>";
        }
    ?>
    <div class="user_dashboard">
    <h1>Username: <?= $_SESSION['auth_user']['username']?></h1>
    <h1>Email: <?= $_SESSION['auth_user']['email']?></h1>
    </div>
    <form action="add_card.php" method="POST">
        <label for="">City:</label>
        <input type="number" min="1" max="7" name="city_id">
        <label for="">Card Type:</label>
        <select name="type" id="type">
            <option value="visit" name="placesToVisit">Places to Visit</option>
            <option value="sleep" name="placesToSleep">Places to Sleep</option>
            <option value="eat" name="placesToEat">Places to Eat</option>
        </select>
        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="description">Description:</label>
        <textarea name="description"></textarea>

        <label for="image">Insert an Image:</label>
        <input type="file" name="image" required>

        <br><button type="submit" name="submit_btn">Add Card</button>
    </form>
    </div>
</body>
</html>

