<?php
// Palindrome Checker Function

class Palindrome
{
    public $msg = '';

    public function checkPalindrome(string $word)
    {
        $word_len = strlen($word) - 1;
        $output = '';

        // Reverse the string output
        for ($x = $word_len; $x >= 0; $x--) {
            $output .= $word[$x];
        }

        // Check if the reverse string output is equals to word param
        return ($output == $word) ?
            $this->msg = 'The Word is Palindrome' :
            $this->msg = 'The Word is Not Palindrome';
    }

    public function sanitize($word)
    {
        $word = trim($word);
        $word = htmlspecialchars($word);
        $word = strip_tags($word);

        return $word;
    }
}

$palindrome = new Palindrome;

if (isset($_POST['check_word'])) {
    $word = strtolower(
        $palindrome->sanitize($_POST['word'])
    );
    $error = ['error'];
    if (strlen($word) == 0) {
        $error['error'] = "String should not be empty";
    } else {
        if (!preg_match("/^[a-zA-Z]/", $word)) {
            $error['error'] = "This field should only contain characters";
        } else {
            $palindrome->checkPalindrome($word);
        }
    }
}

isset($_POST['reset']) ? header("location:palindrome.php") : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check if word is palindrome</title>
</head>

<body>

    <div style="text-align:center">
        <h3>Palindrome Checker</h3>
    </div>

    <div style="display:flex;
        justify-content:center;
        margin-top:20px;
        text-align:center">

        <form action="" method="post">
            <label>Input Text</label>
            <br>
            <br>
            <input type="text" name="word" value="<?= isset($word) ? $word : ''; ?>">
            <br>
            <div style="margin-top:5px;color:red">
                <?= isset($error['error']) ? $error['error'] : ''; ?>
            </div>
            <br>
            <input type="submit" value="Check Word" name="check_word">&nbsp;
            <input type="submit" value="Reset" name="reset">
            <br>
            <div style="margin-top:15px;color:darkblue;font-weight:bold;">
                <?=
                    isset($palindrome->msg) ? $palindrome->msg : '';
                ?>
            </div>
        </form>
    </div>

</body>

</html>