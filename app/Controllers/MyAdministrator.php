<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class MyAdministrator extends Controller
{
    protected $user;
    protected $helpers = ['url', 'form']; // helpers útiles para views

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Leer el token desde la cookie y loguear para depuración
        $token = $_COOKIE['token'] ?? null;
        error_log('TOKEN EN COOKIE: ' . ($token ?: 'NO HAY TOKEN'));

        if (!$token) {
            return redirect()->to('/login');
        }

        try {
            $key = getenv('JWT_SECRET') ?: 'supersecretkey';
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            // Validar campos mínimos del JWT
            if (!isset($decoded->uid) || !isset($decoded->email)) {
                return redirect()->to('/login');
            }

            // Guardar usuario decodificado para uso en controladores y vistas
            $this->user = $decoded;
        } catch (\Exception $e) {
            // Si falla la validación, redirige al login
            return redirect()->to('/login');
        }
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
        // Validar que la vista exista
        if (!is_file(APPPATH . 'Views/' . $page . '.php')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Datos compartidos
        $data['breadcrumb'] = $this->generarBreadcrumb();
        $data['user'] = $this->user;

        return view('template/view_header', $data)
            . view('template/view_sidemenu', $data)
            . view('template/view_navbar', $data)
            . view('template/view_mainheader', $data)
            . view('template/view_breadcrum', $data)
            . view($page, $data)
            . view('template/view_footer', $data);
    }
}
