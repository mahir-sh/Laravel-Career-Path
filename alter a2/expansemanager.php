<?php

class expansemanager 
{
    private $transactions = [];
    private $filePath = 'transactions.json';

    public function __construct() {
        $this->loadTransactions();
    }

    public function addTransaction($amount, $category, $type) {
        $transaction = new expense($amount, $category, $type);
        $this->transactions[] = $transaction;
        $this->saveTransactions();
        echo ucfirst($type) . " added successfully.\n";
    }

    public function viewTransactions($type) {
        echo ucfirst($type) . "s:\n";
        foreach ($this->transactions as $transaction) {
            if ($transaction->type == $type) {
                echo "- {$transaction->category}: \${$transaction->amount}\n";
            }
        }
    }

    public function viewCategories() {
        $categories = [];
        foreach ($this->transactions as $transaction) {
            if (!in_array($transaction->category, $categories)) {
                $categories[] = $transaction->category;
            }
        }
        echo "Categories:\n";
        foreach ($categories as $category) {
            echo "- $category\n";
        }
    }

    public function viewSavings() {
        $totalIncome = 0;
        $totalExpense = 0;
        foreach ($this->transactions as $transaction) {
            if ($transaction->type == 'income') {
                $totalIncome += $transaction->amount;
            } elseif ($transaction->type == 'expense') {
                $totalExpense += $transaction->amount;
            }
        }
        $savings = $totalIncome - $totalExpense;
        echo "Total savings: \${$savings}\n";
    }

    private function saveTransactions() {
        $data = array_map(function ($transaction) {
            return $transaction->toArray();
        }, $this->transactions);
        file_put_contents($this->filePath, json_encode($data));
    }

    private function loadTransactions() {
        if (file_exists($this->filePath)) {
            $data = json_decode(file_get_contents($this->filePath), true);
            $this->transactions = array_map(function ($item) {
                return expense::fromArray($item);
            }, $data);
        }
    }
}


