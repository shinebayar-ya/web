<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Poll</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body class="bg-dark">
    <div class="container bg-light mt-5 p-5 rounded">
        <h2>Create Poll</h2>
        <form method="post" action="process_poll.php">
            <div class="mb-3 border border-primary rounded p-3">
                <div class="mb-3 border border-success rounded p-3 questions-container">
                    <div class="question row">
                        <div class="col-10">
                        <div class="mb-3 border border-warning rounded p-3 d-grid gap-3">
                            <input type="text" class="form-control" name="questions[]" placeholder="Question">
                            <div class="mb-3 border border-info rounded p-3 options-container">
                                <div class="row g-2 mb-3 border border-dark p-2 rounded">
                                    <div class="col-auto">
                                        <input type="text" class="form-control option" name="answers[]" placeholder="Option">
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-danger delete-answer"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success mt-2 add-answer"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        </div>
                        <div class="col-2">

                            <button type="button" class="btn btn-danger mb-3 delete-question"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-success add-question">Add Question</button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        // Add Answer button click event to dynamically add answers
        $(document).on("click", ".add-answer", function () {
            const newAnswerField = `
                <div class="row g-2 mb-3 border border-dark p-2 rounded">
                    <div class="col-auto"><input type="text" class="form-control option" name="answers[]" placeholder="Option"></div>
                    <div class="col-auto"><button type="button" class="btn btn-danger delete-answer"><i class="fas fa-trash"></i></button></div>
                </div>
            `;
            $(this).prev().after(newAnswerField);
        });

        // Delete answer button
        $(document).on("click", ".delete-answer", function () {
            const answerContainers = $(this).closest(".options-container").find(".option");
            
            // Only delete if there's more than one answer
            if (answerContainers.length > 1) {
                $(this).closest(".row").remove();
            }
        });

        $(".add-question").click(function () {
            const newQuestionField = `
            <div class="question row">
                        <div class="col-10">
                        <div class="mb-3 border border-warning rounded p-3 d-grid gap-3">
                            <input type="text" class="form-control" name="questions[]" placeholder="Question">
                            <div class="mb-3 border border-info rounded p-3 options-container">
                                <div class="row mb-3 border border-dark p-2 rounded">
                                    <div class="col-auto">
                                        <input type="text" class="form-control option" name="answers[]" placeholder="Option">
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-danger delete-answer"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success mt-2 add-answer"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        </div>
                        <div class="col-2">

                            <button type="button" class="btn btn-danger mb-3 delete-question"><i class="fas fa-trash"></i></button>
                        </div>
            `;
            $(".questions-container").append(newQuestionField);
        });

        // Delete question button
        $(document).on("click", ".delete-question", function () {
            const answerContainers = $(this).closest(".questions-container").find(".question");
            
            // Only delete if there's more than one answer
            if (answerContainers.length > 1) {
                $(this).closest(".question").remove();
            }
        });
    </script>
</body>

</html>
