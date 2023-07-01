<?php
class Task
{
  private const FILENAME = "tasks.json";

  /**
   * Add a task with the name `$taskName` and priority `$priority` to the list of tasks.
   * 
   * @param string $taskName Name of task
   * @param int $priority Priority of task
   * @return mixed Return `new task`, if it was successfully added in file, otherwise - `false`.
   */
  public static function addTask($taskName, $priority)
  {
    $tasks = self::getArrayTasks();

    $new_task = array(
      'taskId' => uniqid(),
      'taskName' => $taskName,
      'priority' => $priority,
      'completed' => false
    );

    array_push($tasks, $new_task);

    if (self::saveTasksToFile($tasks)) {
      return $new_task;
    }

    return false;
  }

  /**
   * Delete task by unique task id
   * 
   * @param string $taskId Unique id of task
   * @return mixed Returns `deleted task`, if task were in array and updated list of tasks saved to file, otherwise return `false`.
   */

  public static function deleteTask($taskId)
  {
    $tasks = self::getArrayTasks();

    $id = self::getTask($tasks, $taskId);

    if ($id === false)
      return false;

    $deleted_task = $tasks[$id];

    array_splice($tasks, $id, 1);

    if (self::saveTasksToFile($tasks)) {
      return $deleted_task;
    }
    return false;
  }

  /**
   * @return array Returns array of tasks sorted by priority in descending order
   */
  public static function getTasks()
  {
    $tasks = self::getArrayTasks();

    $compare = function ($a, $b) {
      return $b['priority'] - $a['priority'];
    };

    usort($tasks, $compare);

    return $tasks;
  }

  /**
   * Marks the task with $taskId as completed.
   * 
   * @param string $taskId Unique id of task
   * @return mixed Returns `completed task`, if task exists in array and updated list of tasks saved to file, otherwise return `false`.
   */
  public static function completeTask($taskId)
  {
    $tasks = self::getArrayTasks();

    $id = self::getTask($tasks, $taskId);

    if ($id === false)
      return false;

    $tasks[$id]['completed'] = true;

    if (self::saveTasksToFile($tasks)) {
      return $tasks[$id];
    }
    return false;
  }

  /**
   * Find task by unique id in array of tasks.
   * 
   * @param array $tasks array of tasks
   * @param string $taskId unique id of task
   * @return mixed Returns `index` of task in array, if task exists in array, else return `false`
   */
  private static function getTask($tasks, $taskId)
  {
    for ($i = 0; $i < count($tasks); $i++) {
      if ($tasks[$i]['taskId'] === $taskId) {
        return $i;
      }
    }
    return false;
  }

  /**
   * @return array Returns `array of tasks`, if file with tasks exists, otherwise - `empty array`.
   */
  private static function getArrayTasks()
  {
    try {
      if (file_exists(self::FILENAME)) {
        $json = file_get_contents(self::FILENAME);
        return json_decode($json, true);
      }
    } catch (Exception $e) {
      echo "File read error: " . $e->getMessage();
    }

    return array();
  }

  /**
   * @param array $tasks Array of tasks
   * @return bool Returns true, if file was successfully updated, otherwise - false
   */
  private static function saveTasksToFile($tasks)
  {
    try {
      $json = json_encode($tasks, JSON_PRETTY_PRINT);
      if (!file_put_contents(self::FILENAME, $json)) {
        throw new Exception("File write error");
      }
      return true;
    } catch (Exception $e) {
      echo "File write error: " . $e->getMessage();
    }

    return false;
  }
}

?>