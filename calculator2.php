<?php
    session_start();


    //retain the current expression
    if (!isset($_SESSION['expression'])) {
        $_SESSION['expression'] = '';
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $btn = $_POST['btn'];

        if ($btn === 'AC') {
            $_SESSION['expression'] = '';
        } elseif ($btn === '=') {
            $expr = str_replace('X', '*', $_SESSION['expression']);
            $expr = preg_replace('/[^0-9\+\-\*\/\.\%\(\)]/', '', $expr); 
        
            try {
                if ($expr === '' || preg_match('/[\+\-\*\/]$/', $expr)) {
                    $_SESSION['expression'] = 'Error';
                } else {
                    $result = eval("return $expr;");
                    $_SESSION['expression'] = $result;
                }
            } catch (Throwable $e) {
                $_SESSION['expression'] = 'Error';
            }
        } elseif ($btn === 'x') {
            $_SESSION['expression'] = substr($_SESSION['expression'], 0, -1);
        } else {
            $_SESSION['expression'] .= $btn;
        }
        
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Simple Calculator</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="calculator">
        <h1>My Calculator</h1>
        <form method="post">
            <table>
                <tr>
                    <td colspan="4">
                    <input type="text" name="screen" disabled value="<?= htmlspecialchars($_SESSION['expression']) ?>">
                    </td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn" value="AC">AC</button></td>
                    <td><button type="submit" name="btn" value="%">%</button></td>
                    <td><button type="submit" name="btn" value="x">x</button></td>
                    <td><button type="submit" name="btn" value="/">/</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn" value="7">7</button></td>
                    <td><button type="submit" name="btn" value="8">8</button></td>
                    <td><button type="submit" name="btn" value="9">9</button></td>
                    <td><button type="submit" name="btn" value="X">X</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn" value="4">4</button></td>
                    <td><button type="submit" name="btn" value="5">5</button></td>
                    <td><button type="submit" name="btn" value="6">6</button></td>
                    <td><button type="submit" name="btn" value="-">-</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn" value="1">1</button></td>
                    <td><button type="submit" name="btn" value="2">2</button></td>
                    <td><button type="submit" name="btn" value="3">3</button></td>
                    <td><button type="submit" name="btn" value="+">+</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn" value="00">00</button></td>
                    <td><button type="submit" name="btn" value="0">0</button></td>
                    <td><button type="submit" name="btn" value=".">.</button></td>
                    <td><button type="submit" name="btn" value="=">=</button></td>
                </tr>
            </table>
        </form>
    </div>

    <?php
  
    ?>
</body>

</html>