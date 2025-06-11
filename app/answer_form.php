<?php
require "./app/check_auth.php";
require "./app/common.php";

$question_id = $_GET['question_id'] ?? '';
$module = $_GET['module'] ?? '';

if (empty($question_id) || empty($module)) {
    header("Location: index.php");
    exit;
}

$question = getQuestionById($question_id);
if (!$question) {
    header("Location: index.php");
    exit;
}

$module_data = getModuleByCode($module);
$title = "Answer Question";
$base_url = "./";

require "./layouts/header.php";
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h1 class="fw-bold text-theme">Answer Question</h1>
                <div class="border-bottom border-3 border-primary w-25 mx-auto mt-3"></div>
            </div>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light py-3 border-0">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><?= $question['student_id'] ?></h5>
                            <small class="text-muted">
                                <i class="fas fa-book-open me-1"></i><?= $module_data['name'] ?? $module ?>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h3 class="text-primary mb-3"><?= $question['title'] ?></h3>
                    <p class="text-muted mb-0"><?= $question['content'] ?></p>
                </div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4">
                        <i class="fas fa-reply text-primary me-2"></i>Your Answer
                    </h4>
                    <form id="answer_form">
                        <input type="hidden" name="question_id" value="<?= $question_id ?>">
                        <input type="hidden" name="module" value="<?= $module ?>">
                        <input type="hidden" name="form_submit" value="1">
                        <div class="mb-4">
                            <textarea class="form-control" id="answer" name="answer" rows="8" placeholder="Enter Your Answer"></textarea>
                            <small id="answer_error" class="text-danger" style="display: none;"></small>
                        </div>
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn flex-grow-1 btn-theme">
                                <i class="fas fa-paper-plane me-2"></i>Submit Answer
                            </button>
                            <a href="<?= $base_url ?>question_list.php?module=<?= $module ?>" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./js/answer_form.js"></script>
<?php require "./layouts/footer.php" ?>