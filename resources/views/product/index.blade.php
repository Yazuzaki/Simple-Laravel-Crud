<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.transition = 'opacity 0.5s ease-out'; // Add transition for smooth fading
                    successMessage.style.opacity = 0; // Fade out
                    setTimeout(() => {
                        successMessage.remove(); // Remove the element from the DOM
                    }, 500); // Wait for the transition to finish before removing
                }, 3000); // Change this number to set how long the message is displayed (in milliseconds)
            }
        });
    </script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4 text-center">
    <a href="{{ route('product.index') }}" class="text-black-500 no-underline hover:text-green-700">
        Product Management
    </a>
</h1>

</h1>

        
        <!-- Success Message -->
        @if (session()->has('success'))
        <div id="success-message" class="mb-4 p-4 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
        @endif

        <!-- Search Form -->
        <div class="mb-4">
            <form action="{{ route('product.index') }}" method="GET">
                <input type="text" name="search" placeholder="Search products..." class="border border-gray-300 rounded-md shadow-sm px-4 py-2" value="{{ request()->input('search') }}">
                <button type="submit" class="ml-2 bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition duration-200">Search</button>
            </form>
        </div>

        <div class="mb-4">
            <a href="{{ route('product.create') }}" class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                Create Product
            </a>
        </div>

        <!-- Product Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delete</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->qty }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('product.edit', ['product' => $product]) }}" class="inline-block bg-green-200 text-green-800 font-semibold py-1 px-3 rounded hover:bg-green-300 transition duration-200">Edit</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form method="post" action="{{ route('product.destroy', ['product' => $product]) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" class="bg-red-500 text-white font-semibold py-1 px-3 rounded hover:bg-red-700 transition duration-200">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $products->appends(request()->input())->links() }} <!-- Appending search query to pagination links -->
        </div>
    </div>
</body>
</html>
