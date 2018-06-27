<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Name: DOMPDF
 *
 * Author: Jd Fiscus
 * jdfiscus@gmail.com
 * @iamfiscus
 *
 *
 * Origin API Class: http://code.google.com/p/dompdf/
 *
 * Location: http://github.com/iamfiscus/Codeigniter-DOMPDF/
 *
 * Created: 06.22.2010
 *
 * Description: This is a Codeigniter library which allows you to convert HTML to PDF with the DOMPDF library
 *
 */
class Mpdf_gen {

    public function __construct() {
        $this->CI = & get_instance();
        require_once 'mpdf/mpdf.php';
    }

    public function gen_pdf($html, $paper = 'A4') {
        $session_info = $this->CI->session->userdata('logged_in');
        $mpdf = new mPDF('utf-8', $paper, '', '', 15, 15, 30, 20, 5, 5, 'L');
        $mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

        $header = '<table style="border-bottom: 1px solid #e3e3e3; color: #000088; font-family: serif;  font-size: 9pt; margin-bottom: 25px; width: 100%;"><tr>
                    <td width="50%"><img title="Image" src="' . base_url() . "uploads/logo.png" . '" width="65px" /><br/><br/></td>
                    <td width="50%" style="text-align: right;"><span style="font-size: 22px; font-style: italic;">OKP-9</span><br/><span style="font: 12px; font-style: italic;">Bangladesh Military Contingent to Kuwait</span><br/></td>
                    </tr></table>
                    ';
        $headerE = '<table style="border-bottom: 1px solid #e3e3e3; color: #000088; font-family: serif; font-size: 9pt; margin-bottom: 25px; width: 100%;"><tr>
                    <td width="50%"><img src="' . base_url() . "uploads/logo.png" . '" width="65px" /><br/></td>
                    <td width="50%" style="text-align: right;"><span style="font-size: 22px; font-style: italic;">OKP-9</span><br/><span style="font-size: 12px; font-style: italic;">Bangladesh Military Contingent to Kuwait</span><br/></td>
                    </tr></table>
                    ';
        $footer = '<table style="width: 100%;">
					<tbody>
						<tr>
							<td style="width: 33%; font-family: sans-serif; font-size: 7pt; font-style: italic;">Inventory Management System</td>
							<td style="width: 33%; font-family: sans; font-size: 12pt; font-style: italic; font-weight: bold;text-align: center;">- {PAGENO}/{nb} -</td>
							<td style="width: 33%; text-align: right; font-family: monospace; font-size: 9pt;">Printed @ {DATE j-m-Y g:i A}</td>
						</tr>
					</tbody>
				</table>';

        $footerE = '<table style="width: 100%;">
					<tbody>
						<tr>
							<td style="width: 33%; font-family: sans-serif; font-size: 7pt; font-style: italic;">Inventory Management System</td>
							<td style="width: 33%; font-family: sans; font-size: 12pt; font-style: italic; font-weight: bold;text-align: center;">- {PAGENO}/{nb} -</td>
							<td style="width: 33%; text-align: right; font-family: monospace; font-size: 9pt;">Printed @ {DATE j-m-Y g:i A}</td>
						</tr>
					</tbody>
				</table>';
        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLHeader($headerE, 'E');
        $mpdf->SetHTMLFooter($footer);
        $mpdf->SetHTMLFooter($footerE, 'E');

        $mpdf->SetWatermarkText('', 0.1);
        $mpdf->showWatermarkText = true;
        $mpdf->WriteHTML($html);
        $fileName = date('Y_m_d_H_i_s');
        $mpdf->Output('FileName_' . $fileName . '.pdf', 'I');
    }

}