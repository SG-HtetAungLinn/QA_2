<?php
require './common.php';
header('Content-Type: application/json');

$module = $_POST['module'] ?? '';
$search = $_POST['search'] ?? '';

$questions = getQuestions($module);

if (!empty($search)) {
    $search = strtolower($search);
    $questions = array_filter($questions, function ($question) use ($search) {
        // Search in question title and content
        $titleMatch = stripos($question['title'], $search) !== false;
        $contentMatch = stripos($question['content'], $search) !== false;
        // Search in student ID
        $studentMatch = stripos($question['student_id'], $search) !== false;

        // Search in answers
        $answerMatch = false;
        foreach ($question['answers'] as $answer) {
            if (
                stripos($answer['answer'], $search) !== false ||
                stripos($answer['staff_id'], $search) !== false
            ) {
                $answerMatch = true;
                break;
            }
        }
        return $titleMatch || $contentMatch || $studentMatch || $answerMatch;
    });
}

echo json_encode([
    "success" => true,
    "result" => array_values($questions)
]);
exit;
