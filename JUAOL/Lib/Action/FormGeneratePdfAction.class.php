<?php
/**
 * 报名表pdf生成
 * @author Yamamula <abcdko123321@hotmail.com>
 */
Vendor('tcpdf.tcpdf');
class FormGeneratePdfAction extends Action
{
	public function addHeader($pdf,$title)
	{ 
        $eventModel = D('Event');
        $pdf->SetCreator('iRoll Studio');
        $pdf->SetAuthor("iRoll Studio");
        if(session('user') != null)
        {
        	$user = D('User')->getCurrentUserInfo();
        	$activeEvent = D('Event')->getEventByFilter($arrayName = array('id'=>$user['eventName']));
        }
        $pdf->SetTitle($activeEvent['name']);
        $pdf->SetSubject('Match Information');
        $pdf->SetKeywords('judo');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(15,10,15);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->setCellPaddings(0, 0, 0, 0);
        $pdf->AddPage('P','A4');
        //设置标题的位置和大小
        $pdf->SetFont('droidsansfallback', 'B', 18);
        $pdf->SetY(10);
        $pdf->Cell(0, 10, $activeEvent['name'], 0, 1, 'C',false,'', 1);
        //设置字标题
        $pdf->SetFont('droidsansfallback', 'B', 18);
        $pdf->SetY(20);
        $pdf->Cell(0, 10, $activeEvent['venue'].' '.$activeEvent['date'], 0, 1, 'C',false,'', 1);
        $pdf->Image('./JUAOL/Resource/img/logo.png',10,10,23,23);
        $pdf->Line(10,35,200,35);
        $pdf->SetY(40);
        $pdf->SetFont('droidsansfallback', 'BU', 18);
        $pdf->Cell(0, 10, $title, 0, 1, 'C',false,'', 1);
        //表头设置结束，设置正文开始位置
        $pdf->SetY(50);
	}
	function addFooter($pdf)
    {
        $pdf->SetAutoPageBreak(true, 0);
        $pdf->SetFont('droidsansfallback', '', 8);
        $Y = $pdf->GetY();
        $pdf->Line(10,297- 10,200,287);
        $pdf->SetY(-10);
         if(session('user') != null)
        {
        	$user = D('User')->getCurrentUserInfo();
        	$activeEvent = D('Event')->getEventByFilter($arrayName = array('id'=>$user['eventName']));
        }
        $pdf->Cell(0, 10, $activeEvent['venue'].'  Email；'."abcdef@163.com", 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, $M_BOTTOM);
        $pdf->SetY($Y);
    }
	public function firstEntryFormGeneratePdf()
	{
		$pdf = new TCPDF('Portrait', 'mm', 'A4', true, 'UTF-8', false);
		$this->addHeader($pdf,"FIRST ENTRY FORM");
		$pdf->SetFont('droidsansfallback', '', 12);
		if(session('user') != null)
        {
        	$user = D('User')->getCurrentUserInfo();
        	$activeEvent = D('Event')->getEventByFilter($arrayName = array('id'=>$user['eventName']));
        }
		$information = "  Please send this entry form by ".'2015-11-15'." to the office of the ".$activeEvent['hosted_by'].". Email:"."abcdef@hotmail.com";
		$pdf->MultiCell(180, 15, $information, 0, 'L', 0, 1, '', '', true);
		$pdf->SetFont('droidsansfallback', 'B', 12);
		$pdf->SetX($pdf->GetX()+5);
		$pdf->Cell(170, 10, " Federation:".$user['federation'], 1, 1, 'L',false,'', 1);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY()+5);
		$pdf->Cell(51, 10, " Tel:".$user['tel'], 1, 0, 'L',false,'', 1);
		$pdf->Cell(51, 10, " Fax:".$user['fax'], 1, 0, 'L',false,'', 1);
		$pdf->Cell(68, 10, " E-mail:".$user['email'], 1, 1, 'L',false,'', 1);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY()+5);
		$pdf->Cell(85, 10, " Number Of Officials:".$user['number_of_officials'], 1, 0, 'L',false,'', 1);
		$pdf->Cell(85, 10, " Number Of Competitor:".$user['number_of_competitiors'], 1, 1, 'L',false,'', 1);
		$information = "  Please tick / check the Yes or No column indicating if you hace participants in the following Men or Women category.";
		$pdf->SetXY($pdf->GetX(),$pdf->GetY()+5);
		$pdf->MultiCell(180, 13, $information, 0, 'L', 0, 1, '', '', true);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
		$pdf->Cell(16, 10, "No.", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 10, "MEN", 1, 0, 'C',false,'', 1);
		$pdf->Cell(22, 10, "Yes", 1, 0, 'C',false,'', 1);
		$pdf->Cell(22, 10, "No", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 10, "WOMEN", 1, 0, 'C',false,'', 1);
		$pdf->Cell(22, 10, "Yes", 1, 0, 'C',false,'', 1);
		$pdf->Cell(22, 10, "No", 1, 1, 'C',false,'', 1);
		$categories['male'] = D('Event')->getMCat($user['eventName']);
    	$categories['female'] = D('Event')->getFCat($user['eventName']);
    	if(count($categories['male'])>=count($categories['female']))
    	{
    		$cate = $categories['male'];
    	}
    	else
    	{
    		$cate = $categories['female'];
    	}
<<<<<<< HEAD
=======
    	$categoryInfo = explode(";",$user['category_info']);
    	$categoryInfo['male'] = explode(",",$categoryInfo['0']);
    	$categoryInfo['female'] = explode(",",$categoryInfo['1']);
    	unset($categoryInfo['0']);unset($categoryInfo['1']);
>>>>>>> feature/2015-4-29-pdf-change
    	foreach ($cate as $key => $value) 
    	{
    		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
			$pdf->Cell(16, 8, ($key+1).".", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 8, $categories['male'][$key], 1, 0, 'C',false,'', 1);
<<<<<<< HEAD
			$pdf->Cell(22, 8, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(22, 8, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 8, $categories['female'][$key], 1, 0, 'C',false,'', 1);
			$pdf->Cell(22, 8, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(22, 8, "", 1, 1, 'C',false,'', 1);
=======
			if($categoryInfo['male'][$key]==1)
			{
				$pdf->Cell(22, 8, "√", 1, 0, 'C',false,'', 1);
				$pdf->Cell(22, 8, "", 1, 0, 'C',false,'', 1);
			}
			else if($categoryInfo['male'][$key]==0)
			{
				$pdf->Cell(22, 8, "", 1, 0, 'C',false,'', 1);
				$pdf->Cell(22, 8, "√", 1, 0, 'C',false,'', 1);
			}
			else
			{
				$pdf->Cell(22, 8, "", 1, 0, 'C',false,'', 1);
				$pdf->Cell(22, 8, "", 1, 0, 'C',false,'', 1);
			}
			$pdf->Cell(33, 8, $categories['female'][$key], 1, 0, 'C',false,'', 1);
			if($categoryInfo['female'][$key]==1)
			{
				$pdf->Cell(22, 8, "√", 1, 0, 'C',false,'', 1);
				$pdf->Cell(22, 8, "", 1, 1, 'C',false,'', 1);
			}
			else if($categoryInfo['female'][$key]==0)
			{
				$pdf->Cell(22, 8, "", 1, 0, 'C',false,'', 1);
				$pdf->Cell(22, 8, "√", 1, 1, 'C',false,'', 1);
			}
			else
			{
				$pdf->Cell(22, 8, "", 1, 0, 'C',false,'', 1);
				$pdf->Cell(22, 8, "", 1, 1, 'C',false,'', 1);
			}
>>>>>>> feature/2015-4-29-pdf-change
    	}
    	$pdf->SetXY($pdf->GetX()+5,$pdf->GetY()+5);
    	$pdf->Cell(40, 10, " Team Competition", 1, 0, 'L',false,'', 1);
    	if($user['men_team']==1)
    	{
			$pdf->Cell(65, 10, " Men team: Yes ■   No □", 1, 0, 'L',false,'', 1);
		}
		else if($user['men_team']==0)
		{
			$pdf->Cell(65, 10, " Men team: Yes □   No ■", 1, 0, 'L',false,'', 1);
		}
		else
		{
			$pdf->Cell(65, 10, " Men team: Yes □   No □", 1, 0, 'L',false,'', 1);
		}
		if($user['women_team']==1)
		{
			$pdf->Cell(65, 10, " Women team: Yes ■   No □", 1, 1, 'L',false,'', 1);
		}
		else if($user['women_team']==0)
		{
			$pdf->Cell(65, 10, " Women team: Yes □   No ■", 1, 1, 'L',false,'', 1);
		}
		else
		{
			$pdf->Cell(65, 10, " Women team: Yes □   No □", 1, 1, 'L',false,'', 1);
		}
		$pdf->SetFont('droidsansfallback', 'B', 10);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY()+10);
		$pdf->MultiCell(85, 40, "Presidents Signature & Date", 1, 'L', 0, 0, '', '', true, 0, false, true, 40, 'B');
		$pdf->MultiCell(85, 40, "Federation / Association Official Stamp", 1, 'L', 0, 1, '', '', true, 0, false, true, 40, 'B');
		$this->addFooter($pdf);
		$pdf->Output('FirstEntryForm.pdf', "I");
	}

	public function finalEntryFormMenGeneratePdf()
	{
		$pdf = new TCPDF('Portrait', 'mm', 'A4', true, 'UTF-8', false);
		$this->addHeader($pdf,"FINAL ENTRY FORM - (MEN - INDIVIDUAL)");
		$pdf->SetFont('droidsansfallback', '', 12);
		if(session('user') != null)
        {
        	$user = D('User')->getCurrentUserInfo();
        	$activeEvent = D('Event')->getEventByFilter($arrayName = array('id'=>$user['eventName']));
        }
		$information = "  Please fill up all requirements and send this entry form by ".'2015-11-15'." to the office of the ".$activeEvent['hosted_by'].". Email:"."abcdef@hotmail.com";
		$pdf->MultiCell(180, 15, $information, 0, 'L', 0, 1, '', '', true);
		$pdf->SetFont('droidsansfallback', 'B', 12);
		$pdf->SetX($pdf->GetX()+5);
		$pdf->Cell(170, 10, " Federation:".$user['federation'], 1, 1, 'L',false,'', 1);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY()+5);
		$pdf->Cell(51, 10, " Tel:".$user['tel'], 1, 0, 'L',false,'', 1);
		$pdf->Cell(51, 10, " Fax:".$user['fax'], 1, 0, 'L',false,'', 1);
		$pdf->Cell(68, 10, " E-mail:".$user['email'], 1, 1, 'L',false,'', 1);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
		$pdf->Cell(85, 15, " Number Of Officials:".$user['number_of_officials'], 1, 0, 'L',false,'', 1);
		$pdf->Cell(85, 15, " Number Of Competitor:".$user['number_of_competitiors'], 1, 1, 'L',false,'', 1);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
		$pdf->Cell(170, 10, " Address:".$user['adress'], 1, 1, 'L',false,'', 1);
		
		$information = "Competitors:";
		$pdf->SetXY($pdf->GetX(),$pdf->GetY()+3);
		$pdf->MultiCell(180, 8, $information, 0, 'L', 0, 1, '', '', true);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
		$pdf->Cell(15, 7, "No.", 1, 0, 'C',false,'', 1);
		$pdf->Cell(23, 7, "Men", 1, 0, 'C',false,'', 1);
<<<<<<< HEAD
		$pdf->Cell(33, 7, "First Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Last Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Date of Birth", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Passport No.", 1, 1, 'C',false,'', 1);
		$categories = D('Category')->getCategories('male');
    	foreach ($categories as $key => $value) 
    	{
    		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
			$pdf->Cell(15, 7, ($key+1).".", 1, 0, 'C',false,'', 1);
			$pdf->Cell(23, 7, $value['weight'].'kg', 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 1, 'C',false,'', 1);
    	}

=======
		$pdf->Cell(33, 7, "Family Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Given Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Date of Birth", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Passport No.", 1, 1, 'C',false,'', 1);
		$categories = D('Event')->getMCat($user['eventName']);
		$competitors = D('Person')->getPersonInfoList($arrayName = array('groupe' => 'Competitor','gender'=>'male'));
		$i = 1;
    	foreach ($categories as $key => $value) 
    	{
    		foreach($competitors as $key1 =>$value1)
    		{
    			if($value1['category'] == $value)
    			{
		    		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
					$pdf->Cell(15, 7, $i.".", 1, 0, 'C',false,'', 1);
					$pdf->Cell(23, 7, $value, 1, 0, 'C',false,'', 1);
					$pdf->Cell(33, 7, $value1['family_name'], 1, 0, 'C',false,'', 1);
					$pdf->Cell(33, 7, $value1['given_name'], 1, 0, 'C',false,'', 1);
					$pdf->Cell(33, 7, $value1['birth'], 1, 0, 'C',false,'', 1);
					$pdf->Cell(33, 7, $value1['passport_no'], 1, 1, 'C',false,'', 1);
					$i++;
				}
			}
    	}
    	$officials = D('Person')->getPersonInfoList($arrayName = array('gender'=>'male'));
>>>>>>> feature/2015-4-29-pdf-change
    	$information = "Officials:";
		$pdf->SetXY($pdf->GetX(),$pdf->GetY()+3);
		$pdf->MultiCell(180, 8, $information, 0, 'L', 0, 1, '', '', true);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
		$pdf->Cell(38, 7, "Position", 1, 0, 'C',false,'', 1);
<<<<<<< HEAD
		$pdf->Cell(33, 7, "First Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Last Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Date of Birth", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Passport No.", 1, 1, 'C',false,'', 1);
    	for ($key = 0;$key<4;$key++) 
    	{
    		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
			$pdf->Cell(38, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 1, 'C',false,'', 1);
=======
		$pdf->Cell(33, 7, "Family Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Given Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Date of Birth", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Passport No.", 1, 1, 'C',false,'', 1);
    	foreach ($officials as $key => $value) 
    	{
    		if($value['groupe'] == 'Competitor')
    			continue;
    		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
			$pdf->Cell(38, 7, $value['groupe'], 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, $value['family_name'], 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, $value['given_name'], 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, $value['birth'], 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, $value['passport_no'], 1, 1, 'C',false,'', 1);
>>>>>>> feature/2015-4-29-pdf-change
    	}

		$pdf->SetFont('droidsansfallback', 'B', 10);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY()+10);
		$pdf->MultiCell(85, 30, "Presidents Signature & Date", 1, 'L', 0, 0, '', '', true, 0, false, true, 30, 'B');
		$pdf->MultiCell(85, 30, "Federation / Association Official Stamp", 1, 'L', 0, 1, '', '', true, 0, false, true, 30, 'B');
		$this->addFooter($pdf);
		$pdf->Output('FinalEntryMenForm.pdf', "I");
	}

	public function finalEntryFormWomenGeneratePdf()
	{
		$pdf = new TCPDF('Portrait', 'mm', 'A4', true, 'UTF-8', false);
		$this->addHeader($pdf,"FINAL ENTRY FORM - (WOMEN - INDIVIDUAL)");
		$pdf->SetFont('droidsansfallback', '', 12);
<<<<<<< HEAD
		$information = "  Please fill up all requirements and send this entry form by ".'2015-11-15'." to the office of the "." Judo Union Of Asia".". Email:"."abcdef@hotmail.com";
		$pdf->MultiCell(180, 15, $information, 0, 'L', 0, 1, '', '', true);
		$pdf->SetFont('droidsansfallback', 'B', 12);
		$pdf->SetX($pdf->GetX()+5);
		$pdf->Cell(170, 10, " Federation:", 1, 1, 'L',false,'', 1);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY()+5);
		$pdf->Cell(51, 10, " Tel:", 1, 0, 'L',false,'', 1);
		$pdf->Cell(51, 10, " Fax:", 1, 0, 'L',false,'', 1);
		$pdf->Cell(68, 10, " E-mail:", 1, 1, 'L',false,'', 1);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
		$pdf->Cell(85, 15, " Number Of Officials:", 1, 0, 'L',false,'', 1);
		$pdf->Cell(85, 15, " Number Of Competitor:", 1, 1, 'L',false,'', 1);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
		$pdf->Cell(170, 10, " Address:", 1, 1, 'L',false,'', 1);
=======
		if(session('user') != null)
        {
        	$user = D('User')->getCurrentUserInfo();
        	$activeEvent = D('Event')->getEventByFilter($arrayName = array('id'=>$user['eventName']));
        }
		$information = "  Please fill up all requirements and send this entry form by ".'2015-11-15'." to the office of the ".$activeEvent['hosted_by'].". Email:"."abcdef@hotmail.com";
		$pdf->MultiCell(180, 15, $information, 0, 'L', 0, 1, '', '', true);
		$pdf->SetFont('droidsansfallback', 'B', 12);
		$pdf->SetX($pdf->GetX()+5);
		$pdf->Cell(170, 10, " Federation:".$user['federation'], 1, 1, 'L',false,'', 1);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY()+5);
		$pdf->Cell(51, 10, " Tel:".$user['tel'], 1, 0, 'L',false,'', 1);
		$pdf->Cell(51, 10, " Fax:".$user['fax'], 1, 0, 'L',false,'', 1);
		$pdf->Cell(68, 10, " E-mail:".$user['email'], 1, 1, 'L',false,'', 1);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
		$pdf->Cell(85, 15, " Number Of Officials:".$user['number_of_officials'], 1, 0, 'L',false,'', 1);
		$pdf->Cell(85, 15, " Number Of Competitor:".$user['number_of_competitiors'], 1, 1, 'L',false,'', 1);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
		$pdf->Cell(170, 10, " Address:".$user['adress'], 1, 1, 'L',false,'', 1);
		
>>>>>>> feature/2015-4-29-pdf-change
		$information = "Competitors:";
		$pdf->SetXY($pdf->GetX(),$pdf->GetY()+3);
		$pdf->MultiCell(180, 8, $information, 0, 'L', 0, 1, '', '', true);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
		$pdf->Cell(15, 7, "No.", 1, 0, 'C',false,'', 1);
		$pdf->Cell(23, 7, "Men", 1, 0, 'C',false,'', 1);
<<<<<<< HEAD
		$pdf->Cell(33, 7, "First Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Last Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Date of Birth", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Passport No.", 1, 1, 'C',false,'', 1);
		$categories = D('Category')->getCategories('female');
    	foreach ($categories as $key => $value) 
    	{
    		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
			$pdf->Cell(15, 7, ($key+1).".", 1, 0, 'C',false,'', 1);
			$pdf->Cell(23, 7, $value['weight'].'kg', 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 1, 'C',false,'', 1);
    	}

=======
		$pdf->Cell(33, 7, "Family Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Given Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Date of Birth", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Passport No.", 1, 1, 'C',false,'', 1);
		$categories = D('Event')->getFCat($user['eventName']);
		$competitors = D('Person')->getPersonInfoList($arrayName = array('groupe' => 'Competitor','gender'=>'female'));
		$i = 1;
    	foreach ($categories as $key => $value) 
    	{
    		foreach($competitors as $key1 =>$value1)
    		{
    			if($value1['category'] == $value)
    			{
		    		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
					$pdf->Cell(15, 7, $i.".", 1, 0, 'C',false,'', 1);
					$pdf->Cell(23, 7, $value, 1, 0, 'C',false,'', 1);
					$pdf->Cell(33, 7, $value1['family_name'], 1, 0, 'C',false,'', 1);
					$pdf->Cell(33, 7, $value1['given_name'], 1, 0, 'C',false,'', 1);
					$pdf->Cell(33, 7, $value1['birth'], 1, 0, 'C',false,'', 1);
					$pdf->Cell(33, 7, $value1['passport_no'], 1, 1, 'C',false,'', 1);
					$i++;
				}
			}
    	}
    	$officials = D('Person')->getPersonInfoList($arrayName = array('gender'=>'female'));
>>>>>>> feature/2015-4-29-pdf-change
    	$information = "Officials:";
		$pdf->SetXY($pdf->GetX(),$pdf->GetY()+3);
		$pdf->MultiCell(180, 8, $information, 0, 'L', 0, 1, '', '', true);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
		$pdf->Cell(38, 7, "Position", 1, 0, 'C',false,'', 1);
<<<<<<< HEAD
		$pdf->Cell(33, 7, "First Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Last Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Date of Birth", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Passport No.", 1, 1, 'C',false,'', 1);
    	for ($key = 0;$key<4;$key++) 
    	{
    		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
			$pdf->Cell(38, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, "", 1, 1, 'C',false,'', 1);
=======
		$pdf->Cell(33, 7, "Family Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Given Name", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Date of Birth", 1, 0, 'C',false,'', 1);
		$pdf->Cell(33, 7, "Passport No.", 1, 1, 'C',false,'', 1);
    	foreach ($officials as $key => $value) 
    	{
    		if($value['groupe'] == 'Competitor')
    			continue;
    		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
			$pdf->Cell(38, 7, $value['groupe'], 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, $value['family_name'], 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, $value['given_name'], 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, $value['birth'], 1, 0, 'C',false,'', 1);
			$pdf->Cell(33, 7, $value['passport_no'], 1, 1, 'C',false,'', 1);
>>>>>>> feature/2015-4-29-pdf-change
    	}

		$pdf->SetFont('droidsansfallback', 'B', 10);
		$pdf->SetXY($pdf->GetX()+5,$pdf->GetY()+10);
		$pdf->MultiCell(85, 30, "Presidents Signature & Date", 1, 'L', 0, 0, '', '', true, 0, false, true, 30, 'B');
		$pdf->MultiCell(85, 30, "Federation / Association Official Stamp", 1, 'L', 0, 1, '', '', true, 0, false, true, 30, 'B');
		$this->addFooter($pdf);
		$pdf->Output('FinalEntryWomenForm.pdf', "I");
	}

	public function questionaireForAllMenOrWomenGeneratePdf()
	{
		$pdf = new TCPDF('Portrait', 'mm', 'A4', true, 'UTF-8', false);
		 if(session('user') != null)
		 {
        	$personInfo = D('Person')->getPersonInfoList();
        	$user = D('User')->getCurrentUserInfo();
        	$activeEvent = D('Event')->getEventByFilter($arrayName = array('id'=>$user['eventName']));
        	
        }
        foreach ($personInfo as $key => $value) 
        {
<<<<<<< HEAD
			$this->addHeader($pdf,"FINAL ENTRY FORM - (WOMEN - INDIVIDUAL)");
=======
			$this->addHeader($pdf,"QUESTIONAIRE FOR ALL MEN and WOMEN");
>>>>>>> feature/2015-4-29-pdf-change
			$pdf->SetFont('droidsansfallback', '', 12);
			$information = "  Please fill up all requirements and send this entry form by ".'2015-11-15'." to the office of the ".$activeEvent['hosted_by'].". Email:"."abcdef@hotmail.com";
			$pdf->MultiCell(180, 15, $information, 0, 'L', 0, 1, '', '', true);
			$pdf->SetFont('droidsansfallback', 'B', 12);
			$pdf->SetX($pdf->GetX()+5);
			$pdf->Cell(170, 10, " Federation:".$user['federation'], 1, 1, 'L',false,'', 1);
			$pdf->SetXY($pdf->GetX()+5,$pdf->GetY()+5);
			$pdf->Cell(51, 10, " Tel:".$user['tel'], 1, 0, 'L',false,'', 1);
			$pdf->Cell(51, 10, " Fax:".$user['fax'], 1, 0, 'L',false,'', 1);
			$pdf->Cell(68, 10, " E-mail:".$user['email'], 1, 1, 'L',false,'', 1);
			$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
			$pdf->Cell(85, 15, " Number Of Officials:".$user['number_of_officials'], 1, 0, 'L',false,'', 1);
			$pdf->Cell(85, 15, " Number Of Competitor:".$user['number_of_competitiors'], 1, 1, 'L',false,'', 1);
			$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
			$pdf->Cell(170, 10, " Address:".$user['adress'], 1, 1, 'L',false,'', 1);

			$pdf->SetFont('droidsansfallback', 'B', 11);
			$pdf->SetXY($pdf->GetX()+5,$pdf->GetY()+5);
			$pdf->Cell(20, 10, " Position:", 1, 0, 'L',false,'', 1);
<<<<<<< HEAD
			$pdf->Cell(108, 10, " ", 1, 1, 'L',false,'', 1);
=======
			$pdf->Cell(108, 10, " ".$value['groupe'], 1, 1, 'L',false,'', 1);
>>>>>>> feature/2015-4-29-pdf-change
			$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
			$pdf->Cell(20, 12, " Name:", 1, 0, 'L',false,'', 1);
			$pdf->MultiCell(54, 12, " Family Name:".$value['family_name'], 1, 'L', 0, 0, '', '', true, 0, false, true, 12, 'T');
			$pdf->MultiCell(54, 12, " Given Name:".$value['given_name'], 1, 'L', 0, 1, '', '', true, 0, false, true, 12, 'T');
			$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
			$pdf->Cell(64, 10, " Weight Category:".$value['category'], 1, 0, 'L',false,'', 1);
			$pdf->MultiCell(64, 10, " Nationality / Citizenship:", 1, 'L', 0, 1, '', '', true, 0, false, true, 10, 'T');
			$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
			$pdf->MultiCell(64, 12, " Date of Birth:".$value['birth'], 1, 'L', 0, 0, '', '', true, 0, false, true, 12, 'T');
			$pdf->MultiCell(64, 12, " Passport No.".$value['passport_no'], 1, 'L', 0, 1, '', '', true, 0, false, true, 12, 'T');
			$pdf->SetXY($pdf->GetX()+5,$pdf->GetY());
			$pdf->MultiCell(128, 12, " Best Result:".$value['best_result'], 1, 'L', 0, 1, '', '', true, 0, false, true, 12, 'T');
			$x = $pdf->GetX()+133;
			$y = $pdf->GetY()-56;
			$pdf->SetXY($x,$y);
			
			$pdf->Cell(42, 56, "Color Photo", 1, 1, 'C',false,'', 1);
			$pdf->Image($value['img_url'],$x,$y,42,56);
			

			$pdf->SetFont('droidsansfallback', 'B', 12);
			$pdf->SetXY($pdf->GetX()+5,$pdf->GetY()+5);
			$information = " Name of Parent / Guardian:(Print)________________________________________\n\n\n Relationship:____________________________________________\n\n\n Signature:_______________________________________________\n\n\n Date:___________________________________________________";
			$pdf->MultiCell(170, 70, $information, 1, 'L', 0, 0, '', '', true, 0, false, true, 70, 'M');
			$this->addFooter($pdf);
		}
		$pdf->Output('QuestionaireForAllMenOrWomen.pdf', "I");
	}
}
?>