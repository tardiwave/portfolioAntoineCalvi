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
    public function getPagination(string $link): ?string
    {
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPages();
        if($currentPage >= $pages){
            $next = null;
            $nextStatus = "disabled";
        }else{
            $next = $link . "?page=" . ($currentPage + 1);
            $nextStatus = null;
        }
        if($currentPage <= 1){
            $previous = null;
            $previousStatus = "disabled";
        }else{
            if($currentPage >= 2){
                $previous = $link . "?page=" . ($currentPage - 1);
                $previousStatus = null;
            }
        }

        $previousHTML = "<nav aria-label='Page navigation example'><ul class='pagination'><li class='page-item {$previousStatus}'><a class='page-link' href='{$previous}'>Previous</a></li>";
        if($previous === null){
            $pagesLink = [];
            for ($i = 1; $i <= 3; $i++) {
                $pagesLink[] = $i;
            }
        } elseif($next === null){
            $pagesLink = [];
            for ($i = $currentPage; ($i > ($currentPage-3) && $i >= 1); $i--) {
                $pagesLink[] = $i;
            }
            $pagesLink = array_reverse($pagesLink);
        } else{
            for ($i = ($currentPage - 1); $i <= ($currentPage + 1); $i++) {
                $pagesLink[] = $i;
            }
        }

        foreach($pagesLink as $number){
            if ($number === $currentPage) {
                $disabled = "disabled";
            }else{
                $disabled = null;
            }
            $urlNumber = $link . "?page=" . $number ;
            $previousHTML .= "<li class='page-item {$disabled}'><a class='page-link' href='{$urlNumber}'>{$number}</a></li>";
        }






        // <li class="page-item"><a class="page-link" href="#">1</a></li>


        $nextHTML = "<li class='page-item {$nextStatus}'><a class='page-link' href='{$next}'>Next</a></li></ul></nav>";
        $render = $previousHTML . $nextHTML;
        return $render;
    }
}