<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Инвентаризационная опись активов УПИРиИ</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="<?php print base_url('application/css/style.css');?>" type="text/css"/>
	 <script type="text/javascript" src="<?php print base_url('js/jquery-1.7.2.min.js');?>"></script>
	</head>

<body>

<div id="wrapper">

	<header id="header">
	<h1 style="font-size: 150%; color: #003366; ">АСУ-инвентаризация</h1>
			<nav>
				<ul>
					<li><?php print anchor('search', 'Поиск');?></li>
					<li><?php print anchor('assets', 'Карточки');?></li>
					<li><?php print anchor('employee', 'Сотрудники');?></li>
					<li><?php print anchor('rooms', 'Комнаты');?></li>
					<li><?php print anchor('category', 'Категории');?></li>
					<li><?php print anchor('report', 'Распределение');?></li>
					<li><?php print ('<div id="print">' . anchor($page . '/in_print', 'Печать') . '</div>');?></li>

				</ul>
			</nav>
	</header><!-- #header-->

	<section id="middle">

		<div id="container">
			<div id="content">
<?php
print validation_errors('<div style="color:red;">', '</div>');
print $pager;
//		print '<div id="print">'.anchor('print', 'Печать').'</div>';
//отображение таблиц из бд
switch ($page) {
  case 'report' :
    print form_open('report/index/' . $from);
    $this->load->view('tables/table_main_view');
    break;
  case 'assets' :
    print form_open('assets/index/' . $from);
    $this->load->view('tables/table_assets_view');
    break;
  case 'employee' :
    print form_open('employee/index/' . $from);
    $this->load->view('tables/table_employee_view');
    break;
  case 'category' :
    print form_open('category/index/' . $from);
    $this->load->view('tables/table_category_view');
    break;
  case 'rooms' :
    print form_open('rooms/index/' . $from);
    $this->load->view('tables/table_room_view');
    break;
  case 'search' :
    print form_open('search');
    $this->load->view('tables/table_search_view');
    break;
}
?>


			<p></p><!--буферная зона-->
			</div><!-- #content-->
		</div><!-- #container-->

		<aside class="sideRight">
		<!--Показываем панель поиска-->

		<?php
		switch ($page) {
		  case 'report' :
		    $this->load->view('panel_main_view');
		    break;
		  case 'assets' :
		    $this->load->view('panel_assets_view');
		    break;
		  case 'employee' :
		    $this->load->view('panel_employee_view');
		    break;
		  case 'category' :
		    $this->load->view('panel_category_view');
		    break;
		  case 'rooms' :
		    $this->load->view('panel_room_view');
		    break;
		  case 'search' :
		    $this->load->view('panel_search_view');
		    break;
		}
		print form_close();
		?>
		</aside><!-- #sideRight -->
	</section><!-- #middle-->


</div><!-- #wrapper -->
<footer id="footer">
	<strong>&copy; Budaev A. 2012</strong>
	<?php print '<br/>время выполнения скрипта  ' . $this->benchmark->elapsed_time() . ' сек.';?>
</footer><!-- #footer -->


</body>

<script type="text/javascript">
$(document).ready(function(){
							$('select[name=inv_select]').bind('change',getNameInv);//обработчик события для select
							$('select[name=inv_select]').trigger('change'); //генерация события 'change'

              $('#search tr>td:nth-child(2)').css('text-align', 'left'); //наименование
              $('#search tr>td:nth-child(8)').css('text-align', 'left'); //ответственный
              $('#search tr>td:nth-child(8)').css('width', '120px');     //ответственный

              $('#assets tr>td:nth-child(3)').css('text-align', 'left'); //наименование

              $('#report tr>td:nth-child(3)').css('text-align', 'left'); //наименование
              $('#report tr>td:nth-child(9)').css('text-align', 'left');     //ответственный
              $('#report tr>td:nth-child(9)').css('width', '120px');     //ответственный

							});
function getNameInv(eventObj)
{
	//передаём в контроллер ajax метод name_inv данные поля select. Работает только с site_url
	// то есть путь должен быть  http://localhost/inventory/index.php/ajax/name_inv
	$.post('<?php echo site_url("ajax/name_inv");?>', {'data_select':$(eventObj.target).val()}, success, "html");
}

function success(returnData){
$('#test').html(returnData);
}
</script>
</html>