jQuery(document).ready(function ($) {
	// play video in modal
	$('.video-embed--modal[data-youtube-id]').click(function (e) {
		var videoId = $(this).data('youtube-id');
		console.log('videoId', videoId);
		var videoEmbed = $('<iframe width="420" height="315" frameborder="0" allowfullscreen></iframe>')
			.attr('src', 'https://www.youtube.com/embed/' + videoId);
		$('.modal .modal-body .video-embed').html(videoEmbed);
		$('.modal').addClass('show');
		$('body').css('overflow', 'hidden');
	});

	$('.modal-close button', '.modal').click(function() {
		$('.modal').removeClass('show');
		$('body').css('overflow', 'auto');
	})
});
