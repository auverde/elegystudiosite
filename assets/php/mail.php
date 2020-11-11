<?php

$errors = [];
$errorMessage = '';

if (!empty($_POST)) {
    $email = $_POST['email'];
    $message = $_POST['msg'];

    if (empty($email)) {
        $errors[] = 'Поле Email пустой';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email неправильный';
    }

    if (empty($message)) {
        $errors[] = 'Поле сообщение пустое!';
    }


    if (empty($errors)) {
        $toEmail = 'example@example.com';
        $emailSubject = 'Нова заявка з форми сайту: Elegy Studio';
        $headers = ['From' => $email, 'Reply-To' => $email, 'Content-type' => 'text/html; charset=iso-8859-1'];

        $bodyParagraphs = ["Email: {$email}", "Message:", $message];
        $body = join(PHP_EOL, $bodyParagraphs);

        if (mail($toEmail, $emailSubject, $body, $headers)) {
            header('Location: ../../thank-you.html');
        } else {
            $errorMessage = 'Упс, что-то пошло не так. Попробуйте позже.';
        }
    } else {
        $allErrors = join('<br/>', $errors);
        $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
    }
}

?>