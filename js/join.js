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
    if (captcha != '2CCEX') {
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
            document.querySelector('.login_modal').style.display = 'block'
        }
    })
});