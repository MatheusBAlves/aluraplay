<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class NewVideoController implements Controller
{

    public function __construct(private VideoRepository $repository)
    {
    }

    public function processaRequisicao() : void {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $titulo = filter_input(INPUT_POST, 'titulo');

        if ($url === false || $titulo === false) {
            header('Location: /?sucesso=0');
            return;
        }

        $sucess = $this->repository->add(new \Alura\Mvc\Entity\Video($url, $titulo));
        if ($sucess === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }

    }

}