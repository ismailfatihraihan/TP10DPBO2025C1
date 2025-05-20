<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Recipes</h2>
        <a href="index.php?view=recipes&action=create" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded">
            Add New Recipe
        </a>
    </div>

    <?php if (empty($viewModel->recipes)): ?>
        <p class="text-gray-500">No recipes found. Add your first recipe!</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Name</th>
                        <th class="py-2 px-4 border-b text-left">Description</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($viewModel->recipes as $recipe): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b"><?php echo $recipe['id']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $recipe['name']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo substr($recipe['description'], 0, 100) . (strlen($recipe['description']) > 100 ? '...' : ''); ?></td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-2">
                                    <a href="index.php?view=recipes&action=view&id=<?php echo $recipe['id']; ?>" class="text-blue-500 hover:underline">View</a>
                                    <a href="index.php?view=recipes&action=edit&id=<?php echo $recipe['id']; ?>" class="text-yellow-500 hover:underline">Edit</a>
                                    <a href="index.php?view=recipes&action=delete&id=<?php echo $recipe['id']; ?>" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this recipe?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>