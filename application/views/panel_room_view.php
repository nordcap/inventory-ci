<div id="panel_room " style= "padding-left: 10px;padding-top:5px; text-align:center;  ">
<?php 
//подготовка данных и шаблона табл.
//
if(isset($num_room))
{
	$cell_input = array(
	'name'=>'room',
	'style'=>'width: 100px;',
	'value'=>$num_room);
}
else
{
	$cell_input = array(
	'name'=>'room',
	'style'=>'width: 100px;',
	'value'=>set_value('room'));
}
//при копировании определяем выбранный элемент в списке
if (isset($employee_id))
{
	$selected = $employee_id; 	
}
else
{
	$selected = false;
}


$cell_label1 = array(
'data'=>form_label('Комната','room'),
'width'=>50,);

$cell_label2 = array(
'data'=>form_label('Ответственный','emp_select'),
'width'=>50,);


$b1 = array('name'=>'add','id'=>'btnadd', 'value'=>'true');
$b2 = array('name'=>'copy','id'=>'btncopy', 'value'=>'true');
$b3 = array('name'=>'update','id'=>'btnupdate', 'value'=>'true');
$b4 = array('name'=>'delete','id'=>'btndelete', 'value'=>'true');

$tmplp = array (
'table_open'          => '<table border="0" cellpadding="4" cellspacing="0">',
'heading_row_start'   => '<tr>',
'heading_row_end'     => '</tr>',
'heading_cell_start'  => '<th>',
'heading_cell_end'    => '</th>',
'row_start'           => '<tr style="height: 30px;">',
'row_end'             => '</tr>',
'cell_start'          => '<td style="text-align:left;">',
'cell_end'            => '</td>',
'row_alt_start'       => '<tr style="height: 30px;">',
'row_alt_end'         => '</tr>',
'cell_alt_start'      => '<td style="text-align:left;">',
'cell_alt_end'        => '</td>',
'table_close'         => '</table>'
);

$this->table->set_template($tmplp);
$this->table->clear();
//===================================================================
// отображение панели
print("<h3 style='padding-bottom: 10px;'>Заполнение комнат</h3>");
$this->table->add_row($cell_label1,form_input($cell_input));
$this->table->add_row($cell_label2,form_dropdown('emp_select',$array_employee, $selected));
print $this->table->generate();
print "</div>";
//кнопки управления
print form_submit($b1);
print form_submit($b2);
print form_submit($b3);
print form_submit($b4);