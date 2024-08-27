<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Http\Requests\TaskRequest;
use App\Models\Task;


Route::get('/', function(){
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
      'tasks' => Task::latest()->paginate(10),
    ]);
}) -> name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function(Task $task){
    return view('edit', ['task'=>$task]);

}) -> name('tasks.edit');

Route::get('/tasks/{task}', function(Task $task){
    return view('show', ['task'=>$task]);

}) -> name('tasks.show');

Route::post('/tasks', function(TaskRequest $request) {
    // $data = $request->validated();

    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    
    // $task->save();

    $task = Task::create($request->validated());
    
    return redirect()->route('tasks.show',['task'=> $task->id])->with('success', 'task created successfully');
})->name('tasks.store'); 

Route::put('/tasks/{task}', function(Task $task, TaskRequest $request) {
  // $data = $request->validated();

  // $task->title = $data['title'];
  // $task->description = $data['description'];
  // $task->long_description = $data['long_description'];
  
  // $task->save();

  $task->update($request->validated());

  return redirect()->route('tasks.show',['task'=> $task->id])->with('success', 'task updated successfully');
})->name('tasks.update'); 

Route::delete('/tasks/{task}', function(Task $task){
  $task->delete();

  return redirect(route('tasks.index'))->with('success', 'task deleted successfully');
})->name('tasks.destroy');

Route::put('/tasks/{task}/toggle-complete', function(Task $task){
  $task->toggleComplete();

  return redirect()->back()->with('success','Task updated successfully');
})->name('tasks.toggle-complete');

Route::fallback(function () {
    return "still nothing";
});