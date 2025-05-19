<?php

require "./app/check_auth.php";
require "./app/common.php";

$title = "Question List";
$module_code = $_GET['module'] ?? '';
$module_data = getModuleByCode($module_code);
if (empty($module_code)) {
    header("Location: index.php?error=Module Not Found");
    exit;
}
require "./layouts/header.php";
?>
<div class="container">
    <div class="mt-5">
        <div class="text-center ">
            <h1 class="fw-bold text-theme-fourth"><?= $module_data['name'] ?></h1>
            <div class="border-bottom border-3 border-primary w-25 mx-auto mt-3"></div>
        </div>
        <div class="row my-4 ">
            <?php if ($_SESSION['user']['role'] == 'student') { ?>
                <div class="col-lg-4 mb-3 offset-lg-8 text-end">
                    <a class="btn btn-theme rounded-pill shadow-sm" href="question_form.php?module=<?= $module_code ?>">
                        <i class="fas fa-plus-circle me-2"></i>Create Question
                    </a>
                </div>
            <?php } ?>
            <div class="col-lg-4 mb-3">
                <select class="form-select" id="answerFilter">
                    <option value="all">All Questions</option>
                    <option value="answered">Answered</option>
                    <option value="unanswered">Pending</option>
                </select>
            </div>
            <div class="col-lg-4 mb-3">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search questions, answers, or users...">
                    <button class="btn btn-theme" type="button" id="searchButton">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </div>

        </div>
        <div class="row mt-4" id="question_list"></div>
        <input type="hidden" id="module_code" value="<?= $module_code ?>">
        <input type="hidden" id="current_user" value="<?= $_SESSION['user']['username'] ?>">
        <input type="hidden" id="user_role" value="<?= $_SESSION['user']['role'] ?>">
    </div>
</div>

<script src="./js/question_list.js"></script>
<?php
require "./layouts/footer.php"
?>