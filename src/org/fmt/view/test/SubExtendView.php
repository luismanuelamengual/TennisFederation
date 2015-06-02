
<?php $this->loadScript("org\\fmt\\view\\test\\ExtendView"); ?>

<?php $this->beginContent("header"); ?>
Esta es la cabecera.
<?php $this->endContent(); ?>

<?php $this->beginContent("header"); ?>
Esto tambien va en la cabecera.
<?php $this->loadScript("org\\fmt\\view\\test\\innerView", array("name"=>"Chippolaz")); ?>
<?php $this->loadScript("org\\fmt\\view\\test\\innerView", array("name"=>"Ramon")); ?>
<br>yES optus !!
<?php $this->endContent(); ?>
