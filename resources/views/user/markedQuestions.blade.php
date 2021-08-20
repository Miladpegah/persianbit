@extends('layouts.dashboardBasic')

@section('in_article')
  @if($user->followQuestions->isEmpty())
      <h1 style="text-align: center">Nothing followed</h1>
  @else
      <h1 style="text-align: center">{{ $followQuestions->count() }} questions are followed</h1>
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($followQuestions as $followed)
            <tr>
              <td>{{ $followed->question->title }}</td>
              <td>
                <a href="{{ route('question.show', $followed->question->id) }}">Show</a>
                <form action="{{ route('unfollow.question', [$followed->user->id, $followed->question->id]) }}" method="POST">
                  @csrf
                  <button class="delete-btn">Unfollow</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
@stop