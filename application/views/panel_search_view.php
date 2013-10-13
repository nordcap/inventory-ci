<div id="panel_search" style=" padding-left: 10px; padding-top:5px; text-align:center;  ">
<?php 
//подготовка данных и шаблона табл.
//начальная цена 
/*if(isset($price_begin))
{
	$cell_input1 = array(
	'name'=>'price1_search',
	'style'=>'width: 100px;',
	'value'=>$price_begin);
}
else
{
	$cell_input1 = array(
	'name'=>'price1_search',
	'style'=>'width: 100px;',
	'value'=>set_value('price1_search'));
}*/
	$cell_input1 = array(
	'name'=>'price1_search',
	'style'=>'width: 100px;',
	'value'=>set_value('price1_search'));
	
//конечная цена 
if(isset($price_end))
{
	$cell_input2 = array(
	'name'=>'price2_search',
	'style'=>'width: 100px;',
	'value'=>$price_end);
}
else
{
	$cell_input2 = array(
	'name'=>'price2_search',
	'style'=>'width: 100px;',
	'value'=>set_value('price2_search'));
}

//начальная дата 
if(isset($date_begin))
{
	$cell_input3 = array(
	'name'=>'date1_search',
	'style'=>'width: 100px;',
	'value'=>$date_begin);
}
else
{
	$cell_input3 = array(
	'name'=>'date1_search',
	'style'=>'width: 100px;',
	'value'=>set_value('date1_search'));
}

//конечная дата 
if(isset($date2_begin))
{
	$cell_input4 = array(
	'name'=>'date2_search',
	'style'=>'width: 100px;',
	'value'=>$date2_begin);
}
else
{
	$cell_input4 = array(
	'name'=>'date2_search',
	'style'=>'width: 100px;',
	'value'=>set_value('date2_search'));
}




$cell_label1 = array(
'data'=>form_label('Инв.номер','inv_select'),
'width'=>80,);



$cell_label2 = array(
'data'=>form_label('Комната','room_select'),
'width'=>80,);

$cell_label3 = array(
'data'=>form_label('Цена от','price1_search'),
'width'=>30,);

$cell_label3_1 = array(
'data'=>form_label('Цена до','price2_search'),
'width'=>30,);

$cell_label5 = array(
'data'=>form_label('Дата от','date1_search'),
'width'=>30,);

$cell_label5_1 = array(
'data'=>form_label('Дата до','date2_search'),
'width'=>30,);

$cell_label7 = array(
'data'=>form_label('ФИО','fio_select'),
'width'=>80,);

$cell_label8 = array(
'data'=>form_label('Категория','cat_select'),
'width'=>80);


$chk_inv = array(
'name' => 'chk_inv',
'value' => 'TRUE',
'checked' => set_checkbox('chk_inv', 'TRUE', 'FALSE'));

$chk_fio = array(
'name' => 'chk_fio',
'value' => 'TRUE',
'checked' => set_checkbox('chk_fio', 'TRUE', 'FALSE'));

$chk_cat = array(
'name' => 'chk_cat',
'value' => 'TRUE',
'checked' => set_checkbox('chk_cat', 'TRUE', 'FALSE'));

$chk_room = array(
'name' => 'chk_room',
'value' => 'TRUE',
'checked' => set_checkbox('chk_room', 'TRUE', 'FALSE'));

$b1 = array('name'=>'search','id'=>'btnsearch', 'value'=>'true');
$b2 = array('name'=>'clear','id'=>'btnclear', 'value'=>'true');



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
//===================================================================
// отображение панели
print("<h3 style='padding-bottom: 10px;'>Панель поиска</h3>");

$this->table->add_row($cell_label1,form_dropdown('inv_select',$array_inv),form_checkbox($chk_inv));//номер
$this->table->add_row($cell_label2,form_dropdown('room_select',$array_room),form_checkbox($chk_room));//Комната
$this->table->add_row($cell_label3,form_input($cell_input1));//Цена от
$this->table->add_row($cell_label3_1,form_input($cell_input2));//Цена до

$this->table->add_row($cell_label5,form_input($cell_input3));//дата от
$this->table->add_row($cell_label5_1,form_input($cell_input4));//дата до
$this->table->add_row($cell_label7,form_dropdown('fio_select',$array_employee),form_checkbox($chk_fio));//ФИО
$this->table->add_row($cell_label8,form_dropdown('cat_select',$array_category),form_checkbox($chk_cat));//Категория

print $this->table->generate();
print "</div>";
//кнопки управления
print form_submit($b1);
print form_submit($b2);