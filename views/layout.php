<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="bg-emerald-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Recipe Management System</h1>
                <nav>
                    <ul class="flex space-x-6">
                        <li><a href="index.php" class="hover:underline">Home</a></li>
                        <li><a href="index.php?view=recipes" class="hover:underline">Recipes</a></li>
                        <li><a href="index.php?view=ingredients" class="hover:underline">Ingredients</a></li>
                        <li><a href="index.php?view=recipe_ingredients" class="hover:underline">Recipe Ingredients</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <?php if (!empty($viewModel->error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo $viewModel->error; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($viewModel->success)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo $viewModel->success; ?>
            </div>
        <?php endif; ?>

        <?php include $content; ?>
    </main>

    <footer class="bg-gray-200 py-4 mt-8">
        <div class="container mx-auto px-4 text-center text-gray-600">
            &copy; <?php echo date('Y'); ?> Recipe Management System
        </div>
    </footer>
</body>
</html>