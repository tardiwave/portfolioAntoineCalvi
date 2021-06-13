<?php
namespace App;
use \PDO;

class QueryPagination {

    private $query;

    private $queryCount;

    private $pdo;

    private $perPage;

    private $count;

    private $items;

    public function __construct(
        string $query,
        string $queryCount,
        ?\PDO $pdo = null,
        int $perPage = 12
    )
    {
        $this->query = $query;
        $this->queryCount = $queryCount;
        $this->pdo = $pdo ?: Connection::getPDO();
        $this->perPage = $perPage;
    }

    public function getItems(string $classMapping, array $params):array
    {
        if($this->items === null){
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPages();
        if($currentPage > $pages){
            echo "Cette page n'existe pas";
        }
        $offset = $this->perPage * ($currentPage - 1);
        $query = $this->pdo->prepare($this->query .
        " LIMIT {$this->perPage} OFFSET $offset" );
        if($params != []){
            $query->execute([$params[0] => $params[1]]);
        }else{
            $query->execute();
        }
        $query->setFetchMode(PDO::FETCH_CLASS, $classMapping);
        $this->items = $query->fetchAll();
        }
        return $this->items;
    }
    private function getCurrentPage(): int
    {
        return URL::getPositiveInt('page', 1);
    }
    
    private function getPages(): int
    {
        if($this->count === null){
            $this->count = (int)$this->pdo
            ->query($this->queryCount)
            ->fetch(PDO::FETCH_NUM)[0];
        }
        return ceil($this->count / $this->perPage);
    }

    public function previousLink(string $link): ?string
    {
        $currentPage = $this->getCurrentPage();
        if($currentPage <= 1) return null;
        if($currentPage > 2) $link .= "?page=" . ($currentPage - 1);
        return <<<HTML
            <a href="{$link}">precedent</a>
HTML;
    }
    public function nextLink(string $link): ?string
    {
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPages();
        if($currentPage >= $pages) return null;
        $link .= "?page=" . ($currentPage + 1);
        return <<<HTML
            <a href="{$link}">suivant</a>
HTML;
    }
}