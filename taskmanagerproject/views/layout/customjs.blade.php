<script>
function fetchTasks() {
    $.ajax({
        url: "http://127.0.0.1:8000/api/task",
        type: "GET",
        success: function (tasks) {
            let tableBody = $("#taskTable");
            tableBody.empty();
            if (tasks.length === 0) {
                tableBody.append("<tr><td colspan='7' class='text-center'>No tasks found</td></tr>");
                return;
            }

            tasks.forEach(task => {
                let rowClass = task.Task_Status == 1 ? "text-success fw-bold" : ""; // Green text for completed tasks
                
                let row = `<tr class="${rowClass}">
                    <td>${task.id}</td>
                    <td>${task.Task_Description}</td>
                    <td>${task.Task_Owner}</td>
                    <td>${task.Task_Owner_Email}</td>
                    <td>${task.Task_Eta}</td>
                    <td>${task.Task_Status == 1 ? "Completed" : "In Progress"}</td>
                    <td>
                        <i class="bi bi-pencil-square edit-task" data-id="${task.id}"></i>
                        <i class="bi bi-check2-square complete-task" data-id="${task.id}"></i>
                        <i class="bi bi-trash3 delete-task" data-id="${task.id}"></i>
                    </td>
                </tr>`;
                tableBody.append(row);
            });
        },
        error: function () {
            console.error("Failed to fetch tasks.");
        }
    });
}

// Ensure the script runs after the document is fully loaded
//Handel subit action 
$(document).ready(function () {
    fetchTasks(); 

    // Bootstrap form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })();

    // Handle form submission (AJAX for adding a new task)
    $("#taskForm").on("submit", function (event) {
        event.preventDefault(); // Prevent default form submission

        if (!this.checkValidity()) {
            return;
        }

        let formData = {
            Task_Description: $("#taskDescription").val(),
            Task_Owner: $("#taskOwner").val(),
            Task_Owner_Email: $("#taskEmail").val(),
            Task_Eta: $("#taskEta").val(),
            Task_Status: $("#taskStatus").val() 
        };

        $.ajax({
            url: "http://127.0.0.1:8000/api/task",
            type: "POST",
            data: JSON.stringify(formData),
            contentType: "application/json",
            success: function (response) {
                console.log("Task added:", response);
                $("#taskModal").modal("hide");
                $("#taskForm")[0].reset();
                $(".needs-validation").removeClass("was-validated");
                fetchTasks(); // Refresh task list
            },
            error: function () {
                alert("Error adding task.");
            }
        });
    });

    // Handle Edit Task click event
    $(document).on("click", ".edit-task", function () {
        let taskId = $(this).data("id");

        // Fetch task details using AJAX
        $.ajax({
            url: `http://127.0.0.1:8000/api/task/${taskId}`,
            type: "GET",
            success: function (task) {
                // Populate modal fields with the task data
                $("#updateTaskId").val(task.id);
                $("#updateTaskDescription").val(task.Task_Description);
                $("#updateTaskOwner").val(task.Task_Owner);
                $("#updateTaskEmail").val(task.Task_Owner_Email);
                $("#updateTaskEta").val(task.Task_Eta);
                $("#updateTaskStatus").val(task.Task_Status);
                
                // Show the update modal
                $("#updateTaskModal").modal("show");
            },
            error: function () {
                alert("Failed to fetch task details.");
            }
        });
    });

    // Handle Task Update (AJAX)
    $("#updateTaskForm").on("submit", function (event) {
        event.preventDefault(); // Prevent default form submission

        let taskId = $("#updateTaskId").val();
        let updatedData = {
            Task_Description: $("#updateTaskDescription").val(),
            Task_Owner: $("#updateTaskOwner").val(),
            Task_Owner_Email: $("#updateTaskEmail").val(),
            Task_Eta: $("#updateTaskEta").val(),
            Task_Status: $("#updateTaskStatus").val()
        };

        $.ajax({
            url: `http://127.0.0.1:8000/api/task/${taskId}`,
            type: "PUT",
            data: JSON.stringify(updatedData),
            contentType: "application/json",
            success: function (response) {
                console.log("Task updated:", response);
                $("#updateTaskModal").modal("hide");
                fetchTasks(); // Refresh task list
            },
            error: function (xhr) {
                console.error("Error updating task:", xhr.responseText);
                alert("Failed to update task: " + xhr.responseText);
            }
        });
    });
});
$(document).on("click", ".complete-task", function () {
    let taskId = $(this).data("id"); // Get task ID from button
    $("#completeTaskId").val(taskId); // Store the task ID in the hidden input
    $("#completeTaskModal").modal("show"); // Show the modal
});

$(document).on("click", "#confirmCompleteTask", function () {
    let taskId = $("#completeTaskId").val();

    $.ajax({
        url: `http://127.0.0.1:8000/api/task/done/${taskId}`,
        type: "POST",
        success: function (response) {
            console.log("Task marked as completed:", response);
            $("#completeTaskModal").modal("hide");
            fetchTasks(); // Refresh list to apply green text styling
        },
        error: function (xhr) {
            console.error("Error completing task:", xhr.responseText);
            alert("Failed to mark task as completed: " + xhr.responseText);
        }
    });
});
$(document).on("click", ".delete-task", function () {
    let taskId = $(this).data("id");
    $("#deleteTaskId").val(taskId); // Store task ID in hidden input
    $("#deleteTaskModal").modal("show"); // Show modal
});
$(document).on("click", "#confirmDeleteTask", function () {
    let taskId = $("#deleteTaskId").val(); // Retrieve task ID

    $.ajax({
        url: `http://127.0.0.1:8000/api/task/${taskId}`, // API endpoint
        type: "DELETE",
        success: function (response) {
            console.log("Task deleted:", response);
            $("#deleteTaskModal").modal("hide"); // Hide modal
            fetchTasks(); // Refresh task list
        },
        error: function (xhr) {
            console.error("Error deleting task:", xhr.responseText);
            alert("Failed to delete task: " + xhr.responseText);
        }
    });
});

</script>