<?php
require "./app/check_auth.php";
require "./app/common.php";

$module = $_GET['module'] ?? '';
if (empty($module)) {
    header("Location: index.php");
    exit;
}

$module_data = getModuleByCode($module);
if (!$module_data) {
    header("Location: index.php");
    exit;
}

$title = "Ask Question";
$module_name = $module_data['name'];

require "./layouts/header.php";
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h1 class="fw-bold text-theme"><?= $module_name ?></h1>
                <div class="border-bottom border-3 border-primary w-50 mx-auto mt-3"></div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form id="question_form">
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">Question Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Question Title" />
                            <small id="title_error" class="text-danger" style="display: none;"></small>
                        </div>
                        <div class="mb-4">
                            <label for="question" class="form-label fw-bold">Your Question</label>
                            <textarea name="question" id="question" class="form-control" rows="8" placeholder="Enter Your Question"></textarea>
                            <small id="question_error" class="text-danger" style="display: none;"></small>
                        </div>
                        <input type="hidden" name="module" value="<?= $module ?>">
                        <input type="hidden" name="form_submit" value="1" />
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="fas fa-paper-plane me-2"></i>Submit Question
                            </button>
                            <a href="question_list.php?module=<?= $module ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./js/question_form.js"></script>
<?php require "./layouts/footer.php" ?>