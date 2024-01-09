@props([
'redirect' => false,
'messageToDisplay' => ''
])


<div x-data="{isOpen:false,
            messageToDisplay:'{{ $messageToDisplay }}',
            showNotification(message){
                this.isOpen=true
                this.messageToDisplay=message
                setTimeout(()=>{
                    this.isOpen=false
                },5000)
            }}" x-init="

            @if ($redirect)
                $nextTick(() => showNotification(messageToDisplay))

            @else
            Livewire.on('priceWasAssigned',message=>{
                showNotification(message)
            })
        
            Livewire.on('userHasDeleted',message=>{
                showNotification(message)
            })
        
            Livewire.on('discountRemovedSuccessfully',message=>{
                showNotification(message)
            })

            Livewire.on('priceWasUpdated',message=>{
                showNotification(message)
            })
            @endif
    " 
    x-cloak x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-x-8"
    x-transition:enter-end="opacity-100 transform trnaslate-x-0" x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 transform translate-x-0"
    x-transition:leave-end="opacity-0 transform translate-x-8" x-show="isOpen"
    class="fixed flex items-center justify-between min-w-[25%] rounded-lg mb-4 bg-white z-20 bottom-0 right-0 px-6 py-4 mr-4">
    <div class="flex space-x-4">
        <span class="text-green-600"><svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </span>
        <span class="font-semibold text-base text-gray-600" x-text="messageToDisplay"></span>

    </div>
    <div class="" @click="isOpen=false"><svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6 text-gray-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg></div>
</div>