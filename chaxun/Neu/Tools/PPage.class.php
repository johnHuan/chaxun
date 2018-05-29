<?php

/*
 * john_3 web俱乐部
 * ============================================================================
 * * 版权所有 2016-2026 john_3网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.John_3.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * DATE:2016年8月23日;
 * TIME:下午8:49:35;
 * {supporter: yun};
 * author:john;
 * 字符编码：UTF-8
 * PHP;
 */

/**
 * Tools名称与上级名称一致，该类文件在做自动加载的时候，Tools名称会转换为目录
 * 的一部分，进而include引入当前类文件
 */
namespace Tools;

/**
 * 分页类
 *
 * @author john
 *        
 */
class PPage {
	private $total; // 数据表中总记录数
	private $listRows; // 每页显示条数；
	private $limit; //sql语句最后得LIMIT属性 (LIMIT 10,1;)
	private $uri;
	private $pageNum; // 页数
	private $listNum = 10; // 限制页码数目  左右偏移量各为5
	private $config = array (
			'header' => "条记录",
			"prev" => "上一页",
			"next" => "下一页",
			"first" => "首页",
			"last" => "尾页" 
	);
	
	/**
	 *
	 * @param unknown $total        	
	 * @param number $listRows        	
	 * @param string $pa        	
	 */
	public function __construct($total, $listRows = 10, $pa = "") {
		$this->total = $total;
		$this->listRows = $listRows;
		$this->uri = $this->getUri ( $pa );
		$this->page = ! empty ( $_GET ["page"] ) ? $_GET ["page"] : 1;
		$this->pageNum = ceil ( $this->total / $this->listRows );
		$this->limit = $this->setLimit ();
	}
	
	/**
	 *
	 * @return string
	 */
	private function setLimit() {
		return "Limit " . ($this->page - 1) * $this->listRows . ",{$this->listRows}";
	}
	
	/**
	 *
	 * @param unknown $pa        	
	 * @return string
	 */
	private function getUri($pa) {
		$url = $_SERVER ["REQUEST_URI"] . (strpos ( $_SERVER ["REQUEST_URI"], '?' ) ? '' : '?') . $pa;
		$parse = parse_url ( $url );
		
		if (isset ( $parse ["query"] )) {
			parse_str ( $parse ["query"], $params );
			unset ( $params ["page"] );
			$url = $parse ['path'] . '?' . http_build_query ( $params );
		}
		return $url;
	}
	
	/**
	 *
	 * @param unknown $args        	
	 * @return NULL
	 */
	public function __get($args) {
		if ($args == "limit")
			return $this->limit;
		else
			return null;
	}
	
	/**
	 *
	 * @return number
	 */
	private function start() {
		if ($this->total == 0)
			return 0;
		else
			return ($this->page - 1) * $this->listRows + 1;
	}
	
	/**
	 *
	 * @return mixed
	 */
	private function end() {
		return min ( $this->page * $this->listRows, $this->total );
	}
	
	/**
	 *
	 * @return string
	 */
	private function first() {
		$html = "";
		if ($this->page == 1)
			$html .= '';
		else
			$html .= "<li><a href='{$this->uri}&page=1'>{$this->config["first"]}</a></li>";
		return $html;
	}
	private function prev() {
		$html = "";
		if ($this->page == 1)
			$html .= '';
		else
			$html .= "<li><a  href='{$this->uri}&page=" . ($this->page - 1) . "'>{$this->config["prev"]}</a></li>";
		return $html;
	}
	
	/**
	 *
	 * @return string
	 */
	private function pageList() {
		$linkPage = "";
		$inum = floor ( $this->listNum / 2 );
		
		for($i = $inum; $i >= 1; $i --) {
			$page = $this->page - $i;
			if ($page < 1)
				continue;
			
			$linkPage .= "<li><a href='{$this->uri}&page={$page}'>{$page}</a></li>";
		}
		
		$linkPage .= "<li class='active'><a>{$this->page}</a></li>";
		
		for($i = 1; $i <= $inum; $i ++) {
			$page = $this->page + $i;
			if ($page <= $this->pageNum)
				$linkPage .= "<li><a href='{$this->uri}&page={$page}'>{$page}</a><li>";
			else
				break;
		}
		return $linkPage;
	}
	
	/**
	 *
	 * @return string
	 */
	private function next() {
		$html = "";
		if ($this->page == $this->pageNum)
			$html .= "";
		else
			$html .= "<li><a href='{$this->uri}&page=" . ($this->page + 1) . "'>{$this->config["next"]}</a></li>";
		return $html;
	}
	
	/**
	 *
	 * @return string
	 */
	private function last() {
		$html = '';
		if ($this->page == $this->pageNum)
			$html .= "";
		else
			$html .= "<li><a href='{$this->uri}&page=" . ($this->pageNum) . "'>{$this->config["last"]}</a></li>";
		return $html;
	}
	
	/**
	 *
	 * @return string
	 */
	private function goPage() {
		return '&nbsp;&nbsp;<input type="text" style="width:35px;" onkeydown="javascript:if(event.keyCode==13){var page=(this.value>' . $this->pageNum . ')?' . $this->pageNum . ':this.value;location=\'' . $this->uri . '&page=\'+page+\'\'}" value="' . $this->page . '" style="width:25px;"><input type="button" class="btn btn-default small" value="GO" onclick="javascript:var page=(this.previousSibling.value>' . $this->pageNum . ')?' . $this->pageNum . ':this.previousSibling.value; location=\'' . $this->uri . '&page=\'+page+\'\'">&nbsp;&nbsp;';
	}
	
	/**
	 *
	 * @param unknown $display        	
	 * @return string
	 */
	public function fpage($display = array(0,1,2,3,4,5,6,7,8)) {
		$html [0] = "&nbsp;共有<b>{$this->total}</b>{$this->config["header"]}&nbsp;";
		$html [1] = "&nbsp;每页显示<b>" . ($this->end () - $this->start () + 1) . "</b>条，本页<b>{$this->start()}-{$this->end()}</b>条&nbsp;";
		$html [2] = "&nbsp;<b>{$this->page}/{$this->pageNum}</b>页&nbsp;";
		$html [3] = $this->first ();
		$html [4] = $this->prev ();
		$html [5] = $this->pageList ();
		$html [6] = $this->next ();
		$html [7] = $this->last ();
		$html [8] = $this->goPage ();
		$fpage = '';
		foreach ( $display as $index ) {
			$fpage .= $html [$index];
		}
		return $fpage;
	}
}

	
	












