<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Edit Ingredient</h2>
        <p class="text-gray-600">Update ingredient details</p>
    </div>

    <form action="index.php?view=ingredients&action=edit" method="post" class="space-y-4">
        <input type="hidden" name="id" value="<?php echo $viewModel->id; ?>">
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Ingredient Name</label>
            <input type="text" id="name" name="name" value="<?php echo $viewModel->name; ?>" required 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>

        <div>
            <label for="unit" class="block text-sm font-medium text-gray-700 mb-1">Unit (e.g., g, kg, ml, cup)</label>
            <input type="text" id="unit" name="unit" value="<?php echo $viewModel->unit; ?>" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>

        <div class="flex items-center justify-between pt-4">
            <a href="index.php?view=ingredients" class="text-emerald-600 hover:underline">Back to Ingredients</a>
            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded">
                Update Ingredient
            </button>
        </div>
    </form>
</div>