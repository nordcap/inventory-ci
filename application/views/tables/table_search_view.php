<?php
//подготавливаем данные и шаблона табл.
$tmpl = array (
'table_open'          => '<table id= "search" border="0" cellpadding="4" cellspacing="0" >',
'heading_row_start'   => '<tr class="darkblue_table" style="border-left: 1px solid gray;">',
'heading_row_end'     => '</tr>',
'heading_cell_start'  => '<th  style="border-right: 1px solid gray; padding: 0 5px 0 5px;">',
'heading_cell_end'    => '</th>',
'row_start'           => '<tr style="border-left: 1px solid gray;">',
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
$this->table->set_heading('Инв. №','Наименование','Цена','Аморти<br />зация','Дата', 'Количество','Комната','Ответственный','Категория', 'Комментарий');
if (isset($array_report))
{
	foreach($array_report as $index=>$value)
	{
		$this->table->add_row($value['Inv_id'], $value['Name'], $value['Price'], $value['Amortization'], $value['Time'], $value['Number'], $value['Num_room'], $value['Family'], $value['Name_Category'], $value['Comment']);
	}
}
print '<div style="width: 830px; margin-left: 10px;">';
print $this->table->generate();
echo $this->table->clear();
print '</div>';