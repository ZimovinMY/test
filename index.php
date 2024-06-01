<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
<form id="registrationForm">
    <div>
        <label for="firstName">Имя:</label>
        <input type="text" id="firstName" name="firstName" required>
    </div>
    <div>
        <label for="lastName">Фамилия:</label>
        <input type="text" id="lastName" name="lastName" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="confirmPassword">Повтор пароля:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>
    </div>
    <button type="submit">Регистрация</button>
</form>
<div class="message"></div>

<script>
    $(document).ready(function(){
        $("#registrationForm").submit(function(event){
            event.preventDefault();

            let formData = {
                firstName: $("#firstName").val(),
                lastName: $("#lastName").val(),
                email: $("#email").val(),
                password: $("#password").val(),
                confirmPassword: $("#confirmPassword").val()
            };

            $.ajax({
                type: "POST",
                url: "register.php",
                data: formData,
                dataType: "json",
                success: function(response){
                    console.log(response);
                    if(response.success){
                        $("#registrationForm").hide();
                        $(".message").html("<p class='success'>Регистрация успешна!</p>");
                    } else {
                        $(".message").html("<p class='error'>" + response.message + "</p>");
                    }
                }
            });
        });
    });
</script>
</body>
</html>