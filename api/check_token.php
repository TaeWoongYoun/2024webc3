<?php
$conn = mysqli_connect('localhost', 'root', '', 'gwangju');
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$userid = mysqli_real_escape_string($conn, $data['userid']);
$token = mysqli_real_escape_string($conn, $data['token']);

// 사용자 조회 SQL 쿼리
$sql = "SELECT * FROM users WHERE userid = '$userid' AND token = '$token'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => '유효하지 않은 토큰입니다.']);
}

// 데이터베이스 연결 종료
mysqli_close($conn);
?>
