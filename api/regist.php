<?php
header('Content-Type: application/json');

// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gwangju";

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 오류 확인
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error); // 오류 기록
    die(json_encode(['success' => false, 'message' => '데이터베이스 연결 실패: ' . $conn->connect_error]));
}

// 입력 데이터 가져오기 및 SQL 인젝션 방지
$userid = mysqli_real_escape_string($conn, $_POST['userid']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$userpassword = password_hash($_POST['userpassword'], PASSWORD_BCRYPT);
$token = bin2hex(random_bytes(16)); // 16바이트의 랜덤 문자열을 32자리의 16진수로 변환합니다.
$apikey = bin2hex(random_bytes(16)); // 동일하게 32자리의 API 키를 생성합니다.

// 사용자 데이터 삽입 SQL 쿼리
$sql = "INSERT INTO users (role, username, userid, userpassword, token, apikey) VALUES ('u', '$username', '$userid', '$userpassword', '$token', '$apikey')";

// 쿼리 실행 및 결과 확인
if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true]); // 성공적으로 실행되었을 때 JSON 응답
} else {
    error_log("Insert Error: " . mysqli_error($conn)); // 오류 기록
    echo json_encode(['success' => false, 'message' => '회원가입에 실패했습니다: ' . mysqli_error($conn)]); // 오류 발생 시 JSON 응답
}

// 데이터베이스 연결 종료
mysqli_close($conn);
?>
