<?php
namespace Services\Generation;

use Dompdf\Dompdf;

class PdfGenerator
{
    private Dompdf $pdf;

    public function __construct()
    {
        $pdf = new Dompdf();
        $pdf->setPaper('A4');
        $this->pdf = $pdf;
    }

    /**
     * Load the view to be generated
     *
     * @param string $view
     * @param array $data
     * @return self
     */
    public function load_html(string $view, array $data = []): self
    {
        $view_file = VIEWS . $view . VIEW_EXTENSION;
        $this->pdf->loadHtml(get_file_content($view_file, $data));
        return $this;
    }

    /**
     * Download pdf
     *
     * @param string $name
     * @return void
     */
    public function download(string $name = 'default'): void
    {
        $name .= '.pdf';
        $this->pdf->render();
        $this->pdf->stream($name, ['Attachment' => 0]);
    }
}