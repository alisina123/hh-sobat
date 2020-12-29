<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
  Class pdf extends TCPDF
  {
      function __construct()
      {
          parent::__construct();
      }
       public function Header() {
       // $image_file = K_PATH_IMAGES.'logo_example.jpg';
      //  $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 18);
        // Title
        $this->Cell(0, 15, ' CV ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10,$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
  }
?>
