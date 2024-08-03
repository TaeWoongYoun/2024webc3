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
    <button class="join_modal_open">회원가입</button>

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
            <input type="text" id="captcha" placeholder="켑챠"> <br>
            <button type="submit" class="join_submit">회원가입</button>
            <button type="reset" class="join_modal_close">취소</button>
        </form>
    </div>

    <script>
        document.querySelector('.join_submit').addEventListener('click', function(event) {
            event.preventDefault(); // 폼 제출을 막습니다.

            const username = document.getElementById('username').value;
            const userid = document.getElementById('userid').value;
            const userpassword = document.getElementById('userpassword').value;
            const userpasswordCk = document.getElementById('userpassword_ck').value;
            const captcha = document.getElementById('captcha').value;

            // 폼 유효성 검사
            if (username.length < 2) {
                alert("이름을 2글자 이상 입력해주세요");
                return false;
            }
            if (userid.length < 4) {
                alert("아이디를 4글자 이상 입력해주세요");
                return false;
            }
            if (userpassword.length < 4) {
                alert("비밀번호를 4글자 이상 입력해주세요");
                return false;
            }
            if (userpassword != userpasswordCk) {
                alert("비밀번호를 확인해주세요.");
                return false;
            }
            if (captcha != '2CCEX') { // 실제 캡챠 검증 로직이 필요합니다.
                alert("캡챠를 다시 확인해주세요.");
                return false;
            }

            // AJAX 요청을 위한 FormData 객체 생성
            const formData = new FormData();
            formData.append('username', username);
            formData.append('userid', userid);
            formData.append('userpassword', userpassword);

            // 서버로 AJAX 요청 보내기
            fetch('http://localhost:8012/2024webc3/api/regist.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // 서버 응답을 로그에 기록합니다.
                if (data.success) {
                    alert('회원가입이 완료되었습니다.');
                    document.querySelector('.join_modal').style.display = 'none';
                    document.querySelector('.signupForm').reset();
                }
            })
        });
    </script>
    <script src="seong.js"></script>
</body>
</html>
