<?php
// 사용자 응답 조합 받기 (예: ABAB)
$answers = $_POST['answers'] ?? '';

// JSON 파일 로드
$dataPath = __DIR__ . '/data/song_map_with_links.json';
$songMap = json_decode(file_get_contents($dataPath), true);

// 추천 결과 초기화
$title = "추천 결과를 찾을 수 없습니다.";
$link = "#";

// 유효한 조합이면 랜덤 추천
if (isset($songMap[$answers])) {
    $randomSong = $songMap[$answers][array_rand($songMap[$answers])];
    $title = $randomSong['title'];
    $link = $randomSong['youtube'];
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>노래 추천 결과</title>
  <style>
    body { font-family: Arial; text-align: center; margin-top: 60px; }
    h1 { font-size: 28px; margin-bottom: 20px; }
    .song { font-size: 22px; margin: 20px; }
    .link a {
      display: inline-block;
      margin-top: 10px;
      font-size: 18px;
      color: #007BFF;
      text-decoration: none;
    }
    .link a:hover {
      text-decoration: underline;
    }
    button {
      margin-top: 30px;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>🎵 당신에게 어울리는 노래는?</h1>
  <div class="song">
    <strong><?= htmlspecialchars($title) ?></strong>
    <div class="link">
      <a href="<?= htmlspecialchars($link) ?>" target="_blank">▶ 유튜브에서 들어보기</a>
    </div>
  </div>

  <!-- 다시 추천 -->
  <form method="POST" action="process.php">
    <input type="hidden" name="answers" value="<?= htmlspecialchars($answers) ?>">
    <button type="submit">🔁 다시 추천 받기</button>
  </form>

  <br>
  <a href="index.html">↩ 처음부터 다시</a>
</body>
</html>
