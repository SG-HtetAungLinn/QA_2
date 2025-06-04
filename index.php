<?php

require "./app/check_auth.php";

$title = "Modules List";
require "./layouts/header.php";
?>
<div class="container py-5">
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <h1 class="text-center text-theme fw-bold">Modules List</h1>
            <input type="hidden" value="<?= $_SESSION["user"]['username'] ?>" id="tutor" />
            <input type="hidden" value="<?= $_SESSION["user"]['role'] ?>" id="role" />
            <div class="text-center">
                <div class="border-bottom border-3 border-primary w-25 mx-auto mt-3"></div>
            </div>
        </div>
    </div>
    <div class="row mt-2 g-4" id="module_list"></div>
</div>
<script src="./js/modules.js"></script>
<?php
require "./layouts/footer.php"
?>