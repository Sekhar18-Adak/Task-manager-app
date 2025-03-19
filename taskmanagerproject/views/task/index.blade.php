@extends('layout.baseview')
@section('title','All task')
@section('content')
    @include('layout.navigation')
    <div class="container mt-4">
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Add Task
</button>

<!-- Modal for adding task -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Adding more task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- form start -->
        <form id="taskForm" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="taskDescription" class="form-label">Task Description</label>
                                <input type="text" class="form-control" id="taskDescription" name="task_description" required>
                                <div class="invalid-feedback">Please enter a task description.</div>
                            </div>

                            <div class="mb-3">
                                <label for="taskOwner" class="form-label">Owner</label>
                                <input type="text" class="form-control" id="taskOwner" name="task_owner" required>
                                <div class="invalid-feedback">Please enter the owner's name.</div>
                            </div>

                            <div class="mb-3">
                                <label for="taskEmail" class="form-label">Owner Email</label>
                                <input type="email" class="form-control" id="taskEmail" name="task_email" required>
                                <div class="invalid-feedback">Please enter a valid email.</div>
                            </div>

                            <div class="mb-3">
                                <label for="taskEta" class="form-label">ETA</label>
                                <input type="date" class="form-control" id="taskEta" name="task_eta" required>
                                <div class="invalid-feedback">Please select a date.</div>
                            </div>

                            <div class="mb-3">
                                <label for="taskStatus" class="form-label">Status</label>
                                <select class="form-select" id="taskStatus">
                                  <option value="1">Completed</option>
                                  <option value="0">Incomplete</option>
                                </select>
                                <div class="invalid-feedback">Please select a status.</div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Task</button>
                            </div>
                   </form>
                        <!-- Form End -->
      </div>
    </div>
  </div>
</div>

<!-- Modal for updating task -->
<div class="modal fade" id="updateTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateTaskModalLabel">Update Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateTaskForm" class="needs-validation" novalidate>
                            <input type="hidden" id="updateTaskId"> <!-- Hidden field for task ID -->

                            <div class="mb-3">
                                <label for="updateTaskDescription" class="form-label">Task Description</label>
                                <input type="text" class="form-control" id="updateTaskDescription" required>
                                <div class="invalid-feedback">Please enter a task description.</div>
                            </div>

                            <div class="mb-3">
                                <label for="updateTaskOwner" class="form-label">Owner</label>
                                <input type="text" class="form-control" id="updateTaskOwner" required>
                                <div class="invalid-feedback">Please enter the owner's name.</div>
                            </div>

                            <div class="mb-3">
                                <label for="updateTaskEmail" class="form-label">Owner Email</label>
                                <input type="email" class="form-control" id="updateTaskEmail" required>
                                <div class="invalid-feedback">Please enter a valid email.</div>
                            </div>

                            <div class="mb-3">
                                <label for="updateTaskEta" class="form-label">ETA</label>
                                <input type="date" class="form-control" id="updateTaskEta" required>
                                <div class="invalid-feedback">Please select a date.</div>
                            </div>

                            <div class="mb-3">
                                <label for="updateTaskStatus" class="form-label">Status</label>
                                <select class="form-select" id="updateTaskStatus">
                                    <option value="1">Completed</option>
                                    <option value="0">Incomplete</option>
                                </select>
                                <div class="invalid-feedback">Please select a status.</div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Complete Task Confirmation Modal -->
<div class="modal fade" id="completeTaskModal" tabindex="-1" aria-labelledby="completeTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="completeTaskModalLabel">Complete Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to mark this task as completed?</p>
                <input type="hidden" id="completeTaskId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="confirmCompleteTask">Yes, Complete</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteTaskModal" tabindex="-1" aria-labelledby="deleteTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteTaskModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this task?
                <input type="hidden" id="deleteTaskId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteTask">Delete</button>
            </div>
        </div>
    </div>
</div>
            <div  class="card">
                <h2 class="mb-4">All Taks</h2>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th> Task Description</th>
                            <th>Owner</th>
                            <th>Email</th>
                            <th>ETA</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead >
                    <tbody id="taskTable">
                    </tbody>
                </table>
                </div>
    </div>
@endsection
@section('custom.js')
    @include('layout.customjs')
@endsection
