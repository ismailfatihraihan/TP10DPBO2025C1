<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800"><?php echo $viewModel->name; ?></h2>
                <?php if (!empty($viewModel->description)): ?>
                    <p class="text-gray-600 mt-2"><?php echo $viewModel->description; ?></p>
                <?php endif; ?>
            </div>
            <div class="flex space-x-2">
                <a href="index.php?view=recipes&action=edit&id=<?php echo $viewModel->id; ?>" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Edit</a>
                <a href="index.php?view=recipes" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm">Back</a>
            </div>
        </div>
    </div>

    <div class="mb-8">
        <h3 class="text-lg font-medium text-gray-800 mb-2">Ingredients</h3>
        <?php if (empty($recipeIngredients)): ?>
            <p class="text-gray-500">No ingredients added to this recipe yet.</p>
            <div class="mt-2">
                <a href="index.php?view=recipe_ingredients&action=create&recipe_id=<?php echo $viewModel->id; ?>" 
                   class="text-emerald-600 hover:underline">Add ingredients</a>
            </div>
        <?php else: ?>
            <ul class="list-disc pl-5 space-y-1">
                <?php foreach ($recipeIngredients as $ingredient): ?>
                    <li>
                        <?php echo $ingredient['quantity']; ?> 
                        <?php echo $ingredient['unit'] ? $ingredient['unit'] : ''; ?> 
                        <?php echo $ingredient['ingredient_name']; ?>
                        <a href="index.php?view=recipe_ingredients&action=edit&id=<?php echo $ingredient['id']; ?>" 
                           class="text-xs text-blue-500 hover:underline ml-2">Edit</a>
                        <a href="index.php?view=recipe_ingredients&action=delete&id=<?php echo $ingredient['id']; ?>&redirect=recipe&recipe_id=<?php echo $viewModel->id; ?>" 
                           class="text-xs text-red-500 hover:underline ml-1" 
                           onclick="return confirm('Are you sure you want to remove this ingredient?')">Remove</a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="mt-3">
                <a href="index.php?view=recipe_ingredients&action=create&recipe_id=<?php echo $viewModel->id; ?>" 
                   class="text-emerald-600 hover:underline">Add more ingredients</a>
            </div>
        <?php endif; ?>
    </div>

    <div>
        <h3 class="text-lg font-medium text-gray-800 mb-2">Instructions</h3>
        <?php if (empty($viewModel->instructions)): ?>
            <p class="text-gray-500">No instructions provided.</p>
        <?php else: ?>
            <div class="bg-gray-50 p-4 rounded whitespace-pre-line">
                <?php echo $viewModel->instructions; ?>
            </div>
        <?php endif; ?>
    </div>
</div>