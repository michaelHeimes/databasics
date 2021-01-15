<?php

/**
 * The template for the Login page
 *
 * @package DATABASICS
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php get_template_part('template-parts/hero'); ?>

	<?php get_template_part('template-parts/content-blocks'); ?>

	<?php while (have_posts()) : the_post(); ?>

		<section class="login-form">
			<div class="container">
				<div id="dblogin">
					<form>
						<div>
							<ul>
								<li class="field" id="field_email">
									<label for="input_email">Email <span class="field_required">*</span></label>
									<div class="validation_message_wrapper">
										<div id="email_error_message" class="validation_message field_hidden">This field is required.</div>
									</div>
									<div>
										<input name="input_email" id="input_email" type="email" value="" tabindex="1" size="32" />
									</div>
								</li>
								<li class="field" id="field_captcha">
									<label for="input_captcha">Anti-spam Code <span class="field_required">*</span></label>
									<div class="validation_message_wrapper">
										<div id="captcha_error_message" class="validation_message field_hidden">You didn"t enter the correct Anti-spam Code. Please try again.</div>
									</div>
									<div> <img id="field_captcha_img" class="field_captcha" src="" alt="Loading CAPTCHA" width="150" height="42" />
										<div>
											<input type="text" name="input_captcha" id="input_captcha" tabindex="2" />
										</div>
									</div>
								</li>
								<li class="field" id="field_submit">
									<button class="button button--blue btn-submit action-button" type="button" onclick="submitRequest()">Submit</button>
								</li>
								<li class="field" id="field_privacy">
									<p><a href="/privacy/" title="DATABASICS Privacy Policy" target="PRIVACYWIN" data-wpel-link="internal">DATABASICS Privacy Policy</a></p>
								</li>
							</ul>
						</div>
					</form>
				</div>
		</section><!-- .login-form -->

	<?php endwhile; // End of the loop.
	?>
	</div>

</main><!-- #main -->

<script type="text/javascript">
	var captchaSessionId = null;
	var serviceBaseUrl = 'https://drmobilehub.data-basics.net/mobilehub/';
	var captchaInitUrl = serviceBaseUrl + 'sms?$=' + encodeURIComponent('{cmd:"CaptchaInit", encode:false}');
	var jsUrl = serviceBaseUrl + 'redirect/cors_ajax.min.js?';
	var serviceError = 'Service is unavailable to handle the request, please contact your administrator.';

	document.write('<script type="text/javascript" src="' + jsUrl + '"><\/script>');

	jQuery(document).ready(function($) {
		captchaInit()
	});

	function captchaInit() {
		corsAjax(captchaInitUrl, 'get', null, function(data, status) {
			var result = eval("(" + data + ")");
			if (result && result.success) {
				captchaSessionId = result.sessionId;
				getCaptcha();
			}
		});
	}

	function getCaptcha() {
		var url = serviceBaseUrl + 'sms?$=' + encodeURIComponent('{cmd:"GetCaptcha", sessionId:"' + captchaSessionId + '"}');
		jQuery('#field_captcha_img').attr('src', url);
	}

	function submitRequest() {
		if (validateRequest()) {
			handleRedirect();
		}
	}

	function validateRequest() {
		var valid = true;
		var email = jQuery('#input_email').val();
		var captcha = jQuery('#input_captcha').val();
		if (isEmpty(email)) {
			valid = false;
			markInvalid('field_email', 'email_error_message');
		}

		if (isEmpty(captcha)) {
			valid = false;
			markInvalid('field_captcha', 'captcha_error_message', 'This field is required.');
		}

		return valid;
	}

	function handleRedirect() {
		var email = jQuery('#input_email').val();
		var captcha = jQuery('#input_captcha').val();
		var url = serviceBaseUrl + 'sms?$=' + encodeURIComponent('{cmd:"Redirect", email:"' + email + '", captcha:"' + captcha + '", sessionId:"' + captchaSessionId + '", encode:false}');
		try {
			corsAjax(url, 'get', null, function(data, status) {
				var result = eval("(" + data + ")");
				if (result && result.success) {
					if (isEmpty(result.error)) {
						var targetUrl = result.targetUrl;
						window.open(targetUrl, '_self');
					} else {
						captchaSessionId = result.sessionId;
						getCaptcha();

						var error = result.error;
						markInvalid('field_captcha', 'captcha_error_message', error);
					}

				} else {
					markInvalid('field_captcha', 'captcha_error_message', serviceError);
				}
			});
		} catch (e) {
			markInvalid('field_captcha', 'captcha_error_message', serviceError);
		}
	}

	function markInvalid(fid, msgFid, msg) {
		var fieldId = '#' + fid;
		var field = jQuery(fieldId);
		if (!field.hasClass('field_error')) {
			field.addClass('field_error')
		}

		fieldId = '#' + msgFid;
		var msgField = jQuery(fieldId);
		if (!isEmpty(msg)) {
			msgField.text(msg);
		}

		if (msgField.hasClass('field_hidden')) {
			msgField.removeClass('field_hidden')
		}
	}

	function isEmpty(v, allowBlank) {
		return v === null || v === undefined || (!allowBlank ? v === '' : false);
	}
</script>

<?php
get_footer();
