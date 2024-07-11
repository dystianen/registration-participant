<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $session = session();

    // Check if user is logged in
    if (!$session->has('id_user')) {
      // Redirect to login page if not authenticated
      return redirect()->to(base_url('login'))->with('failed', 'You must be logged in to access this page.');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // No action needed after request
  }
}
