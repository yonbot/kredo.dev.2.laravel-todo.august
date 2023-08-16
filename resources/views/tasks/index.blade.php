@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1 class="h3">{{ config('app.name') }}</h1>

    <form action="{{ route('store') }}" method="post">
        @csrf
        {{-- cross-site request forgeries
        ~~to validate the request/input data
        ~~security
        ~~CSRF protection --}}

        <div class="row gx-2 mb-3">
            <div class="col-10">
                <input type="text" name="name" id="name"
                    placeholder="Create a task..." class="form-control" 
                    value="{{ old('name') }}" autofocus>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fa-solid fa-plus"></i> Add
                </button>
            </div>
            {{-- ERROR --}}
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
    </form>
    
        @if ($all_tasks->isNotEmpty())
            <ul class="list-group">
                @foreach($all_tasks as $task)
                    <li class="list-group-item d-flex align-items-center">
                        {{-- TASK --}}
                        <p class="mb-0 me-auto">{{ $task->name }}</p>

                        {{-- ACTION BUTTONS --}}
                        {{-- Routeのname --}}
                        <a href="{{ route('edit', $task->id) }}" class="btn btn-warning btn-sm me-1"
                            title="Edit Task">
                            <i class="fa-solid fa-edit"></i>
                        </a>

                        <form action="{{ route('destroy', $task->id) }}" method="post" class="ms-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                title="Delete Task">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
@endsection