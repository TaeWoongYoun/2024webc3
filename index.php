<?php $conn = mysqli_connect('localhost', 'root', '', 'gwangju')?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>광주</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button class="login_modal_open">로그인</button>
    <button class="join_modal_open">회원가입</button>

    <div class="login_modal">
        <h3>로그인</h3>
        <input type="text" name="loginid" id="loginid" placeholder="아이디"> <br>
        <input type="text" name="loginpassword" id="loginpassword" placeholder="비밀번호"> <br>
        <button type="submit">로그인</button>
        <button type="submit" class="login_modal_close">취소</button>
    </div>

    <div class="join_modal">
        <h3>회원가입</h3>
        <form class="signupForm">
            <input type="text" name="username" id="username" placeholder="이름"> <br>
            <input type="text" name="userid" id="userid" placeholder="아이디"> <br>
            <input type="password" name="userpassword" id="userpassword" placeholder="비밀번호"> <br>
            <input type="password" name="userpassword_ck" id="userpassword_ck" placeholder="비밀번호 확인"> <br>
            <p class="captcha">
                <img src="image/캡차.png" alt="캡챠" id="captchaImage">
                <button type="button" class="refresh">새로고침</button>
            </p>
            <input type="text" id="captcha" placeholder="캡챠"> <br>
            <button type="submit" class="join_submit">회원가입</button>
            <button type="reset" class="join_modal_close">취소</button>
        </form>
    </div>

    <script src="js/join.js"></script>
    <script src="js/seong.js"></script>
</body>
</html>
