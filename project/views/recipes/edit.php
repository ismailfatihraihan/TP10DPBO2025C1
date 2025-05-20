<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Edit Recipe</h2>
        <p class="text-gray-600">Update recipe details and instructions</p>
    </div>

    <form action="index.php?view=recipes&action=edit" method="post" class="space-y-4">
        <input type="hidden" name="id" value="<?php echo $viewModel->id; ?>">
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Recipe Name</label>
            <input type="text" id="name" name="name" value="<?php echo $viewModel->name; ?>" required 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea id="description" name="description" rows="3" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"><?php echo $viewModel->description; ?></textarea>
        </div>

        <div>
            <label for="instructions" class="block text-sm font-medium text-gray-700 mb-1">Instructions</label>
            <textarea id="instructions" name="instructions" rows="6" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"><?php echo $viewModel->instructions; ?></textarea>
        </div>

        <div class="flex items-center justify-between pt-4">
            <a href="index.php?view=recipes" class="text-emerald-600 hover:underline">Back to Recipes</a>
            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded">
                Update Recipe
            </button>
        </div>
    </form>
</div>