<?php
class assets{
	public function warning($mensagem){
		echo '<div class="isa_warning">'.$mensagem.'</div>';
	}
	public function alert($mensagem){
		echo '<div class="isa_alert">'.$mensagem.'</div>';
	}
	public function sucesso($mensagem){
		echo '<div class="isa_success">'.$mensagem.'</div>';
	}
	public function error($mensagem){
		echo '<div class="isa_error">'.$mensagem.'</div>';
	}
	public function alert_warning($mensagem){
		echo '<div class="alert alert-warning alert-dismissible alerta fade in" role="alert">
								'.$mensagem.'
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							</div>';
	}
	public function alert_sucesso($mensagem){
		echo '<div class="alert alert-success alert-dismissible alerta fade in" role="alert">
								'.$mensagem.'
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							</div>';
	}
	
}