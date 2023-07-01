<?php
require 'taskClass.php';

// ADD TASKS
// $success_add = "successfully added!";
// $fail_add = "Failed to add task";
// for ($i = 1; $i <= 3; $i++) {
//     $task = Task::addTask("Task $i", rand(1, 10));
//     echo displayResult($task, $success_add, $fail_add);
// }

// DELETE TASK
// $deleted_task = Task::deleteTask('64a040d27a999');
// $success_del = "successfully deleted!";
// $fail_del = "Failed to delete task";
// echo displayResult($deleted_task, $success_del, $fail_del);

// COMPLETE TASK
// $completed_task = Task::completeTask('64a042d462acb');
// $success_compl = "was successfully completed!";
// $fail_compl = "Failed to complete task";
// echo displayResult($completed_task, $success_compl, $fail_compl);

// SHOW TASKS
// print_r(Task::getTasks());

function displayResult($task, $successMessage, $errorMessage)
{
    if ($task)
        return $task['taskName'] . " " . $successMessage . "<br>";
    return $errorMessage;
}