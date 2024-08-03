<?php
$conn = mysqli_connect('localhost', 'root', '', 'gwangju');
header('Content-Type: application/json');

// 입력 데이터 가져오기 및 SQL 인젝션 방지
$userid = mysqli_real_escape_string($conn, $_POST['userid']);
$userpassword = mysqli_real_escape_string($conn, $_POST['userpassword']);

// 사용자 조회 SQL 쿼리
$sql = "SELECT * FROM users WHERE userid = '$userid'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    // 비밀번호 검증
    if (password_verify($userpassword, $user['userpassword'])) {
        // 토큰 생성
        $token = bin2hex(random_bytes(15)); // 30자리의 토큰 생성
        $updateTokenSql = "UPDATE users SET token = '$token' WHERE userid = '$userid'";
        if (mysqli_query($conn, $updateTokenSql)) {
            echo json_encode([
                'success' => true,
                'username' => $user['username'],
                'userid' => $user['userid'],
                'token' => $token,
                'apikey' => $user['apikey']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => '토큰 업데이트에 실패했습니다.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => '아이디 또는 패스워드를 확인하세요.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => '아이디 또는 패스워드를 확인하세요.']);
}

// 데이터베이스 연결 종료
mysqli_close($conn);
?>