<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Name:  DOMPDF
 * 
 * Author: Jd Fiscus
 * 	 	  jdfiscus@gmail.com
 *         @iamfiscus
 *          
 *
 * Origin API Class: http://code.google.com/p/dompdf/
 * 
 * Location: http://github.com/iamfiscus/Codeigniter-DOMPDF/
 *          
 * Created:  06.22.2010 
 * 
 * Description:  This is a Codeigniter library which allows you to convert HTML to PDF with the DOMPDF library
 * 
 */

use Dompdf\Dompdf;

class Pdf extends Dompdf
{
	public $filename;
	public function __construct()
	{
		parent::__construct();
		$this->filename = "laporan.pdf";
	}
	protected function ci()
	{
		return get_instance();
	}
	public function load_view($view, $data = array())
	{
		$html = $this->ci()->load->view($view, $data, TRUE);
		$this->load_html($html);
		$this->render();
		$this->stream($this->filename, array("Attachment" => false));
	}
}
