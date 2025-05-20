<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Recipe Ingredients</h2>
        <a href="index.php?view=recipe_ingredients&action=create" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded">
            Add Recipe Ingredient
        </a>
    </div>

    <?php if (empty($viewModel->recipe_ingredients)): ?>
        <p class="text-gray-500">No recipe ingredients found. Add ingredients to your recipes!</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Recipe</th>
                        <th class="py-2 px-4 border-b text-left">Ingredient</th>
                        <th class="py-2 px-4 border-b text-left">Quantity</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($viewModel->recipe_ingredients as $recipe_ingredient): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b"><?php echo $recipe_ingredient['id']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $recipe_ingredient['recipe_name']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $recipe_ingredient['ingredient_name']; ?></td>
                            <td class="py-2 px-4 border-b">
                                <?php echo $recipe_ingredient['quantity']; ?> 
                                <?php echo $recipe_ingredient['unit'] ? $recipe_ingredient['unit'] : ''; ?>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-2">
                                    <a href="index.php?view=recipe_ingredients&action=edit&id=<?php echo $recipe_ingredient['id']; ?>" class="text-yellow-500 hover:underline">Edit</a>
                                    <a href="index.php?view=recipe_ingredients&action=delete&id=<?php echo $recipe_ingredient['id']; ?>" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this recipe ingredient?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>