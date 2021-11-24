<?php

declare(strict_types=1);


namespace App\Core\Api;

use http\Exception\RuntimeException;

class ApiEntry
{

    protected array $request;

    /**
     * @throws BadRequest
     */
    public function __construct()
    {
        //parent::__construct();
        $this->getRequestMethod();
    }

    protected function getResponse($request)
    {
        try {
            if (!is_array($request) || empty($request)) {
                throw new BadRequest('Не удалось разобрать запрос');
            }
            $command = ApiCore::get($request['action']);
            $status = 200;
            $result = $command->process($request);
            $response = ['result' => $result, 'error' => null];
        } catch (BadRequest $e) {
            $status = 400;
            $response = ['result' => null, 'error' => $e->getMessage()];
        } catch (ProcessingError $e) {
            $status = 500;
            $response = ['result' => null, 'error' => $e->getMessage()];
        } catch (\Exception $e) {
            $status = 500;
            $response = ['result' => null, 'error' => 'Внутренняя ошибка сервера'];
        }
        return [$status, $response];
    }

    protected function processRequest($request)
    {
        [$status, $response] = $this->getResponse($request);
        http_response_code($status);
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header('Content-Type: application/json');
        header('Cache-Control: no-cache, no-store, must-revalidate');

        try {
            echo json_encode(
                $response,
                JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
            );
        } catch (\JsonException $e) {
        }
    }

    /**
     * @throws BadRequest
     */
    protected function getRequestMethod(): void
    {
        $requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

        $shift = array_shift($requestUri);

        if ($shift !== 'api') {
            //throw new RuntimeException('API Not Found', 404);
            throw new BadRequest('Метод запроса не поддерживается');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->request = $_GET;
        } else {
            throw new BadRequest('Метод запроса не поддерживается');
        }
    }

    public function run()
    {
        $this->processRequest($this->request);
    }

}
