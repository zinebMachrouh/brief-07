<?php
include '../SQL/connect.php';
ob_start();
session_start();

$reaction_type = 0;

$user_id = $_SESSION['user_id'];
$question_id = $_GET['question_id'];

$checkStmt = $conn->prepare("SELECT * FROM reactions WHERE user_id = :user_id AND question_id = :question_id AND reaction = :reaction_type");
$checkStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$checkStmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
$checkStmt->bindParam(':reaction_type', $reaction_type, PDO::PARAM_INT);
$checkStmt->execute();

if ($checkStmt->rowCount() > 0) {
    $deleteStmt = $conn->prepare("DELETE FROM reactions WHERE user_id = :user_id AND question_id = :question_id AND reaction = :reaction_type");
    $deleteStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $deleteStmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $deleteStmt->bindParam(':reaction_type', $reaction_type, PDO::PARAM_INT);
    $deleteStmt->execute();
} else {
    $insertStmt = $conn->prepare("INSERT INTO reactions (user_id, question_id, reaction) VALUES (:user_id, :question_id, :reaction_type)");
    $insertStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $insertStmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $insertStmt->bindParam(':reaction_type', $reaction_type, PDO::PARAM_INT);
    $insertStmt->execute();
}
$updateStmt = $conn->prepare("UPDATE reactions SET reaction = NULL WHERE question_id = :question_id AND reaction = 1");
$updateStmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
$updateStmt->execute();
header('Location: ./community.php');
?>