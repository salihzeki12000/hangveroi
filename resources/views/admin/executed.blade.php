<form action="" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<textarea name="text" id="text" cols="30" rows="10"></textarea>
	<input type="submit" value="BOMB">
</form>