<div id="panel_main" style= "padding-left: 10px;padding-top:5px; text-align:center;  ">
<?php 
//подготовка данных и шаблона табл.

//Дата
if(isset($amount))
{
	$cell_input1 = array(
	'name'=>'amount',
	'style'=>'width: 100px;',
	'value'=>$amount);
}
else
{
	$cell_input1 = array(
	'name'=>'amount',
	'style'=>'width: 100px;',
	'value'=>set_value('amount'));
}

//комментарий
if(isset($comment))
{
	$comment_field = array(
	'name'=>'comment',
	'style'=>'width: 100px;',
	'value'=>$comment);
}
else
{
	$comment_field = array(
	'name'=>'comment',
	'style'=>'width: 100px;',
	'value'=>set_value('comment'));
}


$cell_inv_name = array(
	'name'=>'name_inventory',
	'rows'=>2,
	'cols'=>15,
	'readonly'=>TRUE);


	
//при копировании определяем выбранный элемент в списке
if (isset($inv_id))
{
	$selected_inv = $inv_id; 	
}
else
{
	$selected_inv = false;
}

if (isset($room_id))
{
	$selected_room = $room_id; 	
}
else
{
	$selected_room = false;
}


$cell_label1 = array(
'data'=>form_label('Инв.номер','inv_select'),
'width'=>80,);



$cell_label2 = array(
'data'=>form_label('Комната','room_select'),
'width'=>80,);

$cell_label3 = array(
'data'=>form_label('Количество','amount'),
'width'=>80,);

$cell_label4 = array(
'data' => form_label('Название', 'inv_name'),
'width'=>80,
);

$cell_label5 = array(
'data' => form_label('Комментарий', 'comment'),
'width'=>80,
);

$chk_inv = array(
'name' => 'chk_inv',
'value' => 'TRUE',
'checked' => set_checkbox('chk_inv', 'TRUE', 'FALSE'));

$chk_room = array(
'name' => 'chk_room',
'value' => 'TRUE',
'checked' => set_checkbox('chk_room', 'TRUE', 'FALSE'));


$b1 = array('name'=>'add','id'=>'btnadd', 'value'=>'true');
$b2 = array('name'=>'copy','id'=>'btncopy', 'value'=>'true');
$b3 = array('name'=>'update','id'=>'btnupdate', 'value'=>'true');
$b4 = array('name'=>'delete','id'=>'btndelete', 'value'=>'true');
$b5 = array('name'=>'search','id'=>'btnsearch', 'value'=>'true', 'style'=>'margin-top:0px');

$tmplp = array (
'table_open'          => '<table border="0" cellpadding="4" cellspacing="0">',
'heading_row_start'   => '<tr>',
'heading_row_end'     => '</tr>',
'heading_cell_start'  => '<th>',
'heading_cell_end'    => '</th>',
'row_start'           => '<tr style="height: 25px;">',
'row_end'             => '</tr>',
'cell_start'          => '<td style="text-align:left;">',
'cell_end'            => '</td>',
'row_alt_start'       => '<tr  style="height: 25px;">',
'row_alt_end'         => '</tr>',
'cell_alt_start'      => '<td style="text-align:left;">',
'cell_alt_end'        => '</td>',
'table_close'         => '</table>'
);

$this->table->set_template($tmplp);
$this->table->clear();
//===================================================================
// отображение панели
print("<h3 style='padding-bottom: 10px;'>Панель распределения средств</h3>");

$this->table->add_row($cell_label1,form_dropdown('inv_select',$array_inv, $selected_inv),form_checkbox($chk_inv));//номер
$this->table->add_row($cell_label4, '<div id="test">'.form_textarea($cell_inv_name).'</div>');//наименование
$this->table->add_row($cell_label2,form_dropdown('room_select',$array_room, $selected_room),form_checkbox($chk_room));//Комната
$this->table->add_row($cell_label3,form_input($cell_input1));//Дата
$this->table->add_row($cell_label5,form_input($comment_field));//комментарий

print $this->table->generate();
print "</div>";
//кнопки управления
print form_submit($b1);
print form_submit($b2);
print form_submit($b3);
print form_submit($b4);
print form_submit($b5);
$b6 = array('name'=>'clear','id'=>'btnclear_1', 'value'=>'true','style'=>'margin-top:0px');
print form_submit($b6);