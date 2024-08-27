@extends('layouts.app')

@section('title', 'The list of tasks')
@section('content')
<nav class="mb-4">
  <a href="{{route('tasks.create')}}"
    class="link">Create Task</a>
</nav>
<div>
  @forelse ($tasks as $task)
    <div>
      <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
      @class( ['font-bold' => !$task->completed, 'line-through text-gray-400' =>$task->completed] )>{{ $task -> title }}</a>
    </div>
  @empty
    <div>no tasks</div>
  @endforelse

  @if ($tasks->count())
  <nav class="mt-4">
    {{$tasks->links()}}
  </nav>
  @endif
</div>
@endsection