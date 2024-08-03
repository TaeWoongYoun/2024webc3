document.querySelector('.login_submit').addEventListener('click', function(event) {
    event.preventDefault(); // 폼 제출을 막습니다.

    const loginid = document.getElementById('loginid').value;
    const loginpassword = document.getElementById('loginpassword').value;

    // 폼 유효성 검사
    if (!loginid || !loginpassword) {
        alert("아이디와 비밀번호를 입력해주세요.");
        return false;
    }

    // AJAX 요청을 위한 FormData 객체 생성
    const formData = new FormData();
    formData.append('userid', loginid);
    formData.append('userpassword', loginpassword);

    // 서버로 AJAX 요청 보내기
    fetch('http://localhost:8012/2024webc3/api/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // 서버 응답을 로그에 기록합니다.
        if (data.success) {
            alert('로그인에 성공했습니다.');
            localStorage.setItem('username', data.username);
            localStorage.setItem('userid', data.userid);
            localStorage.setItem('token', data.token);
            localStorage.setItem('apikey', data.apikey);

            document.querySelector('.login_modal').style.display = 'none';
            updateHeaderForLoggedInUser(data.username);
        } else {
            alert(data.message || '로그인에 실패했습니다.');
            document.getElementById('loginid').value = '';
            document.getElementById('loginpassword').value = '';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('로그인 중 오류가 발생했습니다.');
    });
});

function updateHeaderForLoggedInUser(username) {
    const header = document.getElementById('header');
    header.innerHTML = `
        <span>환영합니다, ${username}님</span>
        <button class="mypage_button">마이페이지</button>
        <button class="logout_button">로그아웃</button>
    `;

    document.querySelector('.logout_button').addEventListener('click', function() {
        localStorage.removeItem('username');
        localStorage.removeItem('userid');
        localStorage.removeItem('token');
        localStorage.removeItem('apikey');
        location.reload(); // 페이지 새로고침
    });
}

function checkLoginStatus() {
    const userid = localStorage.getItem('userid');
    const token = localStorage.getItem('token');

    if (userid && token) {
        fetch('http://localhost:8012/2024webc3/api/check_token.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ userid, token })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateHeaderForLoggedInUser(localStorage.getItem('username'));
            } else {
                localStorage.clear();
                alert('다른 곳에서 로그인하였거나 인증 정보가 변경되었습니다.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            localStorage.clear();
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    checkLoginStatus();
});