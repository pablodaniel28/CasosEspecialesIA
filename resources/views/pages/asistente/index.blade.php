<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Asistente Virtual
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 flex flex-col" style="height: 500px;">
                <!-- Área de mensajes -->
                <div id="chat-messages" class="flex-1 overflow-y-auto space-y-3 px-2 scroll-smooth mb-4"
                    style="max-height: 100%; min-height: 0;">
                    <!-- Mensajes se insertan aquí -->
                </div>

                <!-- Formulario -->
                <form id="chat-form" class="flex gap-2 pt-2 border-t border-gray-200 dark:border-gray-700">
                    <input type="text" id="chat-input" name="message" placeholder="Escribe tu pregunta..."
                        autocomplete="off"
                        class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-full text-sm bg-white dark:bg-gray-900 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required />
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-full text-sm hover:bg-blue-700 transition">
                        Enviar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');
        const chatMessages = document.getElementById('chat-messages');

        chatForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const userMessage = chatInput.value.trim();
            if (!userMessage) return;

            appendMessage('user', userMessage);
            chatInput.value = '';
            chatInput.disabled = true;

            try {
                const response = await fetch("{{ route('asistente.preguntar') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        pregunta: userMessage
                    }),
                });

                const data = await response.json();
                appendMessage('assistant', data.respuesta);
            } catch (error) {
                appendMessage('assistant', '⚠️ Lo siento, ocurrió un error. Inténtalo de nuevo.');
                console.error(error);
            } finally {
                chatInput.disabled = false;
                chatInput.focus();
            }
        });

        function appendMessage(sender, message) {
            const wrapper = document.createElement('div');
            wrapper.classList.add('flex', 'gap-2');

            if (sender === 'user') {
                wrapper.classList.add('justify-end');
                wrapper.innerHTML = `
                    <div class="bg-blue-600 text-white px-3 py-1.5 rounded-xl max-w-sm text-sm">
                        ${message}
                    </div>
                `;
            } else {
                wrapper.classList.add('justify-start');
                wrapper.innerHTML = `
                    <div class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 px-4 py-3 rounded-xl max-w-2xl text-base whitespace-pre-line leading-relaxed shadow-sm">
                        ${message}
                    </div>
                `;
            }

            chatMessages.appendChild(wrapper);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    </script>
</x-app-layout>
