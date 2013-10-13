<?php
//подготавливаем данные и шаблона табл.
$tmpl = array (
'table_open'          => '<table border="0" cellpadding="4" cellspacing="0" style="width:250px;">',
'heading_row_start'   => '<tr class="darkblue_table" style="border-left: 1px solid gray;">',
'heading_row_end'     => '</tr>',
'heading_cell_start'  => '<th  style="border-right: 1px solid gray; padding: 0 5px 0 5px;">',
'heading_cell_end'    => '</th>',
'row_start'           => '<tr style="border-left: 1px solid gray;">',
'row_end'             => '</tr>',
'cell_start'          => '<td style="border-right: 1px solid gray; padding: 0 5px 0 5px;">',
'cell_end'            => '</td>',
'row_alt_start'       => '<tr class="blue_table" style="border-left: 1px solid gray;">',
'row_alt_end'         => '</tr>',
'cell_alt_start'      => '<td style="border-right: 1px solid gray; padding: 0 5px 0 5px;">',
'cell_alt_end'        => '</td>',
'table_close'         => '</table>'
);
$this->table->set_template($tmpl);
$this->table->clear();
//отображение табл.
$this->table->set_heading('','id','имя категории');
if (isset($array_category))
{
	foreach($array_category as $index=>$value)
	{
		$chk_input = array(
		'name'=>'chk_id[]',
		'value'=>$value['id'],
		'checked'=>set_checkbox('chk_id[]',$value['id'],FALSE));
		$this->table->add_row(form_checkbox($chk_input), $value['id'],$value['Name_Category']);
	}
}
print '<div style="width: 830px; margin-left: 10px;">';
print $this->table->generate();
print '</div>';