<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use \App\Models\Task;
use \App\Http\Requests\TaskRequest;

### PRZEKIEROWANIE NA STRONĘ GŁÓWNĄ ###
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

### LISTOWANIE WSZYSTKICH ZADAŃ ###
Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()
//            ->where('completed', true)  pobiera dane gdzie pole completed ma wartosc true
//            ->get() // pobiera najnowsze zadania
            ->paginate(10) // dzieli na strony
    ]);
})->name('tasks.index');

### FORMULARZ DODAWANIA NOWEGO ZADANIA ###
Route::view('/tasks/create', 'create')
    ->name('tasks.create');


### FORMULARZ EDYCJI ISTNIEJĄCEGO ZADANIA ###
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

### WYŚWIETLANIE POJEDYNCZEGO ZADANIA ###
Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

### DODAWANIE NOWEGO ZADANIA ###
Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());

    // Przekierowanie do podglądu nowo utworzonego zadania
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');

})->name('tasks.store');


### AKTUALIZACJA ISTNIEJĄCEGO ZADANIA ###
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());

    // Przekierowanie do podglądu zaktualizowanego zadania
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');

})->name('tasks.update');

### USUWANIE ZADAŃ ###
Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');

### OBSŁUGA NIEZNANYCH ŚCIEŻEK (FALLBACK) ###
Route::fallback(fn() => 'Still got somewhere!',
);
