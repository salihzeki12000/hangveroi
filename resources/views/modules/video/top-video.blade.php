@if($articleItem)
<div class="video-right">
	<iframe src="{{ get_video_youtube($articleItem->link) }}?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
</div>
@endif