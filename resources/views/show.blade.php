@extends('layouts.app')

@section('title', $task->title)


@section('content')
<p class="mb-4 text-slate-700">{{ $task->description }}</p>
@isset($task->long_description)
<p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
@endisset


<p class="mb-4 text-sm text-slate-500">{{ $task->created_at->diffForHumans() }} . {{ $task->updated_at->diffForHumans() }}</p>
<div class='mb-4'>
  @if($task->completed)
  <span class="font-medium text-green-500">Completed</span>
  @else
  <span class="font-medium text-red-500">Not Completed</span>
  @endif
</div>


<div class="flex gap-2 items-center">
  <form>
    <a class="btn"
      href="{{ route('tasks.edit',['task' => $task]) }}">
      Edit
    </a>
  </form>

  <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
    @csrf
    @method('PUT')
    <button class="btn" type="submit">Mark as {{$task->completed? 'not completed': 'completed'}}</button>
  </form>

  <form method="POST" action="{{route('tasks.destroy',['task' => $task->id])}}">
    @csrf
    @method('DELETE')
    <button class="btn" type='submit'>Delete</button>
  </form>
@endsection
</div>