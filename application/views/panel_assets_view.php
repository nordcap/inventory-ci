<div id="panel_assets" style= "padding-left: 10px;padding-top:5px; text-align:center;  ">
<?php 
//подготовка данных и шаблона табл.
//
if(isset($num_inventory))
{
	$cell_input1 = array(
	'name'=>'number_assets',
	'style'=>'width: 100px;',
	'value'=>$num_inventory);
}
else
{
	$cell_input1 = array(
	'name'=>'number_assets',
	'style'=>'width: 100px;',
	'value'=>set_value('number_assets'));
}
if(isset($nm_assets))
{
	$cell_input2 = array(
	'name'=>'name_assets',
	'style'=>'width: 100px;',
	'value'=>$nm_assets);
}
else
{
	$cell_input2 = array(
	'name'=>'name_assets',
	'style'=>'width: 100px;',
	'value'=>set_value('name_assets'));
}
if(isset($price))
{
	$cell_input3 = array(
	'name'=>'price_assets',
	'style'=>'width: 100px;',
	'value'=>$price);
}
else
{
	$cell_input3 = array(
	'name'=>'price_assets',
	'style'=>'width: 100px;',
	'value'=>set_value('price_assets'));
}
if(isset($amortization))
{
	$cell_input4 = array(
	'name'=>'amortization_assets',
	'style'=>'width: 100px;',
	'value'=>$amortization);
}
else
{
	$cell_input4 = array(
	'name'=>'amortization_assets',
	'style'=>'width: 100px;',
	'value'=>set_value('amortization_assets'));
}
//??????????????????????????????????????????????????????
if(isset($date))
{
	$cell_input5 = array(
	'name'=>'date_assets',
	'style'=>'width: 100px;',
	'value'=>$date);
}
else
{
	$cell_input5 = array(
	'name'=>'date_assets',
	'style'=>'width: 100px;',
	'value'=>set_value('date_assets'));
}
//при копировании определяем выбранный элемент в списке
if (isset($category_id))
{
	$selected = $category_id;
}
else
{
	$selected = false;
}
$cell_label1 = array(
	'data'=>form_label('Инв. номер','number_assets'),
	'width'=>80,);
$cell_label2 = array(
	'data'=>form_label('Наименование','name_assets'),
	'width'=>80,);
$cell_label3 = array(
	'data'=>form_label('Цена','price_assets'),
	'width'=>80,);
$cell_label4 = array(
	'data'=>form_label('Амортизация','amortization_assets'),
	'width'=>80,);
$cell_label5 = array(
	'data'=>form_label('Дата','date_assets'),
	'width'=>80,);
$cell_label6 = array(
	'data'=>form_label('Категория','cat_select'),	
	'width'=>80,);

$chk_inv = array(
'name' => 'chk_inv',
'value' => 'TRUE',
'checked' => set_checkbox('chk_inv', 'TRUE', 'FALSE'));

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
print("<h3 style='padding-bottom: 10px;'>Заполнение карточки</h3>");
$this->table->add_row($cell_label1,form_input($cell_input1),form_checkbox($chk_inv));
$this->table->add_row($cell_label2,form_input($cell_input2));
$this->table->add_row($cell_label3,form_input($cell_input3));
$this->table->add_row($cell_label4,form_input($cell_input4));
$this->table->add_row($cell_label5,form_input($cell_input5)); 
$this->table->add_row($cell_label6,form_dropdown('cat_select',$array_category, $selected));
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