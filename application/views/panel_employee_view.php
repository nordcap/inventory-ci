<div id="panel_employee " style= "padding-left: 10px;padding-top:5px; text-align:center;  ">
<?php 
//подготовка данных и шаблона табл.
//
if(isset($name_employee))
{
	$cell_input = array(
	'name'=>'family',
	'value'=>$name_employee);
}
else
{
	$cell_input = array(
	'name'=>'family',
	'value'=>set_value('family'));
}
$cell_label = array(
'data'=>form_label('ФИО','family'),
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
'row_start'           => '<tr>',
'row_end'             => '</tr>',
'cell_start'          => '<td>',
'cell_end'            => '</td>',
'row_alt_start'       => '<tr>',
'row_alt_end'         => '</tr>',
'cell_alt_start'      => '<td>',
'cell_alt_end'        => '</td>',
'table_close'         => '</table>'
);
$this->table->set_template($tmplp);
$this->table->clear();
//===================================================================
// отображение панели
print("<h3 style='padding-bottom: 10px;'>Заполнение ответственных</h3>");
$this->table->add_row($cell_label,form_input($cell_input));
print $this->table->generate();
print "</div>";
//кнопки управления
print form_submit($b1);
print form_submit($b2);
print form_submit($b3);
print form_submit($b4);