<?php
// PHP Code to handle the form input and calculate results
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $numbersString = trim($_POST['numbers']);
    
    // Convert the string into an array of numbers
    $numbersArray = array_filter(explode(' ', $numbersString), function($value) {
        return is_numeric($value);
    });
    
    // Get the selected operation
    $operation = $_POST['operation'];
    
    // Initialize the result variable
    $result = '';

    // Perform the selected operation using a switch statement
    switch ($operation) {
        case 1: // Check Even/Odd
            $result = array_map(function($number) {
                return $number . ' is ' . ($number % 2 == 0 ? 'Even' : 'Odd');
            }, $numbersArray);
            $result = implode(', ', $result);
            break;
        case 2: // Calculate Age
            $currentYear = date("Y");
            $result = array_map(function($year) use ($currentYear) {
                return 'Born in ' . $year . ' is ' . ($currentYear - $year) . ' years old';
            }, $numbersArray);
            $result = implode(', ', $result);
            break;
        case 3: // Check Palindrome
            $result = array_map(function($number) {
                $reversed = strrev($number);
                return $number . ' is ' . ($number == $reversed ? 'a Palindrome' : 'not a Palindrome');
            }, $numbersArray);
            $result = implode(', ', $result);
            break;
        case 4: // Sort Ascending
            sort($numbersArray, SORT_NUMERIC);
            $result = 'Ascending order: ' . implode(', ', $numbersArray);
            break;
        case 5: // Sort Descending
            rsort($numbersArray, SORT_NUMERIC);
            $result = 'Descending order: ' . implode(', ', $numbersArray);
            break;
        default:
            $result = "Invalid operation selected.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Assignment 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: black;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="radio"] {
            margin: 0 10px;
            margin-top: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
            margin-top: 20px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .result {
            margin-top: 20px;
            font-size: 1.2em;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Number Operations</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="numbers" placeholder="Enter numbers separated by spaces or add your birth year" value="<?php echo isset($_POST['numbers']) ? htmlspecialchars($_POST['numbers']) : ''; ?>" required>
            <div>
                <label>
                    <input type="radio" name="operation" value="1" <?php echo (isset($_POST['operation']) && $_POST['operation'] == 1) ? 'checked' : ''; ?>> Even/Odd
                </label>
                <label>
                    <input type="radio" name="operation" value="2" <?php echo (isset($_POST['operation']) && $_POST['operation'] == 2) ? 'checked' : ''; ?>> Calculate Age
                </label>
                <label>
                    <input type="radio" name="operation" value="3" <?php echo (isset($_POST['operation']) && $_POST['operation'] == 3) ? 'checked' : ''; ?>> Palindrome
                </label>
                <label>
                    <input type="radio" name="operation" value="4" <?php echo (isset($_POST['operation']) && $_POST['operation'] == 4) ? 'checked' : ''; ?>> Ascending
                </label>
                <label>
                    <input type="radio" name="operation" value="5" <?php echo (isset($_POST['operation']) && $_POST['operation'] == 5) ? 'checked' : ''; ?>> Descending
                </label>
            </div>
            <input type="submit" value="Calculate">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<div class='result'>Result: " . htmlspecialchars($result) . "</div>";
        }
        ?>
    </div>
</body>
</html>
