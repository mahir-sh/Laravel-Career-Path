<?php
class CategoryManager {
    private $categoriesFile = 'categories.json';

    public function manageCategories() {
        while (true) {
            echo "1. View categories\n";
            echo "2. Create category\n";
            echo "Enter your option (or press Enter to go back): ";
            $option = trim(fgets(STDIN));

            if ($option == '') {
                break;
            }

            switch ($option) {
                case '1':
                    $this->viewCategories();
                    break;
                case '2':
                    $this->createCategory();
                    break;
                default:
                    echo "Invalid option.\n";
            }
        }
    }

    public function viewCategories() {
        $categories = $this->loadData($this->categoriesFile);
        if (empty($categories)) {
            echo "No categories found.\n";
            return;
        }

        echo "Categories:\n";
        foreach ($categories as $category) {
            echo "- $category\n";
        }
    }

    public function createCategory() {
        echo "Enter new category name: ";
        $category = trim(fgets(STDIN));

        $categories = $this->loadData($this->categoriesFile);
        if (in_array($category, $categories)) {
            echo "Category already exists.\n";
            return;
        }

        $categories[] = $category;
        $this->saveData($this->categoriesFile, $categories);
        echo "Category created successfully.\n";
    }

    public function selectCategory() {
        $categories = $this->loadData($this->categoriesFile);

        if (empty($categories)) {
            echo "No categories available. Creating a new category.\n";
            $this->createCategory();
            $categories = $this->loadData($this->categoriesFile);
        }

        while (true) {
            echo "Available categories:\n";
            foreach ($categories as $index => $category) {
                echo ($index + 1) . ". $category\n";
            }

            echo "Select category number or enter a new category name: ";
            $input = trim(fgets(STDIN));

            if (is_numeric($input)) {
                $categoryIndex = $input - 1;

                if (isset($categories[$categoryIndex])) {
                    return $categories[$categoryIndex];
                } else {
                    echo "Invalid category selected. Please try again.\n";
                }
            } else {
                // If the input is not a number, assume it's a new category name
                $newCategory = $input;
                $categories[] = $newCategory;
                $this->saveData($this->categoriesFile, $categories);
                echo "New category '$newCategory' created successfully.\n";
                return $newCategory;
            }
        }
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
}
