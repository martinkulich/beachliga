<!-- indexer::stop -->
<style type="text/css">
/* <![CDATA[ */
.mod_botdetection2 {
	padding:10px;
}
.mod_botdetection2 label {
	display:block;
}
.mod_botdetection2 .widget {
	margin-bottom: 5px;
}
.mod_botdetection2 input {
	width:360px;
}
.mod_botdetection2 input.captcha {
	width:50px;
}
.mod_botdetection2 input.submit {
	margin:0px 0 15px 100px;
	width:12em;
}
.mandatory span.mandatory {
	color:#FF0000;
}
/* ]]> */
</style>

<div class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<div class="form">
	<form action="<?php echo $this->action; ?>" method="post">
	<div class="formbody">
		<input type="hidden" name="FORM_SUBMIT" value="botdetectiondemo2" />
		<?php foreach ($this->fields as $objWidget): ?>
		<div class="widget">
			<?php echo $objWidget->generateLabel(); ?>
			<?php echo $objWidget->generateWithError(); ?>
			<?php if ($objWidget->name == 'agent_captcha') :?> 
			<?php echo " ".$objWidget->generateQuestion(); ?> 
			<?php endif; ?>
		</div> <!-- widget ende -->
		<?php endforeach; ?>
		<div class="submit_container">
  			<input type="submit" class="submit" value="<?php echo $this->submit; ?>" />
		</div>
	</div> <!-- formbody ende -->
	</form>
</div> <!-- from ende -->
<?php if($this->message):?>
<p class="message"><?php echo $this->message; ?></p>
<?php endif; ?>
<br />
<h2>ModuleBotDetection Version: <?php echo $this->version; ?></h2>
</div> <!-- class ende -->
<!-- indexer::continue -->
