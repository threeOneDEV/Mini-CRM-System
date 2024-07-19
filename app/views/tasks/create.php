<div class="col-lg-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Add Task
        </div>
        <div class="card-body">
            <form id="taskForm" method="post" action="/tasks/store">
                <div class="mb-3">
                    <label for="taskDescription" class="form-label">Task description</label>
                    <textarea type="text" name="description" class="form-control" id="taskDescription" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="deadline" class="form-label">Deadline</label>
                    <input name="deadline" type="date" class="form-control" id="deadline" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="button_add_task">Add Task</button>
            </form>
        </div>
    </div>
</div>