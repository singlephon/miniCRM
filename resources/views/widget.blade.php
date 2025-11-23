<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Widget</title>
</head>
<body class="bg-transparent p-4">

<div id="widget-container" class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">

    <div id="success-message" class="hidden text-center py-10">
        <div class="text-green-500 text-5xl mb-4">✓</div>
        <h3 class="text-xl font-bold text-gray-800">Ticket created!</h3>
        <p class="text-gray-600 mt-2">We will contact you.</p>
        <button onclick="location.reload()" class="mt-6 text-indigo-600 hover:underline text-sm">Send another</button>
    </div>

    <form id="ticket-form" class="space-y-4">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Feedback</h2>

        <div id="error-message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm"></div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Your name</label>
            <input type="text" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Phone number</label>
                <input type="text" name="phone" required placeholder="+7..." class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Subject</label>
            <input type="text" name="subject" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" required rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Attachmet</label>
            <input type="file" name="attachment" class="mt-1 block w-full text-sm text-gray-500">
        </div>

        <button type="submit" id="submit-btn" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition disabled:opacity-50">
            Send
        </button>
    </form>
</div>

<script>
    const ticketForm = document.getElementById('ticket-form');
    ticketForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const form = e.target;
        const btn = document.getElementById('submit-btn');
        const errorDiv = document.getElementById('error-message');
        const formData = new FormData(form);

        btn.disabled = true;
        btn.innerText = 'Sending...';
        errorDiv.classList.add('hidden');

        try {
            const response = await fetch('/api/tickets', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok) {
                form.classList.add('hidden');
                document.getElementById('success-message').classList.remove('hidden');
            } else {
                let message = data.message || 'Something went wrong...';
                if (data.errors) {
                    message = Object.values(data.errors).flat().join('<br>');
                }
                throw new Error(message);
            }
        } catch (error) {
            errorDiv.innerHTML = error.message;
            errorDiv.classList.remove('hidden');
        } finally {
            btn.disabled = false;
            btn.innerText = 'Send';
        }
    });
</script>
</body>
</html>
