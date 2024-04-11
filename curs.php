class Ingredient {
    private $name;
    private $price_per_unit;
    private $markup;

    public function __construct($name, $price_per_unit, $markup = 0) {
        $this->name = $name;
        $this->price_per_unit = $price_per_unit;
        $this->markup = $markup;
    }

    public function getName() {
        return $this->name;
    }

    public function getPricePerUnit() {
        return $this->price_per_unit * (1 + $this->markup);
    }
}

class Recipe {
    private $name;
    private $ingredients;

    public function __construct($name, $ingredients) {
        $this->name = $name;
        $this->ingredients = $ingredients;
    }

    public function getName() {
        return $this->name;
    }

    public function getIngredients() {
        return $this->ingredients;
    }

    public function calculateCost() {
        $total_cost = 0;
        foreach ($this->ingredients as $ingredient) {
            $total_cost += $ingredient->getPricePerUnit();
        }
        return $total_cost;
    }
}

class Dish {
    private $name;
    private $recipe;
    private $quantity;
    private $markup;

    public function __construct($name, $recipe, $quantity, $markup = 0) {
        $this->name = $name;
        $this->recipe = $recipe;
        $this->quantity = $quantity;
        $this->markup = $markup;
    }

    public function getName() {
        return $this->name;
    }

    public function getRecipe() {
        return $this->recipe;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function calculateCost() {
        return $this->recipe->calculateCost() * (1 + $this->markup) * $this->quantity;
    }
}

$flour = new Ingredient('flour', 0.5, 0.1); // 10% націнка
$sugar = new Ingredient('sugar', 1.0);
$butter = new Ingredient('butter', 2.0, 0.2); // 20% націнка

$cookie_recipe = new Recipe('cookie', [$flour, $sugar, $butter]);

$cookie = new Dish('cookie', $cookie_recipe, 12, 0.1); // 10% націнка

echo $cookie->calculateCost();  // Output: 21.78