<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\TaskRepository;
use Helpers;

class TaskController extends Controller
{
    /**
	 * @var $task
	 */
	private $task;

	/**
	 * TaskController constructor.
	 *
	 * @param App\Repositories\TaskRepository $task
	 */
	public function __construct(TaskRepository $task) 
	{
		$this->task = $task;
	}

	public function index()
	{
		echo Helpers::contohHelper();
		return view('tasks');	
	}

	/**
	 * Get all tasks.
	 *
	 * @return Illuminate\View
	 */
	public function getAllTasks($id = null)
	{
		$tasks = $this->task->getAll();
		$editTask = (isset($id)) ? $this->task->getById($id) : null;

		return view('tasks.index', compact('tasks', 'editTask'));
	}

	/**
	 * Store a task
	 *
	 * @var array $attributes
	 *
	 * @return mixed
	 */
	public function postStoreTask(Request $request)
	{
		$attributes = $request->only(['title','description','price']);
		$this->task->create($attributes);

		return redirect()->route('task.index')->with("message","Data berhasil ditambah");
	}

	/**
	 * Update a task
	 *
	 * @var integer $id
	 * @var array 	$attributes
	 *
	 * @return mixed
	 */
	public function postUpdateTask($id, Request $request)
	{
		$attributes = $request->only(['title','description','price']);
		$this->task->update($id, $attributes);

		return redirect()->route('task.index')->with("message","Data berhasil diedit");
	}

	/**
	 * Delete a task
	 *
	 * @var integer $id
	 *
	 * @return mixed
	 */
	public function postDeleteTask($id)
	{
		$this->task->delete($id);

		return redirect()->route('task.index')->with("message","Data berhasil dihapus");
	}
}