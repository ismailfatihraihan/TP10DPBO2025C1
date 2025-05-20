<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Add Ingredient to Recipe</h2>
        <p class="text-gray-600">Specify the recipe, ingredient, and quantity</p>
    </div>

    <form action="index.php?view=recipe_ingredients&action=create" method="post" class="space-y-4">
        <div>
            <label for="recipe_id" class="block text-sm font-medium text-gray-700 mb-1">Recipe</label>
            <select id="recipe_id" name="recipe_id" required 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">Select a recipe</option>
                <?php foreach ($viewModel->recipes as $recipe): ?>
                    <option value="<?php echo $recipe['id']; ?>" <?php echo (isset($_GET['recipe_id']) && $_GET['recipe_id'] == $recipe['id']) ? 'selected' : ''; ?>>
                        <?php echo $recipe['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="ingredient_id" class="block text-sm font-medium text-gray-700 mb-1">Ingredient</label>
            <select id="ingredient_id" name="ingredient_id" required 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">Select an ingredient</option>
                <?php foreach ($viewModel->ingredients as $ingredient): ?>
                    <option value="<?php echo $ingredient['id']; ?>">
                        <?php echo $ingredient['name']; ?> (<?php echo $ingredient['unit'] ? $ingredient['unit'] : 'no unit'; ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
            <input type="number" id="quantity" name="quantity" step="0.01" min="0" required 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>

        <div class="flex items-center justify-between pt-4">
            <?php if (isset($_GET['recipe_id'])): ?>
                <a href="index.php?view=recipes&action=view&id=<?php echo $_GET['recipe_id']; ?>" class="text-emerald-600 hover:underline">Back to Recipe</a>
            <?php else: ?>
                <a href="index.php?view=recipe_ingredients" class="text-emerald-600 hover:underline">Back to Recipe Ingredients</a>
            <?php endif; ?>
            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded">
                Add Ingredient to Recipe
            </button>
        </div>
    </form>
</div>