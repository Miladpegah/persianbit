@extends('layouts.dashboardBasic')

@section('in_article')
  @if($questions->isEmpty())
    <h1>You didn't ASk any question</h1>
  @else
	 <h1 style="text-align: center">{{ $questions->count() }} Questions</h1>
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Question</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($questions as $question)
          <tr>
          <td>{{ $question->title }}</td>
          <td>
            <a href="{{ route('question.show', $question->id) }}">Show</a>
            <form action="{{ route('question.destroy', $question->id) }}" method="POST">
              @method('DELETE')
              @csrf
              <button class="delete-btn">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  @endif
	
@stop