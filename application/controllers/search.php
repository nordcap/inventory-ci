<?php
if (!defined('BASEPATH'))    exit ('No direct script access allowed');
session_start();
class Search extends CI_Controller {
  /**
  Контроллер поиска обрабатывает поиск информации по базе
  */
  function __construct() {
    parent :: __construct();
    $this->load->helper('date');
    $this->load->model('Assets_model');
    $this->load->model('Rooms_model');
    $this->load->model('Report_model');
    $this->load->model('Employee_model');
    $this->load->model('Category_model');

  }
  //основная функция контроллера
  public function index() {
    $data['page'] = "search";
    //загружаем модель и получаем необходимые данные для отображеня в виде
    $data['pager'] = NULL;
    if (isset ($_REQUEST['search'])) {
      //проверяем входные данные
      if ($this->form_validation->run('search') == TRUE) {
        //инициализация переменных из полей
        $inv_select = $this->input->post('inv_select');
        $room_select = $this->input->post('room_select');
        $price1_search = $this->input->post('price1_search');
        $price2_search = $this->input->post('price2_search');
        $date1_search = $this->format_date($this->input->post('date1_search'));
        $date2_search = $this->format_date($this->input->post('date2_search'));
        $fio_select = $this->input->post('fio_select');
        $cat_select = $this->input->post('cat_select');
        //первоначально в массив попадают только данные прошедшие валидацию
        $condition = array('Price >=' => $price1_search, 'Price <=' => $price2_search, 'Time >=' => $date1_search, 'Time <=' => $date2_search,);
        //если выбраны переключатели обязательности поиска, то добавляем условия в запрос
        if ($this->input->post('chk_inv')) {
          $condition['assets.id'] = $inv_select;
        }
        if ($this->input->post('chk_room')) {
          $condition['rooms.id'] = $room_select;
        }
        if ($this->input->post('chk_fio')) {
          $condition['employee.id'] = $fio_select;
        }
        if ($this->input->post('chk_cat')) {
          $condition['category.id'] = $cat_select;
        }
        //запрос данных
        $data['array_report'] = $this->Report_model->getdata_search($condition);

        //заносим в сессию данные
        $_SESSION['data_print'] = $data['array_report'];
      }
    }
    if (isset ($_REQUEST['clear'])) {
      //перегружаем страницу чтобы очистить поля
      redirect('search', 'refresh');
    }
    //список комнат
    $data['array_room'] = $this->Rooms_model->getRoom();
    //список инвентарных номеров
    $data['array_inv'] = $this->Assets_model->getInventory();
    //список фамилий
    $data['array_employee'] = $this->Employee_model->getFamily();
    //список категорий
    $data['array_category'] = $this->Category_model->getCategory();

    $this->load->view('main_view', $data);
  }
  //отправка на страницу печати
  //------------------------------------------------------------------
  public function in_print() {
    if ( isset($_SESSION['data_print']))
    {
      $data['array_report'] = $_SESSION['data_print'];
      $this->load->view('tables/table_print', $data);
      session_unset();
      session_destroy();
    }
    else
    {
      //перегружаем страницу чтобы очистить поля
      redirect('search', 'refresh');

    }
  }
  //форматирование строки вводимой даты с хх.хх.хххх на хххх-хх-хх в формат MYSQL
  //------------------------------------------------------------------
  public function format_date($str) {
    list($day, $month, $year) = explode('.', $str);
    return $year . '-' . $month . '-' . $day;
  }
  //проверка даты на правильность форматирования
  //------------------------------------------------------------------
  public function check_date($date) {
    if (preg_match('/[\d]{0,2}\.[\d]{1,2}\.[\d]{2,4}/', $date)) {
      list($day, $month, $year) = explode('.', $date);
      if (checkdate($month, $day, $year) === TRUE) {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }
    else {
      return FALSE;
    }
  }
  //заполнение начальной даты
  //------------------------------------------------------------------
  public function check_empty_date1($date1) {
    if (empty ($date1)) {
      return '01.01.1980';
    }
    else {
      return TRUE;
    }
  }
  //заполнение конечной даты
  //------------------------------------------------------------------
  public function check_empty_date2($date2) {
    if (empty ($date2)) {
      return mdate("%d.%m.%Y");
    }
    else {
      return TRUE;
    }
  }
  //заполнение начальной цены
  //------------------------------------------------------------------
  public function check_empty_price1($price) {
    if (empty ($price)) {
      return 0;
    }
    else {
      return TRUE;
    }
  }
  //заполнение конечной цены
  //------------------------------------------------------------------
  public function check_empty_price2($price) {
    if (empty ($price)) {
      return pow(10, 9);
    }
    else {
      return TRUE;
    }
  }
  //сравнение цен
  //------------------------------------------------------------------
  public function compare() {
    //переводим из строки в число
    $arg1 = (float) $this->input->post('price1_search');
    $arg2 = (float) $this->input->post('price2_search');
    if ($arg1 <= $arg2) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
  //сравнение дат
  //------------------------------------------------------------------
  public function compare_date() {
    $arg1 = strtotime($this->input->post('date1_search'));
    $arg2 = strtotime($this->input->post('date2_search'));
    if ($arg1 <= $arg2) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
  //заглушка для флажков
  //------------------------------------------------------------------
  public function return_true() {
    return TRUE;
  }
}
/* End of file search.php */
/* Location: ./application/controllers/search.php */