<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $response = ['success' => false, 'message' => ''];

    // Валидация
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Неверный формат email.';
    } elseif ($password !== $confirmPassword) {
        $response['message'] = 'Пароли не совпадают.';
    } else {
        // Массив существующих пользователей
        $existingUsers = [
            ['id' => 1, 'name' => 'Mikhail', 'email' => 'mikhail@example.com'],
            ['id' => 2, 'name' => 'Dmitry', 'email' => 'dmitry@example.com']
        ];

        // Проверка наличия email в массиве пользователей
        $userExists = false;
        foreach ($existingUsers as $user) {
            if ($user['email'] === $email) {
                $userExists = true;
                break;
            }
        }
        if ($userExists) {
            $response['message'] = 'Пользователь с таким email уже зарегистрирован.';
        } else {
            $response['success'] = true;
            $response['message'] = 'Регистрация успешна!';

            // Логирование результата проверки
            date_default_timezone_set('Europe/Moscow');
            $log = "[" . date('Y-m-d H:i:s') . "] Регистрация успешна: " . $email . PHP_EOL;
            file_put_contents('registration.log', $log, FILE_APPEND);
        }
    }

    echo json_encode($response);
}
