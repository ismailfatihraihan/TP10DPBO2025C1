<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Welcome to Recipe Management System</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Manage your recipes, ingredients, and keep track of what ingredients are used in each recipe.
            This system allows you to create, read, update, and delete recipes and ingredients.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="bg-emerald-50 p-6 rounded-lg shadow border border-emerald-100">
            <h3 class="text-xl font-semibold text-emerald-700 mb-3">Recipes</h3>
            <p class="text-gray-600 mb-4">
                Create and manage your recipes with detailed instructions.
            </p>
            <a href="index.php?view=recipes" class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded">
                Manage Recipes
            </a>
        </div>

        <div class="bg-blue-50 p-6 rounded-lg shadow border border-blue-100">
            <h3 class="text-xl font-semibold text-blue-700 mb-3">Ingredients</h3>
            <p class="text-gray-600 mb-4">
                Add and manage ingredients with their measurement units.
            </p>
            <a href="index.php?view=ingredients" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Manage Ingredients
            </a>
        </div>

        <div class="bg-amber-50 p-6 rounded-lg shadow border border-amber-100">
            <h3 class="text-xl font-semibold text-amber-700 mb-3">Recipe Ingredients</h3>
            <p class="text-gray-600 mb-4">
                Connect ingredients to recipes with specific quantities.
            </p>
            <a href="index.php?view=recipe_ingredients" class="inline-block bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded">
                Manage Recipe Ingredients
            </a>
        </div>
    </div>

    <div class="mt-12 border-t border-gray-200 pt-8">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Getting Started</h3>
        <ol class="list-decimal pl-5 space-y-2 text-gray-600">
            <li>Start by adding ingredients to your system</li>
            <li>Create recipes with names, descriptions, and cooking instructions</li>
            <li>Add ingredients to your recipes with specific quantities</li>
            <li>View your complete recipes with all ingredients and instructions</li>
        </ol>
    </div>
</div>