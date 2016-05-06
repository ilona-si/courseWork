<?php
    require_once('connection.php');

    class Items{
        public static function addItem($item){
            $query = "INSERT INTO goods (name, `desc`, size, color, price, img, created) VALUES
                     		('".trim($item[name])."', '".trim($item[desc])."',
                     		'".trim($item[size])."', '".trim($item[color])."',
                     		".$item[price].", '".trim($item[img])."', now() )";
            $result= mysql_query($query);
            if (mysql_error()) return false;
            return true;
        }


        public static function addImageTo($id, $url){
             $query = "INSERT INTO gallery (good_id, url) VALUES (".$id.", '".trim($url)."')";
              $result= mysql_query($query);
              if (mysql_error()) return false;
              return true;
        }

        public static function getExcel(){
                    $xsl = new PHPExcel();
                    $xsl->setActiveSheetIndex(0);
                     $sheet = $xsl->getActiveSheet();
                     $sheet->setTitle("Goods");
                     $writer = new PHPExcel_Writer_Excel5($xsl);

                     $query = "SELECT id, name, `desc`, size, color, price, created FROM goods";
                     $result = mysql_query($query);
                     echo mysql_error();
                     while ($row = mysql_fetch_assoc($result)) $res[] = $row;
                     $array = array("#",  "Наименование", "Описание", "Размер", "Цвет", "Цена", "Добавлен");
                     $sheet->fromArray($array, NULL, "A1");
                     $sheet->fromArray($res, NULL, "A2");
                     $style = new PHPExcel_Style();
                     $style->applyFromArray(
                     			array('fill' => array(
                     				'type' => PHPExcel_Style_Fill::FILL_SOLID,
                     				'color'=>array('rgb'=>'66CC66')
                     				),
                     				'borders'=>array(
                     					'bottom'=>array('style'=>PHPExcel_Style_Border::BORDER_THIN),
                     					'right'=>array('style'=>PHPExcel_Style_Border::BORDER_THIN)
                     			)
                     		));
                     $sheet->getColumnDimension('C')->setWidth(100);
                     $sheet->getColumnDimension('B')->setAutoSize(true);
					 $sheet->getColumnDimension('E')->setAutoSize(true);
                     $sheet->getColumnDimension('F')->setAutoSize(true);
                     $sheet->getColumnDimension('G')->setAutoSize(true);
                     $writer->save('php://output');
         }

          public static function getExcelStatics(){
              $xsl = new PHPExcel();
              $xsl->setActiveSheetIndex(0);
              $sheet = $xsl->getActiveSheet();
              $sheet->setTitle("Statistics");
              $writer = new PHPExcel_Writer_Excel5($xsl);
              $query = "SELECT name, views, ordered FROM goods";
              $array = array("Наименование", "Просмотрен", "Куплен");
              $result = mysql_query($query);
              echo mysql_error();
              while ($row = mysql_fetch_assoc($result)) $res[] = $row;

              $sheet->fromArray($array, NULL, "A1");
              $sheet->fromArray($res, NULL, "A2");
              $style = new PHPExcel_Style();
              $style->applyFromArray(
              array('fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color'=>array('rgb'=>'66CC66')
                    ),
                    'borders'=>array(
                            'bottom'=>array('style'=>PHPExcel_Style_Border::BORDER_THIN),
                            'right'=>array('style'=>PHPExcel_Style_Border::BORDER_THIN)
                     )
              ));
              $sheet->getColumnDimension('A')->setAutoSize(true);
              $sheet->getColumnDimension('B')->setAutoSize(true);
 			
              $writer->save('php://output');
          }

		
		#=== G METHODS ==
	public static function getItems($amount=0){
		if($amount==0) $query="SELECT * FROM goods";
			else $query="SELECT * FROM goods ORDER BY RAND() LIMIT $amount";
			
		$result=mysql_query($query);
		echo mysql_error();
		
		while($row = mysql_fetch_assoc($result)) $res[] = $row;
		
		
		return $res;
	}
	public static function proceedName($name){
		

		$pattern = "/([a-zA-z\s]+)/";
		$subject="<i>$1</i>";
 		$name=preg_replace ( $pattern ,$subject , $name);
 		
		return $name;
	}
	
	public static function search($params){
		if ($params){
		$query = "SELECT * FROM goods WHERE ";
		if ($params["name"]) $query.= " name LIKE '%{$params['name']}%' AND ";
		if (isset($params['color'])) $query.= " color='{$params['color']}' AND ";
		if (isset($params["size"])) $query.= " size='{$params['size']}' AND ";
		if (isset($params["price_from"])) $query.= " price>={$params['price_from']} AND ";
		if (isset($params["price_to"])) $query.= " price<={$params['price_to']} AND ";
		$query.= "1";
	}
	$result = mysql_query($query);
	echo mysql_error();
	while ($row = mysql_fetch_assoc($result)) $res[] = $row;
	return $res;		
	}

	public	static	function getLatest($n=4){
	$query="SELECT * FROM goods	ORDER BY  created desc	 LIMIT $n";
	$result=mysql_query($query);
	echo mysql_error();
	while($row = mysql_fetch_assoc($result)) $res[] = $row;
	return $res;
	}

	public	static	function getPopulars($n=4){
	$query="SELECT * FROM goods	ORDER BY  views DESC LIMIT $n";
	$result=mysql_query($query);
	echo mysql_error();
	while($row = mysql_fetch_assoc($result)) $res[] = $row;
	return $res;
	}
	
	#====I FRAGMENT
	
	public static function increment($id){
		$query = mysql_query("SELECT * FROM `goods` WHERE `id`= $id ");
		$arr = mysql_fetch_assoc($query);
		if (isset($arr['size'])) {
			$counterViews = $arr['views'];
 			$counterViews+=1;
 			mysql_query("UPDATE `goods` SET `views`= $counterViews WHERE  `id`= $id ");
		}
	}
	
	public static function getById($id){
		$query = mysql_query("SELECT * FROM `goods` WHERE `id`= $id ");
 		$arr = mysql_fetch_assoc($query);
			if (isset($arr['size'])) {
				return $arr;
	    }

	}

	public static function addToOrder($id,$amount){
		$query = mysql_query("SELECT * FROM `goods` WHERE `id`= $id ");
		$arr = mysql_fetch_assoc($query);
		if (isset($arr['ordered'])) {
			$counterOrder = $arr['ordered'];
 			$counterOrder+=$amount;
 			mysql_query("UPDATE `goods` SET `ordered`= $counterOrder WHERE  `id`= $id ");
		}

	}

	public static function getGalleryImages($id){
		$query = mysql_query("SELECT * FROM `gallery` WHERE `good_id`= $id ");
		$arrPictures = array();
		while ($arr = mysql_fetch_assoc($query)) {
			$arrPictures[] = $arr['url'];
		}
		return $arrPictures;
	}


	public static function getColors(){
		$query = mysql_query("SELECT DISTINCT `color` FROM `goods` ");
		$arrColors = array();
		
		while ($arr = mysql_fetch_assoc($query)) {
			$arrColors[] = $arr['color'];
		}
		return $arrColors;
	}

	public static function getSizes(){
		$query = mysql_query("SELECT DISTINCT `size` FROM `goods` ");
		$arrColors = array();
		while ($arr = mysql_fetch_assoc($query)) {
			$arrSizes[] = $arr['size'];
		}
		return $arrSizes;
	}


}