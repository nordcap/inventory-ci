<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Инвентаризационная опись активов УПИРиИ</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="<?php print base_url('application/css/style.css'); ?>" type="text/css" media="screen, projection" />
  <script type="text/javascript" src="<?php print base_url('js/jquery-1.7.2.min.js');?>"></script>
  </head>
<body>
<?php
print anchor('search', 'Поиск');
//подготавливаем данные и шаблона табл.
$tmpl = array (
'table_open'          => '<table id="table_print" border="0" cellpadding="4" cellspacing="0" style="width:1000px;">',
'heading_row_start'   => '<tr class="darkblue_table" style="border-left: 1px solid gray;">',
'heading_row_end'     => '</tr>',
'heading_cell_start'  => '<th  style="border-right: 1px solid gray; padding: 0 5px 0 5px;">',
'heading_cell_end'    => '</th>',
'row_start'           => '<tr style="border-left: 1px solid gray; ">',
'row_end'             => '</tr>',
'cell_start'          => '<td style="border-right: 1px solid gray; text-align:center; padding: 0 5px 0 5px;">',
'cell_end'            => '</td>',
'row_alt_start'       => '<tr class="blue_table" style="border-left: 1px solid gray;">',
'row_alt_end'         => '</tr>',
'cell_alt_start'      => '<td style="border-right: 1px solid gray; text-align:center; padding: 0 5px 0 5px;">',
'cell_alt_end'        => '</td>',
'table_close'         => '</table>'
);
$this->table->set_template($tmpl);
$this->table->clear();
//отображение табл.
$this->table->set_heading('Инв. №','Наименование','Цена','Аморти-<br/>зация','Дата', 'Кол-во','Комната','Ответственный', 'Комментарий');
if (isset($array_report))
{
	foreach($array_report as $index=>$value)
	{
		$chk_input = array(
		'name'=>'chk_id[]',
		'value'=>$value['id'],
		'checked'=>set_checkbox('chk_id[]',$value['id'],FALSE));
		$this->table->add_row($value['Inv_id'], $value['Name'], $value['Price'], $value['Amortization'], $value['Time'], $value['Number'], $value['Num_room'], $value['Family'], $value['Comment']);
	}
}
print '<div style="width: 900px; margin-left: 10px;">';
print $this->table->generate();
print '</div>';
?>
</body>
<script  type="text/javascript">
$(document).ready(function(){
              $('#table_print tr>td:nth-child(2)').css('text-align', 'left'); //наименование
              $('#table_print tr>td:nth-child(8)').css('text-align', 'left');     //ответственный
              $('#table_print tr>td:nth-child(7)').css('width', '80px');      //комната
              $('#table_print tr>td:nth-child(8)').css('width', '120px');     //ответственный
              });
</script>

</html>