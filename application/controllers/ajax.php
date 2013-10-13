<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller{
	/**
	контроллер ajax 
	*/

	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function name_inv()
	{
		//$this->output->enable_profiler(true);
		$this->load->model('Assets_model');
		//получаем данные из вида main_view - id инвентарного компонента

			$cell_inv_name = array(
								'name'=>'name_inventory',
								'rows'=>5,
								'cols'=>10,
								'readonly'=>TRUE,
								'value'=>$this->Assets_model->getname_is_id($this->input->post('data_select')));
		echo form_textarea($cell_inv_name);


	}
	

}
/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */


