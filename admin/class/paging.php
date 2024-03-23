<?php
class paging
{
	public $total;			// Total records in DB  
	public $limit;		// Records per page to display
	//public $total_page;			// Total Pages
	public $page;			// Fix Page length to display
	public $maxpage = 15;
	private $limitpage = 7;
	private $total_page;
	public $html; // Html Code for display
	public $url;

	public function totalpage()
	{
		if ($this->total > $this->limit) {
			$res = @ceil($this->total / $this->limit);
			$this->total_page = $res;
			return $res;
		}
	}

	public function display($name_function)
	{
		if ($this->totalpage()) {
			if ($this->total_page > $this->maxpage) {
				//Trường hợp phải thêm dấu mũi tên đầu cuối do số lượng trang vượt maxpage
				$start = $this->page - $this->limitpage;
				if (($this->page - $this->limitpage) > 0) $this->html .= "
															<li onclick='return " . $name_function . "(1)'>
																<a  href='javascript:;'><i class='fa fa-angle-double-left' aria-hidden='true'></i></a>
															</li>
															<li onclick='return " . $name_function . "(" . $start . ")' ><a title='trở lại'  href='javascript:;'> <i class='fa fa-angle-double-left' aria-hidden='true'></i> </a></li>";

				// ======================
				if ($this->page > $this->limitpage) {

					if (($this->page + $this->limitpage) >= $this->total_page)
						$end = $this->total_page;
					else
						$end = $this->page + $this->limitpage;

					for ($i = $start; $i <= $end; $i++) {
						$this->html .= "<li class='" . ($this->page == $i ? "active" : "") . "' onclick='return " . $name_function . "(" . $i . ")'><a href='javascript:;'>" . $i . "</a></li>";
					}
				} else {
					for ($i = 1; $i <= $this->maxpage; $i++) {
						$this->html .= "<li class='" . ($this->page == $i ? "active" : "") . "' onclick='return " . $name_function . "(" . $i . ")'><a href='javascript:;'>" . $i . "</a></li>";
					}
				}
				// ======================


				if ((($this->page - $this->limitpage) < $this->total_page) && ($this->total_page - $this->page) > $this->limitpage) {
					$this->html .= "<li class='' onclick='return " . $name_function . "(" . $i . ")'>
										<a title='đi tiếp'  href='javascript:;'> 
											<i class='fa fa-angle-double-right' aria-hidden='true'></i>
										</a>
									</li>";

					$this->html .= "	<li class='' onclick='return " . $name_function . "(" . $this->total_page . ")'>
										<a  title='Đi đến trang cuối cùng' href='javascript:;'><i class='fa fa-angle-double-right' aria-hidden='true'></i></a>
									</li>";
				}
			} else {
				for ($i = 1; $i <= $this->total_page; $i++) {
					$this->html .= "<li class='" . ($this->page == $i ? "active" : "") . "' onclick='return " . $name_function . "(" . $i . ")'><a href='javascript:;'>" . $i . "</a></li>";
				}
			}
		}

		if ($this->html != '')  $this->html = "<ul class='pagination m-n' style='margin-bottom: 0px;'>" . $this->html . "</ul>";

		return $this->html . '';
	}
}
$paging = new paging();
