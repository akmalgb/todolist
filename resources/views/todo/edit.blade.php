@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Edit Task
                    </div>
                    <div class="card-body">
                        <form action="{{ route('todo.update', $todo->id) }}" method="post">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Title</label>
                                <div class="col-md-6">
                                    <input type="text" name="title" class="form-control" value="{{ old('title') ?: $todo->title }}" autocomplete="off" required>
                                    @error('title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Description</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="description" rows="3">{{ $todo->description }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
