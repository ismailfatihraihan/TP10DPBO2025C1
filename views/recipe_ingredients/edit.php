<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Edit Recipe Ingredient</h2>
        <p class="text-gray-600">Update the recipe, ingredient, or quantity</p>
    </div>

    <form action="index.php?view=recipe_ingredients&action=edit" method="post" class="space-y-4">
        <input type="hidden" name="id" value="<?php echo $viewModel->id; ?>">
        
        <div>
            <label for="recipe_id" class="block text-sm font-medium text-gray-700 mb-1">Recipe</label>
            <select id="recipe_id" name="recipe_id" required 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <?php foreach ($viewModel->recipes as $recipe): ?>
                    <option value="<?php echo $recipe['id']; ?>" <?php echo ($viewModel->recipe_id == $recipe['id']) ? 'selected' : ''; ?>>
                        <?php echo $recipe['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="ingredient_id" class="block text-sm font-medium text-gray-700 mb-1">Ingredient</label>
            <select id="ingredient_id" name="ingredient_id" required 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <?php foreach ($viewModel->ingredients as $ingredient): ?>
                    <option value="<?php echo $ingredient['id']; ?>" <?php echo ($viewModel->ingredient_id == $ingredient['id']) ? 'selected' : ''; ?>>
                        <?php echo $ingredient['name']; ?> (<?php echo $ingredient['unit'] ? $ingredient['unit'] : 'no unit'; ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
            <input type="number" id="quantity" name="quantity" step="0.01" min="0" value="<?php echo $viewModel->quantity; ?>" required 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>

        <div class="flex items-center justify-between pt-4">
            <a href="index.php?view=recipe_ingredients" class="text-emerald-600 hover:underline">Back to Recipe Ingredients</a>
            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded">
                Update Recipe Ingredient
            </button>
        </div>
    </form>
</div>