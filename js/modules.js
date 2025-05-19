$(document).ready(function () {
    $.ajax({
        url: 'app/get_modules.php',
        method: "POST",
        dataType: "json",
        success: function (response) {
            if (response.success) {
                $('#module_list').html('')
                let moduleHtml
                if (response.result.length > 0) {
                    response.result.forEach((item) => {
                        moduleHtml = `
                        <div class="col-md-4">
                            <a href="question_list.php?module=${item.code}" class="text-decoration-none">
                                <div class="card h-100 border-0 shadow hover-shadow transition" style="border-left: 2px solid blue;">
                                    <div class="card-body d-flex flex-column justify-content-center p-4">
                                        <div class="text-center mb-3">
                                            <span class="badge bg-primary px-3  rounded-pill">
                                            ${item.code}
                                            </span>
                                        </div>
                                        <p class="text-center text-theme-fourth">${item.tutor}</p>
                                        <h4 class="card-title text-center text-dark mb-0">
                                             ${item.name}
                                        </h4>
                                    </div>
                                    <div class="card-footer bg-primary bg-opacity-10 border-0 text-center py-3">
                                        <small class="text-primary fw-bold">Click to view questions</small>
                                    </div>
                                </div>
                            </a>
                        </div>`;
                        $('#module_list').append(moduleHtml);
                    })
                } else {
                    moduleHtml = `<h1 class="text-center text-theme">There is no Module</h1>`
                    $('#module_list').append(moduleHtml);
                }
            }

        },
    })

})