$(document).ready(function () {
    let searchTimeout;
    const searchInput = $("#searchInput");
    const searchButton = $("#searchButton");
    const answerFilter = $("#answerFilter");
    function loadQuestions(module, search = "", filter = "all") {
        $.ajax({
            url: "app/get_question.php",
            method: "POST",
            data: {
                module: module,
                search: search,
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    $("#question_list").html("");
                    let questionHtml;
                    // sorting vote count and answer
                    const questions = Array.isArray(response.result) ? response.result : [];
                    // Apply answer filter
                    let filteredQuestions = questions;
                    if (filter !== "all") {
                        filteredQuestions = questions.filter((question) => {
                            if (filter === "answered") {
                                return question.answers.length > 0;
                            } else if (filter === "unanswered") {
                                return question.answers.length === 0;
                            }
                            return true;
                        });
                    }
                    const sortedQuestions = filteredQuestions.sort((a, b) => {
                        return b.votes.length - a.votes.length;
                    });

                    if (sortedQuestions.length > 0) {
                        sortedQuestions.forEach((item) => {
                            const hasVoted = item.votes.includes($("#current_user").val());
                            const userRole = $("#user_role").val();
                            const currentUser = $("#current_user").val();
                            // check has answer in question
                            const hasAnswered = item.answers.some((answer) => answer.staff_id === $("#current_user").val());
                            // check show Answer Button condition
                            const showAnswerButton = userRole === "staff" && !hasAnswered;
                            // check vote Button condition
                            const showVoteButton = userRole === "student" && item.answers.length === 0;
                            // question status condition
                            const showStatus = item.answers.length > 0;
                            // check if current user is the question owner
                            const isQuestionOwner = item.student_id === currentUser;
                            questionHtml = `
                                <div class="col-lg-6 mb-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-header bg-light py-3 border-0">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="mb-1">${item.student_id}</h5>
                                                    <small class="text-muted">Student</small>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <span class="badge bg-primary rounded-pill">
                                                        <i class="fas fa-thumbs-up me-1"></i>${item.votes.length}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                            <h4 class="text-primary mb-3">${item.title}</h4>
                                            <p class="text-muted">${item.content}</p>
                                            ${answerHtml(item.answers) ? answerHtml(item.answers) : ""}
                                        </div>
                                        <div class="card-footer bg-white border-0 py-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex gap-2">
                                                ${showVoteButton ? `<form action="vote.php" method="POST">
                                                        <input type="hidden" name="question_id" value="${item.id}" />
                                                        <input type="hidden" name="module" value="${module}" />
                                                        <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill ${hasVoted ? "btn-outline-danger" : "btn-outline-secondary"}">
                                                            ${hasVoted ? `<i class="fas fa-thumbs-down me-1"></i>Unvote` : `<i class="fas fa-thumbs-up me-1"></i>Vote`}
                                                        </button>
                                                    </form>`: ''}
                                                    ${showAnswerButton ? `<a href="answer_form.php?question_id=${item.id}&module=${module}"
                                                        class="btn btn-primary btn-sm rounded-pill">
                                                        <i class="fas fa-reply me-1"></i>Answer
                                                    </a>`: ''}
                                                    ${isQuestionOwner ? `<button class="btn btn-sm btn-outline-danger delete-question rounded-pill" data-question-id="${item.id}">Delete</button>` : ""}
                                                </div>
                                                <div>
                                                Status: <small class="badge ${showStatus ? "bg-theme" : "bg-danger"} ms-2"><span class="">${showStatus ? `Answered` : `Pending`}</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            $("#question_list").append(questionHtml);
                        });
                    } else {
                        questionHtml = `<div class="border-danger border mt-5 p-5 rounded-5 shadow">
                                            <h1 class="text-center text-danger">Question not found.</h1>
                                        </div>`;
                        $("#question_list").append(questionHtml);
                    }
                }
            },
            error: handleAjaxError,
        });
    }
    function answerHtml(answer) {
        let answerHtml = "";
        answer.forEach((item) => {
            answerHtml += `<div class="answers-section mt-4">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="fas fa-comments text-primary me-2"></i>Answers
                                </h5>
                                    <div class="answer-card bg-light rounded p-3 mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-user-tie text-primary me-2"></i>
                                            <strong class="text-primary">${item.staff_id}</strong>
                                        </div>
                                        <p class="mb-0 text-muted">${item.answer}</p>
                                    </div>
                            </div>
                            `;
        });
        return answerHtml;
    }
    // Handle filter change
    answerFilter.on("change", function () {
        loadQuestions(
            $("#module_code").val(),
            searchInput.val().trim(),
            $(this).val()
        );
    });

    // Handle search input
    searchInput.on("input", function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            loadQuestions($("#module_code").val(), $(this).val().trim(), answerFilter.val());
        }, 300);
    });

    // Handle search button click
    searchButton.on("click", function () {
        loadQuestions($("#module_code").val(), searchInput.val().trim(), answerFilter.val());
    });

    // Handle Enter key in search input
    searchInput.on("keypress", function (e) {
        if (e.which === 13) {
            loadQuestions($("#module_code").val(), $(this).val().trim(), answerFilter.val());
        }
    });
    // Initial load Data
    loadQuestions($("#module_code").val());

    // Vote
    $(document).on("submit", 'form[action="vote.php"]', function (e) {
        e.preventDefault();
        const form = $(this);
        const question_id = form.find('input[name="question_id"]').val();
        const module = form.find('input[name="module"]').val();
        $.ajax({
            url: "app/vote.php",
            method: "POST",
            data: {
                question_id,
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    loadQuestions(module, searchInput.val().trim(), answerFilter.val());
                    handleAjaxSuccess(response);
                } else {
                    showAlert(
                        response.message || "Failed to update vote",
                        "danger"
                    );
                }
            },
            error: handleAjaxError,
        });
    });

    // Delete Question
    $(document).on("click", ".delete-question", function () {
        if (confirm("Are you sure you want to delete this question?")) {
            const questionId = $(this).data("question-id");
            const module = $("#module_code").val();
            $.ajax({
                url: "app/delete_question.php",
                method: "POST",
                data: {
                    question_id: questionId,
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        loadQuestions(module, searchInput.val().trim(), answerFilter.val());
                        handleAjaxSuccess(response);
                    } else {
                        showAlert(
                            response.message || "Failed to delete question",
                            "danger"
                        );
                    }
                },
                error: handleAjaxError,
            });
        }
    });

    // Alert function for success and error messages
    function showAlert(message, type = "success") {
        const alertDiv = document.createElement("div");
        alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 translate-middle-x mt-5`;
        alertDiv.style.zIndex = "9999";
        alertDiv.innerHTML = `${message} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`;
        document.body.appendChild(alertDiv);
        setTimeout(() => {
            alertDiv.remove();
        }, 3000);
    }

    // Function to handle AJAX errors
    function handleAjaxError(xhr, status, error) {
        console.error("AJAX Error:", error);
        let errorMessage = "An error occurred. Please try again.";
        const response = JSON.parse(xhr.responseText);
        if (response.message) {
            errorMessage = response.message;
        }
        showAlert(errorMessage, "danger");
    }

    // Function to handle AJAX success
    function handleAjaxSuccess(response) {
        if (response.success) {
            showAlert(response.message || "Operation completed successfully");
        } else {
            showAlert(response.message || "Operation failed", "danger");
        }
    }
});

