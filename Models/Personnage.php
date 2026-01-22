<?php
namespace Models;

use Models\Element;
use Models\origin;
use Models\UnitClass;

class Personnage
{
    private ?string $id = null;
    private string $name;
    private int $rarity;
    private string $urlImg;
    private ?Element $element = null;
    private ?Origin $origin = null;
    private ?Unitclass $unitclass = null;

    public function getId(): ?string { return $this->id; }
    public function setId(?string $id): void { $this->id = $id; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }

    public function getElement(): ?Element { return $this->element; }
    public function setElement (?Element $element): void { $this->element = $element; }

    public function getUnitclass(): ?UnitClass { return $this->unitclass; }
    public function setUnitclass(?UnitClass $unitclass): void { $this->unitclass = $unitclass; }

    public function getRarity(): int { return $this->rarity; }
    public function setRarity(int $rarity): void { $this->rarity = $rarity; }

    public function getOrigin(): ?Origin { return $this->origin; }
    public function setOrigin(?Origin $origin): void { $this->origin = $origin; }

    public function getUrlImg(): string { return $this->urlImg; }
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }
}
