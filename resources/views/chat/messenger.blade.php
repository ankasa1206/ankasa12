<x-app-layout>
    <x-slot name="header">
        <x-teks-url :items="[
            'WebChat' => route('messages.inbox'),
        ]" />
    </x-slot>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e0; border-radius: 4px; }
        .chat-height { height: calc(100vh - 200px); } 
    </style>

    <div class="py-6 overflow-hidden">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex shadow-lg rounded-lg border border-gray-200 overflow-hidden chat-height">
                
                <div class="w-1/3 flex flex-col border-r bg-gray-50 shrink-0">
                    <div class="p-4 bg-green-900 text-white font-bold flex justify-between items-center shrink-0">
                        <span>Obrolan</span>
                        <i class="fas fa-comments opacity-70"></i>
                    </div>
                    
                    <div class="flex-1 overflow-y-auto custom-scrollbar">
                        @foreach($users as $user)
                            <a href="{{ route('chat.show', $user->id) }}" 
                               class="flex items-center p-4 border-b hover:bg-green-50 transition {{ isset($receiver) && $receiver->id == $user->id ? 'bg-green-100 border-l-4 border-green-700' : '' }}">
                                <div class="w-12 h-12 bg-green-800 rounded-full flex items-center justify-center text-white font-bold shrink-0 shadow-sm">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="ml-3 overflow-hidden">
                                    <h4 class="text-sm font-bold text-gray-800 truncate">{{ $user->name }}</h4>
                                    <p class="text-xs text-gray-500 truncate italic">Klik untuk chat...</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="w-2/3 flex flex-col bg-[#e5ddd5] relative">
                    @if(isset($receiver))
                        <div class="p-3 bg-white border-b flex items-center shrink-0 shadow-sm z-10">
                            <div class="w-10 h-10 bg-green-900 rounded-full flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($receiver->name, 0, 1)) }}
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-sm font-bold text-gray-800 leading-tight">{{ $receiver->name }}</h3>
                                <span class="text-[10px] text-green-600 font-bold uppercase tracking-widest">Aktif</span>
                            </div>
                        </div>

                        <div id="chat-container" class="flex-1 overflow-y-auto p-4 space-y-4 custom-scrollbar bg-[url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png')] bg-repeat">
                            @foreach($messages as $msg)
                                <div class="flex {{ $msg->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                                    <div class="max-w-[75%] px-3 py-2 rounded-lg shadow-sm {{ $msg->sender_id == auth()->id() ? 'bg-green-800 text-white rounded-tr-none' : 'bg-white text-gray-800 rounded-tl-none border border-gray-100' }}">
                                        <p class="text-sm leading-relaxed">{{ $msg->message }}</p>
                                        <span class="text-[9px] mt-1 block text-right {{ $msg->sender_id == auth()->id() ? 'text-green-200' : 'text-gray-400' }}">
                                            {{ $msg->created_at->format('H:i') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="p-4 bg-white border-t shrink-0">
                            <form id="ajax-chat-form" class="flex items-center space-x-2">
                                @csrf
                                <input type="hidden" name="receiver_id" id="receiver_id" value="{{ $receiver->id }}">
                                <input type="text" name="message" id="message-input" autocomplete="off" required placeholder="Tulis pesan..." 
                                       class="flex-1 border-gray-300 focus:ring-green-500 focus:border-green-500 rounded-full px-4 py-2 text-sm shadow-sm">
                                <button type="submit" class="text-green-800 hover:scale-110 transition p-2">
                                    <i class="fas fa-paper-plane text-xl"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex-1 flex flex-col items-center justify-center bg-gray-50 text-gray-400">
                            <div class="bg-gray-200 p-8 rounded-full mb-4 shadow-inner">
                                <i class="fas fa-comments text-5xl opacity-30"></i>
                            </div>
                            <h3 class="text-lg font-bold">Ponpes Mahmud Chat</h3>
                            <p class="text-sm">Silakan pilih kontak untuk mulai mengobrol</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const container = document.getElementById('chat-container');
            const userId = @json(auth()->id());
            
            const scrollToBottom = () => {
                if(container) container.scrollTop = container.scrollHeight;
            };
            scrollToBottom();

            // 1. AJAX SEND MESSAGE
            $('#ajax-chat-form').on('submit', function(e) {
                e.preventDefault();
                let message = $('#message-input').val();
                let receiver_id = $('#receiver_id').val();
                let token = $('input[name="_token"]').val();

                if(message.trim() == '') return;

                $.ajax({
                    url: "{{ route('messages.store') }}",
                    method: "POST",
                    data: { _token: token, receiver_id: receiver_id, message: message },
                    success: function(response) {
                        let html = `
                            <div class="flex justify-end">
                                <div class="max-w-[75%] px-3 py-2 rounded-lg shadow-sm bg-green-800 text-white rounded-tr-none">
                                    <p class="text-sm leading-relaxed">${message}</p>
                                    <span class="text-[9px] mt-1 block text-right text-green-200 italic">Baru saja</span>
                                </div>
                            </div>`;
                        $('#chat-container').append(html);
                        $('#message-input').val('');
                        scrollToBottom();
                    }
                });
            });

            // 2. REALTIME LISTENER (Echo)
            if (window.Echo) {
                window.Echo.private('chat.' + userId)
                .listen('MessageSent', (e) => {
                    const activeReceiverId = $('#receiver_id').val();
                    
                    // Validasi: Hanya tampilkan jika pengirim adalah orang yang sedang kita ajak chat
                    if (e.message.sender_id == activeReceiverId) {
                        let html = `
                            <div class="flex justify-start">
                                <div class="max-w-[75%] px-3 py-2 rounded-lg shadow-sm bg-white text-gray-800 rounded-tl-none border border-gray-100">
                                    <p class="text-sm leading-relaxed">${e.message.message}</p>
                                    <span class="text-[9px] mt-1 block text-right text-gray-400 italic">Baru saja</span>
                                </div>
                            </div>`;
                        $('#chat-container').append(html);
                        scrollToBottom();
                    }
                });
            }
        });
    </script>
</x-app-layout>