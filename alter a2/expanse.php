<?php


class expense {
    public $amount;
    public $category;
    public $type;

    public function __construct($amount, $category, $type) {
        $this->amount = $amount;
        $this->category = $category;
        $this->type = $type;
    }

    public function toArray() {
        return [
            'amount' => $this->amount,
            'category' => $this->category,
            'type' => $this->type,
        ];
    }

    public static function fromArray($data) {
        return new self($data['amount'], $data['category'], $data['type']);
    }
}