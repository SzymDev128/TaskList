@extends('layouts.app')

@section('title',isset($task) ? 'Edit Task' : 'Add Task')



@section('content')
    <form method="POST" action="{{isset($task) ? route('tasks.update',['task'=>$task->id]) : route('tasks.store') }}">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div>
            <label for="title" class="block uppercase text-slate-800 mb-2">
                Title
            </label>
            <input
                class="shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text" name="title" id="title" value="{{$task->title ?? old('title') }}"/>
            @error('title')
            <p class="text-red-500 text-sm">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="description" class="block uppercase text-slate-800 mb-2">Description</label>
            <textarea name="description" id="description"
                      class="shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline"
                      rows="5"> {{$task->description ?? old('description')}}
            </textarea>
            @error('description')
            <p class="text-red-500 text-sm">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="long_description" class="block uppercase text-slate-800 mb-2">Long Description</label>
            <textarea name="long_description" id="long_description"
                      class="shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline"
                      rows="10"> {{$task->long_description ?? old('long_description')}}
            </textarea>
            @error('long_description')
            <p class="text-red-500 text-sm">{{$message}}</p>
            @enderror
        </div>
        <div>
            <button type="submit"
                    class="rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/10 hover:slate-500 text-slate-500">
                @isset($task)
                    Update Task
                @else
                    Add Task
                @endisset
            </button>
        </div>
    </form>
@endsection
