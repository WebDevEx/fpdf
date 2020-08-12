<?php

/*
* FPDF - http://www.fpdf.org/
* EasyTable - https://github.com/fpdf-easytable/fpdf-easytable
*/

//namespace fpdf;
require("easytable/exfpdf.php");
require("easytable/easytable.php");
//look it`s original file
// use fpdf\FPDF;
//use easytable\easyTable;

class Torg12PDF extends exFPDF
{

	protected $titlePDF = 'torg12'; // Заголовок документа

	protected $sum_count = 0;	// Счетчик кол-ва товаров
	protected $sum_price = 0; 	// Счетчик цены товаров

	protected $products = []; 	// Товары накладной

	protected $lang = [

		// Header
	
		'forma' 			=> "Унифицированная форма № ТОРГ-12\nУтверждена постановлением Госкомстата России от 25.12.98 №132",

		'shipper_title' 		=> "Грузоотправитель",
		'consignee_title' 		=> "Грузополучатель",
		'supplier_title' 		=> "Поставщик",
		'payer_title' 			=> "Платильщик",
		'base_title' 			=> "Основание",

		'shipper_value' 		=> "Грузоотправитель не указан",
		'consignee_value' 		=> "Грузополучатель не указан",
		'supplier_value' 		=> "Поставщик не указан",
		'payer_value' 			=> "Платильщик не указан",
		'base_value' 			=> "",

		'entity_description' 		=> "организация, адрес, телефон, факс, банковские реквизиты",
		'base_description' 		=> "договор, заказ-наряд",

		'codes' 			=> "Коды",
		'forma_okyd' 			=> "Форма по ОКУД",
		'code_okyd' 			=> "0330212",
		'by_okpo' 			=> "по ОКПО",
		'view_okdp' 			=> "Вид деятельности по ОКДП",
		'code_okdp' 			=> "",

		'shipper_okpo' 			=> "не указан",
		'consignee_okpo' 		=> "",
		'supplier_okpo' 		=> "не указан",
		'payer_okpo' 			=> "",

		'number' 			=> "номер",
		'date' 				=> "дата",
		'waybill' 			=> "Транспортная накладная",		
		'type_operation' 		=> "Вид операции",

		'packing_list' 			=> "ТОВАРНАЯ НАКЛАДНАЯ",

		'number_up' 			=> "Номер",
		'invoice_number' 		=> "не указан",

		'date_up' 			=> "Дата составления",
		'invoice_date' 			=> "не указана",

		// Product table

		'number_in_order' 		=> "Номер по порядку",
		'product' 			=> "Товар",
		'unit_measurement' 		=> "Единица измерения",
		'type_packaging' 		=> "Вид упаковки",
		'amount' 			=> "Количество",
		'gross_weight' 			=> "Масса брутто",
		'amount_weight' 		=> "Количество (масса нетто)",
		'price' 			=> "Цена, руб. коп.",
		'price_without_nds' 		=> "Сумма без учёта НДС, руб. коп",
		'nds' 				=> "НДС",
		'price_with_nds' 		=> "Сумма с учётом НДС, руб. коп.",

		'full_name' 			=> "наименование, характеристика, сорт, артикул товара",
		'code' 				=> "код",
		'name' 				=> "наименование",
		'code_okei' 			=> "код по ОКЕИ",
		'in_one_place' 			=> "в одном месте",
		'places_pieces' 		=> "мест, штук",
		'rate' 				=> "ставка, %",
		'summa' 			=> "сумма, руб. коп.",

		'pcs' 				=> "шт.",
		'code_okei' 			=> "796",
		'without_nds' 			=> "без НДС",
		'total' 			=> "Итого",
		'total_invoice' 		=> "Всего по накладной",

		'sum_format' 			=> '0,00',
		'sum_words' 			=> 'Ноль рублей 00 копеек',
		'count' 			=> '0',
		'count_words' 			=> 'ноль',

		// Footer

		'applications_title' 		=> "Товарная накладная имеет приложения на",
		'applications_value' 		=> "",

		'contains_title' 		=> "и содержит",

		'serial_numbers' 		=> "порядковых номеров записей",

		'total_places_title' 		=> "Всего мест",

		'cargo_weight_title' 		=> "Масса груза (нетто)",
		'cargo_weight_value' 		=> "",

		'weight_gross_title' 		=> "Масса груза (брутто)",
		'weight_gross_value' 		=> "",

		'in_words' 			=> "(прописью)",
		'by_to' 			=> "кем, кому (организация, место работы, должность, фамилия, и., о.)",
		'position' 			=> "должность",
		'signature' 			=> "подпись",
		'decryption_signature' 		=> "расшифровка подписи",

		'm_p' 				=> "М.П.",

		// Left column

		'application' 			=> "Приложение (паспорта, сертификаты) на",
		'sheets_value' 			=> "",
		'sheets' 			=> "листах",

		'sum_words_title' 		=> "Всего отпущено на сумму",
		'sum_words' 			=> "Ноль рублей 00 копеек",

		'shipment_allowed' 		=> "Отпуск груза разрешил",
		'shipment_allowed_position' 	=> "не указано",
		'sshipment_allowed_fio' 	=> "не указано",

		'accountant' 			=> "Главный (старший) бухгалтер",
		'accountant_fio' 		=> "не указано",

		'shipment_produced' 		=> "Отпуск груза произвел",
		'shipment_produced_position' 	=> "не указано",
		'shipment_produced_fio' 	=> "не указано",

		// Right column

		'power_attorney' 		=> "По доверенности №",
		'from' 				=> "от",
		'year' 				=> "года",
		'issued' 			=> "выданной",

		'сargo_accepted' 		=> "Груз принял",
		'consignee_has_received_goods' 	=> "Груз получил грузополучатель",

		'template_date' 		=> "\"__\"_______20__г.",

		'page' 				=> "Страница",
		'of' 				=> "из",

	];


	/**
	* Initialize PDF.
	*
	*
	* @return void
	*/
	protected function initializePDF() 
	{
		$this->SetTitle($this->titlePDF . '.pdf');

		$this->AddFont('Times','','times.php'); 
		$this->AddFont('Times','B','timesb.php'); 
		$this->SetFont('Times');

		$this->SetTextColor(0, 0, 0);
		$this->SetFontSize(10);
	}

	/**
	* Print table PDF.
	*
	*
	* @return void
	*/
	protected function printTablePDF() 
	{
		$this->AddPage('L');
		$this->headerTablePDF();
		$this->ln(2);
		$this->productTablePDF();
		$this->ln(2);
		if ($this->getY() > 130) $this->AddPage('L');
		$this->footerTablePDF();
	}

	/**
	* Output Pdf.
	*
	*
	* @return void
	*/
	public function OutputPDF()
	{
		$this->initializePDF();
		$this->printTablePDF();
		$this->Output($this->titlePDF . '.pdf','I');
	}

	// Page footer
	function Footer()
	{
		$this->SetY(-10);
		$this->AliasNbPages();
		$this->setCellMargin(-5);

		$page = $this->lang['page'];
		$num = $this->PageNo();
		$of = $this->lang['of'];

		$this->Cell(0, 5, $this->ru("$page $num $of {nb}"), 0, 1, 'R');
	}

	/**
	* Get lang.
	*
	* @param string $key
	* @return string
	*/
	public function GetLang($key)
	{
		if (isset($this->lang[$key])) return $this->ru($this->lang[$key]);
		return "";
	}

	/**
	* Add lang.
	*
	* @param string $key
	* @param string $value
	* @return bool
	*/
	public function AddLang($key, $value)
	{
		if (!isset($this->lang[$key])) {
			$this->lang[$key] = $value;
			return true;
		}
		return false;
	}

	/**
	* Add lang.
	*
	* @param string $key
	* @param string $value
	* @return bool
	*/
	public function SetLang($key, $value)
	{
		if (isset($this->lang[$key])) {
			$this->lang[$key] = $value;
			return true;
		}
		return $this->AddLang($key, $value);
	}

	/**
	* Set cell margin.
	*
	* @param float $margin
	*
	* @return void
	*/
	public function SetCellMargin($margin)
	{
		$this->cMargin = $margin;
	}

	/**
	* Get cell margin.
	*
	* @return float
	*/
	public function GetCellMargin()
	{
		return $this->cMargin;
	}

	/**
	* Set title pdf.
	*
	* @param string $title
	*
	* @return void
	*/
	public function SetTitlePDF($title)
	{
		$this->titlePDF = $title;
	}

	/**
	* Get title pdf.
	*
	* @return string
	*/
	public function GetTitlePDF()
	{
		return $this->titlePDF;
	}

	/**
	* Set entity.
	*
	* @param string $entity
	*
	* @return void
	*/
	public function SetEntity($entity)
	{
		$this->SetLang('shipper_value', $entity);
		$this->SetLang('supplier_value', $entity);
	}

	/**
	* Set OKPO entity.
	*
	* @param string $okpo
	*
	* @return void
	*/
	public function SetOkpoEntity($okpo)
	{
		$this->SetLang('shipper_okpo', $okpo);
		$this->SetLang('supplier_okpo', $okpo);
	}

	/**
	* Set Position entity.
	*
	* @param string $position
	*
	* @return void
	*/
	public function SetPositionEntity($position)
	{
		$this->SetLang('shipment_allowed_position', $position);
		$this->SetLang('shipment_produced_position', $position);
	}

	/**
	* Set Fio entity.
	*
	* @param string $fio
	*
	* @return void
	*/
	public function SetFioEntity($fio)
	{
		$this->SetLang('sshipment_allowed_fio', $fio);
		$this->SetLang('accountant_fio', $fio);
		$this->SetLang('shipment_produced_fio', $fio);
	}

	/**
	* Set Consignee.
	*
	* @param string $consignee
	*
	* @return void
	*/
	public function SetConsignee($consignee)
	{
		$this->SetLang('consignee_value', $consignee);
	}

	/**
	* Set Payer.
	*
	* @param string $payer
	*
	* @return void
	*/
	public function SetPayer($payer)
	{
		$this->SetLang('payer_value', $payer);
	}

	/**
	* Set Base value.
	*
	* @param string $base_value
	*
	* @return void
	*/
	public function SetBaseValue($base_value)
	{
		$this->SetLang('base_value', $base_value);
	}

	/**
	* Set Invoice Number.
	*
	* @param string $invoice_number
	*
	* @return void
	*/
	public function SetInvoiceNumber($invoice_number)
	{
		$this->SetLang('invoice_number', $invoice_number);
	}

	/**
	* Set Invoice Date.
	*
	* @param Carbon $invoice_date
	*
	* @return void
	*/
	public function SetInvoiceDate($invoice_date)
	{
		$this->SetLang('invoice_date', $this->formatDate($invoice_date));
	}	

	/**
	* Add Product.
	*
	* @param string $name
	* @param int $count
	* @param float $price
	*
	* @return void
	*/
	public function AddProduct($name, $count, $price) 
	{
		$total_price = $price * $count;

		$this->sum_count += $count;
		$this->sum_price += $total_price;

		$this->products[] = [
			'name' => $this->ru($name),
			'count' => $this->ru($count),
			'price' => $this->ru($this->formatPrice($price)),
			'total_price' => $this->ru($this->formatPrice($total_price)),
		];

		$this->updateProductsInfo();
	}

	/**
	* Add Products.
	*
	* @param arra $data
	*
	* @return void
	*/
	public function AddProducts($data) 
	{
		if (!empty($data) && is_array($data)) 
		{
			foreach ($data as $product) 
			{
				if (
					!empty($product['name']) && 
					!empty($product['count']) && 
					!empty($product['price'])
				) 
				{
					$total_price = $product['price'] * $product['count'];

					$this->sum_count += $product['count'];
					$this->sum_price += $total_price;

					$this->products[] = [
						'name' => $this->ru($product['name']),
						'count' => $this->ru($product['count']),
						'price' => $this->ru($this->formatPrice($product['price'])),
						'total_price' => $this->ru($this->formatPrice($total_price)),
					];
				}
			}
			$this->updateProductsInfo();
		}
	}

	/**
	* Update Products Info.
	*
	*
	* @return void
	*/
	protected function updateProductsInfo() 
	{
		$this->sum_price = round($this->sum_price, 2);

		$this->SetLang('sum_format', $this->formatPrice($this->sum_price));
		$this->SetLang('sum_words', $this->sum2words($this->sum_price, true, true));
		$this->SetLang('count', $this->sum_count);
		$this->SetLang('count_words', $this->sum2words($this->sum_count, false));
	}

	/**
	* Ru.
	*
	* @param string $text
	*
	* @return string $text
	*/
	public function ru($text)
	{
		return iconv('utf-8', 'windows-1251', $text);
	}

	/**
	* Format Date.
	*
	* @param Carbon $dt
	*
	* @return string
	*/
	protected function formatDate($dt) 
	{
		$day = $dt->format('j');

		$n = $dt->format('n');
		$arMonth = [
			1 =>  'января',
			2 =>  'февраля',
			3 =>  'марта',
			4 =>  'апреля',
			5 =>  'мая',
			6 =>  'июня',
			7 =>  'июля',
			8 =>  'августа',
			9 =>  'сентября',
			10 => 'октября',
			11 => 'ноября',
			12 => 'декабря'
		];

		$month = $arMonth[$n];
		$year = $dt->format('Y');

		return $day . ' ' . $month . ' ' . $year;
	}

	/**
	* Format price.
	*
	* @param float $price
	*
	* @return string
	*/
	public function formatPrice($price = 0) 
	{
		return number_format($price, 2, ',', ' ');
	}

	/**
	* Num 2 words.
	*
	* @param int $n
	* @param array $words
	*
	* @return string
	*/
	public function num2word($n, $words) {
		return ($words[($n=($n=$n%100)>19?($n%10):$n)==1?0 : (($n>1&&$n<=4)?1:2)]);
	}

	/**
	* Sum 2 words.
	*
	* @param float $n
	* @param boolean $u // Is upper
	* @param boolean $m // Is mooney
	*
	* @return string
	*/
	public function sum2words($n, $u = true, $m = false) 
	{
		$words = [
			900 => 'девятьсот',
			800 => 'восемьсот',
			700 => 'семьсот',
			600 => 'шестьсот',
			500 => 'пятьсот',
			400 => 'четыреста',
			300 => 'триста',
			200 => 'двести',
			100 => 'сто',
			90 	=> 'девяносто',
			80	=> 'восемьдесят',
			70	=> 'семьдесят',
			60	=> 'шестьдесят',
			50	=> 'пятьдесят',
			40	=> 'сорок',
			30	=> 'тридцать',
			20	=> 'двадцать',
			19	=> 'девятнадцать',
			18	=> 'восемнадцать',
			17	=> 'семнадцать',
			16	=> 'шестнадцать',
			15	=> 'пятнадцать',
			14	=> 'четырнадцать',
			13	=> 'тринадцать',
			12	=> 'двенадцать',
			11	=> 'одиннадцать',
			10	=> 'десять',
			9	=> 'девять',
			8	=> 'восемь',
			7	=> 'семь',
			6	=> 'шесть',
			5	=> 'пять',
			4	=> 'четыре',
			3	=> 'три',
			2	=> 'два',
			1	=> 'один',
		];
	 
		$level = [
			4 => ['миллиард', 'миллиарда', 'миллиардов'],
			3 => ['миллион', 'миллиона', 'миллионов'],
			2 => ['тысяча', 'тысячи', 'тысяч'],
		];
	 
		list($rub, $kop) = explode('.', number_format($n, 2));
		$parts = explode(',', $rub);
	 
		for ($str = '', $l = count($parts), $i = 0; $i < count($parts); $i++, $l--) {
			if (intval($num = $parts[$i])) {
				foreach($words as $key => $value) {
					if ($num >= $key) {
						// Fix для одной тысячи
						if ($l == 2 && $key == 1) {
							$value='одна';
						}
						// Fix для двух тысяч
						if ($l == 2 && $key == 2) {
							$value='две';
						}
						$str .= ($str != '' ? ' ' : '') . $value;
						$num -= $key;
					}
				}
				if (isset($level[$l])) {
					$str .= ' ' . $this->num2word($parts[$i],$level[$l]);
				}
			}
		}

		if ($m) {
			if (intval($rub = str_replace(',', '', $rub))) {
				$str .= ' ' . $this->num2word($rub, ['рубль', 'рубля', 'рублей']);
			}
		 
			$str .= ($str != '' ? ' ' : '') . $kop;
			$str .= ' ' . $this->num2word($kop, ['копейка', 'копейки', 'копеек']);
		}	 
	 
		return ($u) ? mb_strtoupper(mb_substr($str, 0, 1, 'utf-8'), 'utf-8').
			 mb_substr($str, 1, mb_strlen($str,'utf-8'), 'utf-8') : $str;
	}
	

	/**
	* Header table PDF.
	*
	*
	* @return void
	*/
	protected function headerTablePDF() 
	{
		$table = new easyTable($this, '%{9.7, 29.4, 13.2, 13.2, 19.1, 1.4, 6.5, 7.5}', 'font-size:8;');
 
		$table->easyCell($this->GetLang('forma'), 'paddingY: 0; font-size: 5; align: R; valign: T; colspan: 8');
		$table->printRow();


		$table->easyCell('', 'colspan: 7');
		$table->easyCell($this->GetLang('codes'), 'border: LTR; paddingY: 0; align: C;');
		$table->printRow();


		$table->easyCell($this->GetLang('forma_okyd'), 'align: R;  paddingY: 0; colspan: 7');
		$table->easyCell($this->GetLang('code_okyd'), 'border: LTR; align: C; paddingY: 0;');
		$table->printRow();


		$table->easyCell($this->GetLang('shipper_title'), 'paddingY: 0; paddingX: 2; font-size:7; align:R; valign:B');
		$table->easyCell($this->GetLang('shipper_value'), 'border: B; paddingY: 0; colspan: 4');
		$table->easyCell($this->GetLang('by_okpo'), 'paddingY: 0; colspan: 2; align:R; valign:B');
		$table->easyCell($this->GetLang('shipper_okpo'), 'border: LTR; paddingY: 0; align: C; valign: B');
		$table->printRow();


		$table->easyCell('', 'paddingY: 0;');
		$table->easyCell($this->GetLang('entity_description'), 'paddingY: 0; align: C; valign: T; font-size: 5; colspan: 3');
		$table->easyCell($this->GetLang('view_okdp'), 'paddingY: 0; align: R; valign: B; colspan: 3');
		$table->easyCell($this->GetLang('code_okdp'), 'border: LTR; paddingY: 0; align: C; valign: M;');
		$table->printRow();

		
		$table->easyCell($this->GetLang('consignee_title'), 'paddingY: 0; paddingX: 2; font-size:7; align:R; valign:B');
		$table->easyCell($this->GetLang('consignee_value'), 'border: B; paddingY: 0; colspan: 4');
		$table->easyCell($this->GetLang('by_okpo'), 'paddingY: 0; colspan: 2; align:R; valign:B');
		$table->easyCell($this->GetLang('consignee_okpo'), 'border: LTR; paddingY: 0; align: C; valign: B');
		$table->printRow();
		

		$table->easyCell('', 'paddingY: 0;');
		$table->easyCell($this->GetLang('entity_description'), 'paddingY: 0; align: C; valign: T; font-size: 5; colspan: 3');
		$table->easyCell('', 'paddingY: 0; align: R; valign: B; colspan: 3');
		$table->easyCell('', 'border: LTR; paddingY: 0; align: C; valign: M;');
		$table->printRow();


		$table->rowStyle('min-height: 3;');
		$table->easyCell('', 'colspan: 7; paddingY: 0; paddingX: 2;');
		$table->easyCell('', 'border: LTR; paddingY: 0; align: C; valign: B');
		$table->printRow();
		

		$table->easyCell($this->GetLang('supplier_title'), 'paddingY: 0; paddingX: 2; font-size:7; align:R; valign:B');
		$table->easyCell($this->GetLang('supplier_value'), 'border: B; paddingY: 0; colspan: 4');
		$table->easyCell($this->GetLang('by_okpo'), 'paddingY: 0; colspan: 2; align:R; valign:B');
		$table->easyCell($this->GetLang('supplier_okpo'), 'border: LR; paddingY: 0; align: C; valign: B');
		$table->printRow();

		
		$table->easyCell('', 'paddingY: 0;');
		$table->easyCell($this->GetLang('entity_description'), 'paddingY: 0; align: C; valign: T; font-size: 5; colspan: 3');
		$table->easyCell('', 'paddingY: 0; align: R; valign: B; colspan: 3');
		$table->easyCell('', 'border: LTR; paddingY: 0; align: C; valign: M;');
		$table->printRow();
		

		$table->easyCell($this->GetLang('payer_title'), 'paddingY: 0; paddingX: 2; font-size:7; align:R; valign:B');
		$table->easyCell($this->GetLang('payer_value'), 'border: B; paddingY: 0; colspan: 4');
		$table->easyCell($this->GetLang('by_okpo'), 'paddingY: 0; colspan: 2; align:R; valign:B');
		$table->easyCell($this->GetLang('payer_okpo'), 'border: LTR; paddingY: 0; align: C; valign: B');
		$table->printRow();

		
		$table->easyCell('', 'paddingY: 0;');
		$table->easyCell($this->GetLang('entity_description'), 'paddingY: 0; align: C; valign: T; font-size: 5; colspan: 3');
		$table->easyCell($this->GetLang(''), 'paddingY: 0; align: R; valign: B; colspan: 3');
		$table->easyCell('', 'border: LTR; paddingY: 0; align: C; valign: M;');
		$table->printRow();
		

		$table->easyCell($this->GetLang('base_title'), 'paddingY: 0; paddingX: 2; font-size:7; align:R; valign:B');
		$table->easyCell($this->GetLang('base_value'), 'border: B; paddingY: 0; colspan: 4');
		$table->easyCell('', 'paddingY: 0; align: C; valign: M');
		$table->easyCell($this->GetLang('number'), 'border: LT; paddingY: 0; align:R; valign:B');
		$table->easyCell('', 'border: LTR; paddingY: 0; align: C; valign: B');
		$table->printRow();


		$table->easyCell('', 'paddingY: 0;');
		$table->easyCell($this->GetLang('base_description'), 'paddingY: 0; align: C; valign: T; font-size: 5; colspan: 3');
		$table->easyCell('', 'paddingY: 0; align: C; valign: M; colspan: 2');
		$table->easyCell($this->GetLang('date'), 'border: LT; paddingY: 0; align: R; valign: B;');
		$table->easyCell('', 'border: LTR; paddingY: 0; align: C; valign: M;');
		$table->printRow();		

		$table->easyCell('', 'paddingY: 0; colspan: 2');
		$table->easyCell($this->GetLang('number_up'), 'border: LT; paddingY: 0; align: C; valign: M;');
		$table->easyCell($this->GetLang('date_up'), 'border: LTR; paddingY: 0; align: C; valign: M;');
		$table->easyCell($this->GetLang('waybill'), 'paddingY: 0; colspan: 2; align: R; valign: B;');
		$table->easyCell($this->GetLang('number'), 'border: LT; paddingY: 0; align:R; valign:B');
		$table->easyCell("", 'border: LTR; paddingY: 0; align: C; valign: B');
		$table->printRow();
		

		$table->easyCell($this->GetLang('packing_list'), 'paddingY: 0; align: R; valign: M; font-size: 10; colspan: 2; paddingX: 2; font-style: bold;');
		$table->easyCell($this->GetLang('invoice_number'), 'border: LTB; paddingY: 0; align:C; valign: M');
		$table->easyCell($this->GetLang('invoice_date'), 'border: 1; paddingY: 0; align:C; valign: M');
		$table->easyCell('', 'paddingY: 0; colspan: 2');
		$table->easyCell($this->GetLang('date'), 'border: LTB; paddingY: 0; align: R; valign: B;');
		$table->easyCell('', 'border: LTR; paddingY: 0; align: C; valign: M;');
		$table->printRow();


		$table->easyCell($this->GetLang('type_operation'), 'paddingY: 0; align: R; valign: B; colspan: 7;');
		$table->easyCell('', 'border: LBR; paddingY: 0; align: C; valign: M;');
		$table->printRow();
	

		$table->endTable();
	}

	/**
	* Product table PDF.
	*
	*
	* @return void
	*/
	protected function productTablePDF() 
	{

		$table = new easyTable($this, '%{4.1, 26.3, 2.8, 6.5, 5.1, 4.5, 4.1, 4.8, 4.4, 5, 5.5, 7, 4.9, 6.5, 8.5}', 'font-size: 7; paddingY: 0; paddingX: 0.2');

		$table->easyCell($this->GetLang('number_in_order'), 'border: LT; rowspan: 2; align: C; valign: M');
		$table->easyCell($this->GetLang('product'), 'border: LT; colspan: 2; align: C; valign: M');
		$table->easyCell($this->GetLang('unit_measurement'), 'border: LT1; colspan: 2; align: C; valign: M');
		$table->easyCell($this->GetLang('type_packaging'), 'border: LT; rowspan: 2; align: C; valign: M');
		$table->easyCell($this->GetLang('amount'), 'border: LT; colspan: 2; align: C; valign: M');
		$table->easyCell($this->GetLang('gross_weight'), 'border: LT; rowspan: 2; align: C; valign: M');
		$table->easyCell($this->GetLang('amount_weight'), 'border: LT; rowspan: 2; align: C; valign: M');
		$table->easyCell($this->GetLang('price'), 'border: LT; rowspan: 2; align: C; valign: M');
		$table->easyCell($this->GetLang('price_without_nds'), 'border: LT; rowspan: 2; align: C; valign: M');
		$table->easyCell($this->GetLang('nds'), 'border: LT; colspan: 2; align: C; valign: M');
		$table->easyCell($this->GetLang('price_with_nds'), 'border: LTR; rowspan: 2; align: C; valign: M');
		$table->printRow();


		$table->easyCell($this->GetLang('full_name'), 'border: LT; align: C; valign: M');
		$table->easyCell($this->GetLang('code'), 'border: LT; align: C; valign: M');
		$table->easyCell($this->GetLang('name'), 'border: LT; align: C; valign: M');
		$table->easyCell($this->GetLang('code_okei'), 'border: LT; align: C; valign: M');
		$table->easyCell($this->GetLang('in_one_place'), 'border: LT; align: C; valign: M');
		$table->easyCell($this->GetLang('places_pieces'), 'border: LT; align: C; valign: M');
		$table->easyCell($this->GetLang('rate'), 'border: LT; align: C; valign: M');
		$table->easyCell($this->GetLang('summa'), 'border: LT; align: C; valign: M');
		$table->printRow();


		$table->easyCell("1", 'border: LTB; align: C; valign: M');
		$table->easyCell("2", 'border: LTB; align: C; valign: M');
		$table->easyCell("3", 'border: LTB; align: C; valign: M');
		$table->easyCell("4", 'border: LTB; align: C; valign: M');
		$table->easyCell("5", 'border: LTB; align: C; valign: M');
		$table->easyCell("6", 'border: LTB; align: C; valign: M');
		$table->easyCell("7", 'border: LTB; align: C; valign: M');
		$table->easyCell("8", 'border: LTB; align: C; valign: M');
		$table->easyCell("9", 'border: LTB; align: C; valign: M');
		$table->easyCell("10", 'border: LTB; align: C; valign: M');
		$table->easyCell("11", 'border: LTB; align: C; valign: M');
		$table->easyCell("12", 'border: LTB; align: C; valign: M');
		$table->easyCell("13", 'border: LTB; align: C; valign: M');
		$table->easyCell("14", 'border: LTB; align: C; valign: M');
		$table->easyCell("15", 'border: 1; align: C; valign: M');
		$table->printRow();


		if (!empty($this->products)) 
		{
			foreach ($this->products as $key => $product) 
			{

		$table->easyCell($key + 1, 'border: LTB; align: R; valign: M; paddingX: 2;');
		$table->easyCell($product['name'], 'border: LTB; align: L; valign: M; paddingX: 2; paddingY: 0.5;');
		$table->easyCell('', 'border: LTB; align: C; valign: M; paddingX: 2;');
		$table->easyCell($this->GetLang('pcs'), 'border: LTB; align: C; valign: M; paddingX: 2;');
		$table->easyCell($this->GetLang('code_okei'), 'border: LTB; align: C; valign: M; paddingX: 2;');
		$table->easyCell('', 'border: LTB; align: C; valign: M; paddingX: 2;');
		$table->easyCell('', 'border: LTB; align: C; valign: M; paddingX: 2;');
		$table->easyCell('', 'border: LTB; align: C; valign: M; paddingX: 2;');
		$table->easyCell('', 'border: LTB; align: C; valign: M; paddingX: 2;');
		$table->easyCell($product['count'], 'border: LTB; align: R; valign: M; paddingX: 2;');
		$table->easyCell($product['price'], 'border: LTB; align: R; valign: M; paddingX: 2;');
		$table->easyCell($product['total_price'], 'border: LTB; align: R; valign: M; paddingX: 2;');
		$table->easyCell($this->GetLang('without_nds'), 'border: LTB; align: R; valign: M; paddingX: 1;');
		$table->easyCell('', 'border: LTB; align: C; valign: M; paddingX: 2;');
		$table->easyCell($product['total_price'], 'border: 1; align: R; valign: M; paddingX: 2;');
		$table->printRow();
				
			}
		}


		$table->easyCell($this->GetLang('total'), 'colspan: 7; align: R; valign: M; paddingX: 2;');
		$table->easyCell("", 'border: LB; align: C; valign: M; paddingX: 2;');
		$table->easyCell("", 'border: LB; align: C; valign: M; paddingX: 2;');
		$table->easyCell($this->GetLang('count'), 'border: LB; align: R; valign: M; paddingX: 2;');
		$table->easyCell("X", 'border: LB; align: C; valign: M; paddingX: 2;');
		$table->easyCell($this->GetLang('sum_format'), 'border: LB; align: R; valign: M; paddingX: 2;');
		$table->easyCell("X", 'border: LB; align: C; valign: M; paddingX: 2;');
		$table->easyCell("0,00", 'border: LB; align: R; valign: M; paddingX: 2;');
		$table->easyCell($this->GetLang('sum_format'), 'border: LBR; align: R; valign: M; paddingX: 2; font-style: bold;');
		$table->printRow();


		$table->easyCell($this->GetLang('total_invoice'), 'colspan: 7; align: R; valign: M; paddingX: 2;');
		$table->easyCell("", 'border: LB; align: C; valign: M; paddingX: 2;');
		$table->easyCell("", 'border: LB; align: C; valign: M; paddingX: 2;');
		$table->easyCell($this->GetLang('count'), 'border: LB; align: R; valign: M; paddingX: 2; font-style: bold;');
		$table->easyCell("X", 'border: LB; align: C; valign: M; paddingX: 2;');
		$table->easyCell($this->GetLang('sum_format'), 'border: LB; align: R; valign: M; paddingX: 2; font-style: bold;');
		$table->easyCell("X", 'border: LB; align: C; valign: M; paddingX: 2;');
		$table->easyCell("0,00", 'border: LB; align: R; valign: M; paddingX: 2; font-style: bold;');
		$table->easyCell($this->GetLang('sum_format'), 'border: LBR; align: R; valign: M; paddingX: 2; font-style: bold;');
		$table->printRow();


		$table->endTable();
	}

	/**
	* Footer table PDF.
	*
	*
	* @return void
	*/
	protected function footerTablePDF() 
	{		
		$table = new easyTable($this, '%{6, 6, 2.4, 5.6, 4.2, 4.2, 0.4, 5, 6.9, 0.4, 3.5, 1.4, 7, 1.8, 1.8, 8.7, 2.2, 8.7, 0.4, 5.6, 1, 0.7, 4.5, 0.4, 2.5, 4.5, 4.2}', 'font-size: 7; paddingY: 0; paddingX: 0.2;');		


		$table->easyCell("", 'align: L; valign: B');
		$table->easyCell($this->GetLang('applications_title'), 'colspan: 4; align: L; valign: B; paddingX: 0;');
		$table->easyCell($this->GetLang('applications_value'), 'border: B; colspan: 16; align: L; valign: B; paddingX: 2;');
		$table->easyCell("", 'colspan: 6; align: L; valign: B;');
		$table->printRow();


		$table->easyCell("", 'align: L; valign: B');
		$table->easyCell($this->GetLang('contains_title'), 'colspan: 4; align: L; valign: B;  paddingX: 0;');
		$table->easyCell($this->GetLang('count_words'), 'border: B; colspan: 16; align: L; valign: B; paddingX: 2;');
		$table->easyCell($this->GetLang('serial_numbers'), 'colspan: 6; align: R; valign: B; paddingX: 2;');
		$table->printRow();


		$table->rowStyle('min-height: 3;');
		$table->easyCell("", 'colspan: 5; align: L; valign: B;');
		$table->easyCell($this->GetLang('in_words'), 'colspan: 16; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'colspan: 6; align: L; valign: B;');
		$table->printRow();


		$table->rowStyle('min-height: 5;');
		$table->easyCell($this->GetLang('cargo_weight_title'), 'colspan: 11; align: R; valign: B; paddingX: 2;');
		$table->easyCell($this->GetLang('cargo_weight_value'), 'border: B; colspan: 9; align: L; valign: B;');
		$table->easyCell("", 'colspan: 2; align: L; valign: B;');
		$table->easyCell("", 'border: 1; colspan: 5; align: L; valign: B;');
		$table->printRow();


		$table->easyCell("", 'colspan: 11; align: L; valign: B');
		$table->easyCell($this->GetLang('in_words'), 'colspan: 9; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'colspan: 2; align: L; valign: B;');
		$table->easyCell("", 'border: LR; colspan: 5; align: L; valign: B;');
		$table->printRow();


		$table->easyCell("", 'align: L; valign: B');
		$table->easyCell($this->GetLang('total_places_title'), 'colspan: 2; align: L; valign: B;  paddingX: 0;');
		$table->easyCell($this->GetLang('count_words'), 'border: B; colspan: 5; align: L; valign: B; paddingX: 2;');
		$table->easyCell($this->GetLang('weight_gross_title'), 'colspan: 3; align: R; valign: B; paddingX: 2;');
		$table->easyCell($this->GetLang('weight_gross_value'), 'border: B; colspan: 9; align: L; valign: B;');
		$table->easyCell("", 'colspan: 2; align: L; valign: B;');
		$table->easyCell("", 'border: LBR; colspan: 5; align: L; valign: B;');
		$table->printRow();


		$table->rowStyle('min-height: 3;');
		$table->easyCell("", 'colspan: 3; align: L; valign: B');
		$table->easyCell($this->GetLang('in_words'), 'colspan: 5; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'colspan: 3; align: R; valign: B; paddingX: 2;');
		$table->easyCell($this->GetLang('in_words'), 'colspan: 9; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'colspan: 7; align: L; valign: B;');
		$table->printRow();


		$table->easyCell($this->GetLang('application'), 'colspan: 4; align: L; valign: B; paddingX: 2;');
		$table->easyCell($this->GetLang('sheets_value'), 'border: B; colspan: 8; align: L; valign: B; paddingX: 2;');
		$table->easyCell($this->GetLang('sheets'), 'border: R; colspan: 2; align: L; valign: B; paddingX: 2;');
		$table->easyCell("", 'align: L; valign: B;');
		$table->easyCell($this->GetLang('power_attorney'), 'colspan: 2; align: L; valign: B;  paddingX: 2;');
		$table->easyCell("", 'border: B; colspan: 7; align: L; valign: B; paddingX: 2;');
		$table->easyCell($this->GetLang('from'), 'align: R; valign: B; paddingX: 2;');
		$table->easyCell("", 'border: B; align: C; valign: B; paddingX: 2;');
		$table->easyCell($this->GetLang('year'), 'align: L; valign: B; paddingX: 2;');
		$table->printRow();


		$table->easyCell($this->GetLang('sum_words_title'), 'border: R; colspan: 14; align: L; valign: B; paddingX: 2;');
		$table->easyCell("", 'align: L; valign: B;');
		$table->easyCell($this->GetLang('issued'), 'colspan: 2; align: L; valign: B;  paddingX: 2;');
		$table->easyCell("", 'border: B; colspan: 10; align: L; valign: B; paddingX: 2;');
		$table->printRow();


		$table->rowStyle('min-height: 3;');
		$table->easyCell("", 'colspan: 14; border: R; align: L; valign: B');
		$table->easyCell("", 'colspan: 3; align: L; valign: B');
		$table->easyCell($this->GetLang('by_to'), 'colspan: 10; font-size: 5; align: C; valign: T;');
		$table->printRow();


		$table->easyCell($this->GetLang('sum_words'), 'border: B; colspan: 13; align: L; valign: B; paddingX: 2;');
		$table->easyCell("", 'border: R; align: L; valign: B');
		$table->easyCell("", 'align: L; valign: B');
		$table->easyCell("", 'colspan: 12; border: B; align: L; valign: B');
		$table->printRow();


		$table->rowStyle('min-height: 3;');
		$table->easyCell($this->GetLang('in_words'), 'colspan: 13; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'border: R; align: L; valign: B');
		$table->easyCell("", 'colspan: 13; align: L; valign: B');
		$table->printRow();


		$table->easyCell($this->GetLang('shipment_allowed'), 'colspan: 2; align: L; valign: B; paddingX: 2;');
		$table->easyCell($this->GetLang('shipment_allowed_position'), 'border: B; colspan: 4; align: C; valign: B;');
		$table->easyCell("", 'align: C; valign: B;');
		$table->easyCell("", 'border: B; colspan: 2; align: C; valign: B;');
		$table->easyCell("", 'align: C; valign: B;');
		$table->easyCell($this->GetLang('sshipment_allowed_fio'), 'border: B; colspan: 3; align: C; valign: B;');
		$table->easyCell("", 'border: R; align: L; valign: B;');
		$table->easyCell("", 'align: L; valign: B');
		$table->easyCell("", 'colspan: 12; border: B; align: L; valign: B');
		$table->printRow();

		$table->rowStyle('min-height: 3;');
		$table->easyCell("", 'colspan: 2; align: C; valign: T;');
		$table->easyCell($this->GetLang('position'), 'colspan: 4; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'align: C; valign: T;');
		$table->easyCell($this->GetLang('signature'), 'colspan: 2; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'align: C; valign: T;');
		$table->easyCell($this->GetLang('decryption_signature'), 'colspan: 3; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'border: R; align: C; valign: T;');
		$table->easyCell("", 'colspan: 13; align: L; valign: B');
		$table->printRow();


		$table->easyCell($this->GetLang('accountant'), 'colspan: 5; align: L; valign: B; paddingX: 2;');
		$table->easyCell("", 'border: B; colspan: 4; align: C; valign: B;');
		$table->easyCell("", 'align: C; valign: B;');
		$table->easyCell($this->GetLang('accountant_fio'), 'border: B; colspan: 3; align: C; valign: B;');
		$table->easyCell("", 'border: R; align: L; valign: B;');
		$table->easyCell("", 'align: L; valign: B;');
		$table->easyCell($this->GetLang('сargo_accepted'), 'align: L; valign: B; paddingX: 2;');
		$table->easyCell("", 'border: B; colspan: 2; align: C; valign: B;');
		$table->easyCell("", 'align: C; valign: B;');
		$table->easyCell("", 'border: B; colspan: 4; align: C; valign: B;');
		$table->easyCell("", 'align: C; valign: B;');
		$table->easyCell("", 'border: B; colspan: 3; align: C; valign: B;');
		$table->printRow();


		$table->easyCell("", 'colspan: 5; align: C; valign: B;');
		$table->easyCell($this->GetLang('signature'), 'colspan: 4; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'align: C; valign: T;');
		$table->easyCell($this->GetLang('decryption_signature'), 'colspan: 3; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'border: R; align: C; valign: T;');
		$table->easyCell("", 'colspan: 2; align: C; valign: T;');
		$table->easyCell($this->GetLang('position'), 'colspan: 2; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'align: C; valign: T;');
		$table->easyCell($this->GetLang('signature'), 'colspan: 4; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'align: C; valign: T;');
		$table->easyCell($this->GetLang('decryption_signature'), 'colspan: 3; font-size: 5; align: C; valign: T;');
		$table->printRow();


		$table->easyCell($this->GetLang('shipment_produced'), 'colspan: 2; align: L; valign: B; paddingX: 2;');
		$table->easyCell($this->GetLang('shipment_produced_position'), 'border: B; colspan: 4; align: C; valign: B;');
		$table->easyCell("", 'align: C; valign: B;');
		$table->easyCell("", 'border: B; colspan: 2; align: C; valign: B;');
		$table->easyCell("", 'align: C; valign: B;');
		$table->easyCell($this->GetLang('shipment_produced_fio'), 'border: B; colspan: 3; align: C; valign: B;');
		$table->easyCell("", 'border: R; align: L; valign: B;');
		$table->easyCell("", 'align: L; valign: B;');
		$table->easyCell($this->GetLang('consignee_has_received_goods'), 'align: L; valign: B; paddingX: 2;');
		$table->easyCell("", 'border: B; colspan: 2; align: C; valign: B;');
		$table->easyCell("", 'align: C; valign: B;');
		$table->easyCell("", 'border: B; colspan: 4; align: C; valign: B;');
		$table->easyCell("", 'align: C; valign: B;');
		$table->easyCell("", 'border: B; colspan: 3; align: C; valign: B;');
		$table->printRow();


		$table->rowStyle('min-height: 3;');
		$table->easyCell("", 'colspan: 2; align: C; valign: T;');
		$table->easyCell($this->GetLang('position'), 'colspan: 4; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'align: C; valign: T;');
		$table->easyCell($this->GetLang('signature'), 'colspan: 2; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'align: C; valign: T;');
		$table->easyCell($this->GetLang('decryption_signature'), 'colspan: 3; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'border: R; align: C; valign: T;');
		$table->easyCell("", 'colspan: 2; align: C; valign: T;');
		$table->easyCell($this->GetLang('position'), 'colspan: 2; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'align: C; valign: T;');
		$table->easyCell($this->GetLang('signature'), 'colspan: 4; font-size: 5; align: C; valign: T;');
		$table->easyCell("", 'align: C; valign: T;');
		$table->easyCell($this->GetLang('decryption_signature'), 'colspan: 3; font-size: 5; align: C; valign: T;');
		$table->printRow();


		$table->rowStyle('min-height: 3;');
		$table->easyCell($this->GetLang('m_p'), 'colspan: 4; align: C; valign: B;');
		$table->easyCell($this->GetLang('invoice_date'), 'border: R; colspan: 10; align: L; valign: T; paddingX: 2;');
		$table->easyCell("", 'colspan: 2; align: C; valign: B;');
		$table->easyCell($this->GetLang('m_p'), 'colspan: 3; align: L; valign: B; paddingX: 2;');
		$table->easyCell($this->GetLang('template_date'), 'colspan: 8; align: L; valign: B; paddingX: 2;');
		$table->printRow();


		$table->endTable();
	}
	
}