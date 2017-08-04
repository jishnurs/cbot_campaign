<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>Login success!</h1>
			</div>
			<p>You are now logged in.</p>
		</div>
	</div>
	<?php 
	if(!empty($status_message)){?>
		<div class="row">
			<div class="col-md-12">
					<!-- <h1>Login success!</h1> -->
				<p style="color: green;"><?=$status_message?></p>
			</div>
		</div>
	<?php }
	 ?>
	<div class="row">
		<div class="col-md-6">
			<?= form_open('send-doc-email') ?>
				<div class="form-group">
					<label for="mailType">Mail type</label>
					<select class="form-control" id="mailTypeId" name="mailTypeId">
						<option>-- Select mail type --</option>
						<option value="1" selected="selected">Doctor Website Offer</option>
						<option value="2">User Website Offer</option>
					</select>
				</div>
				<div class="form-group">
					<label for="toemail">To email</label>
					<input type="text" class="form-control" id="toEmail" name="toEmail" placeholder="To email">
				</div>
				<div class="form-group">
					<label for="subject">Subject</label>
					<input type="text" class="form-control" list="subject" name="subject" placeholder="Subject" value="2nd-anniversary big offer, Doctors Premium website for Rs 4999/- only Hurry!" autocomplete="off">
					<datalist id="subject">
						<option value="Low cost Premium website from Team Medpicky">
						<option value="User Website Offer">
						<option value="2nd-anniversary big offer, Doctors Premium website for Rs 4999/- only Hurry!">
					</datalist>
				</div>
				
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Send email">
				</div>
			</form>
		</div>
	</div>
</div><!-- .container -->