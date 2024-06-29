<?php
class TransactionManager {
    private $incomesFile = 'incomes.json';
    private $expensesFile = 'expenses.json';
    private $categoryManager;

    public function __construct($categoryManager) {
        $this->categoryManager = $categoryManager;
    }

    public function addIncome() {
        echo "Enter income amount: ";
        $amount = trim(fgets(STDIN));
        $category = $this->categoryManager->selectCategory();

        $income = [
            'amount' => $amount,
            'category' => $category,
            'date' => date('Y-m-d H:i:s')
        ];

        $incomes = $this->loadData($this->incomesFile);
        $incomes[] = $income;
        $this->saveData($this->incomesFile, $incomes);
        echo "Income added successfully.\n";
    }

    public function addExpense() {
        echo "Enter expense amount: ";
        $amount = trim(fgets(STDIN));
        $category = $this->categoryManager->selectCategory();

        $savings = $this->calculateSavings();
        if ($amount > $savings) {
            echo "Insufficient balance.\n";
            return;
        }

        $expense = [
            'amount' => $amount,
            'category' => $category,
            'date' => date('Y-m-d H:i:s')
        ];

        $expenses = $this->loadData($this->expensesFile);
        $expenses[] = $expense;
        $this->saveData($this->expensesFile, $expenses);
        echo "Expense added successfully.\n";
    }

    public function viewIncomes() {
        $incomes = $this->loadData($this->incomesFile);
        $this->printData($incomes, "Incomes");
    }

    public function viewExpenses() {
        $expenses = $this->loadData($this->expensesFile);
        $this->printData($expenses, "Expenses");
    }

    public function viewSavings() {
        $savings = $this->calculateSavings();
        echo "Total savings: $savings\n";
    }

    public function viewCategoriesSummary() {
        $incomes = $this->loadData($this->incomesFile);
        $expenses = $this->loadData($this->expensesFile);

        $categories = [];

        foreach ($incomes as $income) {
            if (!isset($categories[$income['category']])) {
                $categories[$income['category']] = 0;
            }
            $categories[$income['category']] += $income['amount'];
        }

        foreach ($expenses as $expense) {
            if (!isset($categories[$expense['category']])) {
                $categories[$expense['category']] = 0;
            }
            $categories[$expense['category']] -= $expense['amount'];
        }

        echo "Categories Summary:\n";
        foreach ($categories as $category => $total) {
            echo "$category: $total\n";
        }
    }

    private function calculateSavings() {
        $incomes = $this->loadData($this->incomesFile);
        $expenses = $this->loadData($this->expensesFile);

        $totalIncome = array_sum(array_column($incomes, 'amount'));
        $totalExpense = array_sum(array_column($expenses, 'amount'));

        return $totalIncome - $totalExpense;
    }

    private function loadData($file) {
        if (!file_exists($file)) {
            return [];
        }

        $data = file_get_contents($file);
        return json_decode($data, true);
    }

    private function saveData($file, $data) {
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    }

    private function printData($data, $title) {
        if (empty($data)) {
            echo "No $title found.\n";
            return;
        }

        echo "$title:\n";
        foreach ($data as $item) {
            echo "Amount: {$item['amount']}, Category: {$item['category']}, Date: {$item['date']}\n";
        }
    }
}
