<?php
namespace Models;

use Helpers\Hydrator;

class Element
{
    private ?int $id = null;
    private string $name = '';
    private string $urlImg = '';

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            Hydrator::hydrate($this, $data);
        }
    }

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }

    public function getUrlImg(): string { return $this->urlImg; }
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }
}
