<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class MyAdministrator extends Controller
{
    protected $helpers = ['url', 'form']; // Helpers que se cargarán automáticamente

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        // Inicializaciones comunes aquí
    }

    protected function generarBreadcrumb(): array
    {
        $breadcrumb = [];
        $segments = service('uri')->getSegments();
        $url = base_url();

        foreach ($segments as $segment) {
            $url .= '/' . $segment;
            $breadcrumb[ucwords($segment)] = $url;
        }

        return $breadcrumb;
    }

    protected function renderTemplate(string $page, array $data = []): string
    {
        // Verificar si la vista existe
        if (!is_file(APPPATH . 'Views/' . $page . '.php')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Datos comunes a todas las vistas
        $data['breadcrumb'] = $this->generarBreadcrumb();

        // Construir la vista completa
        return view('template/view_header', $data)
            . view('template/view_sidemenu', $data)
            . view('template/view_navbar', $data)
            . view('template/view_mainheader', $data)
            . view('template/view_breadcrum', $data)
            . view($page, $data)
            . view('template/view_footer', $data);
    }
}