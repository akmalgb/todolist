@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        Task List
                    </div>
                    <div class="card-body">
                        @if (count($uncompletedTodos))
                            <label>Uncomplete Tasks</label>
                            @foreach ($uncompletedTodos as $key => $uncomplete)
                            <div class="mb-3">
                                <ol class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">{{ $key + 1 }}. {{ $uncomplete->title }}</div>
                                            {{ $uncomplete->description }}
                                        </div>
                                        <div>
                                            <a href="{{ route('todo.edit', $uncomplete->id) }}"
                                                class="btn btn-sm btn-info">
                                                Edit
                                            </a>
                                        </div>
                                        <form action="{{ route('todo.changeStatus', $uncomplete->id) }}" method="post" class="mx-2">
                                            @method('put')
                                            @csrf
                                            <button class="btn btn-sm btn-warning"
                                                onclick="return confirm('Apakah anda yakin ingin menyelesaikan tugas ini?')">
                                                <span>Undone</span>
                                            </button>
                                        </form>

                                        <form action="{{ route('todo.destroy', $uncomplete->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus tugas ini?')">
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </li>
                                </ol>
                            </div>
                            @endforeach
                        @endif
                        @if (count($completedTodos))
                            <label>Completed Tasks</label>
                            @foreach ($completedTodos as $key => $complete)
                                <ol class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">{{ $key + 1 }}. {{ $complete->title }}</div>
                                            {{ $complete->description }}
                                        </div>
                                        <div>
                                            <a href="{{ route('todo.edit', $complete->id) }}"
                                                class="btn btn-sm btn-info">
                                                Edit
                                            </a>
                                        </div>
                                        <form action="{{ route('todo.changeStatus', $complete->id) }}" method="post" class="mx-2">
                                            @method('put')
                                            @csrf
                                            <div>
                                                <button class="btn btn-sm btn-success"
                                                    onclick="return confirm('Apakah anda yakin ingin mengembalikan tugas ini?')">
                                                    <span>Done</span>
                                                </button>
                                            </div>
                                        </form>
                                        <form action="{{ route('todo.destroy', $complete->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus tugas ini?')">
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </li>
                                </ol>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Add New Task</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('todo.store') }}">
                            @csrf
                            <div>
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') ?: '' }}"
                                    autocomplete="off" required>
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
