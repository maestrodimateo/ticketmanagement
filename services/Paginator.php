<?php
namespace Services;

class Paginator {

    public $page_number;
    public $rows = [];
    public $current_page;
    public $path;

    public function __construct(array $rows, int $page_number, int $current_page, string $path)
    {
        $this->page_number = $page_number;
        $this->current_page = $current_page;
        $this->rows = $rows;
        $this->path = $path;
    }

    public function active(int $param): string
    {
        return ($this->current_page == $param) ? 'active' : '';
    }
}