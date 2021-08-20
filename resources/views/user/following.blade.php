@extends('layouts.dashboardBasic')

@section('in_article')
	<h1 style="text-align: center">4 questions is followed</h1>
	<table class="table table-dark">
  <tbody>
    @foreach($followings as $following)
    <?php $followed = $user->where('id', $following->following_id)->first(); ?>
      <tr>
        <th scope="row"><img src="{{ $followed->photo_path }}" style="width: 3%;"></th>
        <td><a href="{{ route('user.show', $followed) }}">{{ $followed->name }}</a></td>
        <td>
          <form action="{{ route('user.unfollow', [$user, $followed]) }}" method="POST">
            @csrf
            <button type="submit" name="submit" class="delete-btn">unfollow</button>
          </form>
      </td>
      </tr>
    @endforeach
   </tbody>
</table>
@stop